<?php
	//Fonction de connexion avec la base de donnée
	function ouvrirBase() { 
	mysql_connect("localhost", "root", "root");
	mysql_select_db("sculptureSrc");
	}
	
	function chercherAvis($statut) {
	//Fonction qui va chercher tout les avis pour les personnes qui ont le statut passé en paramètre (élèves, profs ou publics) dans la base de donnée.
	//Ces avis sont mis en formes en xhtml/css et afficher par la suite.
		ouvrirBase();
		
		$i=0;
									
		$requete = "SELECT A.contenu, P.prenom, P.nom FROM avis A, personnes P WHERE A.idPersonne = P.id AND P.statut='$statut'";
		$reponse = mysql_query($requete) or die(error_log(mysql_error()));
		
		while ($d = mysql_fetch_array($reponse))
		{
		if ($i==2) {echo '</tr><tr>'; $i = 0;}
		?>
		<td><?php echo $d['contenu']; ?>
		<p class="auteur"><?php echo $d['prenom'] . ' ' . $d['nom'] ?></p></td>
		<?php $i++; }
		
	}
	
?>