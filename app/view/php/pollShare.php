<?php $this->getHeader(); ?>

        <div id="content">
            <?php $this->getAriadneThread(); ?>
            <form id="share_form" class="default_form" method="post" action="<?php $this->getHomeUrl(); ?>/poll/sended">
                <h2 class="title">Votre sondage a bien été créé !</h2>
                <h3 class="small_title">Lien du sondage</h3>
                <label class="text" for="poll_link" >Lien</label>
                <input type="text" id="poll_link" class="text_edit" readonly onClick="this.select();" value="<?php echo $this->getHomeUrl().'/p/'.$pollUrl; ?>" />
                <h3 class="small_title">Partagez ce lien par e-mail</h3>
                <label class="text lbl_textarea" for="mails">E-mails</label>
                <textarea class="text_edit" id="mails" name="mails" placeholder="mail.example@mail.com"></textarea>
                <input class="orange_button" type="submit" value="Partager">
                <a class="orange_button" href="<?php echo $this->getHomeUrl().'/p/'.$pollUrl; ?>">Voir le sondage</a>
            </form>
        </div>

    <script src="<?php $this->getPath('js/mailcheck.js'); ?>"> </script>
    <script src="<?php $this->getPath('js/mailShare.js'); ?>"> </script>
<?php $this->getFooter(); ?>