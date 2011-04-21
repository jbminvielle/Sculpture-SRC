<?php require('functions.php'); require('functionsCrud.php');

//les noms de page sont formatés pour correspondre aux noms de tables mais être compréhensibles
$page = $_GET['p']; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /> 
 
<title>Administration - <?php echo $page; ?></title> 

<link rel="stylesheet" type="text/css" href="style.css" /> 
<link rel="stylesheet" type="text/css" href="fileuploader/fileuploader.css" /> 
<link rel="stylesheet" type="text/css" href="imgareaselect/css/imgareaselect-animated.css" />

<script src="../js/jquery.js" type="text/javascript"></script> 
<script src="main.js" type="text/javascript"></script>
<script type="text/javascript" src="tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="imgareaselect/scripts/jquery.imgareaselect.pack.js"></script>
<script type="text/javascript" src="fileuploader/fileuploader.js"></script>
</head> 
 
<body>
	<!-- Le header du back office qui contient le module de déconnexion -->
	<div id="header">
		<div id="titreHeader">
			<p>Back office du site Sculpture SRC</p>
		</div>
		<p>Bonjour,<br />
		<a href="auth.php?deco">Déconnexion</a></p>
		
	
	</div>
	<div id="divContent">

				
	<!-- Affiche le fond du menu. -->
		<div id="fondContentLeft"></div>
		
		<div id="contentPage">
		
		<div id="contentLeft">
				<div id="menu3">
			<p>
				<!-- Le menu -->
			
					<a href="index.php?p=accueil"><table>
					<tr>
						
						<td><img src="modules/accueil/icone.png" alt="icone du module" class="iconeModule" /></td>
					</tr>
					<tr><td>Accueil</td></tr>
					</table></a>
					
					<a href="index.php?p=promotions"><table>
					<tr>
						
						<td><img src="modules/promotions/icone.png" alt="icone du module" class="iconeModule" /></td>
					</tr>
					<tr><td>Promotions</td></tr>
					</table></a>
					
					
					
					<a href="index.php?p=personnes"><table>
					<tr>
						
						<td><img src="modules/personnes/icone.png" alt="icone du module" class="iconeModule" /></td>
					</tr>
					<tr><td>Personnes</td></tr>
					</table></a>
					
					
					<a href="index.php?p=images"><table>
					<tr>
						<td><img src="modules/images/icone.png" alt="icone du module" class="iconeModule" /></td>
					</tr>
					<tr><td>Images</td></tr>
					</table></a>
					
					<a href="index.php?p=pages"><table>
					<tr>
					<td><img src="modules/pages/icone.png" alt="icone du module" class="iconeModule" /></td>
					</tr>
					<tr><td>Pages</td></tr>
					</table></a>
					
					<a href="index.php?p=actualites"><table>
					<tr>
						<td><img src="modules/actualites/icone.png" alt="icone du module" class="iconeModule" /></td>
					</tr>
					<tr><td>Avancées du projet</td></tr>
					</table></a>
					
					
					<a href="index.php?p=faces"><table>
					<tr>
						
						<td><img src="modules/faces/icone.png" alt="icone du module" class="iconeModule" /></td>
					</tr>
					<tr><td>Faces</td></tr>
					</table></a>
					
					<a href="index.php?p=symboles"><table>
					<tr>
						<td><img src="modules/symboles/icone.png" alt="icone du module" class="iconeModule" /></td>
					</tr>
					<tr><td>Symboles</td></tr>
					</table></a>
					
										
					<a href="index.php?p=avis"><table>
					<tr>
						<td><img src="modules/avis/icone.png" alt="icone du module" class="iconeModule" /></td>
					</tr>
					<tr><td>Avis</td></tr>
					</table></a>
					
					
			</p></div>
		</div>
		
			<!-- Pour nettoyer le float -->
		
		<div id="clearMenu"></div>
		
			<!-- On integre les pages avec le require -->
		
		<div id="contentRight">
		   
		    	<?php
		    		if (!isset($_GET['p'])) $page = 'accueil';
		    		if ($page == 'accueil' || $page == 'promotions' || $page == 'pages' || $page == 'symboles' || $page == 'actualites' || $page == 'avis' || $page == 'personnes' || $page == 'images' || $page == 'faces')
		    		require('modules/' . $page . '/' . $page . '.php');
		    	?>
		   </div>
		   </div>
		    	
		</div>
		
		<!-- On stocke ici le nom de la page : très utile pour le jquery. -->
		<span id="nomPage"><?php echo $page; ?></span>
		<div class="separation"></div>
	</div>
<div id="footer"></div>

<!-- Sert pour remplir la popup. Voir le fichier CSS. -->
<div id="popup"></div>


</body></html>