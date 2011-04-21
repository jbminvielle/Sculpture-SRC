<?php 
	include ('include/haut.php');
?>
		<div id="corps">
			<div id="animationVisu">
			
			
			<p id="fleches">
					<img src="images/avant.png" id="flecheAvant" /><br />
					<img src="images/arriere.png" id="flecheArriere" />
			</p>
			
			
			<div id="liensFaces"><p><a href="#" id="afficherDevant">Afficher de face</a>
			<a href="#" id="afficherDerriere">Afficher de dos</a>
			<a href="#" id="afficherDroite">Afficher à droite</a>
			<a href="#" id="afficherGauche">Afficher à gauche</a>
			</p></div>
			
			
			<p id="map_sculpture">
				<?php
					//animation générale de la visualisation
					ouvrirBase();
					$requete = "SELECT F.id, F.nom, I.URLmoyen FROM faces F, images I WHERE I.id = F.idImage AND F.annee='2011'";
					$reponse = mysql_query($requete) or die(error_log(mysql_error()));
					//récupération des données utiles a l'affichage des faces
					while ($d = mysql_fetch_array($reponse))
					{ //Affichage des boutons de contrôles de l'animation ?>
						
						<img src="administration/<?php echo $d['URLmoyen']; ?>" alt="face" name="<?php echo $d['nom']; ?>" id="face<?php echo $d['id']; ?>" class="face" usemap="#Map<?php echo $d['id']; ?>"  />
						
						<map name="Map<?php echo $d['id']; ?>" id="Map<?php echo $d['id']; ?>">
						<?php
						//Récupération des coordonées et affichage des zones cliquables
						$requeteCoords = "SELECT id, coordX1, coordY1, coordX2, coordY2 FROM symboles WHERE idFace =". $d['id'];
						$reponseCoords = mysql_query($requeteCoords) or die(error_log(mysql_error()));
						
						while ($dCoord = mysql_fetch_array($reponseCoords))
						{ ?>
							<area shape="rect" coords="<?php
								echo $dCoord['coordX1'] . ',';
								echo $dCoord['coordY1'] . ',';
								echo $dCoord['coordX2'] . ',';
								echo $dCoord['coordY2']; ?>" href="#" title="<?php echo $dCoord['id']; ?>" class="lienFiche" />
						
						<?php
						}
						echo '</map>';
					}	
				?>
				
			</p>
			<div id="popup"></div><div id="cachePopup"></div>
			
			
			</div>
<?php
	include ('include/bas.php');
?>
	