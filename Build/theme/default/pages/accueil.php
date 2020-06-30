<!--Header-->
    <header class="heading" style="background-image: url('theme/upload/slider/<?php echo $_Accueil_['Slider']['image']; ?>');">
        <div class="heading-mask">
            <div class="container" style="text-align:center;">
                <h1 class="text-primary text-uppercase wow zoomInDown" data-wow-delay="0.6s"><?php echo $_Serveur_['General']['name']; ?></h1>
                <p class="h6 wow fadeInUp" data-wow-delay="0.9s"><?php if($_Serveur_['General']['statut'] == 0)
                {
                	echo '<span class="badge badge-danger">Hors-Ligne</span>'; 
                }
                elseif($_Serveur_['General']['statut'] == 1)
                {
                	echo '<span class="badge badge-success">En Ligne</span> : '.$playeronline.' / '.$maxPlayers;
                }
                else
                	echo '<span class="badge badge-warning">En Maintenance</span>'; 
                ?></p>
                <p class="wow fadeInUp" data-wow-delay="1s"><?php echo $_Serveur_['General']['description']; ?></p>
            </div>
        </div>
        <div class="card card-inverse card-primary text-xs-center">
            <div class="card-block text-center text-uppercase">
                <?php if(!empty($_Serveur_['General']['ipTexte'])){
                	echo 'Adresse : <b>'.$_Serveur_['General']['ipTexte'].'</b>'; 
				}else{
					echo 'Adresse inexistante !';
				}?>
            </div>
        </div>
    </header>
    <!--Page-->
    <?php if(!empty($lectureAccueil['Infos']))
    { ?>
	<section class="layout micro-blog">
		<div class="container">
			<div class="row">
				<?php for($i = 1; $i < count($lectureAccueil['Infos']) + 1; $i++)
				{ ?>
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="card hvr-float-shadow" style="margin-bottom:15px;">
							<img style="height: 200px; width: 100%; display: block;" src="theme/upload/navRap/<?php echo $lectureAccueil['Infos'][$i]['image']; ?>" alt="Card image">
							<div class="card-block">
								<p class="card-text"><?php echo $lectureAccueil['Infos'][$i]['message']; ?></p>
							</div>
							<a href="<?php echo $lectureAccueil['Infos'][$i]['lien']; ?>" class="btn btn-primary btn-block">Aller »</a>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
<?php } ?>
    <section class="layout micro-blog">
        <div class="container">
            <div class="text-center">
                <h4 class="text-primary">Informations</h4>
                <p>Suivez notre fil d'actualité</p>
                <hr>
            </div>
            <div class="row">
			<?php 
			$i = 0;
				if(isset($news) && count($news) > 0)
				{
					for($i = 0; $i < 10; $i++)
					{
						if($i < count($news))
						{
							$getCountCommentaires = $accueilNews->countCommentaires($news[$i]['id']);
							$countCommentaires = $getCountCommentaires->rowCount();

							$getcountLikesPlayers = $accueilNews->countLikesPlayers($news[$i]['id']);
							$countLikesPlayers = $getcountLikesPlayers->rowCount();
							$namesOfPlayers = $getcountLikesPlayers->fetchAll();

							$getNewsCommentaires = $accueilNews->newsCommentaires($news[$i]['id']);
							?>
							<div class="<?php if(count($news) == 1) echo 'col-lg-12 col-md-12 col-sm-12'; elseif(count($news) >= 2) echo 'col-lg-6 col-md-6 col-sm 6'; ?>">
								<div class="card hvr-float-shadow w-100" style="margin-bottom:15px;">
									<h5 class="card-header text-uppercase bg-primary" style="color:white;"><small class="text-muted">#<?php echo $news[$i]['id'] - 1; ?></small> <?php echo $news[$i]['titre']; ?></h5><br/>
									<div class="card-block">
										<p class="card-text"><?php echo $news[$i]['message']; ?></p>
										<!--<a href="news.html" class="card-link btn btn-primary">Lire plus</a>-->
										<?php
											if(isset($_Joueur_)) {
												$reqCheckLike = $accueilNews->checkLike($_Joueur_['pseudo'], $news[$i]['id']);
												$getCheckLike = $reqCheckLike->fetch(PDO::FETCH_ASSOC);
												$checkLike = $getCheckLike['pseudo'];
												if($_Joueur_['pseudo'] == $checkLike) {
													echo '<a href="#" data-toggle="modal" data-target="#news'.$news[$i]['id'].'" class="card-link"><i class="fa fa-comment" aria-hidden="true"></i> '.$countCommentaires.' Commentaires</a>';
												} else {
													echo '<a href="?&action=likeNews&id_news='.$news[$i]['id'].'" class="card-link"><i class="fa fa-thumbs-up" aria-hidden="true"></i> J\'aime !</a> | <a href="#" class="card-link" data-toggle="modal" data-target="#news'.$news[$i]['id'].'"><i class="fa fa-comment" aria-hidden="true"></i> '.$countCommentaires.' Commentaires</a>';
												}
											} else {
												echo '<a href="#" data-toggle="modal" class="card-link" data-target="#news'.$news[$i]['id'].'"><i class="fa fa-comment" aria-hidden="true"></i> '.$countCommentaires.' Commentaires</a>';
											}
											
											if($countLikesPlayers != 0) {
												echo '<a href="#" class="card-link"><i class="fa fa-thumbs-up"></i> '.$countLikesPlayers;
												//foreach ($namesOfPlayers as $likesPlayers) {
												//	echo $likesPlayers['pseudo'];
												//}
												echo '</a>';
											}
											unset($Img);
											$Img = new ImgProfil($news[$i]['auteur'], 'pseudo');
											?>
									</div>
									<div class="card-footer text-muted" style="height: 41px;">
										<div style="float: left;"><?php echo 'Posté le '.date('d/m/Y', $news[$i]['date']).' &agrave; '.date('H:i:s', $news[$i]['date']); ?></div>
											<div style="float: right;">Auteur : <a href="?page=profil&profil=<?php echo $news[$i]['auteur']; ?>" alt="aller voir le profil de l'auteur"><img src="<?=$Img->getImgToSize(24, $width, $height);?>" style="width: <?=$width;?>px; height: <?=$height;?>px;" alt="auteur"/> <?php echo $news[$i]['auteur']; ?></a></div>
									</div>
								</div>
							</div>
							<?php 
							unset($Img);
							if(isset($_Joueur_)) {
								$getNewsCommentaires = $accueilNews->newsCommentaires($news[$i]['id']);
								while($newsComments = $getNewsCommentaires->fetch(PDO::FETCH_ASSOC)) {
									$reqEditCommentaire = $accueilNews->editCommentaire($newsComments['pseudo'], $news[$i]['id'], $newsComments['id']);
									$getEditCommentaire = $reqEditCommentaire->fetch(PDO::FETCH_ASSOC);
									$editCommentaire = $getEditCommentaire['commentaire'];
									if($newsComments['pseudo'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1) {  ?>
										<div class="modal fade" id="news<?php echo $news[$i]['id'].'-'.$newsComments['id'].'-edit'; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-support">
												<div class="modal-content modal-lg">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<center><h4 class="modal-title" id="myModalLabel">Edition du commentaire</h4></center>
													</div>
													<form action="?&action=edit_news_commentaire&id_news=<?php echo $news[$i]['id'].'&auteur='.$newsComments['pseudo'].'&id_comm='.$newsComments['id']; ?>" method="post">
														<div class="modal-body">
															<textarea name="edit_commentaire" class="form-control" rows="3" style="resize: none;" maxlength="255" required><?php echo $editCommentaire; ?></textarea>
														</div>
														<div class="modal-footer text-center">
															<h4><b>Minimum de 6 caractères<br>Maximum de 255 caractères</b></h4><br>
															<button type="submit" class="btn btn-primary btn-block">Valider la modification</button>
														</div>
													</form>
												</div>
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
										<?php }
									}
								} ?>
							<div class="modal fade" id="<?php echo "news".$news[$i]['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-support">
								<div class="modal-content modal-lg">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<center><h4 class="modal-title" id="myModalLabel"><B><?php echo $news[$i]['titre']; ?></B></h4></center>
									</div> <!-- Modal-Header -->
									<div class="modal-body">
									<br>
									<?php
									$getNewsCommentaires = $accueilNews->newsCommentaires($news[$i]['id']);
									while($newsComments = $getNewsCommentaires->fetch(PDO::FETCH_ASSOC)) {
										if(isset($_Joueur_)) {
											
											$getCheckReport = $accueilNews->checkReport($_Joueur_['pseudo'], $newsComments['pseudo'], $news[$i]['id'], $newsComments['id']);
											$checkReport = $getCheckReport->rowCount();

											$getCountReportsVictimes = $accueilNews->countReportsVictimes($newsComments['pseudo'], $news[$i]['id'], $newsComments['id']);
											$countReportsVictimes = $getCountReportsVictimes->rowCount();
										}
										unset($Img);
										$Img = new ImgProfil($newsComments['pseudo'], 'pseudo');
										?>

										<div class="container">
											<div class="row">
													<div class="col-md-4 col-lg-4 col-sm-12">
														<img class="rounded" src="<?=$Img->getImgToSize(64, $width, $height);?>" style="margin-left: auto; margin-right: auto; display: block; width: <?=$width;?>px; height: <?=$height;?>px;" alt="Auteur" />
														<p class="text-muted text-center username"><?php echo '<B> '.$newsComments['pseudo'].'</B>'; ?><br/>
															<?php echo  '<b>'.gradeJoueur($newsComments['pseudo'], $bddConnection).'</b><br/>'; ?>
															<?php echo '<B>Le '.date('d/m', $newsComments['date_post']).' à '.date('H:i:s', $newsComments['date_post']).'</B>'; ?></p>
														<?php if(isset($_Joueur_)) { ?>
															<span style="color: red;"><?php if($newsComments['nbrEdit'] != "0"){echo 'Nombre d\'édition: '.$newsComments['nbrEdit'].' | ';}if($countReportsVictimes != "0"){echo '<B>'.$countReportsVictimes.' Signalement</B> |';} ?></span>
															<div class="dropdown">
																<button class="btn btn-info" data-toggle="dropdown" style="font-size: 10px;">Action <b class="caret"></b></button>
																<ul class="dropdown-menu">
																	<?php if($newsComments['pseudo'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1) {
																		echo '<li><a href="#" data-toggle="modal" data-target="#news'.$news[$i]['id'].'-'.$newsComments['id'].'-edit">Editer</a></li>';
																		echo '<li><a href="?&action=delete_news_commentaire&id_comm='.$newsComments['id'].'&id_news='.$news[$i]['id'].'&auteur='.$newsComments['pseudo'].'">Supprimer</a></li>';
																	}
																	if($newsComments['pseudo'] != $_Joueur_['pseudo']) {
																		if($checkReport == "0") {
																			echo '<li><a href="?&action=report_news_commentaire&id_news='.$news[$i]['id'].'&id_comm='.$newsComments['id'].'&victime='.$newsComments['pseudo'].'">Signaler</a></li>';
																		} else {
																			echo '<li><a href="#">Déjà report</a></li>';
																		}
																	} ?>
																</ul>
															</div> <!-- dropdown -->
															<?php } ?>
													</div>
													<div class="col-md-6 col-lg-6 col-sm-12">
														<?php $com = espacement($newsComments['commentaire']); echo BBCode($com, $bddConnection); ?>
													</div>
											</div> <!-- Ticket-Commentaire-->
										</div> <!-- Panel Panel-Default -->
											<?php } ?>
									</div> <!-- Modal-Body -->
										<?php
										if(isset($_Joueur_)) { ?>
											<div class="modal-footer w-100">
												<form action="?&action=post_news_commentaire&id_news=<?php echo $news[$i]['id']; ?>" method="post" class="w-100">
													<textarea name="commentaire" class="form-control w-100" required></textarea>
													<h4 class="text-center"><b>Minimum de 6 caractères<br>Maximum de 255 caractères</b></h4>
												<br>
												<center><button type="submit" class="btn btn-primary btn-block">Commenter</button></center>
												</form>
											</div>
									<?php } else { ?>
										<div class="modal-footer text-center">
											<div class="alert alert-danger">Veuillez-vous connecter pour mettre un commentaire.</div>
											<a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning">Connexion</a>
										</div> <!-- Modal-Footer -->
										<?php } ?>
									</div><!-- Modal-Footer -->
									</div> <!-- Modal-Content -->
						</div>

							<?php }  }
						}
							else
								echo '<div class="col-md-12 col-lg-12 col-sm-12"><div class="alert alert-warning"><p class="text-center">Aucune news n\'a été créée à ce jour...</p></div></div>'; ?>
            </div>
            <?php // if(count($news) > 3 ) echo '<a href="?page=blog" class="btn btn-primary btn-block">Afficher plus</a>'; ?>
        </div>
    </section>