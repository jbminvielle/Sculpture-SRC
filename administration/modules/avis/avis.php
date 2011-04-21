<?php 
if (!isset($_GET['id'])) afficherIcones('concat(prenom, " " , nom)', 'avis');


else {
	afficherEntree('avis', 'idPersonne', array('id', array('avis', 'idPersonne', 'personnes', 'prenom,nom'),'contenu'),  mysql_escape_string($_GET['id']));

}

?>