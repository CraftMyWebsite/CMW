	<nav class="navbar navbar-toggleable-md navbar-inverse bg-primary">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container">
            <a class="navbar-brand wow fadeIn text-uppercase" href="index.php"><?php echo $_Serveur_['General']['name']; ?></a>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav ml-auto">
					<?php
					// Je rappelle que _Menu_ est une variable utilisable partout. Elle est générée en début d'index. 
					// Cette variable contient le texte des liens de la barre des menus, l'adresse des liens, les liste déroulantes etc...
					
					// Cette boucle affiche un lien / menu déroulant à chaque tour. On fait autant de tour qu'il y a de textes à afficher.
					for($i = 0; $i < count($_Menu_['MenuTexte']); $i++)
					{
						// Si il y a une liste déroulante contenant le texte du texte de ce tour de boucle, le lien devient un menu déroulant.
						if(isset($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]]))
						{
							// On affiche la structure de base du menu déroulant de Bootstrap :
							?>
									<li class="nav-item dropdown">
									<a id="Listdefil<?php echo $i; ?>" href="#" class="nav-link dropdown-toggle wow fadeInDown link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-wow-delay="<?php echo $i/10; ?>s"><?php echo $_Menu_['MenuTexte'][$i]; ?></a>
										<div class="dropdown-menu" aria-labelledby="Listdefil<?php echo $i; ?>">
							<?php
						
							// On affiche la puce dans le menu déroulant depuis une boucle, qui fait autant de tour qu'il y a de lignes à afficher dans la liste déroulante.
							for($k = 0; $k < count($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]]); $k++)
							{
								// Dans le cas où le texte de la puce vaut "-divider-", on met une ligne de division à la place du texte (fonctionnalité css de bootstrap). 
								
								if($_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]][$k] == '-divider-')
								{
									echo'<div class="dropdown-divider"></div>';
								}
								// Sinon on met un lien avec texte + adresse.
								else
								{
									echo '<a href="' .$_Menu_['MenuListeDeroulanteLien'][$_Menu_['MenuTexteBB'][$i]][$k]. '" class="dropdown-item">' .$_Menu_['MenuListeDeroulante'][$_Menu_['MenuTexteBB'][$i]][$k]. '</a>';
								}
							}
							
							// On ferme la liste du déroulant, et on remonte à la premiere boucle :p.
							?>
										</div>
									</li>
						<?php
						}
						
						// Si le lien n'est pas un menu déroulant, on l'affiche tout simplement, ou presque, il faut prévoir que si on est sur la page du lien, le lien doit être en foncé (class="active" fonction bootstrap).
						else
						{
							// Cette variable contient la valeur du lien de la puce(on enlève donc ?&page= en le remplaçant par '' et on garde que la fin.
							$quellePage = str_replace('index.php?&page=', '', $_Menu_['MenuLien'][$i]);
							$quellePage1 = str_replace('?&page=', '', $_Menu_['MenuLien'][$i]);
							$quellePage2 = str_replace('?page=', '', $_Menu_['MenuLien'][$i]);
							
							// Si le Get actuel est égal à la variable de la ligne précédente, la puce est active.
							if(isset($_GET['page']) AND ($quellePage == $_GET['page'] OR $quellePage1 == $_GET['page'] OR $quellePage2 == $_GET['page'])) 
								$active = ' active';
							
							// Si il n'y a pas de get(on est donc sur l'index) et qu'on est au premier tour de boucle --> le premier lien(souvent un lien vers l'accueil justement) est actif (foncé).
							elseif(!isset($_GET['page']) AND $i == 0) 
								$active = ' active';
							
							// On prévoit que quand il n'y a rien à afficher, la var est vide pour éviter l'erreur.
							else $active = ' hvr-bounce-in';
							
							// On affiche enfin la puce ! 
							echo '<li class="nav-item' .$active. ' wow fadeInDown" data-wow-delay"'. $i/10 .'s"><a href="' .$_Menu_['MenuLien'][$i]. '" class="nav-link">' .$_Menu_['MenuTexte'][$i]. '</a></li>';
						}
					}
					if(isset($_Joueur_))
					{
						$Img = new ImgProfil($_Joueur_['id']);
					?>
					<div class="btn-group dropdown-hover" role="group" aria-label="Dropdown Membres">
                        <a href="?page=profil&profil=<?php echo $_Joueur_['pseudo']; ?>"><button type="button" class="btn btn-primary wow fadeInDown link btn-colored" data-wow-delay="<?php echo ($i+1)/10;?>s"><img src="<?=$Img->getImgToSize(24, $width, $height); ?>" style="margin-left: -10px; width: <?=$width;?>px; height: <?=$height;?>px;"> <?php echo $_Joueur_['pseudo']; ?></button></a>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop3" type="button" class="btn btn-primary dropdown-toggle wow fadeInDown link btn-colored" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-wow-delay="<?php echo ($i+1)/10; ?>s"></button>
                            <div class="dropdown-menu  dropdown-menu-right animated fadeIn" aria-labelledby="btnGroupDrop3">
								<?php 
									$req_topic = $bddConnection->prepare('SELECT cmw_forum_topic_followed.pseudo, vu, cmw_forum_post.last_answer AS last_answer_pseudo 
										FROM cmw_forum_topic_followed
										INNER JOIN cmw_forum_post WHERE id_topic = cmw_forum_post.id AND cmw_forum_topic_followed.pseudo = :pseudo');
									$req_topic->execute(array(
										'pseudo' => $_Joueur_['pseudo']
									));
									$alerte = 0;
									while($td = $req_topic->fetch(PDO::FETCH_ASSOC))
									{
										if($td['pseudo'] != $td['last_answer_pseudo'] AND $td['last_answer_pseudo'] != NULL AND $td['vu'] == 0)
										{
											$alerte++;
										}
									}
									$req_answer = $bddConnection->prepare('SELECT vu
									FROM cmw_forum_like INNER JOIN cmw_forum_answer WHERE id_answer = cmw_forum_answer.id
									AND cmw_forum_like.pseudo != :pseudo AND cmw_forum_answer.pseudo = :pseudo AND type = 2');
									$req_answer->execute(array(
										'pseudo' => $_Joueur_['pseudo'],
									));
									while($answer_liked = $req_answer->fetch(PDO::FETCH_ASSOC))
									{
										if($answer_liked['vu'] == 0)
										{
											$alerte++;
										}
									}
									if($_PGrades_['PermsPanel']['access'] == "on" OR $_Joueur_['rang'] == 1)
										echo '<a href="admin.php" class="dropdown-item text-success"><i class="fas fa-tachometer-alt"></i> Administration</a>';
									if($_PGrades_['PermsForum']['moderation']['seeSignalement'] == true OR $_Joueur_['rang'] == 1)
									{
										$req_report = $bddConnection->query('SELECT id FROM cmw_forum_report WHERE vu = 0');
										$signalement = $req_report->rowCount();
										echo '<a href="?page=signalement" class="dropdown-item text-warning"><i class="fa fa-bell"></i> Signalement <span class="badge badge-pill badge-warning" id="signalement">' . $signalement . '</span></a>';
									}
								?>
                                <a class="dropdown-item" href="?page=alert"><i class="fa fa-bell"></i> Alertes :  <span class="badge badge-pill badge-primary" id="alerts"><?php echo $alerte; ?></span></a>
                                <a class="dropdown-item" href="?page=messagerie"><i class="fa fa-envelope"></i> Messagerie</a>
                                <a class="dropdown-item" href="?page=token"><i class="ion-cash"></i> Mon solde : <?php if(isset($_Joueur_['tokens'])) echo $_Joueur_['tokens'] . ' '; ?></a>
                                <a class="dropdown-item text-danger" href="?action=deco"><i class="fas fa-sign-out-alt"></i> Se déconnecter</a>
                            </div>
                        </div>
                    </div>
					<?php 
					}
					else
					{
						?>
						<li class="nav-item dropdown">
						    <a class="nav-link dropdown-toggle wow fadeInDown link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-wow-delay="<?php echo ($i+1)/10;?>s">
						         <i class="fa fa-user"></i> Compte
						    </a>
						    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						        <a class="dropdown-item hvr-forward" href="#" data-toggle="modal" data-target="#ConnectionSlide"><i class="fas fa-sign-in-alt"></i> Connexion</a>
						        <a class="dropdown-item hvr-forward" href="#" data-toggle="modal" data-target="#InscriptionSlide"><i class="fa fa-user-plus"></i> Inscription</a>
						    </div>
						</li>
						<?php 
					}
					?>
                </ul>
            </div>
        </div>
    </nav>