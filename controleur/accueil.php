<?php
function GetClientIpEnv() 
{
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP')) {
		$ipaddress = getenv('HTTP_CLIENT_IP');
	} else if(getenv('HTTP_X_FORWARDED_FOR')) {
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	} else if(getenv('HTTP_X_FORWARDED')) {
		$ipaddress = getenv('HTTP_X_FORWARDED');
	} else if(getenv('HTTP_FORWARDED_FOR')) {
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	} else if(getenv('HTTP_FORWARDED')) {
		$ipaddress = getenv('HTTP_FORWARDED');
	} else if(getenv('REMOTE_ADDR')) {
		$ipaddress = getenv('REMOTE_ADDR');
	} else {
		$ipaddress = '0.0.0.0';
	}
	return $ipaddress;
}

require_once('modele/app/accueil.class.php');
$AccueilData = new AccueilData($bddConnection);
$newsRecup = $AccueilData->GetNews();

$i = 0;
while($newsDonnees = $newsRecup->fetch())
{
	$news[$i]['id'] = $newsDonnees['id'];
	$news[$i]['titre'] = $newsDonnees['titre'];
	$news[$i]['message'] = $newsDonnees['message'];
	$news[$i]['auteur'] = $newsDonnees['auteur'];
	$news[$i]['date'] = $newsDonnees['date'];
	$news[$i]['image'] = $newsDonnees['image'];
	$i++;
}

$lectureAccueil = new Lire('modele/config/accueil.yml');
$lectureAccueil = $lectureAccueil->GetTableau();

$sliders = $lectureAccueil['Slider'];
$iSliders = count($lectureAccueil['Slider']);

$couleurInfos[0] = '1';
$couleurInfos[1] = '2';
$couleurInfos[2] = '3';

// rajout //

$getIp = GetClientIpEnv();
$getDates = date("Y-m-d");
$getOldDates = strftime("%Y-%m-%d", mktime(0, 0, 0, date('m'), date('d')-7, date('y'))); 

$repCheckVisit = $AccueilData->CheckVisit($getIp, $getDates);
$CheckVisit = $repCheckVisit->rowCount();

$repTotalVisits = $AccueilData->GetTotalVisits();
$getTotalVisits = $repTotalVisits->fetch();
$totalVisits = $getTotalVisits['id'];

if($CheckVisit == "0") {
	$AccueilData->AddVisit($totalVisits + 1, $getIp, $getDates);
}

$AccueilData->DelOldVisits($getOldDates);

require_once('modele/accueil/accueilNews.class.php');
$accueilNews = new accueilNews($bddConnection);

// fin rajout (Les codes suivants sont dans l'accueil.php du theme) //
?>