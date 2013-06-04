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

function initBlur()
{
    var fields = $("#content form input, textarea");
    var regexp;
    if(fields.length > 0)
    {
        for(var i=0; i<fields.length; i++)
        {
            if( ((fields[i].tagName == 'INPUT' && (fields[i].type == 'text'
                || fields[i].type == 'password')) 
                || fields[i].tagName == 'TEXTAREA')
                && fields[i].id != 'datepicker'
                && fields[i].id != 'new_pwd'
                && fields[i].id != 'new_pwd_confirm'
                && fields[i].id != 'poll_link')
            {
                
                $("#"+fields[i].id).blur(function(e) {

                    regexp = getRegexp(this);

                    if(!this.value.match(regexp) && regexp != null)
                    {
                        this.style.borderLeft = '2px solid red';
                    }
                    else if(regexp != null)
                    { 
                        this.style.borderLeft = '2px solid green';
                    }
                });
            }
        }
    }
}


function formCheck(form) {

    var i;
    var j;
    var valReturn = true;
    var regexp;

    var fields = $("#"+form.id+" input, textarea");

    for(i=0; i<fields.length; i++)
    {
        if( ((fields[i].tagName == 'INPUT' && (fields[i].type == 'text'
            || fields[i].type == 'password')) 
            || fields[i].tagName == 'TEXTAREA') && getStyleProperty(fields[i], 'display') != 'none')
        {
            regexp = getRegexp(fields[i]);

            if(regexp != null && regexp != false)
            {
                if(!fields[i].value.match(regexp))
                {
                    valReturn = false;
                    fields[i].style.borderLeft = '2px solid red';
                }
                else
                {
                    fields[i].style.borderLeft = '2px solid green';
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

var newPassword = false;
function getRegexp(element)
{

    switch(element.name)
    {

        case 'title_input':
        case 'password':
        case 'description_input':
            return strRegexp['default'];
        break;

        case 'date_input':
            return strRegexp['date_input'];
        break;

        case 'choices[]':
            return strRegexp['choice'];
        break;

        case 'email':
            return strRegexp['email'];
        break;

        case 'mails':
            var reg = new RegExp("[ \n,;]+", "g");
            var emails;
            emails = element.value.split(reg);
            var valReturn = true;

            for (j=0; j<emails.length; j++)
            {
                
                if(!emails[j].match(strRegexp['email']))
                {
                    valReturn = false;
                }
            }

            if(!valReturn)
            {
                element.style.borderLeft = '2px solid red';
            }
            else
            {
                element.style.borderLeft = '2px solid green';
            }

            return false;
        break;

        case 'firstNameUser':
            return strRegexp['firstname'];
        break;
        case 'lastNameUser':
            return strRegexp['lastname'];
        break;

        case 'newPassword':
            if(element.value.match(strRegexp['default']))
                newPassword = true;
            
            return false;
        break;
        case 'passwordConfirm':
            if(newPassword)
            {
                return strRegexp['default'];
            }
            else
            {
                return false;
            }
        break;

        default:
            return false;
    }

}

function getStyleProperty(element, styleProperty)
{
 
    var prop = "";
 
    if (element.currentStyle)
        prop = element.currentStyle[styleProperty];
    else if (window.getComputedStyle)
        prop = document.defaultView.getComputedStyle(element,null).getPropertyValue(styleProperty);
 
    return prop;
 
}
