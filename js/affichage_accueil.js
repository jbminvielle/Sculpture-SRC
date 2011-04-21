$(document).ready(function() { //ON OPÈRE APRÈS LE CHARGEMENT COMPLET DU DOM
	
//Animation de la page d'accueil
	$('div').each(function() {	//Affichage des divs en fondu
		$(this).css('opacity', 0);
		
		$(this).animate({opacity: '1'}, 1000);
	});
	
	$('img').each(function() {	//Puis affichage des images en fondu
		$(this).css('opacity', 0);
		
		$(this).delay(500).animate({opacity: '1'}, 1000);
	});
	
	$('#imageStatue img').each(function() {	//Affichage de l'image de sculpture
		$(this).css('opacity', 0);
		
		$(this).animate({opacity: '1'}, 300);
	});
	
	
	$('#menu a').each(function(i) {	//En enfin affichage de chaque élément du menu, en fondu, les un a la suite des autres.
		$(this).css('opacity', 0);
		
		$(this).delay(1000+i*500).animate({opacity: '1'}, 1000);
	});

});