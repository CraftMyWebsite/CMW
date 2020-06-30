<?php
error_reporting(0);
ini_set('display_errors', 1);
require_once('../modele/config/yml.class.php');
$configLecture = new Lire('../modele/config/config.yml');
$_Serveur_ = $configLecture->GetTableau();

$installEtape = new Lire('app/data/install.yml');
$installEtape = $installEtape->GetTableau();
$installEtape = $installEtape['etape'];

require_once ('app/controller/app.php');
require_once ('app/controller/action.php');

include '../include/version.php';

	?>
	<!DOCTYPE html>
	<html lang="fr">
        <head>
        <?php include ('app/views/header.php');
        ?>
        </head>

	<body class="bg-light2">

        <div class="container">
    
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-4 img"
                src="app/ressources/images/craftmywebsite.png" alt="CraftMyWebsite - Logo" width="94"
                height="94" style="border-radius: 9px;">
                    <h2>Bienvenue sur votre site !</h2>
                <p class="lead">
                    Merci d’avoir choisi CraftMyWebsite, des mises à jour seront disponibles très fréquemment sur le site officiel.
                    Il peut néanmoins y avoir des bugs ! Merci de nous en faire part sur le forum ou sur le discord pour les corriger au plus vite.
                </p>

                <div class="row">

                    <div class="col-md-12">
                        <div class="wrapper-progressBar">
                        <ul class="progressBar">
                            <li <?php if($installEtape >= 1) echo 'class="active"'; ?>><span class="d-none d-md-block">Configuration de la base de donnée</span></li>
                            <li <?php if($installEtape >= 2) echo 'class="active"'; ?>><span class="d-none d-md-block">Paramétrage du site</span></li>
                            <li <?php if($installEtape >= 3) echo 'class="active"'; ?>><span class="d-none d-md-block">Création d'un compte Administrateur</span></li>
                        </ul>
                        </div>
                    </div>

                </div>
                <?php
                $retour = VerifieExtension();
                if($retour != "") {
                    $extensionok = "false";
                } else { 
                    $extensionok = "true";
                }

                if($chmodok == "false") { 
                    $retourchmod = VerifieChmod();
                    DrawChmod($retourchmod);
                }
                if($extensionok != "true") { 		
                    echo AfficherExtension($retour);
                }

                ?>

            </div>
        <?php 
        if(!array_key_exists('ENV_HTACCESS_READING', $_SERVER))
        {
            $htaccess = false;
            ?>
            <div class="pt-3">
            <div class="alert alert-danger"><strong>ATTENTION</strong> : Erreur Critique, votre serveur est soumis aux failles htaccess. Veuillez les activer, en suivant <a href="https://www.aidoweb.com/tutoriaux/fichier-htaccess-qui-ne-fonctionne-pas-solutions-configuration-apache-648" target="_blank">ce tuto</a> ou nous contacter sur <a href="https://discord.gg/wMVAeug" target="_blank">Discord</a> <br/><a href="index.php" class="btn btn-primary btn-block minecrafter">Relancer la verification</a></div>
            </div>
        <?php
        }
            if($chmodok == "true" && $extensionok == "true" && (empty($htaccess) OR $htaccess = true)){
		?>
        
        <div class="block border shadow bg-texture" style="border-radius: 2% !important;">

            <div class="row p-3">

            <div class="col-md-4 mb-4" id="prerequis-tab">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Pré-requis</span>
                </h4>
                <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                    <h6 class="my-0"> <i class="fas fa-server"></i> Serveur Web</h6>
                        <small class="text-muted">
                        <?php 
                        if ($return['nginx']){
                            echo '<b>NGINX <a href="#port" class="btn-outline-info" data-toggle="popover" data-placement="top" title="Aide > Nginx / Apache" data-content="Nous avons détecté que vous utilisez NGINX, CraftMyWebsite ne fonctionne pas sous NGINX. <br/> Si vous êtes sur Apache vous pouvez continuez l\'installation"> <i class="fas fa-info-circle"></i></a></b>';
                            echo $serveurweb;
                        }else{
                            echo $serveurweb;
                        }
                        ?>
                        </small>
                    </div>
                        <?php
                        if ($return['nginx']){ ?>
                            <span class="text-warning">
                                <i class="fas fa-exclamation-circle"></i>
                            </span>
                        <?php
                        }else{ ?>
                            <span class="text-success">
                                <i class="fas fa-check-circle"></i>
                            </span>
                        <?php } ?>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                    <h6 class="my-0"> <i class="fab fa-php"></i> Version PHP</h6>
                    <small class="text-muted"><?php echo phpversion();?></small>
                    </div>
                    <span class="text-success">
                        <i class="fas fa-check-circle"></i>
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                    <h6 class="my-0"> <i class="fab fa-expeditedssl"></i> SSL/TLS (https)</h6>
                    <small class="text-muted">
                    <?php
                    $return['ssl'] = is_ssl(); 
                    if (!$return['ssl']){
                        echo 'non détécté';
                    }else{
                        echo 'détécté';
                    }
                    ?>
                    </small>
                    </div>
                    <?php
                    if (!$return['ssl']){ ?>
                        <span class="text-warning">
                            <i class="fas fa-exclamation-circle"></i>
                        </span>
                    <?php
                    }else{ ?>
                        <span class="text-success">
                            <i class="fas fa-check-circle"></i>
                        </span>
                    <?php } ?>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                    <h6 class="my-0"> <i class="fas fa-wrench"></i> Configuration Web</h6>
                    <small class="text-muted">
                    <?php 
                    if (isset($htaccess) AND $htaccess == true){
                        echo 'AllowOverride None';
                    }else{
                        echo 'AllowOverride All';
                    }
                    ?></small>
                    </div>
                    <?php
                    if (isset($htaccess) AND $htaccess == true){ ?>
                        <span class="text-danger">
                            <i class="fas fa-exclamation-circle anim-wow"></i>
                        </span>
                    <?php
                    }else{ ?>
                        <span class="text-success">
                            <i class="fas fa-check-circle"></i>
                        </span>
                    <?php } ?>
                    
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                    <h6 class="my-0"> <i class="fas fa-microchip"></i> Extensions</h6>
                    <small class="text-muted">zip: détecté <span class="text-success"><i
                            class="fas fa-check-circle"></i></span> </small><br />
                    <small class="text-muted">pdo: détecté <span class="text-success"><i
                            class="fas fa-check-circle"></i></span> </small><br />
                    <small class="text-muted">curl: détecté <span class="text-success"><i
                            class="fas fa-check-circle"></i></span> </small>
                    </div>
                    <span class="text-success">
                    <i class="fas fa-check-circle"></i>
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between bg-light lh-condensed">
                    <div>
                    <h6 class="my-0"> <i class="fas fa-wifi"></i> Informations supplémentaires</h6>
                    <small class="text-muted">
                        <span class="bold">IP:</span> <?=$_SERVER['SERVER_ADDR'];?>
                    </small><br />
                    <small class="text-muted">
                        <span class="bold">Port:</span> <?=$_SERVER['SERVER_PORT'];?>
                    </small><br />
                    <small class="text-muted">
                        <span class="bold">Interface:</span> <?=$_SERVER['GATEWAY_INTERFACE'];?>
                    </small><br />
                    <small class="text-muted">
                        <span class="bold">Protocol:</span> <?=$_SERVER['SERVER_PROTOCOL'];?>
                    </small><br />
                    <small class="text-muted">
                        <span class="bold">Chemin:</span> <code><?=$_SERVER['DOCUMENT_ROOT'];?></code>
                    </small><br />
                    <small class="text-muted">
                        <span class="bold">Version CMS:</span> <?=$versioncms;?>
                    </small><br />
                    <small class="text-muted">
                        <span class="bold">Théme:</span> <?=$_Serveur_['General']['theme'];?>
                    </small><br />
                    <small class="text-muted">
                        <span class="bold">Tables:</span> 
                        (
                            <?php
                            if(isset($_Serveur_['DataBase']['dbAdress']) && !empty($_Serveur_['DataBase']['dbAdress'])){
                                $tablesretour = verifTables($_Serveur_['DataBase']['dbAdress'], $_Serveur_['DataBase']['dbName'], $_Serveur_['DataBase']['dbUser'], $_Serveur_['DataBase']['dbPassword'], $_Serveur_['DataBase']['dbPort']);
                            }
                            else
                            {
                                echo 'Inconnues';
                            }
                            ?>
                            )
                    </small><br />
                    </div>
                </li>
                </ul>
            </div>

            <div class="col-md-8">

            <?php 
            if($installEtape == 0) {
                include('app/views/welcome.php');
            }
            if($installEtape == 1) {
                include('app/views/mysql.php');
                echo '<script>console.log("Chargement du formulaire MySQL terminé !");</script>';
            }
            if($installEtape == 2) {
                include('app/views/site.php');
                echo '<script>console.log("Chargement du formulaire de configuration du site terminé !");</script>';
            } 
            if($installEtape == 3) {
                include('app/views/compte.php');
                echo '<script>console.log("Chargement du formulaire de création de compte admin terminé !");</script>';
            }
            if($installEtape >= 4) {
                include('app/views/installation.php');
                echo '<script>console.log("Merci d\'avoir installer CraftMyWebsite sur votre site internet !");</script>';
            }
            ?>

                <div class="d-none d-md-flex minecraft">

                </div>

            </div>



      </div>
      <!-- Fermeture de la row -->
      <center>
        <div class="my-4">
          <a class="minecraftia btn text-primary"
            href="https://craftmywebsite.fr/forum/index.php?threads/tuto-installer-le-cms-craftmywebsite-fr.4437/"
            target="_blank">Besoin d'aide pour l'installation ?</a>
        </div>
      </center>
    <?php }?>

    </div>

    <footer class="my-4 text-muted text-center text-small">
      <p class="mb-1">&copy; 2014 - <script>
          document.write(new Date().getFullYear())
        </script> CraftMyWebsite</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="https://craftmywebsite.fr/forum/index.php" target="_blank">Forum</a></li>
        <li class="list-inline-item"><a href="https://discord.gg/P94b7d5" target="_blank"> <i class="fab fa-discord"></i> Discord</a></li>
        <li class="list-inline-item"><a href="https://github.com/Florentlife/CraftMyWebsite/" target="_blank"> <i class="fab fa-github"></i> GitHub</a></li>
      </ul>
    </footer>
  </div>

      <?php
    //   if($tables = true){ ?>
        <!-- <div class="modal fade" tabindex="-1" id="sqlmodal" style="" data-keyboard="false" data-backdrop="true">
            <div class="modal-dialog bg-light modal-xl" role="document">
                <div class="modal-body">

                        <?php 
                        // if($dejainstaller = true){
                        //     include('app/views/modal-body_cms45.html');
                        // }
                        // else
                        // {
                        //     include('app/views/modal-body_cms.html');
                        // }
                        ?>

                    <h3 class="modal-title text-center center">Que voulez-vous faire ?</h3>
                </div>
                <div class="modal-footer">
                    <button onclick="forceinstallsql()"class="btn btn-danger">Forcer l'installation</button>
                    <button onclick="dropsql()" class="btn btn-success">Vider la base et forcer l'installation (Recommandé) <strong>[Irréversible]</strong></button>
                </div>
            </div>
        </div> -->
    <?php
    //  if(isset($tables)){ ?>
         <!-- $('#sqlmodal').modal('show') -->
       <?php 
    //   } 
        ?>
      <?php // } ?>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="app/ressources/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.13.0/js/all.js"></script>
</body>
</html>
<?php
function verifyPDO($hote, $nomBase, $utilisateur, $mdp, $port)
{
	try
	{
		$sql = new PDO('mysql:host='.$hote.';dbname='.$nomBase.';port='.$port, $utilisateur, $mdp);
		$sql->exec("SET CHARACTER SET utf8");
		$req = $sql->query('SELECT @@GLOBAL.sql_mode AS sql_mode_global, @@SESSION.sql_mode AS sql_mode_session');
		$data = $req->fetch(PDO::FETCH_ASSOC);
		if((!isset($data['sql_mode_global']) || empty($data['sql_mode_global']) || strpos($data['sql_mode_global'], 'STRICT_ALL_TABLES') === FALSE) && (!isset($data['sql_mode_session']) || empty($data['sql_mode_session']) || strpos($data['sql_mode_session'], 'STRICT_ALL_TABLES') === FALSE) && (!isset($data['sql_mode_global']) || empty($data['sql_mode_global']) || strpos($data['sql_mode_global'], 'STRICT_TRANS_TABLES') === FALSE) && (!isset($data['sql_mode_session']) || empty($data['sql_mode_session']) || strpos($data['sql_mode_session'], 'STRICT_TRANS_TABLES') === FALSE))
        {   
            return true;    
        }else
        {    
            return '([GLOBAL.sql_mode: '.$data['sql_mode_globall'].'],[SESSION.sql_mode:'.$data['sql_mode_session'].'])';
        }
	}
	catch(Exception $e)
	{
		return 3;
	}
}


function getPDO($hote, $nomBase, $utilisateur, $mdp, $port)
{
	try
	{
		$sql = new PDO('mysql:host='.$hote.';dbname='.$nomBase.';port='.$port, $utilisateur, $mdp);
		$sql->exec("SET CHARACTER SET utf8");
		return $sql;
	}
	catch(Exception $e)
	{
	}
}

function verifTables($hote, $nomBase, $utilisateur, $mdp, $port){
        $sql = new PDO('mysql:host='.$hote.';dbname='.$nomBase.';port='.$port, $utilisateur, $mdp);

        $req = $sql->prepare('SELECT COUNT(*) AS tables FROM information_schema.tables WHERE table_schema = :db AND TABLE_NAME LIKE "cmw_%"');
        $req->execute(array(
            'db' => $nomBase
        ));
        $data = $req->fetch(PDO::FETCH_ASSOC);

        if(isset($data['tables'])){
            echo $data['tables'];
            $dejainstaller = true;
        }else{
            echo 'Inconnues';
        }
}
?>
