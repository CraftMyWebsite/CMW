<?php
$req = $bddConnection->query('SELECT * FROM cmw_ban_config');
$data = $req->fetch(PDO::FETCH_ASSOC);
require('include/version.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Ban - <?php echo $_Serveur_['General']['name']; ?></title>
	<?php $configFile = new Lire('modele/config/config.yml');
	$configFile = $configFile->GetTableau();
	echo "<style>
	:root {
		--color-main: ". $configFile["color"]['theme']["main"] ."; 
		--color-hover: ". $configFile["color"]['theme']["hover"] ."; 
		--color-focus: ". $configFile["color"]['theme']["focus"] ."; 
	}
	</style>";?>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/ionicons.min.css">
    <link rel="stylesheet" href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/animate.css">
    <link rel="stylesheet" href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/hover.min.css">
    <link rel="stylesheet" href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/custom.css">
    <link rel="stylesheet" href="theme/<?php echo $_Serveur_['General']['theme']; ?>/css/maintenance.css">
</head>
<body>
    <section class="layout" id="page">
		<div class="container">
			<div class="card" style="display: block; margin-left: 20%; text-align: center; margin-right: 20%; margin-top: 12%; padding-top: 2%; padding-bottom: 2%;">
				<div class="card-body">
				    <h4 class="card-title"><?=$data['titre'];?></h4>
				    <p class="card-text"><?=$data['texte'];?></p>
			  	</div>
			</div>
		</div>
	</section>
	<footer style="margin-top: 50px; width: 100%">
        <div class="card card-inverse card-primary text-xs-center">
            <div class="card-block">
                <div class="container text-center">
                    <h4 style="color:white;">Rejoignez-nous sur les réseaux sociaux</h4>
                    <h6 style="margin:0px;">&nbsp;</h6>
                    <div class="row">
                        <div class="col-sm-3 text-center wow fadeInLeft">
                            <a href="<?php echo $_Theme_['Pied']['facebook']; ?>" target="about_blank" class="fa-stack fa-2x hvr-grow">
                                <i class="fa fa-square fa-stack-2x text-facebook"></i>
                                <i class="fab fa-facebook fa-stack-1x fa-inverse"></i>
                            </a>
                        </div>
                        <div class="col-sm-3 text-center wow fadeInLeft" data-wow-delay="0.3s">
                            <a href="<?php echo $_Theme_['Pied']['youtube']; ?>" target="about_blank" class="fa-stack fa-2x hvr-grow">
                                <i class="fa fa-square fa-stack-2x text-youtube"></i>
                                <i class="fab fa-youtube fa-stack-1x fa-inverse"></i>
                            </a>
                        </div>
                        <div class="col-sm-3 text-center wow fadeInRight" data-wow-delay="0.4s">
                            <a href="<?php echo $_Theme_['Pied']['discord']; ?>" target="about_blank" class="fa-stack fa-2x hvr-grow">
                                <i class="fa fa-square fa-stack-2x text-discord"></i>
                                <i class="fab fa-discord fa-stack-1x fa-inverse"></i>
                            </a>
                        </div>
                        <div class="col-sm-3 text-center wow fadeInRight" data-wow-delay="0.7s">
                            <a href="<?php echo $_Theme_['Pied']['twitter']; ?>" target="about_blank" class="fa-stack fa-2x hvr-grow">
                                <i class="fa fa-square fa-stack-2x text-twitter"></i>
                                <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-inverse card-inverse text-xs-center bg-inverse">
            <div class="card-block container">
                <div style="display:inline-block;">Tous droits réservés, site créé pour le serveur <?php echo $_Serveur_['General']['name']; ?></div><br/>
                <small style="display:inline-block;"><a href="http://craftmywebsite.fr">CraftMyWebsite.fr</a>#<?php echo $versioncms; ?></small>
                <div style="display:inline-block;float:right;">
                    <span class="badge badge-secondary" style="font-size: 100%;"><?php $req = $bddConnection->query('SELECT COUNT(id) AS count 
                    FROM cmw_users');
                    $fetch = $req->fetch(PDO::FETCH_ASSOC);
                    echo $fetch['count']; ?></span><a href="?page=membre" style="color: inherit;"> Membres inscrits</a>
                </div>
            </div>
        </div>
    </footer>
	<script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/jquery.min.js"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.2/js/all.js"></script>
    <script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/popper.min.js"></script>
    <script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/bootstrap.min.js"></script>
    <script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/wow.min.js"></script>
    <script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/custom.js"></script>
    <script src="theme/<?php echo $_Serveur_['General']['theme']; ?>/js/snarl.min.js"></script>
</body>
</html>