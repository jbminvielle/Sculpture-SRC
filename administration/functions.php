<?php 

//on démarrer les sessions (on en a besoin sur toutes les pages)
session_start();

//ce header permet de confirmer que l'encodage est bien ISO latin 1 (des fois il faut être un peu bourrin avec les navigateurs)
header("Content-Type: text/html; charset=ISO-8859-1");

//Le mot de passe de l'utilisateur est définit ici
$motDePasseJihel = 'Z5gj0IE9mlyDV';

if (!isset($authEnCours)) {
	//si les DEUX variables de session sont déclarés 
	if (isset($_SESSION['clef'])) {
		$auth = false;
		
		//Si la variable d'auth est bonne
		if ($_SESSION['clef'] == $motDePasseJihel) {
		$auth = true;
		}
	}
	if (!$auth) {
		header('Location: auth.php');
	}
}
				
//La fonction d'ouverture de BBD
function ouvrirBase() { 
mysql_connect("localhost", "root", "root");
mysql_select_db("sculptureSrc");
}


//fonction qui enlève les entités HTML
function unhtmlentities($chaineHtml) {
        $tmp = get_html_translation_table(HTML_ENTITIES);
        $tmp = array_flip ($tmp);
        $chaineTmp = strtr ($chaineHtml, $tmp);
 
        return $chaineTmp;
}

?>