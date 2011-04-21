//Description de la sculpture

pdv = new Array();
pdv['avant'] = new Array();

pdv['avant'][0] = '1';
pdv['avant'][1] = '4';
pdv['avant'][2] = '5';
pdv['avant'][3] = '6';

pdv['arriere'] = new Array();

pdv['arriere'][0] = '7';
pdv['arriere'][1] = '8';
pdv['arriere'][2] = '9';
pdv['arriere'][3] = '10';

pdv['gauche'] = new Array();

pdv['gauche'][0] = '11';

pdv['droite'] = new Array();

pdv['droite'][0] = '12';

//initialisation
var indexPdvActif = 'avant';
var indexFaceActive = 0;

var ratio;
var coords;
var tabCoords;
var i;

$(document).ready(function() { //ON OPÈRE APRÈS LE CHARGEMENT COMPLET DU DOM


	//initialisation
	$('#face1').animate({opacity: 'show'}, 300);
	
	
	
	
	//on modifie le ratio
	$('#face1').load(function() {
		ratio = $('#face1').attr('naturalWidth')/$('#face1').attr('width');

		$('area').each(function() {
			coords = $(this).attr('coords');
			tabCoords = coords.split(',');
			
			for(i=0; i<4; i++) {
				tabCoords[i] = Math.round(tabCoords[i]/ratio);
			}
			
			$(this).attr('coords', tabCoords.join(','));		
		});
		
	});

	//Modification de la face affiché lorsque l'on clique sur un des bouton suivant
	$('#flecheAvant').click(function() {
		if (pdv[indexPdvActif].length > indexFaceActive+1) {
			indexFaceActive ++;
			afficherFace();
		}
	});
	
	
	$('#flecheArriere').click(function() {
		if (indexFaceActive > 0) {
			indexFaceActive --;
			afficherFace();
		}
	});
	
	$('#afficherDevant').click(function() {
		indexFaceActive = 0;
		indexPdvActif = 'avant';
		afficherFace();
	});
	
	$('#afficherDerriere').click(function() {
		indexFaceActive = 0;
		indexPdvActif = 'arriere';
		afficherFace();
	});
	
	$('#afficherGauche').click(function() {
		indexFaceActive = 0;
		indexPdvActif = 'gauche';
		afficherFace();
	});
	
	$('#afficherDroite').click(function() {
		indexFaceActive = 0;
		indexPdvActif = 'droite';
		afficherFace();
	});
	
	
	//POPUP--------------------------- :
	
	$('.lienFiche').click(function() {
		$.ajax({
			url: 'afficherSymbole.php?id=' + $(this).attr('title'),
			success: function(data){
				$('#popup').html(data);
				$('#popup').animate({opacity: 'show'}, 500);
				$('#cachePopup').animate({opacity: 'show'}, 400);
				
				
				
				$('a[title=fermer]').click(function() {
					$('#popup').animate({opacity: 'hide'}, 500);
					$('#cachePopup').animate({opacity: 'hide'}, 400);

				});
			}
		});
	
	
	})
});


function afficherFace() {
	$('.face').animate({opacity: 'hide'}, 300);
	$('#face'+pdv[indexPdvActif][indexFaceActive]).delay(301).animate({opacity: 'show'}, 300);
		
}