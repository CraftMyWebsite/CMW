<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="content-language" content="fr,fr-fr">
    <meta name="language" content="fr,fr-fr">
    <meta name="description" content="Panel d'administration">
    <meta name="author" content="Sprik07">

    <title>CMW - Gestion du site</title>

    <!-- Bootstrap Core CSS -->
    <link href="./admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./admin/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="./admin/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link type="text/css" href="./admin/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Ckeditor JS -->
    <script type="text/javascript" src="./include/ckeditor/ckeditor.js"></script>

    <!-- JQuery-2.1.4 WITH Chart JS -->
    <script type="text/javascript" src="./admin/script/Chart/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="./admin/script/Chart/Chart.js"></script>

    <!-- Tinymce -->
    <script type="text/javascript" src="./admin/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
    tinymce.init({
        plugins: "code",
        language : 'fr_FR',
        selector: ".editorHTML"
     });
    </script>


</head>

<body>

    <?php
    if(isset($_GET['plugin'])) {
        include('./admin/plugin.php');
    } else {
    ?>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">CMW - Gestion du site</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="http://infectedz.cmwph.fr/ApiSkins/face.php?user=<?php echo $_Joueur_['pseudo']; ?>&s=32&v=front"/> <?php echo $_Joueur_['pseudo']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="index.php?&page=profil&profil=<?php echo $_Joueur_['pseudo']; ?>"><i class="fa fa-fw fa-user"></i> Profil</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> A venir</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> A venir</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../index.php?&action=deco"><i class="fa fa-fw fa-power-off"></i> Déconnexion</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li><a href="./index.php"><strong><span class="fa fa-fw fa-arrow-left" aria-hidden="true"></span> Retour site</strong></a></li>

                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['info']['showPage'] == true) { ?><li><a data-toggle="collapse" data-parent="#adminPanel" href="#informations" aria-expanded="true" aria-controls="informations"><span class="fa fa-shield" aria-hidden="true"></span> Informations</a></li><?php } ?>

                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['general']['showPage'] == true) { ?><li><a data-toggle="collapse" data-parent="#adminPanel" href="#general" aria-expanded="true" aria-controls="general"><span class="fa fa-fw fa-dashboard" aria-hidden="true"></span> Général</a></li><?php } ?>

                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['theme']['showPage'] == true) { ?><li><a data-toggle="collapse" data-parent="#adminPanel" href="#theme" aria-expanded="true" aria-controls="theme"><span class="fa fa-fw fa-fire" aria-hidden="true"></span> Thème</a></li><?php } ?>

                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['home']['showPage'] == true) { ?><li><a data-toggle="collapse" data-parent="#adminPanel" href="#accueil" aria-expanded="true" aria-controls="accueil"><span class="fa fa-fw fa-align-justify" aria-hidden="true"></span> Accueil</a></li><?php } ?>

                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['server']['showPage'] == true) { ?><li><a data-toggle="collapse" data-parent="#adminPanel" href="#regServeur" aria-expanded="true" aria-controls="regServeur"><span class="fa fa-cog fa-spin" aria-hidden="true"></span> Réglages Serveur</a></li><?php } ?>

                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['pages']['showPage'] == true) { ?><li><a data-toggle="collapse" data-parent="#adminPanel" href="#pages" aria-expanded="true" aria-controls="pages"><span class="fa fa-fw fa-file" aria-hidden="true"></span> Pages</a></li><?php } ?>

                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['news']['showPage'] == true) { ?><li><a data-toggle="collapse" data-parent="#adminPanel" href="#news" aria-expanded="true" aria-controls="news"><span class="fa fa-fw fa-comment" aria-hidden="true"></span> Nouveautés</a></li><?php } ?>

                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['shop']['showPage'] == true) { ?><li><a data-toggle="collapse" data-parent="#adminPanel" href="#boutique" aria-expanded="true" aria-controls="boutique"><span class="fa fa-fw fa-shopping-cart" aria-hidden="true"></span> Boutique</a></li><?php } ?>

                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['payment']['showPage'] == true) { ?><li><a data-toggle="collapse" data-parent="#adminPanel" href="#payement" aria-expanded="true" aria-controls="payement"><span class="fa fa-fw fa-credit-card" aria-hidden="true"></span> Payement</a></li><?php } ?>

                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['menus']['showPage'] == true) { ?><li><a data-toggle="collapse" data-parent="#adminPanel" href="#menus" aria-expanded="true" aria-controls="menus"><span class="fa fa-fw fa-align-justify" aria-hidden="true"></span> Menus</a></li><?php } ?>

                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['vote']['showPage'] == true) { ?><li><a data-toggle="collapse" data-parent="#adminPanel" href="#voter" aria-expanded="true" aria-controls="voter"><span class="fa fa-fw fa-bullhorn" aria-hidden="true"></span> Voter</a></li><?php } ?>

                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['members']['showPage'] == true) { ?><li><a data-toggle="collapse" data-parent="#adminPanel" href="#membres" aria-expanded="true" aria-controls="membres"><span class="fa fa-fw fa-user" aria-hidden="true"></span> Membres</a></li><?php } ?>

                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['widgets']['showPage'] == true) { ?><li><a data-toggle="collapse" data-parent="#adminPanel" href="#widgets" aria-expanded="true" aria-controls="widgets"><span class="fa fa-book fa-fw" aria-hidden="true"></span> Widgets</a></li><?php } ?>

                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['maintenance']['showPage'] == true OR $_PGrades_['PermsPanel']['support']['tickets']['showPage'] == true) { ?>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#dropSupport" aria-expanded="true" aria-controls="dropSupport"><i class="fa fa-fw fa-arrows-v"></i> Support <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="dropSupport" class="collapse">
                            <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['tickets']['showPage'] == true) { ?><li><a data-toggle="collapse" data-parent="#adminPanel" href="#support" aria-expanded="true" aria-controls="support"> Tickets</a></li><?php } ?>
                            <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['maintenance']['showPage'] == true) { ?><li><a data-toggle="collapse" data-parent="#adminPanel" href="#maintenance" aria-expanded="true" aria-controls="maintenance"> Maintenance</a></li><?php } ?>
                        </ul>
                    </li>
                    <?php } ?>

                    <?php if($_Joueur_['rang'] == 1) { ?><li><a data-toggle="collapse" data-parent="#adminPanel" href="#grades" aria-expanded="true" aria-controls="grades"><i class="fa fa-fw fa-shield" aria-hidden="true"></i> Grades</a></li><?php } ?>

                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['update']['showPage'] == true) { ?><li><a data-toggle="collapse" data-parent="#adminPanel" href="#maj" aria-expanded="true" aria-controls="maj"><i class="fa fa-refresh" aria-hidden="true"></i> Mises a jours</a></li><?php } ?>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="panel-group" id="adminPanel" aria-multiselectable="true">

                    <div class="panel panel-default">

                    <?php $referrer = $_SESSION['referrerAdmin']; ?>
                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['info']['showPage'] == true) { ?>
                            <div id="informations" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'informations'){ echo 'in'; } elseif(!isset($referrer)) { echo'in';} ?> bloc-deroulant-menu">
                                <?php include('donnees/informations.php');
                                include('page/informations.php'); ?>
                            </div>
                    <?php } ?>
                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['general']['showPage'] == true) { ?>
                            <div id="general" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'general'){ echo 'in'; } ?> bloc-deroulant-menu">
                                <?php include('donnees/general.php');
                                include('page/general.php'); ?>
                            </div>
                    <?php } ?>
                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['theme']['showPage'] == true) { ?>
                            <div id="theme" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'theme'){ echo 'in'; } ?> bloc-deroulant-menu">
                                <?php include('donnees/theme.php');
                                include('page/theme.php'); ?>
                            </div>
                    <?php } ?>
                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['home']['showPage'] == true) { ?>
                            <div id="accueil" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'accueil'){ echo 'in'; } ?> bloc-deroulant-menu">
                                <?php include('donnees/accueil.php');
                                include('page/accueil.php'); ?>
                            </div>
                    <?php } ?>
                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['server']['showPage'] == true) { ?>
                            <div id="regServeur" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'regserv'){ echo 'in'; } ?> bloc-deroulant-menu">
                                <?php include('donnees/regServeur.php');
                                include('page/regServeur.php'); ?>     
                            </div>
                    <?php } ?>
                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['pages']['showPage'] == true) { ?>
                            <div id="pages" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'pages'){ echo 'in'; } ?> bloc-deroulant-menu">
                                <?php include('donnees/pages.php');
                                include('page/pages.php'); ?>     
                            </div>
                    <?php } ?>
                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['news']['showPage'] == true) { ?>
                            <div id="news" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'news'){ echo 'in'; } ?> bloc-deroulant-menu">
                                <?php include('donnees/news.php');
                                include('page/news.php'); ?>     
                            </div>
                    <?php } ?>
                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['shop']['showPage'] == true) { ?>
                            <div id="boutique" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'boutique'){ echo 'in'; } ?> bloc-deroulant-menu">
                                <?php include('donnees/boutique.php');
                                include('page/boutique.php'); ?>
                            </div>
                    <?php } ?>
                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['payment']['showPage'] == true) { ?>
                            <div id="payement" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'payement'){ echo 'in'; } ?> bloc-deroulant-menu">
                                <?php include('donnees/payement.php');
                                include('page/payement.php'); ?>
                            </div>
                    <?php } ?>
                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['menus']['showPage'] == true) { ?>
                            <div id="menus" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'menus'){ echo 'in'; } ?> bloc-deroulant-menu">
                                <?php include('donnees/menu.php');
                                include('page/menu.php'); ?>
                            </div>
                    <?php } ?>
                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['vote']['showPage'] == true) { ?>
                            <div id="voter" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'votes'){ echo 'in'; } ?> bloc-deroulant-menu">
                                <?php include('donnees/voter.php');
                                include('page/voter.php'); ?>
                            </div>
                    <?php } ?>
                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['members']['showPage'] == true) { ?>
                            <div id="membres" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'membres'){ echo 'in'; } ?> bloc-deroulant-menu">
                                <?php include('donnees/membres.php');
                                include('page/membres.php'); ?>
                            </div>
                    <?php } ?>
                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['widgets']['showPage'] == true) { ?>
                            <div id="widgets" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'widgets'){ echo 'in'; } ?> bloc-deroulant-menu">
                                <?php include('donnees/widgets.php');
                                include('page/widgets.php'); ?>
                            </div>
                    <?php } ?>
                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['maintenance']['showPage'] == true) { ?>
                            <div id="maintenance" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'maintenance'){ echo 'in'; } ?> bloc-deroulant-menu">
                                <?php include('donnees/maintenance.php');
                                include('page/maintenance.php'); ?>
                            </div>
                    <?php } ?>
                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['tickets']['showPage'] == true) { ?>
                            <div id="support" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'support'){ echo 'in'; } ?> bloc-deroulant-menu">
                                <?php include('donnees/support.php');
                                include('page/support.php'); ?>
                            </div>
                    <?php } ?>
                    <?php if($_Joueur_['rang'] == 1) { ?>
                            <div id="grades" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'grades'){ echo 'in'; } ?> bloc-deroulant-menu">
                                <?php include('donnees/grades.php');
                                include('page/grades.php'); ?>
                            </div>
                    <?php } ?>
                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['update']['showPage'] == true) { ?>
                            <div id="maj" class="panel-collapse collapse <?php if(isset($referrer)&& $referrer == 'maj'){ echo 'in'; } ?> bloc-deroulant-menu">   
                                <?php include('page/update.php'); ?>        
                            </div>
                    <?php } ?>
                    
                    </div>
                    <!-- /.panel-default -->

                </div>
                <!-- /.panel-group -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Plugin -->
    <?php } ?>

    <!-- jQuery -->
    <script src="./admin/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="./admin/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="./admin/js/plugins/morris/raphael.min.js"></script>
    <script src="./admin/js/plugins/morris/morris.min.js"></script>
    <script src="./admin/js/plugins/morris/morris-data.js"></script>

</body>

</html>