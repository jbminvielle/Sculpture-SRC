<?php $authEnCours = true; require('functions.php');
$erreur = '';
if ($auth) header('Location: index.php');
$auth = 0;
$erreur = '';
//SI on veut se déco :
if (isset($_GET['deco'])) {
	session_destroy();
	$auth = false;
}
	
	//Si on s'est connecté :
	if (isset($_POST['nom']) && isset($_POST['mdp'])) {
		
		$nom = $_POST['nom'];
		$mdp = $_POST['mdp'];
		if ($nom == 'jihel' && $mdp == $motDePasseJihel) {
			$auth = 1;
		}
				
		if ($auth == 0) {
			$erreur = "<span id=\"erreur\">Erreur dans le nom ou le mot de passe</span>";
		}
		
		else //Si le système a détecté un cocordance de noms et mdp
		{
			//Si l'utilisateur possède cette variable il est bien authentifié
			$_SESSION['clef'] = $motDePasseJihel;
			
			header('Location: index.php');
		}	
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /> 
 
<title>Administration - Authentification</title> 

<link rel="stylesheet" type="text/css" href="auth.css" /> 
</head> 
 
<body>

<h2>Authentification à l'administration du site</h2>
<div id="auth">
<form method="post" action="auth.php">
	<table>
	  <tr>
	    <td class="label">Nom</td>
	    <td><input type="text" name="nom" id="nom" <?php if(isset($_POST['nom'])) echo 'value="' . $_POST['nom'] . '"'; ?> /><br /><small>Rentrez votre nom complet.</small></td>
	  </tr>
	 <tr>
	   <td class="label">Mot de passe</td>
	   <td><input type="password" name="mdp" id="mdp" /><br /><small>Si vous avez oublié votre mot de passe veuillez contacter l'administrateur du site.</small></td>
	 </tr>
	 <tr>
	    <td class="label"></td>
	    <td><input type="submit" value="Se connecter" /><?php echo $erreur; ?></td>
	  </tr>
	</table>
</form>
</div>
</body>

</html>