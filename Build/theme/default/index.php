<?php
require('theme/' . $_Serveur_['General']['theme'] . '/preload.php'); ?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <style>
        :root {
            --main-color-bg: <?= $_Serveur_["color"]["theme"]["bg-main"] ?> !important;
            --secondary-color-bg: <?= $_Serveur_["color"]["theme"]["bg-secondary"] ?> !important;

            --base-color: <?= $_Serveur_["color"]["theme"]["text-base"] ?> !important;
            --main-color: <?= $_Serveur_["color"]["theme"]["text-main"] ?> !important;
            --active-color: <?= $_Serveur_["color"]["theme"]["text-active"] ?> !important;

            --darkest-color-bg: <?= $_Serveur_["color"]["theme"]["bg-darkest"] ?> !important;
            --lightest-color-bg: <?= $_Serveur_["color"]["theme"]["bg-lightest"] ?> !important;
        }
    </style>

    <title>
        <?= $_Serveur_['General']['name'] . " | " . (isset($_GET["page"]) ? $_GET["page"] : $_Serveur_['General']['description']) ?>
    </title>

    <!-- Meta -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="theme-color" content="<?= $_Serveur_["color"]["theme"]["main"]; ?>">
    <meta name="msapplication-navbutton-color" content="<?= $_Serveur_["color"]["theme"]["main"]; ?>">
    <meta name="apple-mobile-web-app-statut-bar-style" content="<?= $_Serveur_["color"]["theme"]["main"]; ?>">
    <meta name="apple-mobile-web-app-capable" content="<?= $_Serveur_["color"]["theme"]["main"]; ?>">

    <meta property="og:title" content="<?= $_Serveur_['General']['name'] ?>">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://<?= $_SERVER["SERVER_NAME"] ?>">
    <meta property="og:image" content="https://<?= $_SERVER["SERVER_NAME"] ?>/favicon.ico">
    <meta property="og:image:alt" content="<?= $_Serveur_['General']['description'] ?>">
    <meta property="og:description" content="<?= $_Serveur_['General']['description'] ?>">
    <meta property="og:site_name" content="<?= $_Serveur_['General']['name'] ?>" />

    <meta name="twitter:title" content="<?= $_Serveur_['General']['name'] ?>">
    <meta name="twitter:description" content="<?= $_Serveur_['General']['description'] ?>">
    <meta name="twitter:image" content="https://<?= $_SERVER["SERVER_NAME"] ?>/favicon.ico">

    <meta name="author" content="CraftMyWebsite, TheTueurCiTy, <?= $_Serveur_['General']['name']; ?>" />

    <!-- CSS links -->
    <link rel="stylesheet" href="theme/<?= $_Serveur_['General']['theme']; ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="theme/<?= $_Serveur_['General']['theme']; ?>/assets/css/fa-all.min.css">
    <link rel="stylesheet" href="theme/<?= $_Serveur_['General']['theme']; ?>/assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
    <link rel="stylesheet" href="theme/<?= $_Serveur_['General']['theme']; ?>/assets/css/toastr.min.css">
    <script src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/ckeditor.js"></script>
    <?php if(isset($_GET['page']) && $_GET['page'] == "voter") {
        echo '<script src="theme/'.$_Serveur_['General']['theme'].'/assets/js/voteControleur.js"></script>';
    } ?>
</head>

<body>
    <script type="text/javascript">var _Jetons_ = "<?=$_Serveur['General']['moneyName'];?>";</script>
    <?php
    //Verif Version
    include("./include/version.php");
    include("./include/version_distant.php");

    if ($versioncms != $versioncmsrelease && Permission::getInstance()->verifPerm('PermsPanel', 'update', 'showPage')) : ?>

        <div class=" mb-0 rounded-0 text-center alert alert-main bg-lightest alert-dismissible text-shadow-none fade show sticky-top" role="alert">
            <h5 class="m-0">
                Une mise à jour est disponible <strong>(<a href="https://craftmywebsite.fr/telecharger" target="_blank" class="alert-link"><?= $versioncmsrelease ?></a>)</strong> !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color: var(--base-color);">
                    <span aria-hidden="true">&times;</span>
                </button>
            </h5>
        </div>

    <?php endif; ?>

    <?php if (Permission::getInstance()->verifPerm("connect")) /* --> */ setcookie('pseudo', $_Joueur_['pseudo'], time() + 86400, null, null, false, true);

    include('theme/' . $_Serveur_['General']['theme'] . '/entete.php'); //Header included
    tempMess(); ?>

    <?php
    //Verif Installation Folder is deleted
    if (is_dir("installation")) {
        include('theme/' . $_Serveur_['General']['theme'] . '/pages/fichier_installation.php');
    } else {
        include('controleur/page.php'); //Page included
    }
    include('theme/' . $_Serveur_['General']['theme'] . '/pied.php');  //Footer included
    include('theme/' . $_Serveur_['General']['theme'] . '/formulaires.php'); //Forms included
    ?>

    <div id="divScroll" class="btn btn-main" onclick="goToTop()"><i class="fa fa-arrow-up" aria-hidden="true"></i></div>


    <!-- Librairies Essential -->
    <script src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/jquery.min.js"></script>
    <script src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/popper.min.js"></script>
    <script src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>

    <!-- Scripts -->
    <script src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/zxcvbn.js"></script>
    <script src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/custom.js"></script>
    <?php include "theme/" . $_Serveur_['General']['theme'] . "/assets/php/ckeditorManager.php"; ?>
    <script src="theme/<?= $_Serveur_['General']['theme']; ?>/assets//js/toastr.min.js"></script>
    <?php include "theme/" . $_Serveur_['General']['theme'] . "/assets/php/custom.php"; ?>
    <?php if ($_Serveur_['Payement']['dedipass']) : //API DEDIPASS 
    ?>
        <script src="//api.dedipass.com/v1/pay.js"></script>
    <?php endif; ?>

</body>

</html>
