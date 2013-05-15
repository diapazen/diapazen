<?php $this->getHeader(); ?>

        <div id="content">
            <?php $this->getAriadneThread(); ?>
            <form id="share_form" class="default_form" method="post" action="sharePoll">
                <h2 class="title">Votre sondage a bien été créé !</h2>
                <h3 class="small_title">Lien du sondage</h3>
                <input type="text" class="text_edit" onClick="this.select();" value="localhost<?php $this->getHomeUrl(); ?>/poll/view/<?php echo $pollUrl; ?>" />
                <h3 class="small_title">Partagez ce lien par e-mail</h3>
                <textarea class="text_edit" name="mails" placeholder="mail.example@mail.com"></textarea>
                <input class="orange_button" type="submit" value="Partager">
                <a class="orange_button" href="<?php $this->getHomeUrl(); ?>">Retour</a>
            </form>
        </div>

<script type="text/javascript" src="../js/mailcheck.js"></script>
<script type="text/javascript" src="../js/mailShare.js"></script>

<?php $this->getFooter(); ?>