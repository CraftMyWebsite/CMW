<!DOCTYPE html>
<html lang="fr">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<meta name="content-language" content="fr,fr-fr">
<meta name="language" content="fr,fr-fr">
<head>
    <meta charset="UTF-8">
    <meta name="google" content="notranslate" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <script type="text/javascript" src="./include/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="./admin/js/Chart/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="./admin/js/Chart/Chart.js"></script>
    <script type="text/javascript" src="./admin/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
    tinymce.init({
        plugins: "code",
        language : 'fr_FR',
        selector: ".editorHTML"
     });
    </script>

    <title>Administration</title>

    <link href="./admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="./admin/css/sb-admin.css" rel="stylesheet">
    <link href="./admin/css/plugins/morris.css" rel="stylesheet">
    <link href="./admin/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<?php
    if(isset($_GET['plugin']))
    include('plugin.php');
    else
    {
?>    

    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">CraftMyWebsite - Gestion du site</a>
            </div>
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="http://api.craftmywebsite.fr/skin/face.php?u=<?php echo $_Joueur_['pseudo']; ?>&s=32&v=front" /> <?php echo $_Joueur_['pseudo']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="index.php?&page=profil&profil=<?php echo $_Joueur_['pseudo']; ?>"><i class="fa fa-fw fa-user"></i> Profil</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../index.php?&action=deco"><i class="fa fa-fw fa-power-off"></i> Déconnexion</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">

                    <li><a href="./index.php"><strong><span class="fa fa-fw fa-arrow-left" aria-hidden="true"></span> Retour site</strong></a></li>
                    <li class="active"><a data-toggle="collapse" data-parent="#adminPanel" href="#informations"><span class="fa fa-shield" aria-hidden="true"></span> Informations</a></li>
                    <li><a data-toggle="collapse" data-parent="#adminPanel" href="#general"><span class="fa fa-fw fa-dashboard" aria-hidden="true"></span> Général</a></li>
                    <li><a data-toggle="collapse" data-parent="#adminPanel" href="#theme"><span class="fa fa-fw fa-fire" aria-hidden="true"></span> Thème</a></li>
                    <li><a data-toggle="collapse" data-parent="#adminPanel" href="#accueil"><span class="fa fa-fw fa-align-justify" aria-hidden="true"></span> Accueil</a></li>
                    <li><a data-toggle="collapse" data-parent="#adminPanel" href="#regServeur"><span class="fa fa-cog" aria-hidden="true"></span> Réglages Serveur</a></li>
                    <li><a data-toggle="collapse" data-parent="#adminPanel" href="#pages"><span class="fa fa-fw fa-file" aria-hidden="true"></span> Pages</a></li>
                    <li><a data-toggle="collapse" data-parent="#adminPanel" href="#news"><span class="fa fa-fw fa-comment" aria-hidden="true"></span> Nouveautés</a></li>
                    <li><a data-toggle="collapse" data-parent="#adminPanel" href="#boutique"><span class="fa fa-fw fa-shopping-cart" aria-hidden="true"></span> Boutique</a></li>
                    <li><a data-toggle="collapse" data-parent="#adminPanel" href="#payement"><span class="fa fa-fw fa-credit-card" aria-hidden="true"></span> Payement</a></li>
					<li><a data-toggle="collapse" data-parent="#adminPanel" href="#menus"><span class="fa fa-fw fa-align-justify" aria-hidden="true"></span> Menus</a></li>
                    <li><a data-toggle="collapse" data-parent="#adminPanel" href="#voter"><span class="fa fa-fw fa-bullhorn" aria-hidden="true"></span> Voter</a></li>
                    <li><a data-toggle="collapse" data-parent="#adminPanel" href="#membres"><span class="fa fa-fw fa-user" aria-hidden="true"></span> Membres</a></li>
                    <li><a data-toggle="collapse" data-parent="#adminPanel" href="#widgets"><span class="fa fa-book fa-fw" aria-hidden="true"></span> Widgets</a></li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#supp"><i class="fa fa-fw fa-wrench"></i> Support <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="supp" class="collapse">
                              <li><a data-toggle="collapse" data-parent="#adminPanel" href="#support"> Tickets</a></li>
                              <li><a data-toggle="collapse" data-parent="#adminPanel" href="#maintenance"> Maintenance</a></li>
                        </ul>
                    </li>
                    <li><a data-toggle="collapse" data-parent="#adminPanel" href="#maj"><span class="fa fa-refresh fa-spin" aria-hidden="true"></span> Mises à jour</a></li>

                    <?php
                    include "./include/version.php";
                    include "./include/version_distant.php";
                    if($versioncms == $versioncmsrelease) {
                    ?>
                    <center><span class="badge" style="background-color: rgb(45, 179, 45);">A jours</span></center>
                    <?php } else { ?>
                    <span class="badge" style="background-color: red;">Pas à jour !!</span>
                    <?php } ?>
                </ul>
            </div>
        </nav>

        <div class="panel panel-primary panel-group bloc-deroulant-menu" id="adminPanel">
        <?php $referrer = $_SESSION['referrerAdmin']; ?>
   <div class="panel">
    <div id="informations" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'informations'){ echo 'in'; } elseif(!isset($referrer)) { echo'in';} ?> bloc-deroulant-menu">

            <?php include('donnees/informations.php');
                  include('page/informations.php'); ?>
    </div>
  </div>

  <div class="panel">
    <div id="general" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'general'){ echo 'in'; } ?> bloc-deroulant-menu">
    
                    <?php include('donnees/general.php');
                         include('page/general.php'); ?>
    </div>
  </div>
  <div class="panel">
    <div id="theme" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'theme'){ echo 'in'; } ?> bloc-deroulant-menu">
    
                    <?php include('donnees/theme.php');
                         include('page/theme.php'); ?>
    </div>
  </div>
  <div class="panel">
    <div id="accueil" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'accueil'){ echo 'in'; } ?> bloc-deroulant-menu">
    
                    <?php include('donnees/accueil.php');
                         include('page/accueil.php'); ?>
    </div>
  </div>
  <div class="panel">
    <div id="regServeur" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'regserv'){ echo 'in'; } ?> bloc-deroulant-menu">
                    <?php include('donnees/regServeur.php');
                         include('page/regServeur.php'); ?>     
    </div>
  </div>
  <div class="panel">
    <div id="pages" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'pages'){ echo 'in'; } ?> bloc-deroulant-menu">
                    <?php include('donnees/pages.php');
                         include('page/pages.php'); ?>     
    </div>
  </div>
  <div class="panel">
    <div id="news" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'news'){ echo 'in'; } ?> bloc-deroulant-menu">
                    <?php include('donnees/news.php');
                         include('page/news.php'); ?>     
    </div>
  </div>
  <div class="panel">
    <div id="boutique" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'boutique'){ echo 'in'; } ?> bloc-deroulant-menu">
    
                    <?php include('donnees/boutique.php');
                         include('page/boutique.php'); ?>
    </div>
  </div>
  <div class="panel">
    <div id="payement" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'payement'){ echo 'in'; } ?> bloc-deroulant-menu">
    
                    <?php include('donnees/payement.php');
                         include('page/payement.php'); ?>
    </div>
  </div>
  <div class="panel">
    <div id="menus" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'menus'){ echo 'in'; } ?> bloc-deroulant-menu">
    
                    <?php include('donnees/menu.php');
                         include('page/menu.php'); ?>
    </div>
  </div>
  <div class="panel">
    <div id="voter" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'votes'){ echo 'in'; } ?> bloc-deroulant-menu">
    
                    <?php include('donnees/voter.php');
                         include('page/voter.php'); ?>
    </div>
  </div>
  <div class="panel">
    <div id="membres" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'membres'){ echo 'in'; } ?> bloc-deroulant-menu">
    
                    <?php include('donnees/membres.php');
                         include('page/membres.php'); ?>
    </div>
  </div>
  <div class="panel">
    <div id="widgets" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'widgets'){ echo 'in'; } ?> bloc-deroulant-menu">
    
                    <?php include('donnees/widgets.php');
                         include('page/widgets.php'); ?>
    </div>
  </div>

  <div class="panel">
    <div id="maintenance" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'maintenance'){ echo 'in'; } ?> bloc-deroulant-menu">
    
          <?php include('donnees/maintenance.php');
              include('page/maintenance.php'); ?>
    </div>
  </div>

  <div class="panel">
    <div id="support" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'support'){ echo 'in'; } ?> bloc-deroulant-menu">

            <?php include('donnees/support.php');
                 include('page/support.php'); ?>
    </div>
  </div>

  <div class="panel">
    <div id="maj" class="panel-collapse collapse bloc-deroulant-menu">   
                    <?php include('page/update.php'); ?>
    </div>
  </div>

</div>
 </div>
    <script src="./admin/js/jquery.js"></script>
    <script src="./admin/js/bootstrap.min.js"></script>
    <script src="./admin/js/plugins/morris/raphael.min.js"></script>
    <script src="./admin/js/plugins/morris/morris.min.js"></script>
    <script src="./admin/js/plugins/morris/morris-data.js"></script>
    <?php } ?>
</body>
</html>