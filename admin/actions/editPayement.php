<?php

$lecture = new Lire('modele/config/config.yml');
$lecture = $lecture->GetTableau();

if(isset($_POST['paypal']))
	$lecture['Payement']['paypal'] = true;
else
	$lecture['Payement']['paypal'] = false;	
if(isset($_POST['dedipass']))
	$lecture['Payement']['dedipass'] = true;
else
	$lecture['Payement']['dedipass'] = false;	
if(isset($_POST['telipass']))
	$lecture['Payement']['telipass'] = true;
else
	$lecture['Payement']['telipass'] = false;	

$lecture['Payement']['dedipass_public'] = $_POST['dedipass_public'];
$lecture['Payement']['dedipass_private'] = $_POST['dedipass_private'];
$lecture['Payement']['paypalUser'] = $_POST['paypalUser'];
$lecture['Payement']['paypalPass'] = $_POST['paypalPass'];
$lecture['Payement']['paypalSignature'] = $_POST['paypalSignature'];
$lecture['Payement']['paypalEmail'] = $_POST['paypalEmail'];
$lecture['Payement']['paypalMethodeAPI'] = $_POST['paypalMethodeAPI'];

$ecriture = new Ecrire('modele/config/config.yml', $lecture);

?>
