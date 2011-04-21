<?php

if (!isset($_GET['id'])) afficherIcones('titre', 'actualites');

else {
	afficherEntree('actualites', 'titre', array('id', 'titre', 'contenu', 'date', 'annee'),  mysql_escape_string($_GET['id']));
}
?>