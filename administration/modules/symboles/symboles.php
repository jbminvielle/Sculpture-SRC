<?php
if (!isset($_GET['id'])) {
	afficherIcones('idPersonne', 'symboles');
}

else {
	afficherEntree('symboles', 'idPersonne', array('id', array('symboles', 'idAuteur', 'personnes', 'prenom,nom'), array('symboles', 'idImage', 'images', 'URLMoyen'), 'annee', 'coordX1', 'coordY1', 'coordX2', 'coordY2'), mysql_escape_string($_GET['id']));
}
?>