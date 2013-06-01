jQuery(function($){

	$('#datepicker').datepicker({
		dateFormat : 'yy-mm-dd',
		minDate : 0,
		regional : 'fr'
	});

	// $("datepicker").datepicker( $.datepicker.regional[ "fr" ] );

});

/* French initialisation for the jQuery UI date picker plugin. */
/* Written by Keith Wood (kbwood{at}iinet.com.au),
              StÃ©phane Nahmani (sholby@sholby.net),
              StÃ©phane Raimbault <stephane.raimbault@gmail.com> */
jQuery(function($){
	$.datepicker.regional['fr'] = {
		closeText: 'Fermer',
		prevText: 'Précédent',
		nextText: 'Suivant',
		currentText: 'Aujourd\'hui',
		monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
		'Juillet','Aout','Septembre','Octobre','Novembre','Décembre'],
		monthNamesShort: ['Janv.','FÃ©vr.','Mars','Avril','Mai','Juin',
		'Juil.','Aout','Sept.','Oct.','Nov.','Déc.'],
		dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
		dayNamesShort: ['Dim.','Lun.','Mar.','Mer.','Jeu.','Ven.','Sam.'],
		dayNamesMin: ['D','L','M','M','J','V','S'],
		weekHeader: 'Sem.',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['fr']);
});

function manageChoices(input)
{


	switch(input.className)
	{

		case 'orange_button':


			// Le choix selectionné passe en grisé		

			input.className = 'grey_button';
			input.innerHTML = 'x';
			

			// Ajout d'un champ de choix

			choices = input.parentNode.parentNode;

			choice = document.createElement("div");
			choice.className = 'choice';
			choice.innerHTML =	'<label for="" class="lbl_choice text" ></label>' 
								+' <input class="text_edit input_choice" id="" type="text" name="choices[]" /> '
							  +	'<a class="orange_button" type="button" onclick="manageChoices(this);">+</a>';
			
			choices.appendChild(choice);
			
		break;

		case 'grey_button':

			// Suppression du champ de choix

			choices = input.parentNode.parentNode;
			choices.removeChild(input.parentNode);

		break;

		default:
			alert('error');

	}


	// Reset des label
	choices = document.getElementsByClassName('lbl_choice');

	for(i = 1; i <= choices.length; i++)
	{
	   choices.item(i-1).innerHTML = "Choix "+i;
	   choices.item(i-1).setAttribute('for', 'choix'+i);
	}

	choices = document.getElementsByClassName('input_choice');

	for(i = 1; i <= choices.length; i++)
	{
	   choices.item(i-1).setAttribute('id', 'choix'+i);
	}

}