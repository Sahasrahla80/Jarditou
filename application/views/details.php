<?php $title=$details_produit->pro_libelle.' - Jarditou';
$description = $details_produit->pro_libelle.' - Jarditou'; ?>
	
	<?php ob_start(); ?>	

	<p><?= $fil_ariane; ?> > <?= $details_produit->pro_libelle ?></p>
	<h1><?= $details_produit->pro_libelle ?></h1>
                
	<hr>
	
	<section>
    	<div class="row">
        	<article class="col-6 col-sm-6 col-md-6 col-lg-8">
            	<p>Référence : <?= $details_produit->pro_ref ?></p>
                <p id="description"><?= $details_produit->pro_description ?></p>
                <p id="prix"><?= str_replace('.',',',$details_produit->pro_prix) ?> <sup>€</sup></p>
                <p>Catégorie : <?= $details_produit->pro_cat_id ?></p>
                
                <?php 
            	if (!isset($_SESSION["login"]))  //pas de lien vers les pages de suppression et de modification si l'utilisateur n'est pas connecté
            	{ ?> 
            	
            	<span></span> 
            	
            	<?php 
            	} else if ($this->session->rôle=='administrateur') { ?>
            	
                <a href="<?= site_url('produits/modif/'.$details_produit->pro_id).'/'.$this->session->jeton ?>" class="btn btn-info" role="button">Modifier</a> 
                <a href="<?= site_url('produits/supprime/'.$details_produit->pro_id).'/'.$this->session->jeton ?>" class="btn btn-warning" role="button">Supprimer</a>  
                
                <?php } ?>
                
    		</article>
        	<aside class="col-6 col-sm-6 col-md-6 col-lg-4">
        	   <p><img class="img-fluid" alt="photo du produit" src="<?= base_url('assets/images/jarditou_photos/')?><?= $details_produit->pro_id ?>.<?= $details_produit->pro_photo ?>"></p>
        	</aside>
    	</div>
	</section> 
<?php $contenu=ob_get_clean(); ?>
<?php require 'template.php'; ?>