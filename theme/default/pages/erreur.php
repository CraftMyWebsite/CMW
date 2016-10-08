<div class="container" style="background-color: white;margin-top: -20px;margin-bottom: -20px;border-left: 4px solid #e74c3c;border-right: 4px solid #e74c3c;">
	<?php if(!empty($erreur['type'])) { ?>
		<h3 class="titre"><?php echo $erreur['type']; ?></h1>
		<?php echo '<p>'.$erreur['message'].'</p>'; ?>
	<?php } else { ?>
		<h3>404</h1>
		<p>la page demandée est introuvable.</p>
	<?php } ?>
<p><a href="index.php">Retourner à l'accueil</a></p>
</div>		
