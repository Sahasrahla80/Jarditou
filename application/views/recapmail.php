<?php $title='Courriel envoyé';
$description = 'Courriel envoyé - Jarditou';?>
	
<?php ob_start(); ?>
<div class="row justify-content-center">
	<div class="col-6">
	
        <h4>Un courriel vient de vous être envoyé, avec un lien vous permettant de changer votre mot de passe.</h4> 
    
    </div>
</div>
<?php 
$contenu = ob_get_clean(); 
require 'template.php'; 
?>