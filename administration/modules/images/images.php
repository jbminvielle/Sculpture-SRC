<?php if (!isset($_GET['id'])) afficherIcones('nom', 'images'); 

else {
	afficherEntree('images', 'nom', array('id', 'URLpetit', 'URLMoyen', 'URLGrand'),  mysql_escape_string($_GET['id']));

}

?>