<?php
if($_Permission_->verifPerm('PermsPanel', 'widgets', 'actions', 'addWidgets')) {
    
    require('modele/widgets.class.php');
    $widgets = new widgets($bddConnection);
    
    $data = array();
    
    $data['message'] = $_POST['message'];
    $data['titre'] = $_POST['titre'];
    $data['type'] = intval($_POST['type']);

    $id =  $widgets->createWidgets($data);
    echo '[DIV]'.$id;
}

?> 