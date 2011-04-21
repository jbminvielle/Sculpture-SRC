<?php require('../functions.php'); require('../functionsCrud.php');


//ce fichier est appelé en Ajax et ne fait qu'effectuer une requète pour trouver une l'image d'une face avec son ID.
//Il afficher (retour ajax) l'URL de l'image de la face

ouvrirBase();

$id = mysql_escape_string($_GET['id']); //mysql_escape_string($_GET['id']);
$reponse = mysql_query("SELECT I.URLmoyen FROM images I, faces F WHERE I.id=F.idImage AND F.id=$id") or die(error_log(mysql_error()));
$adresse = mysql_fetch_row($reponse);
echo $adresse[0];
