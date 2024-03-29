<section id="Support">
    <div class="container-fluid col-md-9 col-lg-9 col-sm-10">

        <div class="row mt-4">
            <!-- Tableau des Tickets  -->
            
                <table class="table table-dark table-hover  mb-4 mt-4">
                    <thead>
                        <tr>
                            <?php if (Permission::getInstance()->verifPerm('PermsDefault', 'support', 'displayTicket')) : ?>
                                <th scope="col" data-toggle="collapse">Visibilité</th>
                            <?php endif; ?>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                            <th scope="col">Status</th>
                            <?php if (Permission::getInstance()->verifPerm('PermsDefault', 'support', 'closeTicket')) : ?>
                                <th scope="col">Modification</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $j = 0;
                        while ($tickets = $ticketReq->fetch(PDO::FETCH_ASSOC)) : ?>

                            <!-- Listing des tickets -->
                            <tr class="no-hover">
                                <?php if (htmlspecialchars($tickets['ticketDisplay']) === 0 || htmlspecialchars($tickets['auteur']) === $_Joueur_['pseudo'] || Permission::getInstance()->verifPerm('PermsDefault', 'support', 'displayTicket')) :
                                    if (Permission::getInstance()->verifPerm('PermsDefault', 'support', 'displayTicket')) : ?>
                                        <td>
                                            <?php if (htmlspecialchars($tickets['ticketDisplay']) === '0') : ?>
                                                <span>
                                                    <i class="glyphicon glyphicon-eye-open"></i> Publique
                                                </span>
                                            <?php else : ?>
                                                <span>
                                                    <i class="glyphicon glyphicon-eye-close"></i> Privée
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>

                                    <td>
                                        <a href="index.php?page=profil&profil=<?= htmlspecialchars($tickets['auteur']) ?>">
                                            <img alt="Avatar de l'auteur <?= htmlspecialchars($_Joueur_['pseudo']) ?>" class="icon-player-topbar" src="<?= $_ImgProfil_->getUrlHeadByPseudo($tickets['auteur'], 32) ?>" style="width: 32px; height: 32px" />
                                            <?= htmlspecialchars($tickets['auteur']) ?>
                                        </a>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($tickets['titre']) ?>
                                    </td>

                                    <td><?= $_Forum_->conversionDate($tickets['date_post']) ?>
                                    </td>

                                    <td>
                                            <a class="btn btn-reverse no-hover" data-toggle="modal" data-target="#slide-<?= htmlspecialchars($tickets['id']) ?>" data-dismiss="modal">
                                            <i class="fa fa-eye"></i> Voir
                                        </a>
                                    </td>

                                    <td>
                                        <?php
                                        $ticketstatus = htmlspecialchars($tickets['etat']);
                                        if ($ticketstatus === '1') : ?>
                                            <button class="btn btn-success">
                                                Résolu <span class="glyphicon glyphicon-ok"></span>
                                            </button>
                                        <?php else : ?>
                                            <button class="btn btn-danger">
                                                Non Résolu <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        <?php endif; ?>
                                    </td>

                                    <?php if (Permission::getInstance()->verifPerm('PermsDefault', 'support', 'closeTicket')) : ?>
                                        <td style="text-align: center;">
                                            <form class="form-horizontal default-form" method="post" action="?action=ticketEtat&id=<?= htmlspecialchars($tickets['id']) ?>">
                                                <?php if (htmlspecialchars($tickets['etat']) == 0) : ?>
                                                    <button type="submit" name="etat" class="btn btn-main" value="1">
                                                        Fermer le ticket
                                                    </button>
                                                <?php else : ?>
                                                    <button type="submit" name="etat" class="btn btn-main" value="0">
                                                        Ouvrir le ticket
                                                    </button>
                                                <?php endif; ?>
                                            </form>
                                        </td>
                                <?php endif;
                                endif; ?>
                            </tr>


                            <!-- Système de ticket support -->

                            <?php if (htmlspecialchars($tickets['ticketDisplay']) === '0' || htmlspecialchars($tickets['auteur']) === $_Joueur_['pseudo'] || Permission::getInstance()->verifPerm('PermsDefault', 'support', 'displayTicket')) :
                                $ticketstatus = htmlspecialchars($tickets['etat']);

                                unset($message);
                                $message = $tickets['message'];

                                $commentaires = 0; ?>

                                <div class="modal fade" id="slide-<?= htmlspecialchars($tickets['id']) ?>" tabindex="-1" role="dialog" aria-labelledby="slide-<?= htmlspecialchars($tickets['id']) ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close mr-3 ml-0" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" style="color: var(--base-color);">&times;</span>
                                                </button>
                                                <h5 class="modal-title mr-auto">
                                                    Support : <?= htmlspecialchars($tickets['titre']) ?>

                                                    <?php if ($ticketstatus == 1) : ?>
                                                        <div class="ribbon-wrapper ">
                                                            <div class="ribbon bg-main">Résolu !</div>
                                                        </div>
                                                    <?php endif; ?>
                                                </h5>

                                            </div>


                                            <!-- Message d'aide -->
                                            <div class="modal-body">

                                                <div class="media">
                                                    <p class="username">
                                                        <img class="mr-3" src="<?= $_ImgProfil_->getUrlHeadByPseudo(htmlspecialchars($tickets['auteur']), 32); ?>" style="width: 32px; height: 32px;" alt="Avatar de <?= htmlspecialchars($tickets['auteur']) ?>" />
                                                        <div class="media-body">
                                                            <h6 class="mt-0 mb-2 font-weight-bold">
                                                                <?= htmlspecialchars($tickets['auteur']) ?> | le <?= $_Forum_->conversionDate(htmlspecialchars($tickets['date_post'])) ?>
                                                            </h6>
                                                            <?= $message ?>


                                                            <hr class="bg-main w-100">

                                                            <!-- Commentaires -->
                                                            <?php if (isset($ticketCommentaires[$tickets['id']])) :

                                                                for ($i = 0, $iMax = count($ticketCommentaires[$tickets['id']]); $i < $iMax; $i++) :

                                                                    unset($message);
                                                                    $message = $ticketCommentaires[$tickets['id']][$i]['message'];
                                                            ?>


                                                                    <div class="media mt-4">
                                                                        <p class="username">
                                                                            <img class="mr-3" src="<?= $_ImgProfil_->getUrlHeadByPseudo($ticketCommentaires[$tickets['id']][$i]['auteur'], 32); ?>" style="width:32px; height:32px;" alt="Avatar de <?= $ticketCommentaires[$tickets['id']][$i]['auteur'] ?>" />
                                                                            <div class="media-body">
                                                                                <h6 class="mt-0 mb-2 font-weight-bold">
                                                                                    <?= $ticketCommentaires[$tickets['id']][$i]['auteur']; ?> | le <?= $_Forum_->conversionDate($ticketCommentaires[$tickets['id']][$i]['date_post']); ?>
                                                                                </h6>
                                                                                <div id="contenueCom<?= $tickets['id'] ?>-<?= $ticketCommentaires[$tickets['id']][$i]['id'] ?>" style="margin-bottom:10px;"><?= $message; ?></div>

                                                                                <!-- Actions possible sur les commentaires -->
                                                                                <?php if ((isset($_Joueur_))  &&  (($ticketCommentaires[$tickets['id']][$i]['auteur'] === $_Joueur_['pseudo'] || Permission::getInstance()->verifPerm('PermsDefault', 'support', 'deleteMemberComm')) || (Permission::getInstance()->verifPerm('PermsDefault', 'support', 'editMemberComm')))) : ?>

                                                                                    <div class="dropdown">
                                                                                        <a class="btn btn-reverse no-hover float-right" data-toggle="dropdown">Action <b class="caret"></b></a>
                                                                                        <ul class="dropdown-menu">

                                                                                            <?php if ($ticketCommentaires[$tickets['id']][$i]['auteur'] === $_Joueur_['pseudo'] or Permission::getInstance()->verifPerm('PermsDefault', 'support', 'deleteMemberComm')) : ?>

                                                                                                <li>
                                                                                                    <a href="index.php?action=delete_support_commentaire&id_comm=<?= $ticketCommentaires[$tickets['id']][$i]['id'] ?>&id_ticket=<?= $tickets['id'] ?>&auteur=<?= $ticketCommentaires[$tickets['id']][$i]['auteur'] ?>" class="dropdown-item">
                                                                                                        Supprimer
                                                                                                    </a>
                                                                                                </li>

                                                                                            <?php endif; ?>

                                                                                            <?php if ($ticketCommentaires[$tickets['id']][$i]['auteur'] === $_Joueur_['pseudo'] or Permission::getInstance()->verifPerm('PermsDefault', 'support', 'editMemberComm')) : ?>
                                                                                                <li>
                                                                                                    <a href="#editComm-<?= $ticketCommentaires[$tickets['id']][$i]['id'] ?>" data-toggle="modal" data-target="#editComm-<?= $ticketCommentaires[$tickets['id']][$i]['id'] ?>" class="dropdown-item" data-dismiss="modal">Editer</a>
                                                                                                </li>
                                                                                            <?php endif; ?>
                                                                                        </ul>
                                                                                    </div>

                                                                                <?php endif; if($tickets['etat'] === '0') { ?>
                                                                                <button type="button" onclick="addBlockQuote('ckeditorCom<?= $tickets['id'] ?>','contenueCom<?= $tickets['id'] ?>-<?= $ticketCommentaires[$tickets['id']][$i]['id'] ?>', '<?= $ticketCommentaires[$tickets['id']][$i]['auteur']; ?>');" class="btn btn-dark float-right mb-5" style="margin-right:15px;">Citer</button>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </p>
                                                                    </div>




                                                                <?php endfor; ?>
                                                            <?php endif; ?>


                                                        </div>
                                                    </p>
                                                </div>


                                            </div>

                                            <div class="modal-footer">

                                                <!-- Envoie d'un commentaire -->
                                                <?php if ($tickets['etat'] == '0') : ?>

                                                    <form action="?action=post_ticket_commentaire" method="post">
                                                        <input type="hidden" name="id" value="<?= htmlspecialchars($tickets['id']) ?>" />
                                                            <div style="width:100%;">

                                                                <textarea  data-UUID="0006<?= htmlspecialchars($tickets['id']) ?>" id="ckeditorCom<?= htmlspecialchars($tickets['id']) ?>" name="message" style="height: 275px;"></textarea>
                                                            </div>
                                                        <button type="submit" class="btn btn-main mt-4 w-100">Commenter</button>
                                                    </form>

                                                <?php else : ?>

                                                    <div class="w-100 m-0 info-page bg-danger">
                                                        <div class="text-center">Ticket résolu ! Merci de contacter un administrateur pour réouvrir votre ticket.</div>
                                                    </div>

                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endif; ?>

                            <!-- Edition d'un commentaire -->

                            <?php if ((isset($ticketCommentaires[$tickets['id']][$i]['auteur']) && $ticketCommentaires[$tickets['id']][$i]['auteur'] === $_Joueur_['pseudo']) || Permission::getInstance()->verifPerm('PermsDefault', 'support', 'editMemberComm')) :
                                if (!empty($ticketCommentaires[$tickets['id']])) :
                                    for ($i = 0, $iMax = count($ticketCommentaires[$tickets['id']]); $i < $iMax; $i++) : ?>

                                        <div class="modal fade" id="editComm-<?= $ticketCommentaires[$tickets['id']][$i]['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editComm">
                                            <form method="POST" action="?action=edit_support_commentaire&id_comm=<?= $ticketCommentaires[$tickets['id']][$i]['id']; ?>&id_ticket=<?= $tickets['id'] ?>&auteur=<?= $ticketCommentaires[$tickets['id']][$i]['auteur'] ?>">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edition du commentaire</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true" style="color: var(--base-color);">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="col-lg-12 text-center">


                                                                <div class="row mt-4">
                                                                    <div style="width:100%;">
                                                                        <textarea data-UUID="0015" name="editMessage" class="form-control custom-text-input" style="height: 275px; ">
                                                                        <?= $ticketCommentaires[$tickets['id']][$i]['message'] ?></textarea>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <div class="col-lg-12 text-center">
                                                                <div class="row">
                                                                    <button type="submit" class="btn btn-main w-100">Valider !</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    <?php endfor; ?>
                                <?php endif; ?>
                            <?php endif; ?>

                        <?php $j++;
                        endwhile; ?>
                    </tbody>
                </table>


                <!-- Création de Ticket -->

                <?php if (!Permission::getInstance()->verifPerm('connect')) : ?>

                    <a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-main w-100">
                        <i class="fas fa-sign-in-alt"></i> Se connecter pour ouvrir un ticket
                    </a>
                <?php else : ?>

                    <button data-toggle="collapse" href="#ticketCree" role="button" aria-expanded="false" aria-controls="ticketCree" class="btn btn-reverse w-100 mb-3">
                        <i class="fas fa-pen-square"></i> Poster un ticket
                    </button>

                    <div class="collapse" id="ticketCree">
                        <div class="card">
                            <form action="index.php?action=post_ticket" method="post" >
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="titre_ticket">Sujet</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" id="titre_ticket" class="form-control custom-text-input" name="titre" placeholder="Sujet">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="vu_ticket">Visibilité</label>
                                                <?php
                                                if (!isset($_Serveur_['support']['visibilite']) || $_Serveur_['support']['visibilite'] === 'both') : ?>
                                                    <select class="form-control custom-text-input" id="vu_ticket" name="ticketDisplay">
                                                        <option value="0">Publique</option>
                                                        <option value="1">Privée</option>
                                                    </select>
                                                <?php else : ?>
                                                    <select class="form-control custom-text-input" id="vu_ticket" name="ticketDisplay">
                                                        <?php if ($_Serveur_['support']['visibilite'] === 'prive') : ?>
                                                            <option value="1">Privée</option>
                                                        <?php else : ?>
                                                            <option value="0">Publique</option>
                                                        <?php endif; ?>
                                                    </select>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">

                                        <label for="message_ticket">Description détaillée</label>
                                        <textarea  data-UUID="0007" id="ckeditor" name="message" style="height: 275px; margin: 0; width: 100%;"></textarea>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-main">Envoyer</button>
                                </div>
                            </form>
                        </div>
                    </div>

                <?php endif; ?>
            
        </div>
    </div>
</section>