<?php
include('controleur/maintenance.php');
require('include/version.php');

if($maintenance[$i]['maintenanceEtat'] == 0){
setTempMess("<script> $( document ).ready(function() { Snarl.addNotification({ title: '', text: 'La maintenance n\'est pas activée !', icon: '<span class=\'fas fa-cog\'></span>'});});</script>");
header('Location: index.php');
}
require('theme/'. $_Serveur_['General']['theme'] . '/config/configTheme.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php $configFile = new Lire('modele/config/config.yml');
	$configFile = $configFile->GetTableau();
	echo "<style>
	:root {
		--color-main: ". $configFile["color"]['theme']["main"] ."; 
		--color-hover: ". $configFile["color"]['theme']["hover"] ."; 
		--color-focus: ". $configFile["color"]['theme']["focus"] ."; 
	}
	</style>";?>
	<meta charset="UTF-8">
	<title>Maintenance <?php echo $_Serveur_['General']['name']; ?></title>
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
	<div class="container text-center">
		<?php if(!empty($donnees['dateFin'])){
				if($donnees['dateFin'] != 0 && $donnees['dateFin'] <= time()){
					$req = $bddConnection->prepare('UPDATE cmw_maintenance SET maintenanceEtat = :maintenanceEtat WHERE maintenanceId = :maintenanceId');
					$req->execute(array('maintenanceEtat' => 0, 'maintenanceId' => $donnees['maintenanceId']));
					header("Location: /");
				}?>
			<div id="clockdiv">
				<div>
					<span class="days"></span>
					<div class="smalltext">Jours</div>
				</div>
				<div>
					<span class="hours"></span>
					<div class="smalltext">Heures</div>
				</div>
				<div>
					<span class="minutes"></span>
					<div class="smalltext">Minutes</div>
				</div>
				<div>
					<span class="seconds"></span>
					<div class="smalltext">Secondes</div>
				</div>
			</div>
		<?php }?>
		
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="card" style="border:0px;">
                    <h3 class="card-header text-center" style="border:0px;"><i class="fa fa-cog fa-spin"></i> Maintenance</h3>
                    <hr>
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo $_Serveur_['General']['name']; ?> reviens très bientôt !</h5>
                        <h6 class="card-subtitle text-muted">
                            <?php echo $donnees['maintenanceMsg']; ?>
                        </h6>
                    </div>
                    <hr><?php if(!isset($_Joueur_['rang'], $_PGrades_) && $_Joueur_['rang'] != 1 AND !$_PGrades_['PermsPanel']['access'])
                    { ?>
                    <div class="card-footer text-muted" style="border:0px;">
                        <a class="btn btn-block btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Connexion administrateur</a>
                    </div>
                </div>
                <div class="collapse" id="collapseExample"><form method="post" action="?action=connection">
                    <div class="card card-body text-white bg-dark mb-3" style="border:0px;padding:15px;background:#333;border-top:4px solid #562F91;">
                        <div class="col-auto">
                        	<h4><?php echo $donnees['maintenanceMsgAdmin']; ?></h4>
                            <div class="form-group">
                                <label class="control-label">Votre pseudonyme</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon" style="border:0px;"><i class="fa fa-user"></i></div>
                                        <input type="text" class="form-control" name="pseudo" id="PSEUDO" placeholder="Pseudonyme" style="border:0px;">
                                    </div>
                                </div>
                                <label class="control-label">Votre mot de passe</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon" style="border:0px;"><i class="fa fa-lock"></i></div>
                                        <input type="password" name="mdp" class="form-control" id="MDP" placeholder="Mot de passe" style="border:0px;">
                                    </div>
                                </div>
                                <div class="form-group">
                                	<button class="btn btn-lg btn-primary btn-block" type="submit"> Connexion</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form></div><?php 
                 }
                 else
                 {
                 	?></div>
					<div class="card-footer text-muted" style="border: 0px;">
                 		<a class="btn btn-block btn-primary" href="index.php">Accéder au site</a>
                 	</div><?php 
                 }
                 ?>
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
	<script type="text/javascript">
		function getTimeRemaining(endtime) {
		  var t = Date.parse(endtime) - Date.parse(new Date());
		  var seconds = Math.floor((t / 1000) % 60);
		  var minutes = Math.floor((t / 1000 / 60) % 60);
		  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
		  var days = Math.floor(t / (1000 * 60 * 60 * 24));
		  if(days == 0 && hours == 0 && minutes == 0 && seconds == 0)
			  window.location.replace("/");
		  return {
			'total': t,
			'days': days,
			'hours': hours,
			'minutes': minutes,
			'seconds': seconds
		  };
		}

		function initializeClock(id, endtime) {
		  var clock = document.getElementById(id);
		  var daysSpan = clock.querySelector('.days');
		  var hoursSpan = clock.querySelector('.hours');
		  var minutesSpan = clock.querySelector('.minutes');
		  var secondsSpan = clock.querySelector('.seconds');

		  function updateClock() {
			var t = getTimeRemaining(endtime);

			daysSpan.innerHTML = t.days;
			hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
			minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
			secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

			if (t.total <= 0) {
			  clearInterval(timeinterval);
			}
		  }

		  updateClock();
		  var timeinterval = setInterval(updateClock, 1000);
		}

		var deadline = new Date(Date.parse(new Date()) + <?=($donnees["dateFin"] - time())?> * 1000);
		initializeClock('clockdiv', deadline);
	</script>
</body>
</html>