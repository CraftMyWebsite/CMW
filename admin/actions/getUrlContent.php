<?php

echo '[DIV]' . fetch($_GET['url']);

function fetch($url)
{
    if (function_exists('curl_init') and extension_loaded('curl')) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    } else {
        return @file_get_contents($url);
    }
}

?>