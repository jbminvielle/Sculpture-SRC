<?php require('../functions.php'); require('../functionsCrud.php'); 

//Ce fichier permet d'afficher un formulaire dans une popup, via une fonction de functionsCRUD.php
//Si aucun ID n'est fourni on en fait tout de m�me un vide : il va servir pour la cr�ation.

if (!isset($_GET['id'])) { $nouveau = true; $id =-1; }
else { $nouveau = false; $id = $_GET['id']; }
?>

<div id="boutonFermerPopUp">Annuler</div>
<form>

<div id="affichagePrincipal">
	<?php if ($nouveau) echo '<h2>Ajouter un �l�ment</h2>';
	else echo '<h2>Modifier un �l�ment</h2>'; ?>
	<table>
		
		<?php
		if ($_GET['p'] == 'promotions') 
			afficherFormulaire(mysql_escape_string($_GET['p']), $id, 'annee');
		else
			afficherFormulaire(mysql_escape_string($_GET['p']), $id) ?>
			
	
	</table>
	<input type="button" name="envoyer" id="boutonEnvoyerPage" value="Envoyer"/> <input type="button" name="supprimer" id="boutonSupprimerPage" value="Supprimer"/>
</div>

<div id="affichageSpecial"></div>

	</form>
