<?php
if($_Permission_->verifPerm('PermsPanel', 'upload', 'manage')) {

unlink('./theme/upload/panel/'.$_GET['file']);

}?>