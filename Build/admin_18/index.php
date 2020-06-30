<?php
if(!$admin) { header('Location: index.php'); } 

$_Serveur_ = new Lire('./modele/config/config.yml');
$_Serveur_ = $_Serveur_->GetTableau();

$_Permission_=Permission::getInstance();

include("./include/version.php");
include("./include/version_distant.php");
include('./admin/include/entete.php');
if(isset($_GET['page']) AND $_GET['page'] != "accueil"){
    echo '
    <style>
.card-columns {
	-webkit-column-count: 2;
	-moz-column-count: 2;
	column-count: 2;
}
</style>
    ';
}
?>
	<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-xs-3 col-md-2 center" href="#">CraftMyWebsite #<?php echo $versioncms; ?></a>
        <div class="tools w-100">
            <button class="navbar-toggler" id="navbartoggler" style="float: left" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="btn nav-item text-white" id="voirsite" style="float: left" href="../index.php" target="_blank"
                title="Voir votre site"><i class="fas fa-desktop"></i></a>
        </div>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="btn text-white" href="index.php?action=deco">Déconnexion <i class="fas fa-power-off"></i></a>
            </li>
        </ul>
    </nav>
	<div class="container-fluid">
        <div class="row">
        	<?php include('./admin/include/side.php');?>
        	<main role="main" class="main col-md-9 ml-sm-auto col-lg-10 px-4 col-xs-12" id="main">
        	<?php include('./admin/page.php');?>
        	</main>
     	</div>
    </div>

    <div class="modal coffin" id="coffin" data-backdrop="static">
        <img width="100%" height="100%" src="https://media1.tenor.com/images/89cc0f940769bc079795e4aed3095227/tenor.gif?itemid=16828836" alt="Chargement en cours du gif coffin_dance-minecraft.gif (tenor.gif)">
    </div>

    <div class="modal fade" id="snakemodal" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="game">
            <div class="modal-body">
                <style>
                    #snake {
                        display: block;
                        margin: 0 auto;
                    }
                </style>
                <canvas id="snake" class="snakecanvas" width="608" height="608"></canvas>
                <script src="./admin/assets/js/snake.js"></script>
                <br />
            </div>
            <button class="btn btn-danger btn-block w-100">
                    Pour quitter le jeu veuillez faire F5
            </button>
        </div>
    </div>
    <script>
    $(window).on('shown.bs.modal', function() { 
        if($('#snakemodal').hasClass('show')){
            alert("Utiliser les fléches de votre clavier ( → ↑ ← ↓ ) pour jouer / vous déplacer");
        }
    });
    </script>

<?php include('./admin/include/footer.php');?>