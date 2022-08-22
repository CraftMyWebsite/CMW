<?php
if(!(!$_Permission_->verifPerm('PermsPanel', 'pages', 'actions', 'addPage') AND !$_Permission_->verifPerm('PermsPanel', 'pages', 'actions', 'editPage'))) {
	
    require('modele/app/page.class.php');
    $page = new page();
    $pages = $page->getPages();

}
?>