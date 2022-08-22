<?php if ($_Permission_->verifPerm('PermsPanel', 'home', 'showPage')) {

    require('modele/accueil/miniature.class.php');
    $Miniature = new miniature($bddConnection);
    $Miniature = $Miniature->getMinia();

    $images = scandir('theme/upload/navRap/');
    // $imagesSlider = scandir('theme/upload/slider');

    require('modele/app/page.class.php');
    $page = new page();

    $pages = $page->getPagesName();

    $pages[] = 'boutique';
    $pages[] = 'voter';
    $pages[] = 'tokens';
    $pages[] = 'forum';
    $pages[] = 'support';
    $pages[] = 'chat';
    $pages[] = 'membres';
    $pages[] = 'panier';
    $pages[] = 'banlist';
}