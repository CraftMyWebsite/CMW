<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="nofollow, noindex">
    <meta name="content-language" content="fr,fr-fr">
    <meta name="language" content="fr,fr-fr">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="NOPE..">
    <meta name="author" content="CraftMyWebsite, TheTueurCity (Vladimir), Teyir">

    <title>NOPE</title>

    <link rel="icon" type="image/x-icon" href="favicon.ico">


    <style>
        @import url("https://fonts.googleapis.com/css?family=Share+Tech+Mono|Montserrat:700");

        * {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
            box-sizing: border-box;
            color: inherit;
        }

        body {
            background: -webkit-linear-gradient(to right, #2F0743, #41295a);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #2F0743, #41295a); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            height: 100vh;
        }

        h1 {
            font-size: 30vw;
            text-align: center;
            position: fixed;
            width: 100vw;
            z-index: 1;
            color: #ffffff26;
            text-shadow: 0 0 50px rgba(0, 0, 0, 0.07);
            top: 50%;
            transform: translateY(-50%);
            font-family: "Montserrat", monospace;
        }

        div {
            background: rgba(0, 0, 0, 0);
            width: 70vw;
            position: relative;
            top: 50%;
            transform: translateY(-50%);
            margin: 0 auto;
            padding: 30px 30px 10px;
            box-shadow: 0 0 150px -20px rgba(0, 0, 0, 0.5);
            z-index: 3;
        }

        P {
            font-family: "Share Tech Mono", monospace;
            color: #f5f5f5;
            margin: 0 0 20px;
            font-size: 17px;
            line-height: 1.2;
        }

        span {
            color: #f0c674;
        }

        i {
            color: #8abeb7;
        }

        div a {
            text-decoration: none;
        }

        b {
            color: #81a2be;
        }

        strong{
            font-size: 20px;
            color: #7bacd6;;
        }
        strong:hover{
            color: #b0becb;
        }

        @keyframes slide {
            from {
                right: -100px;
                transform: rotate(360deg);
                opacity: 0;
            }
            to {
                right: 15px;
                transform: rotate(0deg);
                opacity: 1;
            }
        }
    </style>
</head>
<body>


    <h1>NOPE</h1>

    <div><p>> <span>CODE D'ERREUR</span>: "<i>Accès non autorisé</i>"</p>
        <p>> <span>DESCRIPTION DE L'ERREUR</span>: "<i>Vous n'avez pas le droit d'être ici</i>"</p>
        <p>> <span>CAUSE DE L'ERREUR</span>: [<b>execute access forbidden, read access forbidden, write access forbidden, ssl required, ssl 128 required, ip address rejected, client certificate required, site access denied, too many users, invalid configuration, password change, mapper denied access, client certificate revoked, directory listing denied, client access licenses exceeded, client certificate is untrusted or invalid, client certificate has expired or is not yet valid, passport logon failed, source access denied, infinite depth is denied, too many requests from the same client ip <strong>ptdr t'as juste pas les droits !</strong> </b>]</p>
        <p>> <span>Merci de revenir à l'accueil !</span>: [<a href="index.php">Accueil</a>]</p>
        <p><i>- CraftMyWebsite</i></p>
    </div>


    <!-- Script pour l'écriture -->
<script type="text/javascript">
    var str = document.getElementsByTagName('div')[0].innerHTML.toString();
    var i = 0;
    document.getElementsByTagName('div')[0].innerHTML = "";

    setTimeout(function() {
        var se = setInterval(function() {
            i++;
            document.getElementsByTagName('div')[0].innerHTML = str.slice(0, i) + "|";
            if (i == str.length) {
                clearInterval(se);
                document.getElementsByTagName('div')[0].innerHTML = str;
            }
        }, 10);
    },0);

</script>
</body>
</html>

