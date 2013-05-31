
<?php $this->getHeader(); ?>
        
        <div id="content">
            <img id="broken_diapason" src="<?php $this->getPath('media/pictures/diapason_broken.png'); ?>" alt="diapason broken" >
            <div id="text_404">
            	<p class="big_title" >Erreur interne du serveur</p>
            	<p class="title" >Nous sommes désolé, une erreur critique est survenue.</p>
            	<a class="link" href="<?php $this->getHomeUrl(); ?>">Aller à la page d'accueil</a>
            </div>
        </div>

<?php $this->getFooter(); ?>