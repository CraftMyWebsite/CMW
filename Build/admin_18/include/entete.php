<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <meta name="robots" content="nofollow, noindex">
    <meta name="google" content="notranslate" />
    <meta name="content-language" content="fr,fr-fr">
    <meta name="language" content="fr,fr-fr">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Panel administrateur CraftMyWebsite">
    <meta name="author" content="CraftMyWebsite, TheTueurCity (Vladimir), Bootstrap">

    <link rel="stylesheet" href="./admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="./admin/assets/css/main.css">
    <link rel="stylesheet" href="./admin/assets/css/toastr.min.css">
    <link rel="stylesheet" href="./admin/assets/css/dark.css">

    <script src="./admin/assets/js/Chart.min.js"></script>
    <script src="./admin/assets/js/PostManager.js"></script>
    <script src="./admin/assets/js/jquery.js"></script>
    <script src="./admin/assets/js/toastr.min.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
    <title>Administration | <?php echo $_Serveur_['General']['name']; ?></title>

    <style>
        .prefix {
            background-color: transparent;
            padding: 0px 6px;
            border: 1px solid transparent;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            -khtml-border-radius: 2px;
            border-radius: 2px;
            display: inline-block;
        }

        .prefix.prefixRed {
            color: white;
            background-color: red;
            border-color: #F88;
        }
    </style>
    <?php if(file_exists('./favicon.ico')){echo '<link rel="icon" type="image/x-icon" href="./favicon.ico"></link>';}?>
</head>
<body>
    <?php
    if(!isset($_GET['page']) OR $_GET['page'] == "accueil") {
            if($_SESSION['loader'] != true){
                $arr = json_decode(fetch('https://pastebin.com/raw/FXhFjgCh'));
                echo '<div id="loader-wrapper">
                        <div id="loader"></div>
                        <div id="loader-text">'.$arr[array_rand($arr, 1)].'</div>
                        <div class="loader-section section-left"></div>
                        <div class="loader-section section-right"></div>
                    </div>';
                $_SESSION['loader'] = true;
            }
        }


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
