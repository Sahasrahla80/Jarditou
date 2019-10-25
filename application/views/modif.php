<?php $title='Modification du produit'; 
$description = 'Modification du produit - Jarditou';?>
	
	<?php ob_start(); 
	$date = date('Y-m-d H:i:s');
	?>
	<h1>Modifier le produit</h1>
	<hr>
	
	<h2>Produit à modifier :</h2>
	<h4><?= $produits->pro_libelle ?></h4>
    <p>Référence : <?= $produits->pro_ref ?></p>
    <p id="description"><?= $produits->pro_description ?></p>
    <p id="prix"><?= str_replace('.',',',$produits->pro_prix) ?> €</p>
    <p>Catégorie : <?= $produits->pro_cat_id ?></p>
        
    <hr>
    <?php echo validation_errors(); ?>
	<?php echo form_open(); ?>
		<label for="pro_cat_id">Catégorie: </label>
        	<select class="form-control" name="pro_cat_id" id="pro_cat_id">
                <?php 
                foreach ($categories as $categorie) 
                { 
                    if ($categorie->cat_id==$produits->pro_cat_id)
                    { ?>
                        <option value=<?= $produits->pro_cat_id ?> selected><?= $categorie->cat_id ?> - <?= $categorie->cat_nom ?></option>
                    <?php }
                    else 
                    { ?>
                        <option value=<?= $categorie->cat_id ?>><?= $categorie->cat_id ?> - <?= $categorie->cat_nom ?></option>
                    <?php }
                }
    			?>
    		</select><br>
    	<div class="form-group"><label for="pro_libelle">Libellé: </label><input class="form-control" type="text" name="pro_libelle" value="<?= $produits->pro_libelle ?>" id="pro_libelle"></div>
    	<?php echo form_error('pro_libelle'); ?>
    	<div class="form-group"><label for="pro_ref">Référence: </label><input class="form-control" type="text" name="pro_ref" value="<?= $produits->pro_ref ?>" id="pro_ref"></div>
    	<?php echo form_error('pro_ref'); ?>
    	<div class="form-group"><label for="pro_description">Description: </label><input class="form-control" type="text" name="pro_description" value="<?= $produits->pro_description ?>" id="pro_description"></div>
    	<?php echo form_error('pro_description'); ?>
    	<div class="form-group"><label for="pro_prix">Prix: </label><input class="form-control" type="text" name="pro_prix" value="<?= $produits->pro_prix ?>" id="pro_prix"></div>
    	<?php echo form_error('pro_prix'); ?>
    	<div class="form-group"><label for="pro_stock">Stock: </label><input class="form-control" type="text" name="pro_stock" value="<?= $produits->pro_stock ?>" id="pro_stock"></div>
    	<?php echo form_error('pro_stock'); ?>
    	<div class="form-group"><label for="pro_couleur">Couleur: </label><input class="form-control" type="text" name="pro_couleur" value="<?= $produits->pro_couleur ?>" id="pro_couleur"></div>
    	<?php echo form_error('pro_couleur'); ?>
    	<div class="form-group"><label for="pro_photo">Photo: </label><input class="form-control" type="text" name="pro_photo" value="<?= $produits->pro_photo ?>" id="pro_photo"></div>
    	<?php echo form_error('pro_photo'); ?>
    	
    	<div class="form-check">
        	<input class="form-check-input" type="checkbox" name="pro_bloque" value=1 id="bloqué">
        	<label class="form-check-label" for="bloqué">Bloqué à la vente</label>
    	</div><br>
		
		<input type="hidden" name="pro_id" value="<?= $produits->pro_id; ?>"><br>
    	<input type="hidden" name="pro_d_modif" value="<?= $date ?>">
    	<div class="form-group"><input class="btn btn-success" type="submit" value="Modifier"></div>
    	<div class="form-group"><input class="btn btn-warning" type="reset" value="Annuler"></div>
	</form>
<?php $contenu=ob_get_clean(); ?>
<?php require 'template.php'; ?>