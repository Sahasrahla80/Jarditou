<?php $title='Résultat de votre recherche - Jarditou';
$description = 'Résultat de votre recherche - Jarditou';?>
  
	<?php ob_start(); ?>
	<h1>Résultat de votre recherche</h1>
	<?php if (count($resultat_recherche)==1) { ?>
	    <p><?php echo count($resultat_recherche); ?> résultat trouvé.</p>
	<?php } 
	else if (count($resultat_recherche)>1) { ?>
		<p><?php echo count($resultat_recherche); ?> résultats trouvés.</p>
	<?php } ?>
	
	 <?php
        if (isset($erreur))
        {
            echo $erreur;
        }
        
        if (count($resultat_recherche)>0) {
    ?>
    
	<hr>
	<table class="table table-striped table-responsive-lg">
		<thead>
    		<tr>
    			<th></th>
    			<th>Prix</th>
    			<th>Catégorie</th>
    			<th>Référence</th>
    			<th>Libellé</th>
    		</tr>
    	</thead>
	<?php 
	foreach ($resultat_recherche as $valeur)
	{ ?>
	    <tr>
	    	<td class="tableau_photo"><img class="produit_photo" src="<?= base_url('assets/images/jarditou_photos/')?><?= $valeur->pro_id ?>.<?= $valeur->pro_photo ?>"  alt="photo du produit <?= $valeur->pro_libelle ?>" title="<?= $valeur->pro_libelle ?> - <?= $valeur->cat_nom ?>" height="75"></td>
	    	<td><?= str_replace('.',',',$valeur->pro_prix) ?> <sup>€</sup></td>
	    	<td><?= $valeur->cat_nom ?></td>
	    	<td><?= $valeur->pro_ref ?></td>
	    	<td><a class="text-info" href="<?= site_url('produits/details/'.$valeur->pro_id) ?>"><?= $valeur->pro_libelle ?></a></td>
	    <tr>
	<?php } ?>
	</table>
	<?php } ?>
	<?php $contenu=ob_get_clean(); ?>
<?php require 'template.php'; ?>