<?php 
	include ('include/haut.php');
?>
		<div id="corps">
			
			<div id="ancresEtapes">
				<ol>
					<?php
					//Affichage des titres d'étapes depuis la base de données après connexion avec la base et récupération des données
					ouvrirBase();							
					$requete = "SELECT id, titre, contenu, date FROM actualites WHERE annee='2011' ORDER BY date";
					$reponse = mysql_query($requete) or die(error_log(mysql_error()));
					
					while ($d = mysql_fetch_array($reponse))
					{ ?>
					<li><a href="#<?php echo $d['id'] ?>" title="Aller au contenu"><?php echo $d['titre'] ?></a></li>
					<?php } ?>

				</ol>
			</div>
			
			<div id="etapes">
			
				<?php 
				//Affichage du contenu des étapes grâce a la requêtes précédente

					$reponse = mysql_query($requete) or die(error_log(mysql_error()));
					while ($d = mysql_fetch_array($reponse))
					{ ?>
					
				<div class="blocTexte"><p><a name="<?php echo $d['id'] ?>"></a>
					<div class="titre">
						<h3><?php echo $d['titre'] ?></h3>
					</div>
					<div class="date">
						<p><?php echo $d['date'] ?></p>
					</div>
					<div class="texte">
					
				
						<?php echo $d['contenu'] ?>
					</div>
				</div>
				
				<?php } ?>
				
			</div>
			
<?php
	include ('include/bas.php');
?>
	