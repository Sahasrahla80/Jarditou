<?php
$title='Erreur';
$description = 'Page d\'erreur - Jarditou'; ?>
	
<?php ob_start(); ?>
<div class="row justify-content-center">
	<div class="col-6">
	<div class="text-center border border-light p-5"> 
       
       <?= $erreur ?> 
        	
    </div>
    </div>
</div>
<?php 
$contenu=ob_get_clean(); 
require 'template.php'; 
?>