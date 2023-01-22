<?php
if($_Permission_->verifPerm('PermsPanel', 'general', 'actions', 'editUploadImg')) {
    $directory = 'include/UploadImage/';
    foreach (scandir($directory) as $file) {
        if ($file !== '.' && $file !== '..' && $file != 'index.php') {
            unlink($directory.$file);
        }
    }
}