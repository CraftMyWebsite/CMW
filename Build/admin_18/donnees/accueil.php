<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['home']['showPage'] == true) {
    $lectureAccueil = new Lire('modele/config/accueil.yml');
    $lectureAccueil = $lectureAccueil->GetTableau();


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