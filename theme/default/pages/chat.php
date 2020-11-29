<?php if (count($jsonCon) > 0) {
    $Chat = new Chat($jsonCon);
}
?>

<section id="Chat">
    <div class="container-fluid col-md-9 col-lg-9 col-sm-10">

        <div class="row">
            <!-- Présentation -->
            <div class="d-flex col-12 info-page">
                <i class="fas fa-info-circle notification-icon"></i>
                <div class="info-content">
                    Parlez avec les joueurs de nos serveurs sur le site !
                </div>
            </div>
        </div>

        <?php if (count($jsonCon) > 0) : ?>
            <div class="row">
                <div class="col-md-12 col-lg-3 col-sm-12 mb-3">
                    <!-- Linsting des serveurs -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Serveurs :</h4>
                        </div>
                        <div class="card-body categories">
                            <ul class="categorie-content nav nav-tabs" id="servEnLigne">
                                <?php foreach ($lectureJSON as $i => $serveur) : ?>
                                    <li class="categorie-item nav-item<?= ($i == 0) ? ' active' : '' ?>">
                                        <a href="#server-<?= $i ?>" onclick="setTimeout(switchEnLigne, 500);" class="nav-link categorie-link<?= ($i == 0) ? ' active' : '' ?>" data-toggle="tab" data-id="<?=$i;?>">
                                            <?= $serveur['nom']; ?>
                                        </a>
                                    <div style="<?= ($i == 0) ? '' : 'display: none;';?>" id="joueur<?=$i;?>">
                                        <?php $joueurs = $jsonCon[$i]->GetPlayers(); 
                                        if(empty($joueurs))
                                            echo "Pas de joueurs connectés";
                                        else
                                            foreach($joueurs as $value)
                                            {
                                                ?><img class="mr-3" src="<?=$_ImgProfil_->getUrlHeadByPseudo($value, 16);?>" style="width: 16px; height: 16px;"/><?=$value;?> <?=Permission::getInstance()->gradeJoueur($value);?><br/>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-9 col-sm-12 mb-3">
                    <!-- Affichage du Chat -->
                    <div class="tab-content">
                        <?php for ($i = 0; $i < count($jsonCon); $i++) :
                            $messages = $Chat->getMessages($i); ?>
                            <div id="server-<?= $i ?>" class="tab-pane fade <?php if ($i == 0) echo 'in active show'; ?>" aria-expanded="false">
                                <div class="card">
                                    <div class="card-header">
                                        <h4> Chat : </h4>
                                    </div>
                                    <div class="card-body" id="msgChat<?=$i;?>">
                                        <!-- Affichage du message -->
                                        <?php if ($messages != false && $messages != "erreur" && $messages != "query") :
                                            $messages = array_slice($messages, -10, 10);
                                            foreach ($messages as $value) : ?>

                                                <div class="media">
                                                    <p class="username">
                                                        <img class="mr-3" src="<?= $_ImgProfil_->getUrlHeadByPseudo($value['player'], 32); ?>" style="width: 32px; height: 32px;" alt="avatar de l'auteur" />
                                                        <div class="media-body">
                                                            <h5 class="mt-0">
                                                                <?= (empty($value['player'])) ? 'Console' : $value['player'] . ', ' . Permission::getInstance()->gradeJoueur($value['player']); ?>
                                                                <small class="font-weight-light float-right text-muted"><?= date('H:i', $value['time']); ?></small>
                                                            </h5>
                                                            <?= $Chat->formattage(htmlspecialchars($value['message'])); ?>
                                                        </div>
                                                    </p>
                                                </div>

                                            <?php endforeach; ?>
                                            <!-- Affichage des erreurs -->
                                        <?php elseif ($messages == "query") : ?>
                                            <div class="tab-pane fade in show" aria-expanded="false">
                                                <div class="info-page bg-danger">
                                                    <div class="text-center">
                                                        La connexion au serveur ne peut pas être établie avec ce protocole.
                                                    </div>
                                                </div>
                                            </div>
                                        <?php elseif ($messages == "erreur") : ?>
                                            <div class="tab-pane fade in show" aria-expanded="false">
                                                <div class="info-page bg-info">
                                                    <div class="text-center">
                                                        Aucun message n'a été envoyé sur ce serveur !
                                                    </div>
                                                </div>
                                            </div>

                                        <?php else : ?>
                                            <div class="tab-pane fade in show" aria-expanded="false">
                                                <div class="info-page bg-danger">
                                                    <div class="text-center">
                                                        La connexion au serveur n'a pas pu être établie.
                                                    </div>
                                                </div>
                                            </div>

                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>

                    <?php if (Permission::getInstance()->verifPerm("connect")) : ?>
                        <!-- Envoie du message -->
                        <form action="?action=sendChat" method="POST">
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="text" name="message" placeholder="Envoyez votre message..." max="100" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <select name="i" class="form-control">
                                            <?php foreach ($lectureJSON as $i => $serveur) : ?>
                                                <option value="<?= $i; ?>">
                                                    <?= $serveur['nom']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-3 text-center">
                                        <button class="btn btn-main" type="submit">Envoyer</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php else : ?>
                        <div class="card-footer">
                            <h5 class="text-center">
                                Connectez-vous pour utiliser le chat : <br />
                                <a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-main mt-2">
                                    <span class="glyphicon glyphicon-user"></span>Connexion
                                </a>
                            </h5>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        <?php endif ?>

    </div>
</section>