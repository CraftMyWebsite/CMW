<?php

$lecture = new Lire('modele/config/config.yml');
$lecture = $lecture->GetTableau();

if(isset($_POST['paypal']))
	$lecture['Payement']['paypal'] = true;
else
	$lecture['Payement']['paypal'] = false;	
if(isset($_POST['starpass']))
	$lecture['Payement']['starpass'] = true;
else
	$lecture['Payement']['starpass'] = false;	
if(isset($_POST['telipass']))
	$lecture['Payement']['telipass'] = true;
else
	$lecture['Payement']['telipass'] = false;	

$lecture['Payement']['starpassIDD'] = $_POST['starpassIDD'];
$lecture['Payement']['starpassIDP'] = $_POST['starpassIDP'];
$lecture['Payement']['starpassJetons'] = $_POST['starpassJetons'];
$lecture['Payement']['paypalUser'] = $_POST['paypalUser'];
$lecture['Payement']['paypalPass'] = $_POST['paypalPass'];
$lecture['Payement']['paypalSignature'] = $_POST['paypalSignature'];
$lecture['Payement']['paypalEmail'] = $_POST['paypalEmail'];
$lecture['Payement']['paypalMethodeAPI'] = $_POST['paypalMethodeAPI'];

$ecriture = new Ecrire('modele/config/config.yml', $lecture);

?>
