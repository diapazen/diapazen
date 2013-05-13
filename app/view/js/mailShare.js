/**
     *  Vérification des mails entr�s dans le champ de partage
     *  Si le mail est bon, RAS
     *  S'il n'est pas bon, l'utilisateur est pr�venu
     *  Dans tous les cas, on v�rifie si la terminaison est correcte, et on propose �ventuellement une correction)
     **/

$(function(){
    
    //V�rification de la bonne syntaxe du mail
    $("#small_text_edit").keyup(function(e){
        if( (e.keyCode == 32) ||(e.keyCode == 188) ||(e.keyCode == 186) ){    //S�paration avec un espace, virgule, point virgule)
            if($("#small_text_edit").val().match("^[a-zA-Z0-9\-_]+[a-zA-Z0-9\.\-_]*@[a-zA-Z0-9\-_]+\.[a-zA-Z\.\-_]{1,}[a-zA-Z\-_]+", "gi")){
                alert("adresse ok");
            }
            else{
                alert("erreur dans l'adresse");               
            }
            
            var domains = ['hotmail.com', 'gmail.com', 'laposte.net', 'hotmail.fr', '9.fr', 'bbox.fr', 'free.fr'];
            
            //Proposition de correction s'il y a uen erreur minime'
            $("#small_text_edit").keyup(function(){
                var input = $(this);
                
                input.mailcheck({
                    domains : domains,
                    suggested : function(element, suggestion){
                        input.next("span").remove(); 
                        
                        $("<span />").insertAfter(input).append("Vous vouliez dire: <a href='#'>"+suggestion.full+"</a>")
                        .find("a").click(function(e){                          
                            e.preventDefault();
                            input.val($(this).text());
                            input.trigger("keyup");
                        }); //end function(e)
                        
                    },
                    empty : function(element){
                        input.next("span").remove();
                    }
                }); //end mailcheck
                
            }); //end "textarea".keyup"
        }   //end if
    })  //end textarea.keyup
    
});