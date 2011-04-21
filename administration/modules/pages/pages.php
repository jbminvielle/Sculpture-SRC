<?php 

if (!isset($_GET['id'])) {
	afficherIcones('titre', 'pages');
}

else {
	afficherEntree('pages', 'titre', array('id', 'titre', 'contenu'),  mysql_escape_string($_GET['id']));
}
?>