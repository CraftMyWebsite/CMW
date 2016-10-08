<?php
$lectureWidgets = new Lire('modele/config/configWidgets.yml');
$lectureWidgets = $lectureWidgets->GetTableau();


$i = count($lectureWidgets['Widgets']);


$lectureWidgets['Widgets'][$i]['titre'] = $_POST['titre'];
$lectureWidgets['Widgets'][$i]['type'] = $_POST['type'];

if($_POST['type'] == 3)
    $lectureWidgets['Widgets'][$i]['message'] = $_POST['message'];


$ecriture = new Ecrire('modele/config/configWidgets.yml', $lectureWidgets);
?>
