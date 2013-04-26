<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo VIEW_ROOT; ?>css/orangeSoberKit.css">
        <link rel="stylesheet" type="text/css" href="<?php echo VIEW_ROOT; ?>css/diapazen.css">
        <link rel="stylesheet" type="text/css" href="<?php echo VIEW_ROOT; ?>css/home.css">
        <title>Accueil</title>
    </head>

    <body>

        <?php
            $connected = false;
            include 'header.php';
        ?>

        <div id="content">
            

            <form id="create_survey" action="">
                <input class ="orange_big_button" type="submit" value="Créer un sondage">
            </form>
            <article>
                <div class="icon_article" id="img_un">
                    <!-- <img class="img_un" src="../media/pictures/sprites_140x140.png" alt="1"> -->
                </div>
                
                <div class="text_article">
                    <h2 class="big_title">Créez votre sondage*</h2>
                    <p class="big_text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                </div>
            </article>
            <article>
                <div class="icon_article" id="img_deux">
                    <!-- <img class="img_deux" src="../media/pictures/sprites_140x140.png" alt="2"> -->
                </div>
                <div class="text_article">
                    <h2 class="big_title">Ajoutez des propositions</h2>
                    <p class="big_text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                </div>
            </article>
            <article>
                <div class="icon_article" id="img_trois">
                    <!-- <img class="img_trois" src="../media/pictures/sprites_140x140.png" alt="3"> -->
                </div>
                <div class="text_article">
                    <h2 class="big_title">Partagez-le et c'est parti !</h2>
                    <p class="big_text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                </div>
            </article>

            <p class="bold">*Créer un sondage nécessite une inscription, celle-ci peut se faire en même temps que la création de votre sondage</p>
        </div>

        <?php
            include 'footer.php';
        ?>
        
    </body>

</html>