/**
     *  VÃ©rification des mails entrï¿½s dans le champ de partage
     *  Si le mail est bon, RAS
     *  S'il n'est pas bon, l'utilisateur est prï¿½venu
     *  Dans tous les cas, on vï¿½rifie si la terminaison est correcte, et on propose ï¿½ventuellement une correction)
     **/

$(function(){
    
    //Vérification de la bonne syntaxe du mail
    $(".text_edit").keyup(function(e){
        if( (e.keyCode == 32) ||(e.keyCode == 188) ||(e.keyCode == 186) ){    //Sï¿½paration avec un espace, virgule, point virgule)
            if($(".text_edit").val().match("^[a-zA-Z0-9\-_]+[a-zA-Z0-9\.\-_]*@[a-zA-Z0-9\-_]+\.[a-zA-Z\.\-_]{1,}[a-zA-Z\-_]+", "gi")){
               $(this).css("font:2px solid green");
            }
            else{
                  $(this).css("font:2px solid red");     
            }
            
            var domains = ['hotmail.com', 'gmail.com', 'laposte.net', 'hotmail.fr', '9.fr', 'bbox.fr', 'free.fr'];
            
            //Proposition de correction s'il y a uen erreur minime'
            $(".text_edit").keyup(function(){
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