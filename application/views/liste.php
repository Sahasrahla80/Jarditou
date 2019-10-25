<?php $title='Jarditou - plantes et outils pour le jardinage'; ?>
<?php $description='Tout ce dont vous avez besoin pour agrémenter et embellir votre jardin est chez Jarditou : mobilier de jardin, plantes, outils, barbecues et bien plus encore !'; ?>	
<?php ob_start(); ?>
	<h1>Tous nos articles pour votre jardin</h1>
	
	<p id="haut_page"></p>
	<p><a href="#bas_page" title="aller vers le bas de page">Bas de page</a></p>
	
	<?php 
	    if (!isset($_SESSION["login"])) //pas de lien vers la page d'ajout si l'utilisateur n'est pas connecté
    	{  ?> 
    	
    	<span></span> 
    	
    	<?php } else if ($this->session->rôle=='administrateur') { ?>
    	
		<a href="<?= site_url('produits/ajout/').$this->session->jeton ?>" class="btn btn-info" role="button" title="formulaire d'ajout d'un produit">Ajouter un produit</a>
		
	<?php }  ?>
	<hr>
	<div class="dropdown">
      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        Trier par 
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="<?= site_url('produits/liste/') ?>">Catégorie</a>
        <a class="dropdown-item" href="<?= site_url('produits/listePrixCroissants/') ?>">Prix croissants</a>
        <a class="dropdown-item" href="<?= site_url('produits/listePrixDecroissants/') ?>">Prix décroissants</a>
      </div>
    </div> 
	<table class="table table-striped table-responsive-lg">
		<thead>
    		<tr>
    			<th></th>
    			<th>Prix</th>
    			<th>Catégorie</th>
    			<th>Référence</th>
    			<th>Libellé</th>
    			<th>Bloqué à la vente</th>
    		</tr>
    	</thead>
	<?php 
	foreach ($liste_produits as $valeur)
	{ ?>
	    <tr>
	    	<td class="tableau_photo"><img class="img-fluid" src="<?= base_url('assets/images/jarditou_photos/')?><?= $valeur->pro_id ?>.<?= $valeur->pro_photo ?>"  alt="photo de l'article de jardin <?= $valeur->pro_libelle ?>" title="<?= $valeur->pro_libelle ?> - <?= $valeur->cat_nom ?>" height="75"></td>
	    	<td><?= str_replace('.',',',$valeur->pro_prix) ?> <sup>€</sup></td>
	    	<td><?= $valeur->cat_nom ?></td>
	    	<td><?= $valeur->pro_ref ?></td>
	    	<td><a class="text-info" href="<?= site_url('produits/details/'.$valeur->pro_id) ?>"><?= $valeur->pro_libelle ?></a></td>
	    <?php
		if ($valeur->pro_bloque==1) 
		{ ?>
		    <td>Oui</td>
		<?php }
		else
		{ ?>
			<td></td>
		<?php }
		?>
		</tr>
	<?php   
	}
	?>
	</table>
	<?php 
    	if (!isset($_SESSION["login"]))
    	{ ?> <span></span> <?php 
    	} else if ($this->session->rôle=='administrateur') { ?>
	<a href="<?= site_url('produits/ajout/') ?>" class="btn btn-info" role="button" title="formulaire d'ajout d'un produit">Ajouter un produit</a>
	<?php } ?>
	
	<section>
		<div class="row justify-content-center">
    		<article class="col-6 col-sm-6 col-md-6 col-lg-10">
    			<h1 class="text-center ">Le monde de Jarditou</h1>
    			<div id="accordion">
    				<div class="card card-expand-sm">
    					<h3 class="text-center card-header">
    						<a class="card-link" data-toggle="collapse" href="#collapseOne">L'entreprise</a>
    					</h3>
    				
    					<div id="collapseOne" class="collapse" data-parent="#accordion">
    						<div class="card-body .d-lg-block">
    							<p>Notre entreprise familiale met tout son savoir-faire à votre disposition dans le domaine du jardin et du paysagisme.</p>
    				
    							<p>Créée il y a 70 ans, notre entreprise vend fleurs, arbustes, matériels à main et motorisés.</p>
    				
    							<p>Implantés à Amiens, nous intervenons dans tout le département de la Somme: Albert, Doullens, Péronne, Abbeville, Corbie.</p>
    						</div>
    					</div>
    				</div>
    				
    				<div class="card card-expand-sm">
    					<h3 class="text-center card-header">
    						<a class="card-link" data-toggle="collapse" href="#collapseTwo">Qualité</a>
    					</h3>
    				
        				<div id="collapseTwo" class="collapse" data-parent="#accordion">
        					<div class="card-body .d-lg-block">
        						<p>Nous mettons à disposition un service personnalisé, avec 1 seul interlocuteur durant tout votre projet.</p>
        				
        						<p>Vous serez séduits par notre expertise, nos compétences et notre sérieux.</p>
        					</div>
        				</div>
    				</div>
    				
    				<div class="card card-expand-sm">
    					<h3 class="text-center card-header">
    						<a class="card-link" data-toggle="collapse" href="#collapseTrois">Devis gratuit</a>
    					</h3>
    					
        				<div id="collapseTrois" class="collapse" data-parent="#accordion">
            				<div class="card-body .d-lg-block">
            					<p>Vous pouvez bien sûr nous contacter pour de plus amples informations ou pour une demande d'intervention. Vous souhaitez un devis? Nous vous le réalisons gratuitement.</p>
            				</div>
        				</div>
    				</div>
    			</div>
    		</article>
		</div>
	</section>
	<p id="bas_page"></p>
	<p><a href="#haut_page" title="aller vers le haut de page">Haut de page</a></p>
<?php $contenu=ob_get_clean(); ?>
<?php require 'template.php'; ?>