<div class="cmw-page-content-header"><strong>Upload d'images</strong> - uploadez vos propres images</div>
<?php if(isset($_GET["erreur"])){
	switch($_GET["erreur"]){
		case 0:
			echo "<divclass='alert alert-danger'>Vous devez uploader un fichier de type png, gif, jpg ou jpeg...</div>";
			break;
		case 1:
			echo "<divclass='alert alert-danger'>Le fichier est trop volumineux...</div>";
			break;
		case 2:
			echo "<divclass='alert alert-danger'>L'image existe déjà. Changez le nom de l'image pour pouvoir continuer</div>";
			break;
		case 3:
			echo "<divclass='alert alert-danger'>Echec de l'upload !</div>";
			break;
		default:
			echo "<divclass='alert alert-danger'>Erreur inconnue!</div>";
			break;
	}
}?>
<div class="row">
	<div class="col-md-6 text-center">
		<div class="panel panel-default cmw-panel">
			<div class="panel-heading cmw-panel-header">
				<h3 class="panel-title">Liste des images uploadés</h3>
			</div>
			<div class="panel-body">
				<?php if($dossier = opendir('./theme/upload/panel')){
					$j = 0;
					while(false !== ($fichier = readdir($dossier))) {
						if(!is_dir($fichier) && $fichier != '.' && $fichier != '..' && $fichier != 'index.php' && $fichier != '.htaccess') {?>
							<a data-toggle="modal" data-target="#modal_<?=$j?>" class="btn btn-link"><img src="./theme/upload/panel/<?=$fichier?>" style="width:50px;height:50px" alt="<?=$fichier?>"></a>
							<div id="modal_<?=$j?>" class="modal fade" role="dialog">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Image "<?=$fichier?>"</h4>
										</div>
										<div class="modal-body">
											<img src="./theme/upload/panel/<?=$fichier?>" style="max-width: 100%; max-height: 1000px" alt="<?=$fichier?>">
											<br>lien:<br>
											<?= (isset($_SERVER['HTTPS']) ? "https" : "http") . "://".$_SERVER["HTTP_HOST"]?>/theme/upload/panel/<?=$fichier?>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
										</div>
									</div>
								</div>
							</div>
						<?php }
					$j++;}
				}?>
			</div>
		</div>
	</div>
	<div class="col-md-6 text-center">
		<div class="panel panel-default cmw-panel">
			<div class="panel-heading cmw-panel-header">
				<h3 class="panel-title">Uploader une nouvelle image</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="post" action="?action=uploadImg" role="form" enctype="multipart/form-data">
					<div class="form-group">
						<label for="img" class="control-label">Importer votre image (< 1Mo, jpeg, jpg, png, bmp, ico, gif)</label>
						<input type="file" name="img" required class="form-control" id="img">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success">Envoyer</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>