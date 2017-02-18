<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['payment']['actions']['editPayment'] == true) {
	$lecture = new Lire('modele/config/config.yml');
	$lecture = $lecture->GetTableau();
	$lectureAlloconv = new Lire('modele/config/configAlloconv.yml');
	$lectureAlloconv = $lectureAlloconv->GetTableau();


	if(isset($_POST['paypal']))
		$lecture['Payement']['paypal'] = true;
	else
		$lecture['Payement']['paypal'] = false;	
	if(isset($_POST['alloconv']))
		$lectureAlloconv['enabled'] = true;
	else
		$lectureAlloconv['enabled'] = false;	
	if(isset($_POST['telipass']))
		$lecture['Payement']['telipass'] = true;
	else
		$lecture['Payement']['telipass'] = false;	

	$lectureAlloconv['tokens'] = $_POST['alloconv_tokens'];
	$lectureAlloconv['palier'] = $_POST['alloconv_palier'];
	$lectureAlloconv['Infos']['idClient'] = $_POST['alloconv_idClient'];
	$lectureAlloconv['Infos']['idSite'] = $_POST['alloconv_idSite'];
	$lectureAlloconv['Infos']['cle'] = $_POST['alloconv_cle'];
	$lecture['Payement']['paypalUser'] = $_POST['paypalUser'];
	$lecture['Payement']['paypalPass'] = $_POST['paypalPass'];
	$lecture['Payement']['paypalSignature'] = $_POST['paypalSignature'];
	$lecture['Payement']['paypalEmail'] = $_POST['paypalEmail'];
	$lecture['Payement']['paypalMethodeAPI'] = $_POST['paypalMethodeAPI'];

	$ecritureAlloconv = new Ecrire('modele/config/configAlloconv.yml', $lectureAlloconv);
	$ecriture = new Ecrire('modele/config/config.yml', $lecture);
}
?>