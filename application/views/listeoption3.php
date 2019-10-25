<?php
$cat=$_GET["cat_parent"];

require 'connexion_bdd.php';
$bdd=connexionBase();
$reponse=$bdd->prepare('Select cat_id,cat_nom from categories where cat_parent= ?');
$reponse->execute(array($cat));
$tableau=$reponse->fetchAll(PDO::FETCH_OBJ);

if (!empty($tableau)) {?>
    <select id="select3">
<?php }
?>
    
  

    <?php
    foreach ($tableau as $categorie) 
        { var_dump($categorie);?>
            <option value="<?php echo $categorie->cat_id; ?>" size=40><?php echo $categorie->cat_id; ?> - <?php echo $categorie->cat_nom; ?></option>
    <?php }
    ?>
    </select>