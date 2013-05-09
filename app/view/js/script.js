

function manageChoices(input)
{


	switch(input.className)
	{

		case 'orange_small_button':

			input.className = 'grey_small_button';
			input.value = 'x';

			choices = input.parentNode.parentNode;

			choice = document.createElement("div");
			choice.className = 'choice';
			choice.innerHTML = '<input class="text" type="text" name="choix[]" placeholder="" />'
							  +'<input class="orange_small_button" type="button" onclick="manageChoices(this);" value="+" />';
			
			choices.appendChild(choice);
			
		break;

		case 'grey_small_button':

			choices = input.parentNode.parentNode;
			choices.removeChild(input.parentNode);

		break;

		default:
			alert('error');

	}

	choices = document.getElementsByName('choix[]');

	for(i = 1; i <= choices.length; i++)
	{
	   choices.item(i-1).setAttribute('placeholder', "Choix "+i);
	}

}