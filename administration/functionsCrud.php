<?php


//fonction qui affiche les icones pour une table donn�e. Il affiche en nom ce qui est pass� en premier argument.
function afficherIcones($champsNom, $nomTable, $idPresent=true) {
	if ($idPresent == false) { $chercherlid = ''; $id = $champsNom; }
	else { $chercherlid = 'id, '; $id = 'id'; }
	
	//Requete par d�faut
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
	
	//on int�gre le module de recherche
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
		$reponse = mysql_query($requete) or die(error_log(mysql_error())); // Requ�te SQL
	
	while ($donnees = mysql_fetch_array($reponse))//Boucle de r�sultat(s)
	{ 
	//pour chaque r�sultat on affiche une icone (class="tableIcone")
	
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


//Cette fonction affiche le formulaire pour une table donn�e. On fournit aussi l'ID (false si nouveau) et le nom de l'ID si celui-ci est diff�rent (annee pour promotion par exemple)
function afficherFormulaire($nomTable, $id, $nomId = 'id') {
	$WHERE = '';
	
	//Si l'ID n'est pas �gal a false il existe et doit donc �tre ajout� � la condition.
	if (!$id == false) $WHERE = " WHERE $nomId=$id";
	
	ouvrirBase();
	$reponse = mysql_query("SELECT * FROM $nomTable $WHERE") or die(error_log(mysql_error()));
	$d = mysql_fetch_array($reponse);
		for($i=0;$i < mysql_num_fields($reponse);$i++){
			//Pour chaque r�sultat de champs on fait une ligne de tableau qui porte le m�me nom.
			echo '<tr name="' . mysql_field_name($reponse, $i) . '">';
			echo '<td class="label">' . mysql_field_name($reponse, $i) . '</td>';
			
			echo '<td>';
			
			//On va y ranger un imput par d�faut, mais certains champs n�cessitent d'�tre modifi�s avant :
			
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
			
			
			//sinon, on v�rifie grace � une rejex si c'est une clef �trang�re : si c'est le cas on va aller chercher le contenu de cette table pour choisir facilement avec un select
			else if (preg_match('/id(.{2,})/', mysql_field_name($reponse, $i), $regs)) {
				$table = strtolower($regs[1]) . 's';
				$ORDERBY = '';
				//liste des nom de champs possibles
				if ($table == 'personnes')  {$champs = 'concat(nom, " " , prenom)'; $ORDERBY = 'ORDER BY nom';}
				else $champs = 'nom';
				
				
				echo '<select name="' . mysql_field_name($reponse, $i) . '">';
				echo '<option value=" "> </option>';
				$reponse2 = mysql_query("SELECT id, $champs FROM $table $ORDERBY") or die(mysql_error());
				while ($d2 = mysql_fetch_array($reponse2))//Boucle de r�sultat(s)
				{ 
				$selected = '';
				if ($d[$i] == $d2['id']) $selected = 'selected="selected"';
					echo '<option value="'.$d2['id'].'" ' . $selected .'>' . $d2[$champs] .'</option>';
				}
				echo '</selected>';
			}
			
			//Sinon si il s'agit d'ann�e, c'est aussi une clef �trang�re : on va chercher les ann�es disponbibles et on les range dans l'ordre d�croissant pour que l'utilisateur n'ai jamais � s'en occuper sauf quand il en cr�e des nouveaux.
			else if (mysql_field_name($reponse, $i) == 'annee' && $nomTable != 'promotions') {
				echo '<select name="' . mysql_field_name($reponse, $i) . '">';
				$reponse2 = mysql_query("SELECT annee FROM promotions ORDER BY annee DESC") or die(mysql_error());
				while ($d2 = mysql_fetch_array($reponse2))//Boucle de r�sultat(s)
				{ 
					$selected = '';
					if ($d[$i] == $d2['annee']) $selected = 'selected="selected"';
					echo '<option value="'.$d2['annee'].'" ' . $selected .'>' . $d2['annee'] .'</option>';
				}
				echo '</selected>';
			}
						
			//par d�faut on fait un textinput :
			else echo '<input type="text" name="' . mysql_field_name($reponse, $i) . '" value="'. $d[$i] .'" ' . $disabled . '" />';
			
			echo '</td>';
			echo '</tr>';
		}

}

//Cette fonction modifie un �l�ment
function modifierEntite($nomTable, $id, $nomId = 'id') {
		
	$WHICH = '';
	
	//cette boucle permet d'�crire en SQL l'update � partir des donn�es du $_POST
	foreach($_POST as $champs => $valeur) {
		$WHICH = $WHICH . $champs . ' = "' . $valeur . '", ';
	}
	$WHICH = substr($WHICH, 0, strlen($WHICH)-2);
	
		
	ouvrirBase();

	mysql_query(utf8_decode("UPDATE $nomTable SET $WHICH WHERE $nomId = $id")) or die(error_log(mysql_error()));

}

//Cette fonction cr�e un �l�ment
function creerEntite($nomTable, $nomId = 'id', $tableChamps = 'ess') {

	if ($tableChamps == 'ess') $tableChamps = $_POST;
	
	//$WHICH et $WHICH2 permettent de se conformer au SQL � partir des donn�es de $_POST.
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
	
	//on retourne l'ID ins�r� car cela sert pour la cr�ation d'image.
	return mysql_insert_id();

}


function supprimerEntite($nomTable, $id, $nomId = 'id') {
		
	ouvrirBase();
	
	mysql_query("DELETE FROM $nomTable WHERE $nomId = $id") or die(error_log(mysql_error()));
}
