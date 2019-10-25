<!DOCTYPE html>  
<html lang="fr-FR">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="<?= $description ?>"> 
		<meta name="keywords" content="jardinage, outils, plantes, jardin, semis, brouettes"> 
		<meta name="robots" content="index, follow">
		
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> <!-- lien vers une feuille de style bootstrap -->
        <link rel="stylesheet" href="<?= base_url("assets/css/stylebtsp.css") ?>">
        <link rel="stylesheet" href="<?= base_url("assets/css/css/all.css") ?>">
        <link rel="stylesheet" href="<?= base_url("assets/css/css/bootstrap.min.css") ?>">
        <link rel="stylesheet" href="<?= base_url("assets/css/css/mdb.min.css") ?>">
        <link rel="stylesheet" href="<?= base_url("assets/css/css/style.css") ?>">
        <link rel="icon" type="png" href="<?= base_url("assets/images/jarditou_mini.png") ?>">
        <script src="<?= base_url("assets/js/jquery.js") ?>"></script>
        <title><?= $title ?></title>
        <meta property="og:title" content="<?= $title ?>">
    </head>
    
    <body>
    	<header>
            <div class="container">
        		<a href="<?= site_url("produits/liste/") ?>"><img alt="logo de Jarditou: homme avec brouette" src="<?= base_url("assets/images/jarditou_logo.png") ?>" title="Jarditou" width="200" height="60"></a>
        		<div class="texte_header">
            		<p id="slogan">La qualité depuis 70 ans</p>
            		
    			</div>
        	</div>
    	</header>	
    	<nav id="navbar" class="navbar navbar-expand-sm navbar-solid bg-grey"> 
    		<div class="container">
        		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"> <!-- Bouton -->
            		<span id="ligne1" class="blackline"></span> 
                    <span id="ligne2" class="blackline"></span> 
                    <span id="ligne3" class="blackline"></span>
        		</button>
            	<div class="collapse navbar-collapse" id="collapsibleNavbar">    <!-- Contenu qui se replie -->
            		<ul class="nav navbar-nav">
            			<li class="nav-item"><a class="nav-link" href="<?= site_url("produits/liste/") ?>" title="accueil du site">ACCUEIL</a></li>
            			<li class="nav-item"><a class="nav-link" href="<?= site_url("produits/tableau/") ?>" title="tableau des ventes">TABLEAU</a></li>
            			<li class="nav-item"><a class="nav-link" href="<?= site_url("produits/contactjarditou/") ?>" title="formulaire de sondage">CONTACT</a></li>
            			<li class="nav-item"><a class="nav-link" href="<?= site_url("boutique/listeBoutique/") ?>" title="liste des articles disponibles à l'achat">BOUTIQUE</a></li>
            			<li class="nav-item"><a class="nav-link" href="<?= site_url("produits/categories/") ?>" title="liste des articles pour le jardin">NOS PRODUITS</a></li>
            		</ul>
            		<div class="form-inline mr-auto">
            		
                		<?= form_open('produits/recherche') ?>
                    		<div>
                  				<input class="form-control" type="text" placeholder="Rechercher" aria-label="Search" name="recherche">
                			</div>
            			</form>
        			</div>
            		
                <?php 
                if (!isset($_SESSION["login"]))
                { ?>
                </div>
                	<div id="utildropdown" class="nav-item dropdown  noir">
                       <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fas fa-user"></i>
                       </a>
                       <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                           <a class="dropdown-item" href="<?= site_url("utilisateur/inscription/") ?>" title="création d'un compte Jarditou">Inscription</a>
                           <a class="dropdown-item" href="<?= site_url("utilisateur/connexion/") ?>" title="connexion au compte Jarditou">Connexion</a>
                       </div>
                </div>
                       
                <?php }
                else 
                { ?>
                	
                	<ul class="nav navbar-nav">
                    	<li class="nav-item">
                    		<a class="nav-link panier" href="<?= site_url("boutique/affiche/") ?>" title="produits ajoutés au panier">PANIER (<?= $this->session->panier==null?0:count($this->session->panier) ?>)</a>
                    	</li>
                	</ul>
                </div>		
                <div id="utildropdown" class="nav-item dropdown noir">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                        <a class="dropdown-item" href="<?= site_url("utilisateur/deconnexion/") ?>" title="déconnexion du compte Jarditou">Déconnexion</a>
                        <a class="dropdown-item" href="<?= site_url("utilisateur/compte/").$this->session->jeton ?>" title="informations du compte"><?php echo $_SESSION["prenom"].' '.$_SESSION["nom"]; ?></a>
                    </div>
                </div>
                		
                <?php }  ?>
            </div>
    	</nav>
    		
    	
    	
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
          			<img src="<?= base_url("assets/images/panier_legumes.jpg") ?>" alt="Promotion" class="img-fluid" >
          			<div class="carousel-caption d-none d-lg-block">
        				<p>Des plantes de toutes sortes</p>
      				</div>
        		</div>
        		<div class="carousel-item">
          			<img src="<?= base_url("assets/images/outils.jpg") ?>" alt="Outils" class="img-fluid">
          			<div class="carousel-caption d-none d-lg-block">
        				<p>Des outils adaptés</p>
      				</div>
        		</div>
        		<div class="carousel-item">
         			<img src="<?= base_url("assets/images/jardin_fleuri.jpg") ?>" alt="Jardin Fleuri" class="img-fluid" >
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
        <div class="container">	
        <?= $contenu ?>
        </div>
        
        <footer class="navbar navbar-expand-sm navbar-solid bg-gris">
    		<div class="container">
        		<ul class="navbar-nav">
        			<li class="nav-item"><a class="nav-link" href="#">Mentions légales</a></li>
        			<li class="nav-item"><a class="nav-link" href="#">Horaires</a></li>
        			<li class="nav-item"><a class="nav-link" href="#">Plan du site</a></li>
        		</ul>
    		</div>
    	</footer>
    	
     	
    	<!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>  -->
    	<script src="<?= base_url("assets/js/formulaire_validation.js") ?>"></script>
    	<script src="<?= base_url("assets/js/sticky_navbar.js") ?>"></script>
    	
    	<!--  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    	
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    	
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>