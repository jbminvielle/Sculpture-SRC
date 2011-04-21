<?php 
	include ('include/haut.php');
?>
	<div id="corps">
		<div id="blocTexte">
			<div class="titre">
				<h3>
<?php 
 $formNom = $_POST['nom'];
 $formEmail = $_POST['email'];
 $formSujet = $_POST['sujet'];
 $formCommentaire = $_POST['commentaire'];
 
 if(!empty($formEmail) && !empty($formNom) && !empty($formSujet) && !empty($formCommentaire)){ 
	$formCommentaire = htmlentities($formCommentaire); 
	$message = "M/Mme/Mlle $formNom vous contact via votre formulaire.\n \n  $formCommentaire \n \n Voici son e-mail : $formEmail"; 
 if( mail('m.descoudard@gmail.com',$sujet,$message) )
 {
	echo 'Les informations on bien &eacute;t&eacute; envoy&eacute;!';
 }
 else
 {
	echo 'Une erreur est survenu lors de l\'envoi du message !'; 
 } 
} 
else{ 
echo 'Un ou plusieurs champs n\'ont pas été rempli(s) !'; } 
?>
				</h3>
			</div>
		</div>
<?php 
	include ('include/bas.php');
?>
		