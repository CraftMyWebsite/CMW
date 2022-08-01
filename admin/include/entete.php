<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <meta name="robots" content="nofollow, noindex">
    <meta name="google" content="notranslate"/>
    <meta name="content-language" content="fr,fr-fr">
    <meta name="language" content="fr,fr-fr">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Panel administrateur CraftMyWebsite">
    <meta name="author" content="CraftMyWebsite, TheTueurCity (Vladimir), Bootstrap">

    <link rel="stylesheet" href="./admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="./admin/assets/css/main.css">
    <link rel="stylesheet" href="./admin/assets/css/toastr.min.css">
    <link rel="stylesheet" href="./admin/assets/css/dark.css">

    <script src="./admin/assets/js/Chart.min.js"></script>
    <script src="./admin/assets/js/PostManager.js"></script>
    <script src="./admin/assets/js/jquery.min.js"></script>
    <script src="./admin/assets/js/tagsinput.js"></script>
    <script src="./admin/assets/js/toastr.min.js"></script>

    <script src="./admin/assets/js/ckeditor.js"></script>


    <title>Administration | <?php echo $_Serveur_['General']['name']; ?></title>

    <style>
        .prefix {
            background-color: transparent;
            padding: 0px 6px;
            border: 1px solid transparent;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            -khtml-border-radius: 2px;
            border-radius: 2px;
            display: inline-block;
        }

        .prefix.prefixRed {
            color: white;
            background-color: red;
            border-color: #F88;
        }
    </style>
    <?php if (file_exists('./favicon.ico')) {
        echo '<link rel="icon" type="image/x-icon" href="./favicon.ico"></link>';
    } ?>
</head>
<?php
if (isset($_POST['darkSwitch'])) {
    $_SESSION['darkSwitch'] = 1;
} elseif (isset($_POST['removeDarkSwitch']) && isset($_SESSION['darkSwitch'])) {
    unset($_SESSION['darkSwitch']);
}

if (isset($_SESSION['darkSwitch'])) {
    echo '<body data-theme="dark">';
} else {
    echo '<body>';
}
?>
<?php
if (!isset($_GET['page']) or $_GET['page'] == 'accueil') {
    if (!isset($_SESSION['loader']) || $_SESSION['loader'] != true) {
        $arr = array(
            'Quel belle journée pour administrer votre serveur de jeu',
            'Passez une agréable journée administrateur !',
            "Saviez-vous qu'il est possible d'installer un thème pour personnaliser l'apparence de votre site ?",
            'On me dit de vous souhaiter une agréable journée',
            "Bienvenue sur votre panel d'administration !",
            "Connaissez-vous Minestrator ? C'est l'hébergeur Minecraft par excellence !",
            "Connaisez-vous Webstrator ? L'hébergeur web partenaire CraftMyWebsite garantie 100% compatible ! <br/> <strong>Premier mois offert !</strong>",
            'La première version de CraftMyWebsite est sortie au téléchargement le 01/12/2014',
            'Chargement en cours ...',
            "Comment ça va aujourd'hui vous ? Moi ça va",
            'En cas de problèmes, rejoignez le Discord de CraftMyWebsite'
        );
        echo '<div id="loader-wrapper">
                        <div id="loader"></div>
                        <div id="loader-text">' . $arr[array_rand($arr, 1)] . '</div>
                        <div class="loader-section section-left"></div>
                        <div class="loader-section section-right"></div>
                    </div>';
        $_SESSION['loader'] = true;
    }
}
?>