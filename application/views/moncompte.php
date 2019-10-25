<?php $title='Mon compte'; 
$description = 'Mon compte - Jarditou'; ?>
	
<?php ob_start(); ?>
	<h1>Mon compte</h1>
	<hr>
	<p>Nom: <?= $this->session->nom ?>
	<p>Prénom: <?= $this->session->prenom ?>
	<p>Identifiant: <?= $this->session->login ?>
	
<?php $contenu=ob_get_clean(); ?>
<?php require 'template.php'; ?>
	