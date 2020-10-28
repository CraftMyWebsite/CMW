<?php if (count($jsonCon) > 0) {
    require('modele/app/chat.class.php');
    $Chat = new Chat($jsonCon);
}
?>

<section id="Banlist">
    <div class="container-fluid col-md-9 col-lg-9 col-sm-10">
        <div class="row">
            <!-- Présentation -->
            <div class="d-flex col-12 info-page">
                <i class="fas fa-info-circle notification-icon"></i>
                <div class="info-content">
                    Voici la liste des joueurs bannis de nos serveurs de jeu.
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
                            <ul class="categorie-content nav nav-tabs">
                                <?php for ($i = 0; $i < count($jsonCon); $i++) : ?>
                                    <li class="categorie-item nav-item<?= ($i == 0) ? ' active' : '' ?>">
                                        <a href="#server-<?= $j ?>" class="nav-link categorie-link<?= ($i == 0) ? ' active' : '' ?>" data-toggle="tab">
                                            <?= $lectureJSON[$i]['nom']; ?>
                                        </a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-9 col-sm-12 mb-5">
                    <!-- Liste des joueurs banni -->
                    <div class="tab-content">
                        <?php for ($i = 0; $i < count($jsonCon); $i++) : ?>
                            <div id="server-<?= $i ?>" class="tab-pane fade <?php if ($i == 0) echo 'in active show'; ?>" aria-expanded="false">
                                <table class="table table-dark table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Pseudo</th>
                                            <th>Date</th>
                                            <th>Source</th>
                                            <th>Durée</th>
                                            <th>Raison</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($banlist[$i] as $element) : ?>
                                            <tr>
                                                <td title="<?= $element->uuid ?>"><?= $element->name ?></td>
                                                <td><?= $element->created ?></td>
                                                <td><?= $Chat->formattage($element->source); ?></td>
                                                <td><?= $element->expires ?></td>
                                                <td><?= $element->reason ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="tab-pane fade in show" aria-expanded="false">
                <div class="info-page bg-danger">
                    <div class="text-center">
                        Aucun serveur n'a été enregistré !
                    </div>
                </div>
            </div>
        <?php endif; ?>
</section>