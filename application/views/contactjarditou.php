<?php $title='Contact - Jarditou';
$description = 'Contact - Jarditou'; ?>
	
	<?php ob_start(); ?>
	<div class="container">
	
    
		<section>
			<div class="row">
    
			<article  class="col-6 col-sm-6 col-md-6 col-lg-8">
				<form action="post.php" method="post"> <!--ouvre un formulaire-->
    
    				<h1>Nous lançons une grande enquête sur les anciens stagiaires</h1>
    				<h4>Merci de nous répondre</h4>
    
    				<fieldset id=coordonnées> <!--ouvre un champ du formulaire-->
						<legend>Vos coordonnées</legend>
    					<div class="form-group"><label for="nom">Votre nom: </label><input class="form-control" type="text" name="nom" id="nom" placeholder="Nom"><div id="message1"></div></div>
    					<div class="form-group"><label for="prénom">Votre prénom: </label><input class="form-control" type="text" name="prénom" id="prénom" placeholder="Prénom"><div id="message2"></div></div>
    					<div class="form-group"><label for="date">Votre date de naissance: </label><input class="form-control" type="text" name="date" id="date" placeholder="jj/mm/aaaa"><div id="message3"></div></div>
    					<div class="form-group"><label for="adresse">Votre adresse: </label><input class="form-control" type="text" name="adresse" id="adresse" placeholder="Adresse"><div id="message4"></div></div>
    					<div class="form-group"><label for="ville">Votre ville: </label><input class="form-control" type="text" name="ville" id="ville" placeholder="Ville"><div id="message5"></div></div>
    					<div class="form-group"><label for="code">Votre code postal: </label><input class="form-control" type="text" name="code" id="code" placeholder="00000"><div id="message6"></div></div>
    					<div class="form-group"><label for="mail">Votre mél: </label><input class="form-control" type="text" name="mail" id="mail" placeholder="Mèl"><div id="message7"></div></div>
					</fieldset><br>
    
    
        			<fieldset>
        				<label class="radio-inline" for="homme">Vous êtes: un homme <input type="radio" name="sexe" value="un homme" id="homme" checked></label>
        				<label class="radio-inline" for="femme">une femme <input type="radio" name="sexe" value="une femme" id="femme"></label> <!--boutons radio: même name!-->
        			</fieldset><br>
    
            		<div class="form-group"><label for="métier">Votre métier:</label>
            			<select class="form-control" name="métier" id="métier" required>
            				<option value="développeur">développeur</option>
            				<option value="webmaster">webmaster</option>
            				<option value="programmeur">programmeur</option>
            				<option value="autre">autre</option>
            			</select>
            		</div>
            		
            		<div class="form-group"><label for="précision">Si vous avez répondu autre, précisez: </label><input class="form-control" type="text" name="métier2" placeholder="Métier" id="précision"><div id="message8"></div></div>
    
            		<div class="form-group"><label for="salaire">Votre salaire:</label>
            			<select class="form-control" name="salaire" id="salaire" required>
            				<option value="<1000€"><1 000€</option>
            				<option value="1000-1500">1 000-1 500€</option>
            				<option value="1500-2000">1 500-2 000€</option>
            				<option value="2000-2500">2 000-2 500€</option>
            				<option value=">2500">>2 500€</option>
            			</select>
            		</div><br>
            		
            		<div class="form-group"><label for="date_afpa">En quelle année avez-vous suivi votre stage Afpa? </label><input class="form-control" type="text" name="date_afpa" placeholder="2000" id="date_afpa"><div id="message9"></div></div>
    
    				<div class="form-group"><textarea class="form-control" name="commentaires" id="commentaires" rows="5">Vos commentaires...</textarea></div>
    
    				<h4>Merci d'avoir répondu au questionnaire</h4>
    		
            		<div class="form-group"><input class="btn btn-success" type="submit" value="Envoyer" id="envoyer"></div>
            		<div class="form-group"><input class="btn btn-warning" type="reset" value="Annuler"></div>
        			<br>
		
				</form>
			</article>
		
    		<aside class="col-6 col-sm-6 col-md-6 col-lg-4">
    			<p>[COLONNE DROITE]</p>
    		</aside>
    		</div>
		</section>
		
	</div>
	<script src="<?= base_url("assets/js/formulaire_validation.js") ?>"></script>	
	<?php $contenu=ob_get_clean(); ?>
<?php require 'template.php'; ?>
		