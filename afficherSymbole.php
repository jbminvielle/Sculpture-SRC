<?php require 'functions.php'; header("Content-Type: text/html; charset=ISO-8859-1");
 ?>

<p id="fermerPopup"><a href="#" title="fermer">Fermer la fenêtre</a></p>

<?php ouvrirBase();
$id = mysql_escape_string($_GET['id']);

$requete = "SELECT S.commentaire, P.prenom, P.nom, I.URLmoyen FROM symboles S, personnes P, images I WHERE S.idPersonne = P.id AND S.idImage = I.id AND S.id=$id";
$reponse = mysql_query($requete) or die(error_log(mysql_error()));

while ($d = mysql_fetch_array($reponse))
{ ?>
	<img src="administration/<?php echo $d['URLmoyen'] ?>" alt="symbole" class="symbole" />
	<h4>Symbole de <?php echo $d['prenom'] . ' '. $d['nom'] ?></h4>
	
	<div class="contenuFiche"><?php echo $d['commentaire'] ?></div>
	
<?php } ?>