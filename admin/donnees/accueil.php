<?php if($_Permission_->verifPerm('PermsPanel', 'home', 'showPage' )) { 
    $lectureAccueil = new Lire('modele/config/accueil.yml');
    $lectureAccueil = $lectureAccueil->GetTableau();

    for($i = 1;$i < count($lectureAccueil['Infos']) + 1;$i++) {
      if($lectureAccueil['Infos'][$i]['type'] == "page") {
        $pageActive[$i] = $lectureAccueil['Infos'][$i]['lien'];
      }
    }


    $images = scandir('theme/upload/navRap/');
   // $imagesSlider = scandir('theme/upload/slider');

    $pagesReq = $bddConnection->query('SELECT titre FROM cmw_pages');
    $i = 0;
    while($pagesDonnees = $pagesReq->fetch(PDO::FETCH_ASSOC))
    {
       $pages[$i] = $pagesDonnees['titre'];
       $i++;
   }
   $pages[$i] = 'boutique';
    $i++;
    $pages[$i] = 'voter';
    $i++;
    $pages[$i] = 'tokens';
    $i++;
    $pages[$i] = 'forum';
    $i++;
    $pages[$i] = 'support';
}
?>