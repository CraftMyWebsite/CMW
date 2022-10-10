<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//error_reporting(0);
require_once('controleur/config.php');
require_once('controleur/connection_base.php');

if (isset($_POST['go']) and $_POST['go'] == 1) {
    //Modifcation des fichiers
    $archiveUpdate = new ZipArchive;
    if ($archiveUpdate->open('update.zip') === TRUE) {
        $archiveUpdate->extractTo(__DIR__);
        $archiveUpdate->close();

        bdd182to19($bddConnection);
        file182to19();

        unlink('update.zip');
        echo 'Mise à jour réussie ! <a href="index.php?&removeUpdater=true">Aller sur votre site</a>';
    }
} else {
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
        <title>CraftMyWebsite | Mise à jour - 1.9 - LTS</title>
    </head>

    <body class="bg-light2">

    <div class="container">

        <div class="pt-5 text-center">
            <img class="d-block mx-auto mb-4 img"
                 src="https://cdn.discordapp.com/attachments/382840368099753984/775433866777198622/craftmywebsite.png"
                 alt="CraftMyWebsite - Logo" width="94"
                 height="94" style="border-radius: 9px;">
            <h2>Mise à jour de votre site ! 😃</h2>
            <p class="lead">
                Bienvenue sur la page de mise à jour de votre site internet<br/>
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
                    Cette version réinitialisera votre choix thème (Défault), les thèmes autre que Default ne seront pas
                    forcément compatible avec cette version - en cas de doute contactez le créateur du thème que vous
                    souhaitez utiliser !
                </p>
            </div>
            <div class="alert alert-danger">
                <p class="text">
                <center><strong>ATTENTION</strong></center>
                Cette mise à jour va modifier le stockage des menus. Par conséquent, <strong>vos menus vont être
                    réinitialisés</strong> et remis par défaut.
                Pensez à noter vos menus afin de les réintégrer prochainement.
                </p>
            </div>
            <?php
            if (!file_exists('update.zip')) {
                ?>
                <div class="alert alert-danger">
                    <p class="text">
                        ALERTE ! Il vous manque le fichier <strong>update.zip</strong>, vous ne pouvez pas commencer la
                        migration sans ce fichier !!!
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
                                    Changelog
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
                                <button type="submit" class="btn btn-success btn-block">Mettre à jour le CMS
                                    (irréversible)
                                </button>
                            </form>
                        </div>


                    </div>
                </div>

            </div>


        </div>

    </div>

    <footer class="my-4 text-muted text-center text-small">
        <p class="mb-1">&copy; 2014 - <?= date('Y') ?>
            CraftMyWebsite
        </p>
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
function file182to19(): void
{
    /* TODO */
}

function bdd182to19($bddConnection): void
{
    //Update resettoken for the new reset system
    $bddConnection->exec('ALTER TABLE `cmw_users` CHANGE `resettoken` `resettoken` VARCHAR(500);');

}


function startsWith($string, $startString): bool
{
    return (str_starts_with($string, $startString));
}

function undir($dir): void
{
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object !== '.' && $object !== '..') {
                if (filetype($dir . '/' . $object) === 'dir') {
                    rrmdir($dir . '/' . $object);
                } else {
                    unlink($dir . '/' . $object);
                }
            }
        }
        reset($objects);
        rmdir($dir);
    }
}
