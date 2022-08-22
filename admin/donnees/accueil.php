<?php if($_Permission_->verifPerm('PermsPanel', 'home', 'showPage' )) { 
    
    require('modele/accueil/miniature.class.php');
    $Miniature = new miniature($bddConnection);
    $Miniature  = $Miniature->getMinia();
  
    $images = scandir('theme/upload/navRap/');
   // $imagesSlider = scandir('theme/upload/slider');

    require('modele/app/page.class.php');
    $page = new page();
    
    $pages = $page->getPagesName();
    
    array_push($pages, 'boutique');
    array_push($pages, 'voter');
    array_push($pages, 'tokens');
    array_push($pages, 'forum');
    array_push($pages, 'support');
    array_push($pages, 'chat');
    array_push($pages, 'membres');
    array_push($pages, 'panier');
    array_push($pages, 'banlist');

}
?>