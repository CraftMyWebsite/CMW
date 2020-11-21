<?php
require_once ('app/plugins/chmod.php');
function SetHtpasswd() {
    $dir[0] = '../modele/.htpasswd';
    $dir[1] = '../controleur/.htpasswd';
    $dir[2] = '../admin/actions/.htpasswd';
    $rand = md5(uniqid(rand(), true)); 

    for($i = 0; $i < count($dir); $i++)
    {
        $htaccess = fopen($dir[$i], 'r+');
        fseek($htaccess, 0);
        fputs($htaccess, 'cms:'. $rand);
    }
}