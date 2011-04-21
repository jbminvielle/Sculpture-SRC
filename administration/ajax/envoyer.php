<?php
header("Content-Type: text/html; charset=ISO-8859-1");

require_once('../functions.php');
require_once('../functionsCrud.php');


//ce fichier va envoyer les données à la BBD via une fonction de functionsCRUD.php

//Si get['id] eixte
if (isset($_GET['id'])) {

	//si il est supérieur à zéro c'est que c'est un élément existant
	if($_GET['id'] >0) {
		
		//Si on est dans la page propotion il ne faut pas oublier de préciser à la fonction que l'ID s'apelle "annee"
		if ($_GET['p'] == 'promotions') 
			modifierEntite(mysql_escape_string($_GET['p']), $_GET['id'], 'annee');
		else
			modifierEntite(mysql_escape_string($_GET['p']), $_GET['id']);
			
		//on fait un retour AJax pour l'utilisateur
		echo 'Modification effectuée';
	}
	
	else {
		//Alors c'est qu'il s'agit d'une création
		creerEntite(mysql_escape_string($_GET['p']));
		echo 'Élément ajouté';
	}
}