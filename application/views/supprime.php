<?php $title='Suppression du produit';
$description = 'Suppression du produit - Jarditou'; ?>
	
	<?php ob_start(); ?>	
<body>
<?php 
if (isset($erreur)) 
{
    echo $erreur;
}
?>
	<p>Numéro du produit: <?= $produits->pro_id ?></p>
	<p>Catégorie du produit:  <?= $produits->pro_cat_id ?></p>
	<p>Nom du produit: <?= $produits->pro_libelle ?></p>
	<p>Référence du produit: <?= $produits->pro_ref ?></p>
	
	
	<?php echo form_open(); ?>
		<input type="hidden" name="jeton" value="<?= $this->session->jeton ?>">
		<div class="form-group"><input class="btn btn-danger" type="submit" value="Supprimer" name="supprimer"></div>
	</form>
<?php $contenu=ob_get_clean(); ?>
<?php require 'template.php'; ?>