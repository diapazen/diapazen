
<?php $this->getHeader(); ?>
        
		<div id="content">
                <h2 class="title">Confirmation de l'envoi</h2>
                
                <?php
                if(isset($sended))
            	{
            		switch($sended)
            		{
            			case 'fail':
            				echo "<div class='error_message' >Erreur lors de l'envoi de votre sondage.</div>";
            				break;

            			case 'success':
            				echo "<div class='success_message' >Votre sondage a bien été envoyé !</div>";
            				break;
            		}
            	}
                ?>

                <a class="orange_button" href="<?php echo $pollUrl; ?>">Voir le sondage</a>
            </form>
        </div>

<?php $this->getFooter(); ?>