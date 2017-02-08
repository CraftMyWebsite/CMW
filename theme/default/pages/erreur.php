<style>
.error-template {padding: 40px 15px;text-align: center;}
.error-actions {margin-top:15px;margin-bottom:15px;}
.error-actions .btn { margin-right:10px; }
</style>
<div class="container" style="background-color: white;margin-top: -20px;margin-bottom: -20px;border-left: 4px solid #e74c3c;border-right: 4px solid #e74c3c;">
	<div class="row">
		<div class="col-md-12">
			<div class="error-template">
				<h1>
					<?=$titre;?></h1>
				<h2>
					<?=$type;?></h2>
				<div class="error-details">
					<?=$contenue;?>
				</div>
				<div class="error-actions">
					<a href="index.php" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
						Retourner sur l'accueil</a>
				</div>
			</div>
		</div>
	</div>
</div>
