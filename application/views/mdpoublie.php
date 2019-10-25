<?php $title='Mot de passe oublié';
$description = 'Mot de passe oublié - Jarditou'; ?>
	
<?php ob_start(); ?>
<div class="row justify-content-center">
	<div class="col-6">
	<div class="text-center border border-light p-5"> 
        <?php
        if (isset($erreur))
        {
            echo $erreur;
        }
        echo form_open(); 
        ?>
        	<h3 class="h4 mb-4 text-primary">Mot de passe oublié?</h3> 
        	<p>Renseignez votre identifiant. Vous recevrez un courriel avec un lien vous permettant de définir un nouveau mot de passe.</p>
    		
    			
            	<label for="login">Identifiant :</label><input class="form-control mb-4" type="text" name="login" id="login">
            	<?php echo form_error('login'); ?>
            	
            	<input class="btn btn-outline-info btn-rounded" type="submit" name="valider" value="Valider">
        		
    		</form>
    	
    </div>
    </div>
</div>
<?php 
$contenu=ob_get_clean(); 
require 'template.php'; 
?>