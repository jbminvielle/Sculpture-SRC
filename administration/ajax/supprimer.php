<?php
header("Content-Type: text/html; charset=ISO-8859-1");

require_once('../functions.php');
require_once('../functionsCrud.php');

//ce fichier va supprimer les donnée dans la BBD via une fonction de functionsCRUD.php

if (isset($_GET['id'])) {
	if ($_GET['p'] == 'promotions') 
		supprimerEntite(mysql_escape_string($_GET['p']), $_GET['id'], 'annee');
	else
	
		supprimerEntite(mysql_escape_string($_GET['p']), $_GET['id']);
		echo 'Suppression effectuée';
}