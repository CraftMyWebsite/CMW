<?php
function GetClientIpEnv()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP')) {
        $ipaddress = getenv('HTTP_CLIENT_IP');
    } else if (getenv('HTTP_X_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    } else if (getenv('HTTP_X_FORWARDED')) {
        $ipaddress = getenv('HTTP_X_FORWARDED');
    } else if (getenv('HTTP_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    } else if (getenv('HTTP_FORWARDED')) {
        $ipaddress = getenv('HTTP_FORWARDED');
    } else if (getenv('REMOTE_ADDR')) {
        $ipaddress = getenv('REMOTE_ADDR');
    } else {
        $ipaddress = '0.0.0.0';
    }
    return htmlspecialchars($ipaddress);
}

$newsRecup = $bddConnection->query('SELECT * FROM cmw_news ORDER BY epingle DESC, date DESC');

$i = 0;
while ($newsDonnees = $newsRecup->fetch(PDO::FETCH_ASSOC)) {
    $news[$i]['id'] = $newsDonnees['id'];
    $news[$i]['titre'] = $newsDonnees['titre'];
    $news[$i]['message'] = $newsDonnees['message'];
    $news[$i]['auteur'] = $newsDonnees['auteur'];
    $news[$i]['date'] = $newsDonnees['date'];
    $news[$i]['image'] = $newsDonnees['image'];
    $i++;
}


$couleurInfos[0] = '1';
$couleurInfos[1] = '2';
$couleurInfos[2] = '3';

require_once('modele/accueil/accueilNews.class.php');
$accueilNews = new accueilNews($bddConnection);

// fin rajout (Les codes suivants sont dans l'accueil.php du theme) //
?>
