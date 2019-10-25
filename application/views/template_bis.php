<?php
session_start();
if (isset($_SESSION["login"]))
{
    $nom = $_SESSION["nom"];
    $prenom = $_SESSION["prenom"];
    $identifiant = $_SESSION["login"];
    setcookie('nom', $nom, time() + 24*3600,null, null, false, true);
    setcookie('prénom', $prenom, time() + 24*3600,null, null, false, true);
    setcookie('identifiant', $identifiant, time() + 24*3600,null, null, false, true);
}
?>
<!DOCTYPE html>  
<html lang="fr">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> <!-- lien vers une feuille de style bootstrap -->
        <link rel="stylesheet" href="../assets/css/stylebtsp.css">
        <link rel="icon" type="image/gif/png" href="<?= base_url("assets/images/jarditou_mini.png") ?>">
        <title><?= $title ?></title>
    </head>
    
    <body>
        <div class="container">
        <header>
    		<a href="index.php"><img alt="logo de Jarditou: homme avec brouette" src="<?= base_url("assets/images/jarditou_logo.png") ?>" title="logo jarditou" width="200" height="60"></a>
    		<p id="slogan">La qualité depuis 70 ans</p>
    		<nav id="navbar" class="navbar navbar-expand-sm navbar-solid bg-green"> 
    			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"> <!-- Bouton -->
        			<span class="line"></span> 
                	<span class="line"></span> 
                	<span class="line"></span>
    			</button>
    		<div class="collapse navbar-collapse" id="collapsibleNavbar">    <!-- Contenu qui se replie -->
    			<ul class="nav navbar-nav">
    				<li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
    				<li class="nav-item"><a class="nav-link" href="tableau.php">Tableau</a></li>
    				<li class="nav-item"><a class="nav-link" href="contactjarditou.php">Contact</a></li>
    			</ul>
    		</div>
    			<ul class="nav justify-content-end">
    			<?php 
    			if (!isset($_SESSION["login"]))
    			{ ?>
    			    <li class="nav-item"><a class="nav-link" href="inscription.php">Inscription</a></li>
    			    <li class="nav-item"><a class="nav-link" href="connexion.php">Connexion</a></li>
    			<?php }
    			else 
    			{ ?>
    			    <span class="navbar-text"><?php echo $_SESSION["prenom"].' '.$_SESSION["nom"]; ?></span>
    			    <li class="nav-item"><a class="nav-link" href="deconnexion.php">Déconnexion</a></li>
    			<?php }
    			?>
    			</ul>
    		</nav>
    	</header>
    	
    	<div id="demo" class="carousel slide" data-ride="carousel">
    
          	<!-- Indicateurs -->
          	<div class="d-none d-md-block"><ul class="carousel-indicators">
            	<li data-target="#demo" data-slide-to="0" class="active"></li>
            	<li data-target="#demo" data-slide-to="1"></li>
            	<li data-target="#demo" data-slide-to="2"></li>
          	</ul></div>
    
      		<!-- Le diaporama -->
      		<div class="carousel-inner">
        		<div class="carousel-item active">
          			<img src="assets/images/promotion.jpg" alt="Promotion" class="img-fluid" >
          			<div class="carousel-caption d-none d-lg-block">
        				<p>Des promotions de folie toute l'année</p>
      				</div>
        		</div>
        		<div class="carousel-item">
          			<img src="assets/images/outils.jpg" alt="Outils" class="img-fluid">
          			<div class="carousel-caption d-none d-lg-block">
        				<p>Des outils adaptés</p>
      				</div>
        		</div>
        		<div class="carousel-item">
         			<img src="assets/images/jardin_fleuri.jpg" alt="Jardin Fleuri" class="img-fluid" >
         			<div class="carousel-caption d-none d-lg-block">
        				<p>Pour des jardins magnifiques</p>
      				</div>
        		</div>
      		</div>
    
      		<!-- contrôles droite et gauche -->
      		<a class="carousel-control-prev" href="#demo" data-slide="prev">
        		<span class="carousel-control-prev-icon"></span>
      		</a>
      		<a class="carousel-control-next" href="#demo" data-slide="next">
        		<span class="carousel-control-next-icon"></span>
      		</a>
    	</div>
        	
        <?= $contenu ?>
        <footer class="navbar navbar-expand-sm navbar-solid bg-gris">
    		<ul class="navbar-nav">
    			<li class="nav-item"><a class="nav-link" href="#">Mentions légales</a></li>
    			<li class="nav-item"><a class="nav-link" href="#">Horaires</a></li>
    			<li class="nav-item"><a class="nav-link" href="#">Plan du site</a></li>
    		</ul>
    	</footer>
    	</div>
    	
    	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    	
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    	
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>