//on calcule la hateur du navigateur
var hauteurNavigateur = window.innerHeight;


$(document).ready(function() { //ON OPÈRE APRÈS LE CHARGEMENT COMPLET DU DOM
	
	//on récupère le nom de la page
	nomPage = $('#nomPage').text();
	
	
	//module recherche :
	//Quand on lache une touche dans le form recherche on rentre dans cette onction :
	$("input[name=recherche]").keyup(function() {
		var recherche = $("input[name=recherche]").attr('value');
		recherche = recherche.toLowerCase();//on passe en lowercase car indexOf est sensible à la casse
		
		var div;		
		var nb =  $('table.tableIcone> *').length;
		
		//Pour toutes les icones, on compare les chaines et on cache si cela correspond.
		for (var i=0; i<nb; i++) {
			div = $('table.tableIcone:eq('+i+') #nomIcone').text();
			div = div.toLowerCase();
			if (div.indexOf(recherche) == -1) {
				$('table.tableIcone:eq('+i+')').hide(150);
			}
			else $('table.tableIcone:eq('+i+')').show(150);
		}
	});
	
	
	//Quand on clique sur une icone
	$('#ecranInitialIcones a').click(function() {
		
		//Si l'icone n'est pas ajouter, on stocke l'ID dans la variable ID.
		var ID = '';
		if ($(this).attr('id') == "boutonModifier") ID = '&id=' + $(this).attr('rel');
		
		
		//On va chercher le formulaire pour remplir le popup
		$.ajax({
			url: "ajax/formulaire.php",
			data: 'p=' + nomPage + ID,
			type: 'GET',
			success: function(data){
			
				//on vide, rempli puis affiche la popup
				$('#popup').empty();
				$('#popup').append(data);
				$('#popup').animate({opacity: 'show'}, 200);
				
				//on active le WYSIWYG :
				setFormTinymce();
								
				//Fonction des boutons
				$('#boutonFermerPopUp').click(function() {
					$('#popup').animate({opacity: 'hide'}, 300);
					$('#popup + div').remove();
					$('.imgareaselect-outer').remove();
				});
				
				//Pour le bouton envoyer
				$('#boutonEnvoyerPage').click(function() {
				
					//on enlève le statut de disabled sinon le serialize les prend pas en compte :
					$('input[disabled=disabled]').removeAttr('disabled');
					$.ajax({
						url: 'ajax/envoyer.php?p=' + nomPage + "&id=" + $('input[name=id]').attr('value'),
						data: $('form').serialize(),
						type: 'POST',
						success: function(data){ $('#popup').animate({opacity: 'hide'}, 300); window.location.reload(false); }
					});
				});	
				
				//Pour le champs supprimer
				$('#boutonSupprimerPage').click(function() {
				
					//On demande d'abord si la personne veux bien supprimer le champs :
					var supprimer = confirm("Êtes vous certain de bien vouloir supprimer ceci ?");
					var id = $('input[name=id]').attr('value');
					if (id == undefined) id = $('input[name=annee]').attr('value');
					
					if (supprimer) {
						$.ajax({
							url: 'ajax/supprimer.php?p=' + nomPage + "&id=" + id,
							data: $('form').serialize(),
							type: 'POST',
							success: function(data){ alert(data); $('#popup').animate({opacity: 'hide'}, 300); window.location.reload(false);}
						});
					}
				});	
				
				
				
				//AFFICHAGES SPÉCIAUX (À DROITE) ------------------------------
				
				//Chaques panneaux peut comporter des affichages spéciaux, à droite des champs classiques.
				
				if (nomPage == 'images') {
					//On affiche l'aperçu de l'image et l'uploader
					$('#affichageSpecial').html('<h4>Aperçu de &laquo; <span class="nomImage">'+$("input[name=nom]").attr('value')+'</span> &raquo;</h4><p><img src="'+$("input[name=URLmoyen]").attr('value')+'" id="apercuImage" /></p><h4>Ajouter/remplacer l\'image</h4><div id="boutonUp"><noscript><p>Please enable JavaScript to use file uploader.</p></noscript></div>');
					
					//On charge l'uplodaer et on active la modification en live des champs
					chargerUploader();
					changerLesChamps();
					
				}



				if (nomPage == 'symboles') {
				
					//On affiche le module de localisation, l'aperçu du symbole et l'uploader
					$('#affichageSpecial').html('<h4>Localisation du symbole</h4><div id="localisation"><img src="" id="sculpture" /></div><h4>Image du symbole</h4><p><img src="" id="apercuSymbole" /><h4>Ajouter/remplacer le symbole</h4><div id="boutonUp"><noscript><p>Please enable JavaScript to use file uploader.</p></noscript></div><small>Ce bouton ajoutera une image dans la section Images</small></p>');
				
					//on va chercher le symboel
					afficher('symbole');

					//On charge l'uplodaer et on active la modification en live des champs
					//true signifie qu'on modifie le champs du symbole					
					chargerUploader(true);
					changerLesChamps();
					
					
					//Module de sélection de la localisation
					//affichage de la face :
					afficher('face');
					
					//On met la sélection de la face au dessus du module de localisation sinon c'est le bordel ergonomique international
					$('#localisation').prepend($('select[name=idFace]')).prepend('Face : ');
					$('tr[name=idFace]').empty();
					
					var ratio; //C'est pour le ration taille réelle image sur taille affichée
					//Le module ne s'affiche qu'après une image chargée (dans la fonction afficher('face')
				}
				
				
				
				
				if (nomPage == 'faces') {
					
					//Pour aider les développeurs du front-office on génère la requète SQL de la face.
					var requeteSQL = 'SELECT F.id, F.nom, I.URLmoyen FROM faces F, images I WHERE I.id = F.idImage AND F.id='+$('input[name=id]').attr('value');
					
					//On affiche l'aperçu de la face, l'uploader et la requète SQL ci-dessus.
					$('#affichageSpecial').html('<h4>Aperçu de la face</h4><p><img src="" id="apercuFace" /></p><h4>Ajouter/remplacer l\'image</h4><div id="boutonUp"><noscript><p>Please enable JavaScript to use file uploader.</p></noscript></div><h4>Requête SQL pour le front-office</h4><p>'+requeteSQL+'</p>');
				
					//On affiche la face, on charge l'uplodaer et on active le changement en live des champs.
					afficher('face');
					chargerUploader();
					changerLesChamps();
				}
				
				if (nomPage == 'pages') {
					//Pour aider les développeurs du front-office on génère la requète SQL de la page.
					var requeteSQL = 'SELECT titre, contenu FROM pages WHERE id='+$('input[name=id]').attr('value');
					$('#affichageSpecial').html('<h4>Requête SQL pour le front-office</h4><p>'+requeteSQL+'</p>');				
				}
				
				if (nomPage == 'actualites') {
					//Pour aider les développeurs du front-office on génère la requète SQL de l'actualité.
					var requeteSQL = 'SELECT titre, contenu, date FROM actualites WHERE id='+$('input[name=id]').attr('value');
					$('#affichageSpecial').html('<h4>Requête SQL pour le front-office</h4><p>'+requeteSQL+'</p>');				
				}
				
			}
		});	
		
	});	
		
});//FIN du chargement complet du dom


//Pour le formulaire en wisiwig : voir documentation de tiny_mce
function setFormTinymce() {
	$('textarea.tinymce').tinymce({
		// Location of TinyMCE script
		script_url : 'tiny_mce/tiny_mce.js',

		// General options
		theme : "advanced",
		theme_advanced_layout_manager: "SimpleLayout",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,bullist,numlist,link,unlink,image",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		
		
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		//theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "style.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
}

//pour charger l'uploader
function chargerUploader(symbole) {

	if (symbole==undefined) symbole = false;//Paramètre par défaut : grosse bidouille en javascript

	//On charge l'uploader
	var uploader = new qq.FileUploader({
	    element: document.getElementById('boutonUp'),
	    action: 'fileuploader/up.php?p='+nomPage,
	    debug: false,
	    
	    onComplete: function(id, fileName, responseJSON){
	    	
	    	if (nomPage == 'images') {
	    		//On est dans le module images : on doit ajouter l'adresse dans les champs
		    	$('input[name=URLpetit]').attr('value', responseJSON.URLpetit);
		    	$('input[name=URLmoyen]').attr('value', responseJSON.URLmoyen);
		    	$('input[name=URLgrand]').attr('value', responseJSON.URLgrand);
		    	
		    	
		    	//De plus si l'utilisateur n'a pas déjà rentré de nom, on lui propose le nom.
		    	if ($('input[name=nom]').attr('value') == '') {
		    		$('input[name=nom]').attr('value', responseJSON.nom);
		    		$('input[name=nom]').select();
		    	}
		    	
		    	$('.nomImage').text($('input[name=nom]').attr('value'));	
		    	$('img#apercuImage').attr('src', responseJSON.URLmoyen);
	    	}
	    	
	    	else if (nomPage == 'faces') {
	    		//C'est la face qu'on doit changer
	    		$('select[name=idImage]').append(new Option(responseJSON.nom, responseJSON.id, true, true));
	    		
	    		$('img#apercuFace').attr('src', responseJSON.URLmoyen);
	    	}
		    
		    else if (symbole) {
		    	//C'est le symbole qu'on doit changer
		    	$('select[name=idImage]').append(new Option(responseJSON.nom, responseJSON.id, true, true));
		    	
		    	$('img#apercuSymbole').attr('src', responseJSON.URLmoyen);
		    }
	    }
	    
	});
}


//pour activer le changement dynamique des champs suivants
function changerLesChamps() {
	//le nom dans le module image
	$('input[name=nom]').keyup(function() {
		$('.nomImage').text($('input[name=nom]').attr('value'));	
	});
	
	//l'aperçu de l'image dans le module image
	$('input[name=URLmoyen]').change(function() {
		$('img#apercuImage').attr('src', responseJSON.URLmoyen);	
	});
	
	//l'aperçu du symbole ou de la face
	$('select[name=idImage]').change(function() {
		if (nomPage=='symboles') afficher('symbole');
		if (nomPage=='faces') afficher('face');
	});
	//l'affichage de la face dans symboles
	$('select[name=idFace]').change(function() {
		afficher('face');
	});
	
	
}

//fonction  qui va chercher les ULR grace à des ID : voir les deux fichiers dans le dossier Ajax
function afficher(quoi) {

	if (quoi=='symbole') {
		//affichage du symbole :
		$.ajax({
			url: 'ajax/afficherImage.php?id=' + $('select[name=idImage]').attr('value'),
			success: function(data){
				$('#apercuSymbole').attr('src', data);							
			}
		});
	}
	
	else if (quoi=='face') {
		//affichage de la face :
		
		if (nomPage == 'symboles') {
			$.ajax({
				url: 'ajax/afficherFace.php?id=' + $('select[name=idFace]').attr('value'),
				success: function(data){
					$('#sculpture').attr('src', data);
					afficherModuleLocalisation();
				}
			});
		}
		
		if (nomPage == 'faces') {
			$.ajax({
				url: 'ajax/afficherImage.php?id=' + $('select[name=idImage]').attr('value'),
				success: function(data){
					$('#apercuFace').attr('src', data);
				}
			});
			
		}
	
	}
}

//chargement du module localisation 
function afficherModuleLocalisation() {

	//on détermine le ratio de l'image pour avoir des coordonnées justes
	ratio = $('#sculpture').attr('naturalWidth')/$('#sculpture').attr('width');
	
	
	//on charge le plu-in
	$('#sculpture').imgAreaSelect({
		handles: true,
		x1: Math.round($('input[name=coordX1]').attr('value')/ratio),
		x2: Math.round($('input[name=coordX2]').attr('value')/ratio),
		y1: Math.round($('input[name=coordY1]').attr('value')/ratio),
		y2: Math.round($('input[name=coordY2]').attr('value')/ratio),
		onSelectEnd: function (img, selection) {
		           $('input[name=coordX1]').val(Math.round(selection.x1*ratio));
		           $('input[name=coordY1]').val(Math.round(selection.y1*ratio));
		           $('input[name=coordX2]').val(Math.round(selection.x2*ratio));
		           $('input[name=coordY2]').val(Math.round(selection.y2*ratio)); }    
		});       
}