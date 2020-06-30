<?php 
include './admin/include/donneescustom.php';
include './admin/include/header.php';
?>
<div class="cmw-cube">
	<div class="container-fluid">
		<div class="row">

		<div class="col-xs-12 col-md-8">

				<div class="cmw-left-navbar">
					<a class="hvr-wobble-horizontal" href="admin.php"> CraftMyWebsite - Gestion du site <?php echo $lecture['General']['name']; ?></a>
					<a href="index.php" target="_blank" class="cmw-pull-right hvr-grow-shadow"><i class="fa fa-desktop" aria-hidden="true"></i> Voir le site</a>
				</div>

			</div>

			<div class="col-xs-12 col-md-4" style="padding-right: 0px;">

				<div class="cmw-right-navbar">
					<audio id="horn" src="./admin/assets/sound/horn.mp3"></audio>
					<a onmouseover="document.getElementById('horn').play()" onmouseout="document.getElementById('horn').pause()" href="index.php?&page=profil&profil=<?php echo $_Joueur_['pseudo']; ?>" class="dropdown-toggle cmw-header-username hvr-buzz" data-toggle="dropdown">
						<?php 
							$Img = new ImgProfil($_Joueur_['id']);
							?>
						<img src="<?=$Img->getImgToSize(32, $width, $height);?>" style="width: <?=$width;?>px; height: <?=$height;?>px;" /> <?php echo $_Joueur_['pseudo']; ?></a>
					<a href="../index.php?&action=deco" class="cmw-nav-disconnect hvr-underline-reveal"><i class="fa fa-fw fa-power-off"></i> Déconnexion</a></div>
				</div>

			</div>
		</div>
		<div class="container-fluid">
			<div class="cmw-main-container">
				<div class="row">
					<div class="cmw-sidebar col-xs-12 col-md-2">
						<?php include './admin/include/sidebar.php'; ?>
					</div>

					<div class="cmw-page-container col-xs-12 col-md-10">
						<?php include './admin/include/pagegen.php'; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="divScroll" class="btn btn-primary" onclick="goToTop()"><i class="fa fa-arrow-up" aria-hidden="true"></i></div>
	<script>
	window.onscroll = function() {divScroll()};

	function divScroll() {
		if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
			document.getElementById("divScroll").style.display = "block";
		} else {
			document.getElementById("divScroll").style.display = "none";
		}
	}

	function goToTop() {
		$('html, body').animate({
			scrollTop: 0
		}, 1000);
	}
	</script>
	<?php include './admin/include/footer.php'; ?>
