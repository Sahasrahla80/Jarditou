<?php 
$title='Ajout d\'un produit';
$description = 'Boutique - Jarditou';
?>
	
	<?php ob_start(); ?>
	
	
	<div class="row justify-content-center">
	
		<div class="col-9">
		<h1>Ajout d'un produit</h1>
		 	<?php echo form_open_multipart(); 
		 	$date = date('Y-m-d');
		 	?>
    		<div class="form-group">
            	<label for="pro_cat_id">Catégorie: </label>
            	<select class="form-control" name="pro_cat_id" id="select1">
                    <?php 
                    foreach ($liste_categories as $value) {?>
                        <option value="<?= $value->cat_id ?>"><?= $value->cat_id ?> - <?= $value->cat_nom ?></option>
                    <?php } 
                    ?>
        		</select>
        		<div id="select2"></div>
    			<div id="select3"></div>
			</div>
        	<div class="form-group"><label for="libellé">Libellé : </label><input class="form-control" type="text" name="pro_libelle" id="libellé" value="<?= set_value('pro_libelle') ?>"></div>
        	<?php echo form_error('pro_libelle'); ?>
        	<div class="form-group"><label for="référence">Référence : </label><input class="form-control" type="text" name="pro_ref" id="référence" value="<?= set_value('pro_ref') ?>"></div>
        	<?php echo form_error('pro_ref'); ?>
        	<div class="form-group"><label for="pro_description">Description : </label><input class="form-control" type="text" name="pro_description" id="pro_description" value="<?= set_value('pro_description') ?>"></div>
    		<?php echo form_error('pro_description'); ?>
    		<div class="form-group"><label for="pro_prix">Prix : </label><input class="form-control" type="text" name="pro_prix" id="pro_prix" value="<?= set_value('pro_prix') ?>"></div>
    		<?php echo form_error('pro_prix'); ?>
    		<div class="form-group"><label for="pro_stock">Stock : </label><input class="form-control" type="text" name="pro_stock" id="pro_stock" value="<?= set_value('pro_stock') ?>"></div>
    		<?php echo form_error('pro_stock'); ?>
    		<div class="form-group"><label for="pro_couleur">Couleur : </label><input class="form-control" type="text" name="pro_couleur" id="pro_couleur" value="<?= set_value('pro_couleur') ?>"></div>
    		<?php echo form_error('pro_couleur'); ?>
        	<div class="form-group"><label for="pro_photo">Photo (extensions autorisées : jpg, jpeg, png) : </label><input class="form-control" type="text" name="pro_photo" id="pro_photo" value="<?= set_value('pro_photo') ?>"></div>
        	<?php echo form_error('pro_photo'); ?>
        	<div class="form-check">
        		<input class="form-check-input" type="checkbox" name="pro_bloque" value=1 id="bloqué">
        		<label class="form-check-label" for="bloqué">Bloqué à la vente</label>
    		</div><br>
    		<div class="input-group">
    			<div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Ajouter une photo</span>
                </div>
    			<div class="custom-file">
    				<label class="custom-file-label" for="fichier_photo">(longueur maximale 350 pix, hauteur maximale 550 pix, taille maximale 100 ko)</label>
    				<input class="custom-file-input" type="file" name="photo" id="fichier_photo" value="Naviguer">
    			</div>
    		</div>
			<?php 
			if (isset($errors))
			{
			    echo $errors;
			}
			?>
			<input type="hidden" name="pro_d_ajout" value="<?= $date ?>">
        	<div class="form-group"><input class="btn btn-success" type="submit" value="Ajouter" id="envoyer"></div>
			<div class="form-group"><input class="btn btn-warning" type="reset" value="Annuler"></div>
        </form>
        </div>
     </div>
     <script src="<?= base_url("assets/js/ajax.js") ?>"></script>
<?php $contenu=ob_get_clean(); ?>
<?php require 'template.php'; ?>