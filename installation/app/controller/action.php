<?php
if (isset($_GET['action']) and $_GET['action'] == 'setchmod') {

    chmod('app/data/install.yml', 0777);

    chmod('../modele/config/config.yml', 0755);
    chmod('../modele/.htpasswd', 0755);
    chmod('../controleur/.htpasswd', 0755);
    chmod('../admin/actions/.htpasswd', 0755);

    exec('chmod 0777 ../theme/upload');
    exec('chmod 0777 ../theme/upload/navRap/');
    exec('chmod 0777 ../theme/upload/panel/');
    exec('chmod 0777 ../utilisateurs/');
}

if (isset($_GET['action']) and $_GET['action'] == 'windowsforceinstall') {
    setWindows();
}
// On essaie de se connecté et d'écrire les premiéres données histoire de voir si la base de données répond bien
if (isset($_GET['action']) and $_GET['action'] == 'sql' and isset($_POST['hote']) and isset($_POST['nomBase']) and isset($_POST['utilisateur']) and isset($_POST['mdp']) and isset($_POST['port'])) {
    if (($testPDO = verifyPDO($_POST['hote'], $_POST['nomBase'], $_POST['utilisateur'], $_POST['mdp'], $_POST['port'])) === TRUE) {
        $sql = getPDO($_POST['hote'], $_POST['nomBase'], $_POST['utilisateur'], $_POST['mdp'], $_POST['port']);
        require_once('app/plugins/installSQL.php');
    } else if ($testPDO == 3) {
        $erreur['type'] = 'pass';
    } else {
        $erreur['type'] = 'sql_mode';
        $erreur['data'] = $testPDO;
    }
}
// On ecrit les informations de la page "Configuration & Paramétrage du site" dans les fichier de config du cms
if (isset($_GET['action']) and $_GET['action'] == 'infos' and isset($_POST['nom']) and isset($_POST['adresse']) and isset($_POST['description'])) {
    require('app/plugins/installInfos.php');
}
if (isset($_GET['action']) and $_GET['action'] == 'cgu') {
    $installLecture = new Lire('app/data/install.yml');
    $installLecture = $installLecture->GetTableau();
    $installLecture['etape'] = 1;

    $ecriture = new Ecrire('app/data/install.yml', $installLecture);

    header('Location: index.php');
}
if (isset($_GET['action']) and $_GET['action'] == 'compte' and isset($_POST['pseudo']) and isset($_POST['mdp']) and isset($_POST['email'])) {
    $sql = getPDO($_Serveur_['DataBase']['dbAdress'], $_Serveur_['DataBase']['dbName'], $_Serveur_['DataBase']['dbUser'], $_Serveur_['DataBase']['dbPassword'], $_Serveur_['DataBase']['dbPort']);

    require_once('app/plugins/compteAdmin.php');
    $compte = new CompteAdmin($sql, $_POST['pseudo'], $_POST['mdp'], $_POST['email']); //Création du compte admin

    $config = new Lire('../modele/config/config.yml');
    $config = $config->GetTableau();
    $config['installation'] = true;
    $ecriture = new Ecrire('../modele/config/config.yml', $config);

    $installLecture = new Lire('app/data/install.yml');
    $installLecture = $installLecture->GetTableau();
    $installLecture['etape'] = 4;

    $ecriture = new Ecrire('app/data/install.yml', $installLecture);

    header('Location: index.php');
}
if (isset($_GET['forceHtaccess']) && $_GET['forceHtaccess'] == true) {
    setcookie('forceInstallHtaccess', true, time() + 3600);
    $forceInstall = true;
}
