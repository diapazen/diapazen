function formCheck(form) {

    var i;
    var j;
    var valReturn = true;
    var strRegexp = {
                    "default"       :   /^.{3,}$/,
                    "choice"         :   /^.{1,}$/,
                    "date_input"    :   /^.{0}|[0-9]{4}-[0-9]{2}-[0-9]{2}$/,
                    "firstname"    :   /^[a-zA-Z\çéèêï]+[-]?[a-zA-Z\çéèêï]+$/,
                    "lastname"    :   /^[a-zA-Z\çéèêï]+[-\'\s]?[a-zA-Z\çéèêï]+$/,
                    "email"         :   /^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/
                };

    var fields = $("#"+form.id+" input, textarea");

    for(i=0; i<fields.length; i++)
    {
        if( ((fields[i].tagName == 'INPUT' && (fields[i].type == 'text'
            || fields[i].type == 'password')) 
            || fields[i].tagName == 'TEXTAREA') && getStyleProperty(fields[i], 'display') != 'none')
        {
            switch(fields[i].name) {

                case 'title_input':
                case 'description_input':
                case 'password':
                    regexp = strRegexp['default'];
                break;

                case 'date_input':
                    regexp = strRegexp['date_input'];
                break;

                case 'choices[]':
                    regexp = strRegexp['choice'];
                break;

                case 'email':
                    regexp = strRegexp['email'];
                break;

                case 'mails':
                    var reg = new RegExp("[ \n,;]+", "g");
                    var emails = fields[i].value.split(reg);
                    for (j=0; j<emails.length; j++)
                    {
                        if(!emails[j].match(strRegexp['email']))
                        {
                            valReturn = false;
                        }
                    }
                    if(!valReturn)
                    {
                        fields[i].style.borderLeft = '2px solid red';
                    }
                    else
                    {
                        fields[i].style.borderLeft = '1px solid #D0D0D0';
                    }

                    regexp = null;
                break;

                case 'firstNameUser':
                    regexp = strRegexp['firstname'];
                break;
                case 'lastNameUser':
                    regexp = strRegexp['lastname'];
                break;

                case 'newPassword':
                    if(fields[i].value.match(strRegexp['default']))
                        var newPassword = true;
                    
                    regexp = null;
                break;
                case 'passwordConfirm':
                    if(newPassword)
                        regexp = strRegexp['default'];
                    else
                    {
                        regexp = null;
                        fields[i].style.borderLeft = '1px solid #D0D0D0';
                    }
                break;

                default:
                    regexp = null;
            }

            if(regexp != null)
            {
                if(!fields[i].value.match(regexp))
                {
                    valReturn = false;
                    fields[i].style.borderLeft = '2px solid red';
                }
                else
                {
                    fields[i].style.borderLeft = '1px solid #D0D0D0';
                }
            }
        }
    }

    return valReturn;

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
