<!DOCTYPE html>
<html lang="fr">
<head>
	<?php $configFile = new Lire('modele/config/config.yml');
	$configFile = $configFile->GetTableau();
	echo "<style>
	:root {
		--color-panel-main: ". $configFile["color"]["panel"]["main"] ."; 
		--color-panel-hover: ". $configFile["color"]["panel"]["hover"] ."; 
		--color-panel-focus: ". $configFile["color"]["panel"]["focus"] ."; 
	}
	</style>";?>
  <meta charset="UTF-8">
  <meta name="google" content="notranslate" />
  <meta name="content-language" content="fr,fr-fr">
  <meta name="language" content="fr,fr-fr">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Panel administrateur CraftMyWebsite">
  <meta name="author" content="CraftMyWebsite, TheTueurCiTy, OctoDev">

  <script type="text/javascript" src="./include/ckeditor/ckeditor.js"></script>
  <script type="text/javascript" src="./admin/assets/js/Chart/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="./admin/assets/js/Chart/Chart.js"></script>
  <script type="text/javascript" src="./admin/assets/js/tinymce/tinymce.min.js"></script>
  <?php if(file_exists('./favicon.ico'))
   {
     echo '<link rel="icon" type="image/x-icon" href="./favicon.ico"></link>';
   }
   ?>
  <script type="text/javascript">
    tinymce.init({
      plugins: "code",
      language : 'fr_FR',
      selector: ".editorHTML"
    });
  </script>

  <title>Administration</title>

  <link href="./admin/assets/css/bootstrap.css" rel="stylesheet">
  <link href="./admin/assets/css/plugins/morris.css" rel="stylesheet">
  <link href="./admin/assets/css/plugins/hover.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet">
  <link href="./admin/assets/css/admin-style.css" rel="stylesheet">
  <link href="./admin/assets/css/forum.css" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
  <body>
