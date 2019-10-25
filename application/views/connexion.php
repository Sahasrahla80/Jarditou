<?php $title='Connexion - Jarditou'; 
$description = 'Connexion - Jarditou'; ?>
  
	<?php ob_start(); ?>
	<div class="row justify-content-center">
    	<div class="col-lg-6 col-md-8">
        	<div class="text-center border border-light p-5"> 
                <?php
                if (isset($erreur))
                {
                    echo $erreur;
                }
                if (isset($confirmation))
                {
                    echo $confirmation;
                }
                echo form_open(); 
                ?>
            		
            		<h3 class="h4 mb-4 text-primary">Déjà inscrit? Connectez-vous</h3>
            		
            			<label for="login">Identifiant :</label><input class="form-control mb-4" type="text" name="login" id="login">
                    	<?php echo form_error('login'); ?>
                    	
                    	<label for="mot_de_passe">Mot de passe :</label><input class="form-control mb-4" type="password" name="mot_de_passe" id="mot_de_passe">
                    	<?php echo form_error('mot_de_passe'); ?>
                    	
                		<input class="btn btn-outline-info btn-rounded" type="submit" name="valider" value="Valider">
                		
                	</form>
                	
            	<p><a href="<?= site_url("utilisateur/mdpoublie/") ?>">Mot de passe oublié?</a></p>
            	<p>Pas encore membre? <a href="<?= site_url("utilisateur/inscription/") ?>">S'inscrire</a></p>
            </div>
        </div>
    </div>
    <?php $contenu=ob_get_clean(); ?>
<?php require 'template.php'; ?>
    


