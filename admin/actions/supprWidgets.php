<?php 

if(isset($_GET['id']) && $_Permission_->verifPerm('PermsPanel', 'widgets', 'actions', 'editWidgets'))
{
    
    require('modele/widgets.class.php');
    $widgets = new widgets($bddConnection);
    
    $widgets->supprWidgets(intval($_GET['id']));
    
}