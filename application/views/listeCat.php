<?php $title=$liste_produits[0]->cat_nom.' - Jarditou' ; 
$description = $liste_produits[0]->cat_nom.' - Jarditou'; ?>
	
<?php ob_start(); ?>
	<p id="haut_page"></p>
	<p><a href="<?= site_url('produits/liste') ?>">Accueil </a>> <a href="<?= site_url('produits/categories') ?>">Nos produits </a>> <?= $liste_produits[0]->cat_nom ?></p>
	<h1><?= $liste_produits[0]->cat_nom ?></h1>
	
	<p><a href="#bas_page">Bas de page</a></p>
	
	<?php 
	    if (!isset($_SESSION["login"])) //pas de lien vers la page d'ajout si l'utilisateur n'est pas connecté
    	{  ?> 
    	
    	<span></span> 
    	
    	<?php } else if ($this->session->rôle=='administrateur') { ?>
    	
		<a href="<?= site_url('produits/ajout/') ?>" class="btn btn-info" role="button">Ajouter un produit</a>
		
	<?php }  ?>
	<hr>
	
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
	    	<td class="tableau_photo"><img class="produit_photo" src="<?= base_url('assets/images/jarditou_photos/')?><?= $valeur->pro_id ?>.<?= $valeur->pro_photo ?>"  alt="photo du produit <?= $valeur->pro_libelle ?>" title="photo du produit <?= $valeur->pro_libelle ?>" height="75"></td>
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
	<a href="<?= site_url('produits/ajout/') ?>" class="btn btn-info" role="button">Ajouter un produit</a>
	<?php } ?>
	<p id="bas_page"></p>
	<p><a href="#haut_page">Haut de page</a></p>
<?php $contenu=ob_get_clean(); ?>
<?php require 'template.php'; ?>