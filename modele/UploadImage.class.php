<?php

class UploadImage
{

    public static function upload($file, $_Serveur_)
    {
        if (isset($_Serveur_['uploadImage']) && isset($_Serveur_['uploadImage']['maxFileSize']) && isset($_Serveur_['uploadImage']['maxSize'])) {
            if (isset($file)) {
                if ($file['size'] <= $_Serveur_['uploadImage']['maxFileSize'] * 1000) {
                    $chemin = pathinfo($file['name']);
                    $extensionFichier = strtolower($chemin['extension']);
                    if (in_array($extensionFichier, array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'ico'))) {
                        // NETTOYAGE DE L'URL
                        $pathwaitclean = self::findFreePath('.' . $extensionFichier);
                        $path = preg_replace("/(\t|\n|\v|\f|\r| |\xC2\x85|\xc2\xa0|\xe1\xa0\x8e|\xe2\x80[\x80-\x8D]|\xe2\x80\xa8|\xe2\x80\xa9|\xe2\x80\xaF|\xe2\x81\x9f|\xe2\x81\xa0|\xe3\x80\x80|\xef\xbb\xbf)+/",
                            '', $pathwaitclean);

                        move_uploaded_file($file['tmp_name'], $path);
                        self::checkOlderFile($_Serveur_);
                        echo $path;
                    } else {
                        return 'error Extension non réglementaire.';
                    }
                } else {
                    return 'error Votre image est trop volumineuse.';
                }
            } else {
                return 'error Contenue invalide.';
            }
        } else {
            return 'error Service désactivé.';
        }
    }

    private static function findFreePath($extensionFichier)
    {
        $directory = 'include/UploadImage/';
        $fileName = uniqid() . $extensionFichier;
        while (file_exists($directory . $fileName)) {
            $fileName = uniqid() . $extensionFichier;
        }
        return $directory . $fileName;
    }

    private static function checkOlderFile($_Serveur_)
    {
        $directory = 'include/UploadImage/';
        $allSize = 0;
        foreach (scandir($directory) as $file) {
            if ($file !== '.' && $file !== '..') {
                $allSize += filesize($directory . $file);
            }
        }
        while ($_Serveur_['uploadImage']['maxSize'] * 1000 < $allSize) {
            $temp = self::removeOldestFile();
            if (isset($temp)) {
                $allSize -= $temp;
            } else {
                break;
            }
        }
    }

    private static function removeOldestFile()
    {
        $directory = 'include/UploadImage/';
        $smallest_time = INF;
        $oldest_file = null;
        if ($handle = opendir($directory)) {
            while (false !== ($file = readdir($handle))) {
                $time = filemtime($directory . '/' . $file);
                if (is_file($directory . '/' . $file)) {
                    if ($time < $smallest_time) {
                        $oldest_file = $file;
                        $smallest_time = $time;
                    }
                }
            }
            closedir($handle);
        }
        if (isset($oldest_file)) {
            $size = filesize($directory . '/' . $file);

            return unlink($directory . '/' . $file) ? $size : null;
        } else {
            return null;
        }
    }


}

?>
