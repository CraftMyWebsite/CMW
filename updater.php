<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//error_reporting(0);
require_once('controleur/config.php');
require_once('controleur/connection_base.php');

if(isset($_POST['go']) AND $_POST['go'] == 1)
{
	//Modifcation des fichiers
	$archiveUpdate = new ZipArchive;
	if($archiveUpdate->open('update.zip') === TRUE)
	{
		$archiveUpdate->extractTo(__DIR__);
		$archiveUpdate->close();

    bdd181to182($bddConnection);
		accueil181to182($bddConnection);
		widgets181to182($bddConnection);
    pages181to182($bddConnection);
		file181to182();

		unlink('update.zip');
		echo 'Mise à jour réussie ! <a href="index.php?&removeUpdater=true">Aller sur votre site</a>';
	}
}
else
{
	?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="CraftMyWebsite">
    <link rel="stylesheet" href="https://getbootstrap.com/docs/4.4/dist/css/bootstrap.min.css">
    <style>
        .bg-light2 {
            background-color: rgb(240, 240, 240) !important;
        }

        .container {
            max-width: 960px;
        }
    </style>
    <title>CraftMyWebsite | Mise à jour - 1.8.2</title>
</head>

<body class="bg-light2">

    <div class="container">

        <div class="pt-5 text-center">
            <img class="d-block mx-auto mb-4 img"
            src="https://cdn.discordapp.com/attachments/382840368099753984/775433866777198622/craftmywebsite.png" alt="CraftMyWebsite - Logo" width="94"
            height="94" style="border-radius: 9px;">
            <h2>Mise à jour de votre site ! 😃</h2>
            <p class="lead">
                Bienvenue sur la page de mise à jour de votre site internet<br />
            </p>
            <div class="alert alert-danger">
                <p class="text">
                    Attention: la mise à jour de votre site web et irréversible ! Pensez à sauvegarder vos fichiers et
                    bases
                    de données avant de procéder à celle-ci.
                </p>
            </div>
            <hr/>
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <p class="text">
                    Cette version réinitialisera votre choix thème (Défault), les thèmes autre que Default sont pas forcément compatible avec cette version - en cas de doute contacter le créateur du thème que vous souaither utilisé ! 
                </p>
            </div>
		<div class="alert alert-danger">
                <p class="text">
					<center><strong>ATTENTION</strong></center>
					Cette mise à jour va modifier le stockage des menus. Par conséquent, <strong>vos menus vont être réinitialisés</strong> et remis par défaut.
					Pensez à noter vos menus afin de les réintégrer prochainement. 
                </p>
            </div>
            <?php
                if (! file_exists("update.zip")){
                    ?>
                    <div class="alert alert-danger">
                        <p class="text">
                            ALERTE ! Il vous manque le fichier <strong>update.zip</strong>, vous ne pouvez pas commencer la migration sans ce fichier !!!
                        </p>
                    </div>
                        <?php
                }
            ?>
          
            <div class="block border" style="border-radius: 2% !important;">

                <div class="row p-5">
                    <div class="col-md-12">


                        <div class="accordion" id="accordionExample">

                            <h2 class="mb-3">
                                <button class="btn btn-block btn-primary" type="button" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Changlog
                                </button>
                            </h2>
                            <div id="collapseOne" class="collapse bg-light" aria-labelledby="headingOne"
                                data-parent="#accordionExample" style="margin:0px;">
                                <div class="card-body">
                                    <div style="max-height: 300px !important;overflow-y: scroll !important;">
                                        <div class="container-fluid">

                                            <p class="card-text" style="text-align: justify;">

                                            

                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="" method="post">
                                <input type="hidden" name="go" value="1">
                                <button type="submit" class="btn btn-success btn-block">Mettre à jour le CMS (irréversible)</button>
                              </form>
                        </div>


                    </div>
                </div>

            </div>



        </div>

    </div>

    <footer class="my-4 text-muted text-center text-small">
        <p class="mb-1">&copy; 2014 - <script>
                document.write(new Date().getFullYear())
            </script> CraftMyWebsite</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="https://craftmywebsite.fr/forum/index.php" target="_blank">Forum</a>
            </li>
            <li class="list-inline-item"><a href="https://discord.gg/P94b7d5" target="_blank"> <i
                        class="fab fa-discord"></i> Discord</a></li>
            <li class="list-inline-item"><a href="https://github.com/CraftMyWebsite" target="_blank"> <i
                        class="fab fa-github"></i> GitHub</a></li>
        </ul>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>  
 
	<?php
}


// https://github.com/guedesite/CMWListDeleteFile
function file181to182() {
	unlink('admin/actions/addRapNav.php');
    unlink('admin/actions/changeSlider.php');
    unlink('admin/actions/creerSection.php');
    unlink('admin/actions/downWidget.php');
    unlink('admin/actions/editMenuListe.php');
    unlink('admin/actions/editPermissions.php');
    unlink('admin/actions/editRapNav.php');
    unlink('admin/actions/getMenuLien.php');
    unlink('admin/actions/newLienMenu.php');
    unlink('admin/actions/newListeMenu.php');
    unlink('admin/actions/newSlider.php');
    unlink('admin/actions/newWidget.php');
    unlink('admin/actions/nouveauMenuListeLien.php');
    unlink('admin/actions/postNavRap.php');
    unlink('admin/actions/supprLienMenu.php');
    unlink('admin/actions/supprLienMenuDeroulant.php');
    unlink('admin/actions/supprMini.php');
    unlink('admin/actions/supprSection.php');
    unlink('admin/actions/supprWidget.php');
    unlink('admin/actions/upWidget.php');
    unlink('controleur/joueur/changeMdp.php');
    unlink('controleur/joueur/changeProfil.php');
    unlink('controleur/joueur/changeProfilAutres.php');
    unlink('controleur/joueur/modifImgProfil.php');
    unlink('controleur/paypal/api.class.php');
    unlink('controleur/paypal/cancel.php');
    unlink('controleur/paypal/fonction_api.php');
    unlink('controleur/paypal/index.php');
    unlink('controleur/paypal/return.php');
    unlink('controleur/profil/index.php');
    unlink('controleur/profil/serveur.php');
    unlink('modele/app/accueil.class.php');
    unlink('modele/config/accueil.yml');
    unlink('modele/config/configMenu.yml');
    unlink('modele/config/configStats.yml');
    unlink('modele/config/configWidgets.yml');
    unlink('modele/page.class.php');
    unlink('theme/upload/navRap/miniature-demo-1.jpg');
}

function bdd181to182($bddConnection) {
    $bddConnection->exec("CREATE TABLE IF NOT EXISTS cmw_widgets (
      id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      message varchar(200) DEFAULT NULL,
      titre varchar(100),
      type int(1) DEFAULT 0,
      ordre int(2)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

    $bddConnection->exec("DROP TABLE cmw_menu");

    $bddConnection->exec("CREATE TABLE IF NOT EXISTS cmw_pages (
      id int(11) AUTO_INCREMENT,
      titre varchar(100),
      contenu text,
      PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

    $bddConnection->exec("CREATE TABLE IF NOT EXISTS cmw_miniature (
      id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      message varchar(200) DEFAULT NULL,
      image varchar(100),
      type int(1) DEFAULT 0,
      lien varchar(100),
      ordre int(2)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

    $bddConnection->exec("CREATE TABLE IF NOT EXISTS cmw_menu (
      `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      `name` varchar(100),
      `dest` int(11),
      `url` varchar(100) DEFAULT NULL,
      `ordre` int(2)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

    $bddConnection->exec("INSERT INTO `cmw_menu` (`id`, `dest`, `url`, `ordre`, `name`) VALUES
        (1, -1, 'index.php', 0, 'Accueil'),
        (2, -1, NULL, 1, 'Serveur'),
        (3, -1, '?&page=boutique', 2, 'Boutique'),
        (4, -1, '?&page=support', 3, 'Support'),
        (5, -1, '?&page=voter', 4, 'Voter'),
        (6, -1, '?page=forum', 5, 'Forum'),
        (7, -1, '?&page=membres', 6, 'Liste des membres'),
        (8, 2, '?page=banlist', 0, 'Ban - List'),
        (9, 2, '?page=chat', 1, 'Chat');");


     // Gestion des UUID dans la bdd
     $bddConnection->exec("ALTER TABLE cmw_users ADD (
        `UUID` varchar(32) DEFAULT NULL,
        `UUIDF` varchar(36) DEFAULT NULL 
        `token` varchar(32) DEFAULT NULL
    )");
}

function pages181to182($bddConnection) {
    $req = $bddConnection->query("SELECT * FROM cmw_pages WHERE 1");
    $req = $req->fetchAll(PDO::FETCH_ASSOC);
    require("modele/app/page.class.php");
    $page = new page();

    if(!empty($req)) {
        foreach($req as $value) {
            $str = "";

            $s2 = explode('#µ¤#', $value['contenu']);
            for($j = 0; $j < count($s2); $j++) 
            {
                $s = explode('|;|', $s2[$j]);
                $str .= "<h3>".$s[0]."</h3>";
                $str .= "<div>".$s[1]."</div>";
            }

            $page->print($value['titre'], $str);

        }
    }
}

function widgets181to182($bddConnection) {

	$wid = new Lire('modele/config/configWidgets.yml');
  	$wid = $wid->GetTableau();

    if(isset($wid['Widgets']) && !empty($wid['Widgets']) ) {
        $i = 0;
        foreach($wid['Widgets'] as $value)
        {

            $infos = array();
            $infos['ordre'] = $i;
            $infos['message'] = isset($value['message']) ? $value['message'] : null;
            $infos['type'] = intval($value['type']);
            $infos['titre'] = $value['titre'];
            $req = $bddConnection->prepare('INSERT INTO `cmw_widgets` (`message`, `titre`, `type`, `ordre`) VALUES (:message, :titre, :type, :ordre);');
            $req->execute($infos);
            $i++;
        }
    }
}

function accueil181to182($bddConnection) {
    $ac = new Lire('modele/config/accueil.yml');
    $ac = $ac->GetTableau();

    if(isset($ac['Infos']) && !empty($ac['Infos']) ) {
        $i = 0;
        foreach($ac['Infos'] as $value)
        {

            $infos = array();
            $infos['ordre'] = $i;
            $infos['message'] = $value['message'];
            $infos['type'] = $value['type'] == "lien" ? 0 : 1;
            $infos['lien'] = $value['lien'];
            $infos['image'] = str_replace("miniature-demo-1.jpg", "miniature-demo-1.png",str_replace("miniature-demo-2.jpg", "miniature-demo-1.png",str_replace("miniature-demo-3.jpg", "miniature-demo-1.png",$value['image'])));

            $req = $bddConnection->prepare("INSERT INTO `cmw_miniature` (`message`, `image`, `type`, `lien`, `ordre`) VALUES (:message, :image, :type, :lien, :ordre);");
            $req->execute($infos);
            $i++;
        }
    }
} 

function startsWith ($string, $startString) 
{ 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
} 

function undir($dir) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
       }
     }
     reset($objects);
     rmdir($dir);
   }
 }
