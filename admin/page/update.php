<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
	    <h1 class="page-header"> Mise à jour
            <small>Gestionnaire de Mise à jour</small>
        </h1>
	    <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a data-toggle="collapse" data-parent="#adminPanel" href="#informations">Informations</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Mise à jour
            </li>
        </ol>
        <hr>
        <?php include("./include/version.php");
        include("./include/version_distant.php");
        if($versioncms == $versioncmsrelease) { ?>
        	<div class="col-lg-6 col-lg-offset-3 text-center">
        		<div class="row">
        			<div class="alert alert-success">
        				<strong>Votre CMS CraftMyWebsite est bien a jours en version <?php echo $versioncms; ?> !</strong>
        			</div>
        		</div>
        		<div class="row">
        			<div class="alert alert-info">
        				<strong>Merci d'avoir pris le thème créé par Sprik07 ! ^.^</strong>
        			</div>
        		</div>
        	</div>
        <?php } else { ?>
        	<div class="col-lg-6 col-lg-offset-3 text-center">
        		<div class="row">
        			<div class="alert alert-danger">
        				<strong>Votre CMS CraftMyWebsite n'est PAS à jour ! Vous êtes en <?php echo $versioncms; ?> et la dernière version est la <?php echo $versioncmsrelease; ?> !</strong>
        			</div>
        		</div>
        		<div class="row">
        			<div class="alert alert-warning">
        				<strong>Cliquez ici pour télécharger la mise a jour de la dernière version : <a href="http://craftmywebsite.fr/release/CraftMyWebsite-<?php echo $versioncmsrelease; ?>MAJ.php" class="btn btn-warning">CraftMyWebsite V<?php echo $versioncmsrelease; ?> </a></strong>
        			</div>
        		</div>
        	</div>
        <?php } ?>
	</div>
</div>
<!-- /.row -->