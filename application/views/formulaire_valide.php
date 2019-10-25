<?php $title='Formulaire validé'; 
$description = 'Formulaire validé - Jarditou'; ?>
	
	<?php ob_start(); ?>	
	<h3>Le formulaire a été validé !</h3>

	<p><?php echo anchor('form', 'Try it again!'); ?></p>
	<?php $contenu=ob_get_clean(); ?>
<?php require 'template.php'; ?>