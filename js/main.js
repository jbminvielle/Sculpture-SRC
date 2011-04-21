$(document).ready(function() { //ON OPÈRE APRÈS LE CHARGEMENT COMPLET DU DOM

//Le terme masqué utilisé ci dessous signifie réduire la hauteur a 1pixel, donnant l'impression de masquer l'élément
//lorsqu'on clique sur une catégorie d'avis, les 3 avis d'exemple sont masqué	
	$('.afficherEleves, .afficherProfs, .afficherPublic').click(function() {
		$('#avisExemple').animate({'height': 1}, 500);
	});
	
	//On récupère la hauteur par défaut des divs "avis par catégories"
	tailleAvisEleves = $('#avisEleves').height();
	$('#avisEleves').animate({'height': 1}, 1);
	
	tailleAvisProfs = $('#avisProfs').height();
	$('#avisProfs').animate({'height': 1}, 1);
	
	tailleAvisPublic = $('#avisPublic').height();
	$('#avisPublic').animate({'height': 1}, 1);
	
	//Des qu'on click sur une catégories d'avis, la div correspondante récupère sa valeurs par défaut et les autres sont masquées
	$('.afficherEleves').click(function() {
		$('#avisEleves').animate({'height': tailleAvisEleves}, 500);
		$('#avisProfs').animate({'height': 1}, 500);
		$('#avisPublic').animate({'height': 1}, 500);
	});
	
	$('.afficherProfs').click(function() {
		$('#avisProfs').animate({'height': tailleAvisProfs}, 500);
		$('#avisPublic').animate({'height': 1}, 500);
		$('#avisEleves').animate({'height': 1}, 500);
	});
	
	$('.afficherPublic').click(function() {
		$('#avisPublic').animate({'height': tailleAvisPublic}, 500);
		$('#avisProfs').animate({'height': 1}, 500);
		$('#avisEleves').animate({'height': 1}, 500);
	});
	
	
	//Ce code permet de réaliser les animations de la page étapes avec le défilement de la page lorsque l'on clique sur une étape, jusqu'a l'étape associée.
	$('a[href*=#]')
	    .not('a[href=#]')
	    .bind('click', function() {
	      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	        var $target = $(this.hash);
	        $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
	        if ($target.length) {
	          var targetOffset = $target.offset().top;
	          $('html,body').animate({scrollTop: targetOffset}, "normal");
	          return void(0);
	     }
	   }});

});