<section id="Vote">
    <div class="container-fluid col-md-9 col-lg-9 col-sm-10">
        <!-- Alerts -->
        <div class="alertSection mb-3">
            <?php if (isset($_GET['success'])) :
                if ($_GET['success'] != 'recupTemp') : ?>
                    <div class="alert alert-success alert-dismissible fade show text-shadow-none" role="alert">
                        Votre récompense arrive, si vous n'avez pas vu de fenêtre s'ouvrir pour voter, la fenêtre à dû s'ouvrir derrière votre navigateur, validez le vote et <strong>profitez de votre récompense In-Game</strong> !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php else : ?>
                    <div class="alert alert-success alert-dismissible fade show text-shadow-none" role="alert">
                        La récompense séléctionnée arrive, <strong>Profitez de cette dernière In-Game ! </strong>
                        Votre(vos) récompense(s) arrive(nt), profitez de votre(vos) récompense(s) In-Game !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
            <?php endif;
            endif; ?>
        </div>
        <div class="row">
            <!-- Présentation -->
            <div class="d-flex col-12 info-page">
                <i class="fas fa-info-circle notification-icon"></i>
                <div class="info-content">
                    Voter pour le serveur permet d'améliorer son référencement ! Les votes sont récompensés par des items In-Game.
                </div>
            </div>
        </div>

        <!-- Gestion des information et doublons de vote -->
        <div>
            <?php
            if (Permission::getInstance()->verifPerm("connect") and isset($_GET['player']) and $_Joueur_['pseudo'] == $_GET['player']) :
                if (!empty($donneesVotesTemp)) : ?>
                    <!-- Gestion des Récompenses -->
                    <div class="alert alert-success text-center">
                        <ul style="list-style-position: inside; padding-left: 0px;">
                            <?php
                            $p = 0;
                            $list = array();
                            $listNum = array();
                            foreach ($donneesVotesTemp as $data) {
                                $flag = false;
                                $temp = '<li>';
                                $action = explode(':', $data['action'], 2);
                                if ($action[0] == "give") {
                                    $temp .= "Give de ";
                                    $action = explode(':', $action[1]);
                                    $temp .= $action[3] . "x " . $action[1];
                                    if ($data['methode'] == 2)
                                        $temp .= ' sur le serveur ' . $lecture['Json'][$data['serveur']]['nom'];
                                    else
                                        $temp .= ' sur tout les serveurs de jeu';
                                } elseif ($action[0] == "jeton") {
                                    $temp .= "Give de " . $action[1] . " jetons sur le site";
                                } else {
                                    $temp .= "Vous récupérerez une surprise :P";
                                }

                                for ($a = 0; $a < count($list); $a++) {
                                    if ($list[$a] == $temp) {
                                        $listNum[$a]++;
                                        $flag = true;
                                    }
                                }
                                if (!$flag) {
                                    $list[$p] = $temp;
                                    $listNum[$p] = 1;
                                    $p++;
                                }
                            }

                            for ($y = 0; $y < $p; $y++) :
                                if ($listNum[$y] > 1) {
                                    echo $list[$y] . " X" . $listNum[$y] . "</li>";
                                } else {
                                    echo $list[$y] . "</li>";
                                }
                            endfor;
                            ?>

                            <a class='btn btn-success' href='?action=recupVotesTemp' title='Récupérer mes récompenses'>Récupérer mes récompenses (Connectez-vous sur le serveur)</a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>


        <div class="row">
            <?php if (!isset($_GET['player'])) : ?>

                <!-- Demande du Pseudonyme -->
                <div class="col col-md-12 col-lg-12 col-sm-12 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Entrez votre pseudonyme</h4>
                            <div class="card-body">
                                <form id="forme-vote" role="form" method="GET" action="index.php">
                                    <div>
                                        <div class="row">
                                            <input type="text" style="display:none;" name="page" value="voter">
                                            <div class="col-md-12 col-lg-9 col-sm-12">
                                                <input type="text" id="vote-pseudo" class="form-control" name="player" placeholder="Pseudo" value="<?= (Permission::getInstance()->verifPerm("connect")) ? $_Joueur_['pseudo'] : '' ?>" required>
                                            </div>
                                            <div class="col-md-12 col-lg-3 col-sm-12">
                                                <button class="form-control btn btn-reverse" type="submit">Suivant</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            <?php else : ?>

                <!-- Affichage des serveurs de jeu -->
                <div class="col-md-12 col-lg-3 col-sm-12 mb-3">
                    <!-- Serveurs -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Serveurs :</h4>
                        </div>
                        <div class="card-body categories">
                            <ul class="categorie-content nav nav-tabs">
                                <!-- Affichage noms Serveurs -->
                                <?php if (!isset($jsonCon) or empty($jsonCon)) : ?>

                                    <p>Veuillez relier votre serveur à votre site avec JsonAPI depuis le panel pour avoir les liens de vote !</p>

                                <?php endif; ?>

                                <?php for ($i = 0; $i < count($jsonCon); $i++) : ?>

                                    <li class="nav-item categorie-item<?= ($i == 0) ? ' active' : '' ?>">
                                        <a href="#voter-<?= $i; ?>" data-toggle="tab" class="categorie-link nav-link<?= ($i == 0) ? ' active' : '' ?>">
                                            <?= $lectureJSON[$i]['nom']; ?>
                                        </a>
                                    </li>

                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>
                </div>


                <?php $pseudo = htmlspecialchars($_GET['player']); ?>
                <div class="col col-md-12 col-lg-6 col-sm-12 mb-5">
                    <!-- Affichage des sites de vote -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Voter pour <?= $_Serveur_['General']['name']; ?></h4>
                            <div class="card-body">


                                <div class="tab-content">
                                    <?php for ($i = 0; $i < count($jsonCon); $i++) : ?>

                                        <div id="voter-<?= $i; ?>" class="tab-pane fade <?= ($i == 0) ? ' in active show' : ''; ?>" aria-expanded="<?= ($i == 0) ? 'true' : 'false' ?>">
                                            <div class="info-page">
                                                <div class="info-content">
                                                    Bienvenue dans la catégorie de vote pour le serveur : <br>
                                                    <strong><?= $lectureJSON[$i]['nom']; ?></strong>
                                                </div>
                                            </div>

                                            <?php
                                            $enligne = false;
                                            foreach ($serveurStats[$i]['joueurs'] as $key => $value) $serveurStats[$i]['joueurs'][$key] = strtolower($value);

                                            //Verification si je joueur en ligne
                                            if (isset($pseudo) and isset($serveurStats[$i]['joueurs']) and $serveurStats[$i]['joueurs'] and in_array(strtolower($pseudo), $serveurStats[$i]['joueurs'])) {
                                                $enligne = true;
                                            }


                                            $req_vote->execute(array('serveur' => $i));
                                            $count_req->execute(array('serveur' => $i));
                                            $data_count = $count_req->fetch();
                                            if ($data_count['count'] > 0) : ?>
                                                <h5 class="title-vote-listing">
                                                    Liste des sites de vote <div class="vote-line"></div>
                                                </h5>
                                                <?php while ($liensVotes = $req_vote->fetch()) :
                                                    $id = $liensVotes['id'];
                                                    if (!ExisteJoueur($pseudo, $id, $bddConnection)) {
                                                        CreerJoueur($pseudo, $id, $bddConnection);
                                                    }
                                                    $donnees = RecupJoueur($pseudo, $id, $bddConnection);
                                                    $lectureVotes = LectureVote($id, $bddConnection);
                                                    $action = explode(':', $lectureVotes['action'], 2);

                                                    if (!Vote($pseudo, $id, $bddConnection, $donnees, $lectureVotes['temps'])) : ?>
                                                        <button type="button" class="btn btn-reverse no-hover" disabled>
                                                            Temps restant : <?= GetTempsRestant($donnees['date_dernier'], $lectureVotes['temps'], $donnees) ?> </button>
                                                    <?php elseif ($action[0] != "jeton" || Permission::getInstance()->verifPerm("connect")) : ?>
                                                        <?php if ($lectureVotes['enligne'] == 1 && !$enligne) : ?>
                                                            <button type="button" class="btn btn-danger" disabled>
                                                                Vous devez être connecté sur le serveur pour pouvoir voter sur ce site.
                                                            </button>
                                                        <?php else : ?>
                                                            <a href="<?= $liensVotes['lien'] ?>" id="btn-lien-<?= $id ?>" target="_blank" onclick="document.getElementById('btn-lien-<?= $id ?>').style.display='none';document.getElementById('btn-verif-<?= $id ?>').style.display='inline';bouclevote(<?= $id ?>, <?= $pseudo ?>);" class="btn btn-secondary">
                                                                <?= $liensVotes['titre'] ?>
                                                            </a>

                                                            <button id="btn-verif-<?= $id ?>" style="display:none;" type="button" class="btn btn-reverse" disabled>
                                                                <span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>
                                                                Vérification en cours
                                                            </button>

                                                            <button type="button" style="display:none;" id="btn-after-<?= $id ?>" class="btn btn-reverse" disabled>
                                                                <?= TempsTotal($lectureVotes['temps']) ?>
                                                            </button>
                                                        <?php endif; ?>
                                                    <?php else :  ?>
                                                        <button type="button" class="btn btn-danger" disabled>
                                                            Vous devez être connecté sur le site pour pouvoir voter sur ce site.
                                                        </button>
                                                    <?php endif; ?>
                                                <?php endwhile; ?>
                                            <?php else : ?>
                                                <!-- Aucun site disponible -->
                                                <div class="info-page bg-danger">
                                                    <div class="text-center">Aucun site de vote disponible ! </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col col-md-12 col-lg-3 col-sm-12 mb-5">
                    <!-- Affichage des informations du joueur -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Informations</h4>
                            <div class="card-body">
                                <h5>Bonjour, <?= $pseudo ?></h5>

                                <h6>Merci d'avance pour votre vote !</h6>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Top vote -->
        <div class="row">

            <table class="table table-dark table-striped table-hover">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pseudo</th>
                        <th>Votes</th>
                    </tr>
                </thead>

                <?php
                if (isset($topVoteurs)) :
                    for ($i = 0; $i < count($topVoteurs) and $i < 10; $i++) :
                        $Img = new ImgProfil($topVoteurs[$i]['pseudo'], 'pseudo'); ?>
                        <tr>
                            <td>
                                <?= $i + 1 ?>
                            </td>
                            <td>
                                <img src="<?= $Img->getImgToSize(30, $width, $height); ?>" style="width: <?= $width; ?>px; height: <?= $height; ?>px;" alt="none" />
                                <strong>
                                    <a href="?page=profil&profil=<?= $topVoteurs[$i]['pseudo'] ?>">
                                        <?= $topVoteurs[$i]['pseudo']; ?>
                                    </a>
                                </strong>
                            </td>
                            <td id="nbr-vote-<?= $topVoteurs[$i]['pseudo']; ?>">
                                <?= $topVoteurs[$i]['nbre_votes']; ?>
                            </td>
                        </tr>
                    <?php endfor; ?>
                <?php else : ?>
                    <tr class="p-0 no-hover">
                        <td colspan="3" class="p-0 no-hover">
                            <div class="m-0 info-page bg-danger">
                                <div class="text-center">Personne n'a encore voté !</div>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </table>

        </div>

    </div>
</section>




<?php
//Fonction de fonctionnement de la page	
function TempsTotal($tempsRestant)
{
    $tempsH = 0;
    $tempsM = 0;
    while ($tempsRestant >= 3600) {
        $tempsH = $tempsH + 1;
        $tempsRestant = $tempsRestant - 3600;
    }
    while ($tempsRestant >= 60) {
        $tempsM = $tempsM + 1;
        $tempsRestant = $tempsRestant - 60;
    }
    if ($tempsH == 0) {
        return $tempsM . ' minute(s)';
    } else if ($tempsM <= 9) {
        return $tempsH . 'H0' . $tempsM;
    } else {
        return $tempsH . 'H' . $tempsM;
    }
}
function RecupJoueur($pseudo, $id, $bddConnection)
{
    $line = $bddConnection->prepare('SELECT * FROM cmw_votes WHERE pseudo = :pseudo AND site = :site');
    $line->execute(array(
        'pseudo' => $pseudo,
        'site' => $id
    ));
    $donnees = $line->fetch(PDO::FETCH_ASSOC);
    return $donnees;
}

function Vote($pseudo, $id, $bddConnection, $donnees, $temps)
{
    if ($donnees['date_dernier'] + $temps < time()) {
        return true;
    } else
        return false;
}

function ExisteJoueur($pseudo, $id, $bddConnection)
{
    $line = $bddConnection->prepare('SELECT * FROM cmw_votes WHERE pseudo = :pseudo AND site = :site');
    $line->execute(array(
        'pseudo' => $pseudo,
        'site' => $id
    ));

    $donnees = $line->fetch(PDO::FETCH_ASSOC);

    if (empty($donnees['pseudo']))
        return false;
    else
        return true;
}

function CreerJoueur($pseudo, $id, $bddConnection)
{
    $req = $bddConnection->prepare('INSERT INTO cmw_votes(pseudo, site) VALUES(:pseudo, :site)');
    $req->execute(array(
        'pseudo' => $pseudo,
        'site' => $id
    ));
}

function GetTempsRestant($temps, $tempsTotal, $donnees)
{
    $tempsEcoule = time() - $temps;
    $tempsRestant = $tempsTotal - $tempsEcoule;
    $tempsH = 0;
    $tempsM = 0;
    while ($tempsRestant >= 3600) {
        $tempsH = $tempsH + 1;
        $tempsRestant = $tempsRestant - 3600;
    }
    while ($tempsRestant >= 60) {
        $tempsM = $tempsM + 1;
        $tempsRestant = $tempsRestant - 60;
    }
    if ($tempsM <= 9) {
        return $tempsH . 'H0' . $tempsM;
    } else {
        return $tempsH . 'H' . $tempsM;
    }
}

function LectureVote($id, $bddConnection)
{
    $req = $bddConnection->prepare('SELECT * FROM cmw_votes_config WHERE id = :id');
    $req->execute(array('id' => $id));
    return $req->fetch(PDO::FETCH_ASSOC);
}
?>