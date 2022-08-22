<?php
if($_Permission_->verifPerm('PermsPanel', 'widgets', 'actions', 'editWidgets')) {
    require("modele/widgets.class.php");
    $widgets = new widgets($bddConnection);
    

    for($i = 0; $i < intval($_POST['count']); $i++) {
        if(isset($_POST['type'.$i])) {
            $data = array();
            
            $data['message'] = $_POST['message'.$i];
            $data['titre'] = $_POST['titre'.$i];
            $data['type'] = intval($_POST['type'.$i]);
         
            $widgets->editWidgets($data, intval($_POST['id'.$i]));
        }
    }
}
?>