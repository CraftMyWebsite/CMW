<style>
	a.tooltips2 {
		position: relative;
		display: inline;
	}
	a.tooltips2 span {
		position: absolute;
		width:140px;
		color: #FFFFFF;
		background: #000000;
		border: 2px solid #6D6D6D;
		height: 37px;
		line-height: 37px;
		text-align: center;
		visibility: hidden;
		border-radius: 8px;
		box-shadow: -1px 0px 6px #000000;
	}
	a.tooltips2 span:before {
		content: '';
		position: absolute;
		top: 100%;
		left: 50%;
		margin-left: -12px;
		width: 0; height: 0;
		border-top: 12px solid #6D6D6D;
		border-right: 12px solid transparent;
		border-left: 12px solid transparent;
	}
	a.tooltips2 span:after {
		content: '';
		position: absolute;
		top: 100%;
		left: 50%;
		margin-left: -8px;
		width: 0; height: 0;
		border-top: 8px solid #000000;
		border-right: 8px solid transparent;
		border-left: 8px solid transparent;
	}
	a:hover.tooltips2 span {
		visibility: visible;
		opacity: 1;
		bottom: 40px;
		left: 70%;
		margin-left: -76px;
		z-index: 999;
		height: 41px;
	}
</style>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="overflow: hidden;width: 100%;margin: 0 auto 30px auto;position: relative;height: 400px;margin-top: -20px;border-bottom: 4px solid #e74c3c;">
	<ol class="carousel-indicators" style="bottom: 0px;">
		<?php for($i = 0; $i < $iSliders; $i++) { ?>
			<li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" <?php if($i == 0) echo 'class="active"'; ?>></li>
			<?php } ?>
		</ol>

		<div class="carousel-inner">
			<?php for($i = 0; $i < $iSliders; $i++) { ?>
				<div class="item <?php if($i == 0) echo 'active'; ?>">
					<img src="theme/upload/slider/<?php echo $sliders[$i]['image']; ?>" style="overflow: hidden;width: 100%;margin: 0 auto 30px auto;height: 420px;" alt="L'image charge :p Si ce message reste trop longtemps, rechargez votre navigateur !">
					<div class="carousel-caption">
						<span style="font-family: Minecraftia;font-weight: 300;"><?php echo $sliders[$i]['message']; ?></span>
					</div>
				</div>
				<?php } ?>
			</div>

			<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div>
		<div class="container" style="border-left: 2px solid rgba(255, 0, 0, 0.12);border-right: 2px solid rgba(255, 0, 0, 0.12);">
			<div class="row">
				<?php for($i = 0; $i < 3; $i++)
				{ ?>
					<div class="col-md-4 col-sm-6">
						<div class="service-wrapper" style="border-radius:0px">
							<center>
								<img class="img-thumbnail" src="theme/upload/navRap/<?php echo $lectureAccueil['Infos'][$i]['image']; ?>" alt="Erreur" style="width: 350px; height: 160px;">	
							</br>
							<p><strong><?php echo $lectureAccueil['Infos'][$i]['message']; ?></strong></p>
							<p><a class="btn btn-default" href="<?php echo $lectureAccueil['Infos'][$i]['lien']; ?>" role="button">Aller »</a></p>
						</center>
					</div>
				</div>
				<?php } ?>
			</div>

			<div class="row">
				<h1 class="titre"><center>Informations:</center></h1>
				<?php
				$i = 0;
				if(isset($news))
					while($i < count($news))
					{

						$getCountCommentaires = $accueilNews->countCommentaires($news[$i]['id']);
						$countCommentaires = $getCountCommentaires->rowCount();

						$getcountLikesPlayers = $accueilNews->countLikesPlayers($news[$i]['id']);
						$countLikesPlayers = $getcountLikesPlayers->rowCount();
						$namesOfPlayers = $getcountLikesPlayers->fetchAll();

						$getNewsCommentaires = $accueilNews->newsCommentaires($news[$i]['id']);
						?>

						<div class="panel panel-primary" style="border-radius:0px;margin-left: 5px;margin-right: 5px;">

							<div class="panel-heading" style="font-family: Minecraftia;font-size: 18px;border-radius:0px"><center><?php echo $news[$i]['titre']; ?></center>
								<a class="tooltips2 pull-right" style="font-family: minecraftia; margin-top: -25px;font-size: 13px;" href="index.php?&page=profil&profil=<?php echo $news[$i]['auteur']; ?>"><img src="http://api.craftmywebsite.fr/skin/face.php?u=<?php echo $news[$i]['auteur']; ?>&s=32&v=front" alt="none" /><span> <?php echo $news[$i]['auteur']; ?></span></a>				
							</div> <!-- Heading -->

							<div class="panel-body"><?php echo $news[$i]['message']; ?>
							</div> <!-- Body -->

							<div class="panel-footer"><?php echo 'Posté le '.date('d/m/Y', $news[$i]['date']).' &agrave; '.date('H:i:s', $news[$i]['date']); ?> par <strong><a href="index.php?&page=profil&profil=<?php echo $news[$i]['auteur']; ?>"><?php echo $news[$i]['auteur']; ?></a></strong>
								
								<?php
								if(isset($_Joueur_)) {
									$reqCheckLike = $accueilNews->checkLike($_Joueur_['pseudo'], $news[$i]['id']);
									$getCheckLike = $reqCheckLike->fetch();
									$checkLike = $getCheckLike['pseudo'];
									if($_Joueur_['pseudo'] == $checkLike) {
										echo '<div style="float: right;">
										<a href="#" data-toggle="modal" data-target="#news'.$news[$i]['id'].'"><i class="glyphicon glyphicon-comment" aria-hidden="true"></i> '.$countCommentaires.' Commentaires</a>';
									} else {
										echo '<div style="float: right;">
										<a href="?&action=likeNews&id_news='.$news[$i]['id'].'"><i class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></i> J\'aime !</a> | <a href="#" data-toggle="modal" data-target="#news'.$news[$i]['id'].'"><i class="glyphicon glyphicon-comment" aria-hidden="true"></i> '.$countCommentaires.' Commentaires</a>';
									}
								} else {
									echo '<div style="float: right;">
									<a href="#" data-toggle="modal" data-target="#news'.$news[$i]['id'].'"><i class="glyphicon glyphicon-comment" aria-hidden="true"></i> '.$countCommentaires.' Commentaires</a>';
								}
								
								if($countLikesPlayers != 0) {
									echo '&nbsp;|&nbsp;<a href="#" class="tooltips2 pull-right"><i class="glyphicon glyphicon-thumbs-up"></i> '.$countLikesPlayers;
									//foreach ($namesOfPlayers as $likesPlayers) {
									//	echo $likesPlayers['pseudo'];
									//}
									echo '</span></a></div>';
								}
								?>

							</div> <!-- Footer -->			
						</div> <!-- Primary -->

						<div class="modal fade" id="<?php echo "news".$news[$i]['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-support">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<center><h4 class="modal-title" id="myModalLabel"><B><?php echo $news[$i]['titre']; ?></B></h4></center>
									</div> <!-- Modal-Header -->
									<div class="modal-body">
									</br>
									<center><h3 class="ticket-commentaire-titre"><B><?php echo $countCommentaires." Commentaires"; ?></B></h3></center> 

									<?php
									while($newsComments = $getNewsCommentaires->fetch()) {
										if(isset($_Joueur_)) {
											
											$getCheckReport = $accueilNews->checkReport($_Joueur_['pseudo'], $newsComments['pseudo'], $news[$i]['id'], $newsComments['id']);
											$checkReport = $getCheckReport->rowCount();

											$getCountReportsVictimes = $accueilNews->countReportsVictimes($newsComments['pseudo'], $news[$i]['id'], $newsComments['id']);
											$countReportsVictimes = $getCountReportsVictimes->rowCount();
										}
										?>

										<div class="panel panel-default">
											<div class="panel-body">
												<div class="ticket-commentaire">
													<div class="left-ticket-commentaire">
														<span class="img-ticket-commentaire">
															<img src="http://api.craftmywebsite.fr/skin/face.php?u=<?php echo $newsComments['pseudo']; ?>&s=32&v=front" alt="none" />
														</span>
														<span class="desc-ticket-commentaire">
															<span class="ticket-commentaire-auteur"><?php echo '<B> - '.$newsComments['pseudo'].'</B>'; ?>
															</span>
															<span class="ticket-commentaire-date"><?php echo '<B>Le '.date('d/m', $newsComments['date_post']).' à '.date('H:i:s', $newsComments['date_post']).'</B>'; ?>
															</span>
															<?php if(isset($_Joueur_)) { ?>
																<span class="ticket-commentaire-action pull-right">
																	<span style="color: red;"><?php if($newsComments['nbrEdit'] != "0"){echo 'Nombre d\'édition: '.$newsComments['nbrEdit'].' | ';}if($countReportsVictimes != "0"){echo '<B>'.$countReportsVictimes.' Signalement</B> |';} ?></span>
																	<div class="dropdown">
																		<a type="button" class="btn btn-info collapsed" data-toggle="dropdown" style="font-size: 10px;">Action <b class="caret"></b></a>
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
																</span>
																<?php } ?>
															</span>
														</div>
														<div class="right-ticket-commentaire">
															<?php echo $newsComments['commentaire']; ?>
														</div>
													</div> <!-- Ticket-Commentaire-->
												</div> <!-- Panel-Body -->
											</div> <!-- Panel Panel-Default -->
											<?php } ?>
										</div> <!-- Modal-Body -->
										<?php
										if(isset($_Joueur_)) { ?>
											<div class="modal-footer">
												<form action="?&action=post_news_commentaire&id_news=<?php echo $news[$i]['id']; ?>" method="post">
													<textarea name="commentaire" class="form-control" rows="3" style="resize: none;" maxlength="255" required></textarea>
													<center><h4><B>Minimum de 6 caractères<br>Maximum de 255 caractères</B></h4></center>
												</br>
												<center><div class="btn-container"><button type="submit" class="btn standard-btn">Commenter</button></div></center>
											</form>
										</div>
									</div> <!-- Modal-Footer -->
									<?php } else { ?>
										<div class="modal-footer">
											<center><div class="alert alert-danger">Veuillez-vous connecter pour mettre un commentaire.</div></center>
											<center><a data-toggle="modal" data-target="#ConnectionSlide" class="btn danger-btn">Connexion</a></center>
										</div> <!-- Modal-Footer -->
										<?php } ?>
									</div> <!-- Modal-Content -->
								</div> <!-- Modal-Dialog Modal-Support -->
							</div> <!-- Modal-Fade -->

							<?php if(isset($_Joueur_)) {
								$getNewsCommentaires = $accueilNews->newsCommentaires($news[$i]['id']);
								while($newsComments = $getNewsCommentaires->fetch()) {
									$reqEditCommentaire = $accueilNews->editCommentaire($newsComments['pseudo'], $news[$i]['id'], $newsComments['id']);
									$getEditCommentaire = $reqEditCommentaire->fetch();
									$editCommentaire = $getEditCommentaire['commentaire'];
									if($newsComments['pseudo'] == $_Joueur_['pseudo'] OR $_Joueur_['rang'] == 1) {  ?>
										<div class="modal fade" id="news<?php echo $news[$i]['id'].'-'.$newsComments['id'].'-edit'; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-support">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<center><h4 class="modal-title" id="myModalLabel">Edition du commentaire</h4></center>
													</div>
													<form action="?&action=edit_news_commentaire&id_news=<?php echo $news[$i]['id'].'&auteur='.$newsComments['pseudo'].'&id_comm='.$newsComments['id']; ?>" method="post">
														<div class="modal-body">
															<textarea name="edit_commentaire" class="form-control" rows="3" style="resize: none;" maxlength="255" required><?php echo $editCommentaire; ?></textarea>
														</div>
														<div class="modal-footer">
															<center><h4><B>Minimum de 6 caractères<br>Maximum de 255 caractères</B></h4></center></br>
															<center><div class="btn-container"><button type="submit" class="btn standard-btn">Valider la modification</button></div></center>
														</div>
													</form>
												</div><!-- /.modal-content -->
											</div><!-- /.modal-dialog -->
										</div><!-- /.modal -->
										<?php }
									}
								} ?>

								<?php $i++; }
								else
									echo '<div class="alert alert-warning">Aucune news n\'a été créé à ce jour...</div>'; ?>
							</div>
						</div>