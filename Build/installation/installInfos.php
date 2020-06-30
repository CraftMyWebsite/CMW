<?php
$config = new Lire('../modele/config/config.yml');
$config = $config->GetTableau();

$config['General']['url'] = $_POST['adresse'];
$config['General']['name'] = $_POST['nom'];
$config['General']['description'] = $_POST['description'];
$config['General']['ipTexte'] = $_POST['ipTexte'];
$config['General']['ip'] = $_POST['ip'];
$config['General']['port'] = $_POST['port'];

$config = new Ecrire('../modele/config/config.yml', $config);



$installLecture = new Lire('install.yml');
$installLecture = $installLecture->GetTableau();
$installLecture['etape'] = 3;

$ecriture = new Ecrire('install.yml', $installLecture);

header('Location: index.php');
?>
