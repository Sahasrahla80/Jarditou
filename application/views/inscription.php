<?php $title='Inscription - Jarditou';
$description = 'Inscription - Jarditou'; ?>
  
<?php ob_start(); ?>

    <div class="row justify-content-center">
	<div class="col-lg-6 col-md-8">
    	<div class="text-center border border-light p-5">
        <?php 
        if (isset($erreur)) 
        {
            echo $erreur;
        } ?>
        
        <h3 class="h4 mb-4 text-primary">Pas encore inscrit? Inscrivez-vous</h3>
        <?php echo form_open_multipart(); ?>
            
                <label for="nom">Nom :</label><input class="form-control mb-4" type="text" name="nom" id="nom">
                <?php echo form_error('nom'); ?>
                <label for="prénom">Prénom :</label><input class="form-control mb-4" type="text" name="prenom" id="prénom">
                <?php echo form_error('prenom'); ?>
                <label for="login">Identifiant (votre adresse mail) :</label><input class="form-control mb-4" type="text" name="login" id="login">
                <?php echo form_error('login'); ?>
                <label for="mot_de_passe">Mot de passe (entre 8 et 20 caractères) :</label><input class="form-control mb-4" type="password" name="mot_de_passe" id="mot_de_passe">
                <?php echo form_error('mot_de_passe'); ?>
                <label for="mot_de_passe_confirme">Confirmez le mot de passe :</label><input class="form-control mb-4" type="password" name="mot_de_passe_confirme" id="mot_de_passe">
                <?php echo form_error('mot_de_passe_confirme'); ?>
                <input class="btn btn-outline-info btn-rounded" type="submit" name="valider" value="Valider">
        	
    	</form>
    	<p>Déjà membre? <a href="<?= site_url("utilisateur/connexion/") ?>">Se connecter</a></p>
    	</div>
    </div>
    </div>
    <?php $contenu=ob_get_clean(); ?>
<?php require 'template.php'; ?>