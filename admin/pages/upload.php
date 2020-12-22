<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h2 class="h2 gray">
        Upload - Gestion des images
	</h2>
</div>
<?php if(!$_Permission_->verifPerm('PermsPanel', "upload","showPage")) { ?>
    
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="alert alert-danger">
                <strong>Vous avez aucune permission pour accéder à cette page.</strong>
            </div>
        </div>
    </div>
<?php } else {?>
<div class="row">

    <div class="col-md-12">
    <?php if(isset($_GET["erreur"])){
	switch($_GET["erreur"]){
		case 0:
			echo "<script>notif('error', 'Erreur', 'L\'extension n\'est pas correcte.');</script>";
			break;
		case 1:
			echo "<script>notif('error', 'Erreur', 'Le fichier est trop volumineux.');</script>";
			break;
		case 2:
			echo "<script>notif('error', 'Erreur', 'Un fichier avec ce nom éxiste déjà.');</script>";
			break;
		case 3:
			echo "<script>notif('error', 'Erreur', 'Impossible de stocker l\'image.');</script>";
			break;

	}
} else if(isset($_GET['success'])) {
    echo "<script>notif('success', 'Image stocké !', '');</script>";
}?>
    </div>
    <?php if($_Permission_->verifPerm('PermsPanel', "upload","manager")) { ?>
    <div class="col-md-12 col-xl-6 col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <strong>
                        Liste des images uploadés
                    </strong>
                </h3>
            </div>
            <div class="card-body">

                <div class="row">

                <?php if($dossier = opendir('./theme/upload/panel')){
					$j = 0;
					while(false !== ($fichier = readdir($dossier))) {
						if(!is_dir($fichier) && $fichier != '.' && $fichier != '..' && $fichier != 'index.php' && $fichier != '.htaccess') {?>

                    <div class="col-md-12" id="fich<?php echo $j; ?>">

                        <div class="card">
                            <div class="card-header" style="cursor:pointer;" onclick="SwitchDisplay(get('fich2<?=$j?>'));">
                                <div style="width: 100%;display: inline-block">
                                    <div class="float-left">
                                        <h5>
                                            Fichier: <i><?=$fichier?></i>     
                                        </h5>
                                    </div>
                                    <div class="float-right">
                                        <button  onclick="sendDirectPost('admin.php?action=supprUpload&file=<?php echo $fichier; ?>', function(data) { if(data) { hide('fich<?php echo $j; ?>'); } });" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body text-center" style="display:none;" id="fich2<?=$j?>">
                                <img src="./theme/upload/panel/<?=$fichier?>" alt="<?=$fichier?>" class="img-fluid">                                
                                <br>
                                <div class="well mt-3">
                                    <p class="pt-2">
                                       <?= (isset($_SERVER['HTTPS']) ? "https" : "http") . "://".$_SERVER["HTTP_HOST"]?>/theme/upload/panel/<?=$fichier?>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                
                    <?php }
                $j++;}
                    }?>

                </div>
                <br>
            </div>
        </div>
    </div>
<?php } ?>
    <div class="col-md-12 col-xl-6 col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <strong>
                        Uploader une nouvelle image
                    </strong>
                </h5>
            </div>
            <form class="form-horizontal" method="post" role="form" enctype="multipart/form-data" action="?action=uploadImg"> 
            <!-- action="?action=uploadImg" -->
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group w-100">
                        <div class="input-group file-input-group" style="margin-top:10px;">
                      <input class="form-control" id="img-text" type="text" placeholder="Aucun fichier séléctioner" readonly>
                      <input type="file" name="img" id="img" style="display:none;" required>
                      <div class="input-group-append">
                        <label class="btn btn-secondary mb-0" for="img">Choisir un fichier</label>
                      </div>
                    </div>
                    <script>
                      const fileInput = get('img');
                      const label = get('img-text');
                      
                      fileInput.onchange =
                      fileInput.onmouseout = function () {
                        if (!fileInput.value) return
                        
                        var value = fileInput.value.replace(/^.*[\\\/]/, '')
                        label.value = value
                      }
                    </script>
                    </div>                
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success w-100" type="submit">
                    Uploader l'image
                </button>
            </div>
            </form>
        </div>
    </div>

</div>
<?php } ?>