

<?php $this->getHeader(); ?>
        
        <div id="content">
            <img id="broken_diapason" src="<?php $this->getPath('media/pictures/diapason.png'); ?>" alt="diapason" >
            <div id="text_404">
            	<p class="big_title" >Erreur 404</p>
            	<p class="title" >La page demandée n'existe pas.</p>
            	<a class="link" href="<?php $this->getHomeUrl(); ?>">Aller à la page d'accueil</a>
            </div>
        </div>

<?php $this->getFooter(); ?>
        
