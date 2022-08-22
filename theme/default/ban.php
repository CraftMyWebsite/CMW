<?php
$req = $bddConnection->query('SELECT * FROM cmw_ban_config');
$data = $req->fetch(PDO::FETCH_ASSOC);
require('include/version.php');

$banned = true
?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <title>
        <?= $_Serveur_['General']['name'] . " | BANNI " ?>
    </title>

   <base href="https://<?= $_SERVER["SERVER_NAME"] ?>/" />

    <!-- Meta -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="theme-color" content="<?= $_Serveur_["color"]["theme"]["main"]; ?>">
    <meta name="msapplication-navbutton-color" content="<?= $_Serveur_["color"]["theme"]["main"]; ?>">
    <meta name="apple-mobile-web-app-statut-bar-style" content="<?= $_Serveur_["color"]["theme"]["main"]; ?>">
    <meta name="apple-mobile-web-app-capable" content="<?= $_Serveur_["color"]["theme"]["main"]; ?>">

    <!-- SEO -->
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
    <meta name="publisher" content="<?= $_SERVER["SERVER_NAME"] ?>"/>
    <meta name="description" content="<?= $_Serveur_['General']['description'] ?>">
    <meta name="keywords" content="<?= isset($_Serveur_['General']['keywords']) & !empty($_Serveur_['General']['keywords']) ? $_Serveur_['General']['keywords'] : 'Minecraft CraftMyWebSite Vote' ?>">

    <meta name="copyright" content="CraftMyWebsite, <?= $_Serveur_['General']['name']; ?>"/>

    <meta name="robots" content="follow, index, all">
    <meta name="google" content="notranslate">

    <!-- CSS links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="theme/<?= $_Serveur_['General']['theme']; ?>/assets/css/custom.css">

</head>

<body>
    <?php

    ?>

    <?php
    include('theme/' . $_Serveur_['General']['theme'] . '/entete.php'); //Header included
    tempMess(); ?>


    <!-- Contenue de la page -->


    <section id="Ban">
        <div class="container-fluid col-md-9 col-lg-9 col-sm-10">
            <div class="card my-5 p-3">
                <h3 class="card-header text-center">
                    <?= $data['titre']; ?>
                </h3>

                <h5 class="card-body">
                    <?= $data['texte']; ?>
                </h5>
            </div>
        </div>
    </section>




    <?php include('theme/' . $_Serveur_['General']['theme'] . '/formulaires.php'); //Forms included 
    include('theme/' . $_Serveur_['General']['theme'] . '/pied.php');  //Footer included 
    ?>



    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>

</html>