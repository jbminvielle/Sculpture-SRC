<?php require('administration/functions.php') ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /> 
 
<title>Administration</title> 

<link rel="stylesheet" type="text/css" href="style.css" /> 

<script src="jquery.js" type="text/javascript"></script> 
<script src="main.js" type="text/javascript"></script>

</head> 
 
<body>


<p id="liensFaces"><a href="#" id="afficherDevant">Afficher de face</a>
<a href="#" id="afficherDerriere">Afficher de dos</a>
<a href="#" id="afficherDroite">Afficher à droite</a>
<a href="#" id="afficherGauche">Afficher à gauche</a>
</p>

<p id="map_sculpture">
	<?php
		ouvrirBase();
		$requete = "SELECT F.id, F.nom, I.URLmoyen FROM faces F, images I WHERE I.id = F.idImage AND F.annee='2011'";
		$reponse = mysql_query($requete) or die(error_log(mysql_error()));
		
		while ($d = mysql_fetch_array($reponse))
		{ ?>
		
			<img src="administration/<?php echo $d['URLmoyen']; ?>" alt="face" name="<?php echo $d['nom']; ?>" id="face<?php echo $d['id']; ?>" class="face" usemap="#Map<?php echo $d['id']; ?>"  />
			
			<map name="Map<?php echo $d['id']; ?>" id="Map<?php echo $d['id']; ?>">
			<?php
			
			$requeteCoords = "SELECT id, coordX1, coordY1, coordX2, coordY2 FROM symboles WHERE idFace =". $d['id'];
			$reponseCoords = mysql_query($requeteCoords) or die(error_log(mysql_error()));
			
			while ($dCoord = mysql_fetch_array($reponseCoords))
			{ ?>
				<area shape="rect" coords="<?php
					echo $dCoord['coordX1'] . ', ';
					echo $dCoord['coordY1'] . ', ';
					echo $dCoord['coordX2'] . ', ';
					echo $dCoord['coordY2']; ?>" href="#" title="<?php echo $dCoord['id']; ?>" class="lienFiche" />
			
			<?php
			}
			echo '</map>';
		}	
	?>
	
</p>

<div id="popup"></div>

</body></html>