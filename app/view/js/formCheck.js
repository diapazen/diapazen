/*
 *Expressions régulières utlisées
 */
var strRegexp = {
                    "default"       :   /^(.|\n){3,}$/,
                    "choice"         :   /^.{1,}$/,
                    "date_input"    :   /^.{0}|[0-9]{4}-[0-9]{2}-[0-9]{2}$/,
                    "firstname"    :   /^[a-zA-Z\çéèêï]+[-]?[a-zA-Z\çéèêï]+$/,
                    "lastname"    :   /^[a-zA-Z\çéèêï]+[-\'\s]?[a-zA-Z\çéèêï]+$/,
                    "email"         :   /^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/
                };


$(document).ready(function() {
    initBlur();
});

/*
 *Fonction de vérification des champs
 */
function initBlur()
{
    var fields = $("#content form input, textarea");
    var regexp;
    if(fields.length > 0)
    {
        for(var i=0; i<fields.length; i++)
        {
			//Liste des champs vérifiés
            if( ((fields[i].tagName == 'INPUT' && (fields[i].type == 'text'
                || fields[i].type == 'password')) 
                || fields[i].tagName == 'TEXTAREA')
                && fields[i].id != 'datepicker'
                && fields[i].id != 'new_pwd'
                && fields[i].id != 'new_pwd_confirm'
                && fields[i].id != 'poll_link')
            {
                
                $("#"+fields[i].id).blur(function(e) {

                    regexp = getRegexp(this, "blur");
					
					//Exception pour la liste des mails pour le partage du lien
                    if(this.name != 'mails')
                    {
                        if(!this.value.match(regexp) && regexp != null)
                        {
                            this.style.borderLeft = '2px solid red';
                        }
                        else if(regexp != null)
                        { 
                            this.style.borderLeft = '2px solid green';
                        }
                        else if(regexp == null)
                        {
                            this.style.borderLeft = '1px solid #D0D0D0';
                        }
                    }
                       
                });
            }
        }
    }
}

/*
 *Fonction de vérification des formulaires
 *Lors du clic sur le bouton submit
 */
function formCheck(form) {

    var i;
    var j;
    var valReturn = true;
    var regexp;

    var fields = $("#"+form.id+" input, textarea");

    for(i=0; i<fields.length; i++)
    {
		//Liste des champs vérifiés
        if( ((fields[i].tagName == 'INPUT' && fields[i].id != 'poll_link' && (fields[i].type == 'text'
            || fields[i].type == 'password')) 
            || fields[i].tagName == 'TEXTAREA') && getStyleProperty(fields[i], 'display') != 'none')
        {
            regexp = getRegexp(fields[i], "submit");
			
			//Vérification de la regexp, exception pour la liste de mails de partage
            if(regexp != null && regexp != false && fields[i].name != 'mails')
            {
                if(!fields[i].value.match(regexp))
                {
                    fields[i].style.borderLeft = '2px solid red';
                    valReturn = false;
                    
                }
                else
                {
                    fields[i].style.borderLeft = '2px solid green';
                    valReturn = true;
                }
            }
            else if(!regexp)
            {
                valReturn = false;
            }            
        }
    }

    return valReturn;
}

var newPassword;

/*
 *Fonction de récupération des regexps 
 */
function getRegexp(element, call)
{


    // On récupère la regexp suivant le name de l'input
    switch(element.name)
    {

        case 'title_input':	//Titre	du sondage
        case 'password':	//Password
        case 'description_input':	//Description du sondage
            return strRegexp['default'];
        break;

        case 'date_input':	//Date de cloture du sondage
            return strRegexp['date_input'];
        break;

        case 'choices[]':	//Liste des choix du sondage
            return strRegexp['choice'];
        break;

        case 'email':	//Adresse mail
            return strRegexp['email'];
        break;

        case 'mails':

            // Cas spécial pour la textarea des mails à partager
            var reg = new RegExp("[ \n,;]+", "g");
            var emails;
            emails = element.value.split(reg);

            if(call == 'blur' && emails.length == 1 && emails[0] == '')
            {
                element.style.borderLeft = '1px solid #D0D0D0';
                return null;
            }
            else
            {


                for (j=0; j<emails.length; j++)
                {
                    
                    if(!emails[j].match(strRegexp['email']))
                    {   
                        element.style.borderLeft = '2px solid red';
                        return false;
                    }
                }
            
                element.style.borderLeft = '2px solid green';
                return true;
            
            }
           

        break;

        case 'firstNameUser':	//Prénom de l'utilisateur
            return strRegexp['firstname'];
        break;
        case 'lastNameUser':	//Nom de l'utilisateur
            return strRegexp['lastname'];
        break;

        case 'newPassword':		//Changement du mot de passe
            
            if(element.value == '')
                newPassword = null;
            else if(element.value.match(strRegexp['default']))
                newPassword = true;
            else
                newPassword = false;
            
            return null;
        break;
        case 'passwordConfirm':	//Confirmation de changement du mot de passe
            if(newPassword)
            {
                return strRegexp['default'];
            }
            else if(newPassword = false)
            {
               
                return false;
            }
            else
                 element.style.borderLeft = '1px solid #D0D0D0';
                
        break;

        default:
            return false;
    }

}

//Retourne le style de l'élément
function getStyleProperty(element, styleProperty)
{
 
    var prop = "";
 
    if (element.currentStyle)
        prop = element.currentStyle[styleProperty];
    else if (window.getComputedStyle)
        prop = document.defaultView.getComputedStyle(element,null).getPropertyValue(styleProperty);
 
    return prop;
 
}
