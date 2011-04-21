<?php require('../functions.php'); require('../functionsCrud.php'); 

//Ce fichier permet d'afficher un formulaire dans une popup, via une fonction de functionsCRUD.php
//Si aucun ID n'est fourni on en fait tout de même un vide : il va servir pour la création.

if (!isset($_GET['id'])) { $nouveau = true; $id =-1; }
else { $nouveau = false; $id = $_GET['id']; }
?>

<div id="boutonFermerPopUp">Annuler</div>
<form>

<div id="affichagePrincipal">
	<?php if ($nouveau) echo '<h2>Ajouter un élément</h2>';
	else echo '<h2>Modifier un élément</h2>'; ?>
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
