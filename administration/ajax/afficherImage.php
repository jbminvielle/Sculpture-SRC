<?php require('../functions.php'); require('../functionsCrud.php');


//ce fichier est appelé en Ajax et ne fait qu'effectuer une requète pour trouver une image avec son ID.
//Il afficher (retour ajax) l'adresse de la l'image

ouvrirBase();

$id = mysql_escape_string($_GET['id']); //mysql_escape_string($_GET['id']);
$reponse = mysql_query("SELECT URLmoyen FROM images WHERE id=$id") or die(error_log(mysql_error()));
$adresse = mysql_fetch_row($reponse);
echo $adresse[0];
