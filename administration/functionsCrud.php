<?php


//fonction qui affiche les icones pour une table donnée. Il affiche en nom ce qui est passé en premier argument.
function afficherIcones($champsNom, $nomTable, $idPresent=true) {
	if ($idPresent == false) { $chercherlid = ''; $id = $champsNom; }
	else { $chercherlid = 'id, '; $id = 'id'; }
	
	//Requete par défaut
	$requete = "SELECT $chercherlid $champsNom FROM $nomTable ORDER BY $champsNom";
	
	//EXEPTIONS :
	//Pour les symboles : avoir le nom des personnes :
	if ($nomTable == 'symboles') {
		$requete = "SELECT P.prenom, P.nom, S.id, I.URLPetit FROM $nomTable S, personnes P, images I WHERE S.idPersonne = P.id AND I.id = S.idImage";
	}
	
	//Pour les avis : avoir le nom des personnes :
	if ($nomTable == 'avis') {
		$requete = "SELECT P.prenom, P.nom, A.id FROM $nomTable A, personnes P WHERE A.idPersonne = P.id";
	}
	
	//Pour les images : avoir l'adresse des images :
	if ($nomTable == 'images') {
		$requete = "SELECT id, nom, URLPetit FROM images";
	}
	
	//on intègre le module de recherche
	?>
	<div id="fonctionRecherche">Recherche <input type="text" name="recherche" value="" /></div>
	<h3>Liste des <?php echo $nomTable ?></h3>
	<div id="ecranInitialIcones">
	
	<a href="#" id="boutonAjouter"><table>
	<tr>
		
		<td><img src="images/ajouter.png" alt="icone ajouter" class="icone"  /></td>
	</tr>
	<tr><td>Ajouter des <?php echo $nomTable ?></td></tr>
	</table></a>
	
	<?php ouvrirBase();
		$reponse = mysql_query($requete) or die(error_log(mysql_error())); // Requête SQL
	
	while ($donnees = mysql_fetch_array($reponse))//Boucle de résultat(s)
	{ 
	//pour chaque résultat on affiche une icone (class="tableIcone")
	
	?>		
		<a href="#z" id="boutonModifier" rel="<?php echo $donnees[$id] ?>"><table class="tableIcone">
		<tr>
			
			<td>
			
			<?php if ($nomTable == 'images' || $nomTable == 'symboles') { ?>
				<img src="<?php echo $donnees['URLPetit']; ?>" alt="icone" class="icone" />
			<?php }
			else { ?>
				<img src="modules/<?php echo $nomTable; ?>/iconeEntite.png" alt="icone" class="icone" />
			<?php } ?>
		
		</td>
		</tr>
		<tr><td id="nomIcone"><?php 
		
		//EXEPTIONS :
		if (($nomTable == 'symboles') || ($nomTable == 'avis')) 
			echo $donnees['prenom'] . ' ' . $donnees['nom'];
		
		//SINON :
		else echo $donnees[$champsNom]; ?>
		</td></tr>
		</table></a>
	<?php }
		mysql_close();
	?>
		</div>
	
<?php }


//Cette fonction affiche le formulaire pour une table donnée. On fournit aussi l'ID (false si nouveau) et le nom de l'ID si celui-ci est différent (annee pour promotion par exemple)
function afficherFormulaire($nomTable, $id, $nomId = 'id') {
	$WHERE = '';
	
	//Si l'ID n'est pas égal a false il existe et doit donc être ajouté à la condition.
	if (!$id == false) $WHERE = " WHERE $nomId=$id";
	
	ouvrirBase();
	$reponse = mysql_query("SELECT * FROM $nomTable $WHERE") or die(error_log(mysql_error()));
	$d = mysql_fetch_array($reponse);
		for($i=0;$i < mysql_num_fields($reponse);$i++){
			//Pour chaque résultat de champs on fait une ligne de tableau qui porte le même nom.
			echo '<tr name="' . mysql_field_name($reponse, $i) . '">';
			echo '<td class="label">' . mysql_field_name($reponse, $i) . '</td>';
			
			echo '<td>';
			
			//On va y ranger un imput par défaut, mais certains champs nécessitent d'être modifiés avant :
			
			//EXCEPTIONS :
			$disabled = '';
			//Si c'est un ID ou une URL on ne doit pas pouvoir le modifier : on grise la cae
			if (mysql_field_name($reponse, $i) == 'id' || mysql_field_name($reponse, $i) == 'URLpetit' || mysql_field_name($reponse, $i) == 'URLmoyen' || mysql_field_name($reponse, $i) == 'URLgrand') $disabled = 'disabled="disabled"';
			
			//Si c'est un contenu ou un commentaire, on doit pouvoir l'afficher en grand : on le transforme en textarea et on active tinymce
			if (mysql_field_name($reponse, $i) == 'contenu' || mysql_field_name($reponse, $i) == 'commentaire')
				echo '<textarea name="' . mysql_field_name($reponse, $i) . '" class="tinymce">'. $d[$i] .'</textarea>';
			
			//Sinon, si c'est un statut on ne doit afficher que les statut disponibles : select.
			else if (mysql_field_name($reponse, $i) == 'statut') {
				echo '<select name="' . mysql_field_name($reponse, $i) . '">';
				$temp = array('prof','eleve','public');
				echo '<option value=" "> </option>';
				
				foreach($temp as $type) {
					$selected = '';
					if ($d[$i] == $type) $selected = 'selected="selected"';
					else if ($type == 'eleve') $selected = 'selected="selected"';
					echo '<option value="'.$type.'" ' . $selected .'>' . $type .'</option>';
				}
				echo '</selected>';
			}
			
			
			//sinon, on vérifie grace à une rejex si c'est une clef étrangère : si c'est le cas on va aller chercher le contenu de cette table pour choisir facilement avec un select
			else if (preg_match('/id(.{2,})/', mysql_field_name($reponse, $i), $regs)) {
				$table = strtolower($regs[1]) . 's';
				$ORDERBY = '';
				//liste des nom de champs possibles
				if ($table == 'personnes')  {$champs = 'concat(nom, " " , prenom)'; $ORDERBY = 'ORDER BY nom';}
				else $champs = 'nom';
				
				
				echo '<select name="' . mysql_field_name($reponse, $i) . '">';
				echo '<option value=" "> </option>';
				$reponse2 = mysql_query("SELECT id, $champs FROM $table $ORDERBY") or die(mysql_error());
				while ($d2 = mysql_fetch_array($reponse2))//Boucle de résultat(s)
				{ 
				$selected = '';
				if ($d[$i] == $d2['id']) $selected = 'selected="selected"';
					echo '<option value="'.$d2['id'].'" ' . $selected .'>' . $d2[$champs] .'</option>';
				}
				echo '</selected>';
			}
			
			//Sinon si il s'agit d'année, c'est aussi une clef étrangère : on va chercher les années disponbibles et on les range dans l'ordre décroissant pour que l'utilisateur n'ai jamais à s'en occuper sauf quand il en crée des nouveaux.
			else if (mysql_field_name($reponse, $i) == 'annee' && $nomTable != 'promotions') {
				echo '<select name="' . mysql_field_name($reponse, $i) . '">';
				$reponse2 = mysql_query("SELECT annee FROM promotions ORDER BY annee DESC") or die(mysql_error());
				while ($d2 = mysql_fetch_array($reponse2))//Boucle de résultat(s)
				{ 
					$selected = '';
					if ($d[$i] == $d2['annee']) $selected = 'selected="selected"';
					echo '<option value="'.$d2['annee'].'" ' . $selected .'>' . $d2['annee'] .'</option>';
				}
				echo '</selected>';
			}
						
			//par défaut on fait un textinput :
			else echo '<input type="text" name="' . mysql_field_name($reponse, $i) . '" value="'. $d[$i] .'" ' . $disabled . '" />';
			
			echo '</td>';
			echo '</tr>';
		}

}

//Cette fonction modifie un élément
function modifierEntite($nomTable, $id, $nomId = 'id') {
		
	$WHICH = '';
	
	//cette boucle permet d'écrire en SQL l'update à partir des données du $_POST
	foreach($_POST as $champs => $valeur) {
		$WHICH = $WHICH . $champs . ' = "' . $valeur . '", ';
	}
	$WHICH = substr($WHICH, 0, strlen($WHICH)-2);
	
		
	ouvrirBase();

	mysql_query(utf8_decode("UPDATE $nomTable SET $WHICH WHERE $nomId = $id")) or die(error_log(mysql_error()));

}

//Cette fonction crée un élément
function creerEntite($nomTable, $nomId = 'id', $tableChamps = 'ess') {

	if ($tableChamps == 'ess') $tableChamps = $_POST;
	
	//$WHICH et $WHICH2 permettent de se conformer au SQL à partir des données de $_POST.
	$WHICH = '';
	$WHICH2 = '';
	foreach($tableChamps as $champs => $valeur) {
		$WHICH = $WHICH . $champs. ', ';
		$WHICH2 = $WHICH2 . '"' . $valeur . '", ';
	}
	$WHICH = substr($WHICH, 0, strlen($WHICH)-2);
	$WHICH2 = substr($WHICH2, 0, strlen($WHICH2)-2);
		
	ouvrirBase();

	mysql_query(utf8_decode("INSERT INTO $nomTable ($WHICH) VALUES ($WHICH2)")) or die(error_log(mysql_error()));
	
	//on retourne l'ID inséré car cela sert pour la création d'image.
	return mysql_insert_id();

}


function supprimerEntite($nomTable, $id, $nomId = 'id') {
		
	ouvrirBase();
	
	mysql_query("DELETE FROM $nomTable WHERE $nomId = $id") or die(error_log(mysql_error()));
}
