<div class="container" style="background-color: white;margin-top: -20px;margin-bottom: -20px;border-left: 4px solid #e74c3c;border-right: 4px solid #e74c3c;">
<?php if($pages['titre'] == "" && $pageContenu[$j][0] == ""){ ?>
<style>
.error-template {padding: 40px 15px;text-align: center;}
.error-actions {margin-top:15px;margin-bottom:15px;}
.error-actions .btn { margin-right:10px; }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oups!</h1>
                <h2>
                    Erreur 404</h2>
                <div class="error-details">
                    Désolé mais la page demandé est introuvable ! :(
                </div>
                <div class="error-actions">
                    <a href="index.php" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                        Retourner sur l'accueil</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } else { ?>
<?php } ?>
		<h1 class="titre"><?php echo $pages['titre']; ?></h1>
			<?php for($j = 0; $j < count($pages['tableauPages']); $j++) { ?>
				<h3><?php echo $pageContenu[$j][0]; ?></h3>
				<div><?php echo $pageContenu[$j][1]; ?></div>		
			<?php } ?>
</div>