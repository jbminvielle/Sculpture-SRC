<?php 
	include ('include/hautContact.php');
?>
		<div id="corps">
			<div id="formulaire">
				<div class="titre">
					<h2>Contactez-nous !</h2>
				</div>
				<form name="formulaire" onsubmit="return verification()" method="post" action="envoi_mail.php">
					<p><input type="text" name="nom" value="Entrer votre nom" size="30" style="background-color:#ccc7c7"/><br/></p>
					<p><input type="text" name="email" size="30" value="Entrer votre e-mail" style="background-color:#ccc7c7"/><br/></p>
					<p><input type="text" name="sujet" size="30" value="Sujet du mail" style="background-color:#ccc7c7"/><br/></p>
					<p><textarea name="commentaire" rows="5" cols="40" style="background-color:#ccc7c7">Votre message</textarea></p>
					<p><input name="envoyer" type="submit" value="Envoyer" /></p>
				</form>
			</div>
			
		
<?php
	include ('include/bas.php');
?>
	