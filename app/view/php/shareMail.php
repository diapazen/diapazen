
<?php $this->getHeader(); ?>
        
		<div id="content">
                <h2 class="title">Confirmation de l'envoi</h2>
                <br>
                <?php
                if(isset($sent))
            	{
            		switch($sent)
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
                <br>
                <div style="text-align: center;">
                    <a class="orange_button" href="<?php echo $pollUrl; ?>">Retour vers le sondage</a>
                </div>
            </form>
        </div>

<?php $this->getFooter(); ?>