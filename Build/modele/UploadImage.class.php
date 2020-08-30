<?php
class UploadImage {

	public static function upload($file, $_Serveur_) {
		if(isset($_Serveur_['uploadImage']) && isset($_Serveur_['uploadImage']['maxFileSize']) && isset($_Serveur_['uploadImage']['maxSize'])) {
			if(isset($file)) {
				if($file['size'] <= $_Serveur_['uploadImage']['maxFileSize'] * 1000)
				{
					$chemin = pathinfo($file['name']);
					$extensionFichier = strtolower ($chemin['extension']);
					if(in_array($extensionFichier, array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'ico')))
					{
						$path = self::findFreePath(".".$extensionFichier);
						move_uploaded_file($file['tmp_name'], $path);
						self::checkOlderFile($_Serveur_);
						echo $path;
					} else {
						return "error Extension non réglementaire.";
					}
				} else {
					return "error Votre image est trop volumineuse.";
				}
			} else {
				return "error Contenue invalide.";
			}
		} else {
			return "error Service désactivé.";
		}
	}

	private static function findFreePath($extensionFichier) {
		$directory = 'include/UploadImage/';
		$fileName = uniqid().$extensionFichier;
		while(file_exists($directory.$fileName)) {
			$fileName = uniqid().$extensionFichier;
		}
		return $directory.$fileName;
	}

	private static function checkOlderFile($_Serveur_) {
		$directory = 'include/UploadImage/';
		$allSize = 0;
	    foreach (scandir($directory) as $file) {
	        if ($file !== '.' && $file !== '..') {
	           $allSize += filesize($directory.$file);
	        }
	    }
	    while($_Serveur_['uploadImage']['maxSize']*1000 < $allSize)
	    {
	    	$temp = self::removeOldestFile();
	    	if(isset($temp)) {
	    		$allSize -= $temp;
	    	} else {
	    		break;
	    	}
	    }
	}

	private static function removeOldestFile() {
		$directory= "include/UploadImage/";
		$smallest_time=INF;
		$oldest_file=null;
		if ($handle = opendir($directory)) {
   			while (false !== ($file = readdir($handle))) {
        		$time=filemtime($directory.'/'.$file);
        		if (is_file($directory.'/'.$file)) {
            		if ($time < $smallest_time) {
						$oldest_file = $file;
						$smallest_time = $time;
					}
				}
			}
			closedir($handle);
		}
		if(isset($oldest_file)) {
			$size = filesize($directory.'/'.$file);

			return unlink($directory.'/'.$file) ? $size : null;
		} else {
			return null;
		}
	}



}
?>
