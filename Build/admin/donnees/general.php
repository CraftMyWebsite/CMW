<?php
if($_Permission_->verifPerm('PermsPanel', 'general', 'actions', 'editUploadImg') && $_Permission_->verifPerm('PermsPanel', 'general', 'showPage')) {
	$filetotal = 0;
	$sizetotal = 0;
	foreach (scandir("include/UploadImage/") as $file) {
	    if ($file !== '.' && $file !== '..' && $file != "index.php") {
	    	$filetotal++;
	        $sizetotal += filesize("include/UploadImage/".$file);
	    }
	}
	$sizetotal /= 1000;
	if($sizetotal > 1000) {
		if($sizetotal > 1000000) {
			$sizetotal = ($sizetotal/1000000)."GB";
		} else {
			$sizetotal = ($sizetotal/1000)."MB";
		}
	} else {
		$sizetotal = $sizetotal."KB";
	}
}
?>