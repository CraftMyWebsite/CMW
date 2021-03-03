<?php if($_Permission_->verifPerm('PermsPanel', 'home', 'showPage' )) { 
    
    require("modele/accueil/miniature.class.php");
    $Miniature = new miniature($bddConnection);
    $Miniature  = $Miniature->getMinia();
  
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