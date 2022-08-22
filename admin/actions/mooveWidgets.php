<?php if($_Permission_->verifPerm('PermsPanel', 'widgets', 'actions', 'editWidgets')) { 
    
    require("modele/widgets.class.php");
    $widgets = new widgets($bddConnection);
    
    if($_GET['type'] == "0") {
        $widgetswidgets->downWidgets(intval($_GET['id']));
    } else if($_GET['type'] == "1") {
        $widgets->upWidgets(intval($_GET['id']));
    }
    
}