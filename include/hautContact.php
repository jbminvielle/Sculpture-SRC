<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Sculpture SRC</title>
  <meta name="author" content="SRC" />
   <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" />
  <meta http-equiv="Content-Language" content="fr" />
  <meta name="keywords" lang="fr" content=" " />
   <link rel="stylesheet" type="text/css" href="css/style.css" />
	<script type="text/javascript" src="js/jquery.js"></script> 
	<script language="JavaScript">
  <!--
  function suivant(encours, suivant, limite)
	{
		if (encours.value.length == limite)
		document.formulaire[suivant].focus();
	}
	//Code qui vérifie si les champs du formulaire ne sont pas vide ou n'ont pas consulter leurs valeurs par défaut
  function verification()
  {
		if(document.formulaire.nom.value == "" || document.formulaire.nom.value == "Entrer votre nom" )  
			{
				alert("Veuillez entrer votre nom ! svp");
				document.formulaire.nom.focus();
				return false;				
			}
		
		else if(document.formulaire.email.value == "" || document.formulaire.email.value == "Entrer votre e-mail") 
			{
				alert("Veuillez entrer votre adresse mail ! svp");
				document.formulaire.email.focus();	
				return false;	
			}
			
			else if(document.formulaire.email.value.indexOf('@') == -1) 
			{
				alert("Votre adresse n'est pas valide ! vérifiez là svp");
				document.formulaire.email.focus();	
				return false;	
			}
			
			else if(document.formulaire.commentaire.value == "" || document.formulaire.commentaire.value == "Votre message") 
			{
				alert("Tapez votre message ! svp");
				document.formulaire.commentaire.focus();	
				return false;	
			}
			
			else if(document.formulaire.sujet.value == "" || document.formulaire.sujet.value == "Sujet du mail") 
			{
				alert("Veuillez mettre un sujet ! svp");
				document.formulaire.sujet.focus();	
				return false;	
			}
	}
//-->
  </script>

</head>
<body>
	<div id="site">
		<div id="logo">
			<a href="index.php"><img src="images/logo.png" alt="Logo Sculpture SRC"/></a>
		</div>	
		<div id="menu">
			<ol>
				<li><a href="presentation.php">Présentation générale</a></li>
				<li><a href="visualisation.php">Visualisation</a></li>
				<li><a href="etapes.php">Étapes</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ol>
		</div>
		