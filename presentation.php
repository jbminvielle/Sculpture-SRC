<?php 
	include ('include/haut.php');
?>
		<div id="corps">
			<div class="blocTexte">
				<div class="titre">				
					<?php
					//Affichage des objectifs depuis la base de données après connexion avec la base et récupération des données
					 ouvrirBase();
					$requete = "SELECT titre, contenu FROM pages WHERE id=6";
					$reponse = mysql_query($requete) or die(error_log(mysql_error()));
					
					while ($d = mysql_fetch_array($reponse))
					{ ?>
					<h2><?php echo $d['titre']; ?></h2>
				</div>
				<div class="texte">
					<?php echo $d['contenu']; ?>
					<?php } ?>
				</div>
			</div>
			<div class="blocTexte">
				<div class="titre">
					<h2>Le projet vu</h2>
				</div>
				<div id="avisGeneral">
					<table>
						<tr id="categories">
							<th><h3 class="afficherEleves">Par les élèves</h3></th>				
							<th><h3 class="afficherProfs">Par les enseignants</h3></th>
							<th><h3 class="afficherPublic">Par le public</h3></th>
						</tr>
					</table>
					
					<div id="avisExemple">
					<table>
						<tr>
							<td>
							<?php
							//Affichage des avis d'exemple depuis la base de données après connexion avec la base et récupération des données
							ouvrirBase();							
							$requete = "SELECT A.contenu, P.prenom, P.nom FROM avis A, personnes P WHERE A.idPersonne = P.id AND A.id=5";
							$reponse = mysql_query($requete) or die(error_log(mysql_error()));
							
							while ($d = mysql_fetch_array($reponse))
							{ ?>
							<?php echo $d['contenu']; ?>
							<p class="auteur"><?php echo $d['prenom'] . ' ' . $d['nom'] ?></p>
							<?php } ?>
							
							<p class="afficherEleves">En afficher plus</p>
							
							</td>
							<td>
							
							<?php
							ouvrirBase();							
							$requete = "SELECT A.contenu, P.prenom, P.nom FROM avis A, personnes P WHERE A.idPersonne = P.id AND A.id=6";
							$reponse = mysql_query($requete) or die(error_log(mysql_error()));
							
							while ($d = mysql_fetch_array($reponse))
							{ ?>
							<?php echo $d['contenu']; ?>
							<p class="auteur"><?php echo $d['prenom'] . ' ' . $d['nom'] ?></p>
							<?php } ?>
							<p class="afficherProfs">En afficher plus</p>
							</td>
							
							<td>
							<?php
							ouvrirBase();							
							$requete = "SELECT A.contenu, P.prenom, P.nom FROM avis A, personnes P WHERE A.idPersonne = P.id AND A.id=7";
							$reponse = mysql_query($requete) or die(error_log(mysql_error()));
							
							while ($d = mysql_fetch_array($reponse))
							{ ?>
							<?php echo $d['contenu']; ?>
							<p class="auteur"><?php echo $d['prenom'] . ' ' . $d['nom'] ?></p>
							<?php } ?>
							<p class="afficherPublic">En afficher plus</p>
							</td>
							
						</tr>
					</table>
					</div>
				</div>
				<div id="avisCategories">
				
				
					<div class="avis" id="avisEleves">
						<table>
							<tr>
								<?php 		//Affichage des avis pour la catégorie élèves
								chercherAvis('eleve'); ?>
							</tr>
						</table>
					</div>
					
					<div class="avis" id="avisProfs">
						<table>
							<tr>
								<?php //Affichage des avis pour la catégorie profs 
								chercherAvis('prof'); ?>
							</tr>
						</table>
					</div>
					
					<div class="avis" id="avisPublic">
						<table>
							<tr>
								<?php //Affichage des avis pour la catégorie public
								chercherAvis('public'); ?>
							</tr>
						</table>
					</div>
				</div>
			</div>
			
<?php
	include ('include/bas.php');
?>
	