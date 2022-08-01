<?php 

if(isset($_GET['id']) && $_Permission_->verifPerm('PermsPanel', 'home', 'actions','editMiniature'))
{
    
    require('modele/accueil/miniature.class.php');
    $Minia = new miniature($bddConnection);
    
    $Minia->supprMinia(intval($_GET['id']));
    
}