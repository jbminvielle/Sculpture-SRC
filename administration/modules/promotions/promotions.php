<?php if (!isset($_GET['id'])) {
afficherIcones('annee', 'promotions', false);

}
else {
	$annee = mysql_escape_string($_GET['id']);
	
	afficherEntree('promotions', 'annee', array(''), $annee, 'annee');
}
?>