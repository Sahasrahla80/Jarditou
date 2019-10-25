<?php $title='Nos produits - Jarditou'; 
$description = 'Nos produits - Jarditou' ?>
	
<?php ob_start(); 
if (isset($erreur)) { echo $erreur; }
?>
	<p id="haut_page"></p>
	<h1>Nos différents produits</h1>
	
	<p><a href="#bas_page">Bas de page</a></p>
	
	
	<div class="cartes">
	<?php 
	foreach ($liste_categorie as $valeur)
	{ ?>
	    <div class="card text-white text-center card-produit">
	    
    	    <!-- Image -->
    	    <img class="card-img" src="<?= base_url('/assets/images/jarditou_photos/'.$valeur->pro_id.'.'.$valeur->pro_photo) ?>" alt="Card image">
      		<a class="card-text" href="<?= site_url('produits/listeCategorie/'.$valeur->cat_id) ?>">
      		
      		<!-- Contenu -->
      		<div class="card-img-overlay">
      		<h3 class="btn success-color-dark text-light bouton_carte">Voir les <?= $valeur->cat_nom ?></h3>
      		
    	    </div>
    	    </a>
	    </div>
	<?php   
	}
	?>
	</div>
	<hr>
	
	<div class="ancre">
    	<p id="bas_page"></p>
    	<p><a href="#haut_page">Haut de page</a></p>
	</div>
	
<?php $contenu=ob_get_clean(); ?>
<?php require 'template.php'; ?>