<?php
if($_Permission_->verifPerm('PermsPanel', 'upload', 'manage')) {

    require_once './controleur/images.class.php';

    Images::upload($_FILES['img'], 'theme/upload/panel');
	
	header ('location: admin.php?page=upload&success');
	exit();
}