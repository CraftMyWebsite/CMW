<?php
if (!(!$_Permission_->verifPerm('PermsPanel', 'pages', 'actions', 'addPage') and !$_Permission_->verifPerm('PermsPanel', 'pages', 'actions', 'editPage'))) {

    require('modele/app/page.class.php');
    $page = new page();
    $pages = $page->getPages();

}
?>