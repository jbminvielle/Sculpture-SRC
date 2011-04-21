<?php include 'functions.php'; ?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Sculpture SRC</title>
  <meta name="author" content="SRC" />
   <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" />
  <meta http-equiv="Content-Language" content="fr" />
  <meta name="keywords" lang="fr" content=" " />
   <link rel="stylesheet" type="text/css" href="css/style.css" />
   <link rel="stylesheet" type="text/css" href="css/style_visualisation.css" />

	<script type="text/javascript" src="js/jquery.js"></script> 
	<script type="text/javascript" src="js/main.js"></script> 
	<script type="text/javascript" src="js/visualisation.js"></script> 
	<?php if (isset($accueil) AND  $accueil == true)
		echo '<script type="text/javascript" src="js/affichage_accueil.js"></script>';
	?>
			

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
		