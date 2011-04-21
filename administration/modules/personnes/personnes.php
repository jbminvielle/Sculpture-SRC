<?php
if (!isset($_GET['id'])) afficherIcones('concat(prenom, " " , nom)', 'personnes');


else {
	afficherEntree('personnes', 'prenom', array('id', 'prenom', 'nom', 'statut'),  mysql_escape_string($_GET['id']));

}
?>