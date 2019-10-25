<select id="select2_1">
    <?php 
        foreach ($liste_categories as $value) {?>
            <option value="<?= $value->cat_id ?>"><?= $value->cat_id ?> - <?= $value->cat_nom ?></option>
    <?php } 
    ?>
</select>
	