<?php 

if($_Permission_->verifPerm('PermsPanel', 'seo', 'actions', 'searchConsole')) {
    
    require_once('modele/google/googleService.class.php');
    
    if(googleService::isSearchConsoleEnable($_Serveur_)) {
        $_Serveur_['googleService']['searchConsole']['enable']  = false;
    } else {
        $_Serveur_['googleService']['searchConsole']['enable']  = true;
        require_once('modele/google/googleSearchConsole.class.php');
        googleSearchConsole::call($_Serveur_, $bddConnection, true);
    }
    $ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);
    
}