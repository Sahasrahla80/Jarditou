<?php $title='Changer de mot de passe'; 
$description = 'Changer de mot de passe - Jarditou'; ?>
	
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
        	<h3 class="h4 mb-4 text-primary">Nouveau mot de passe</h3> 
        	<p>Vous pouvez maintenant définir le nouveau mot de passe de votre compte, avant de vous connecter.</p>
    		
    			
            	<label for="mot_de_passe">Nouveau mot de passe :</label><input class="form-control mb-4" type="password" name="mot_de_passe" id="mot_de_passe">
            	<?php echo form_error('mot_de_passe'); ?>
            	<label for="mot_de_passe_confirme">Confirmez le nouveau mot de passe :</label><input class="form-control mb-4" type="password" name="mot_de_passe_confirme" id="mot_de_passe">
                <?php echo form_error('mot_de_passe_confirme'); ?>
            	<input class="btn btn-outline-info btn-rounded" type="submit" name="valider" value="Valider">
        		
    		</form>
    	
    </div>
    </div>
</div>
<?php 
$contenu=ob_get_clean(); 
require 'template.php'; 
?>