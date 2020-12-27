<?php
// Initialisation des membres
$Membres = new MembresPage($bddConnection);
if (isset($_GET['page_membre'])) {
    $page = htmlentities($_GET['page_membre']);
    $membres = $Membres->getMembres($page);
} else {
    $page = 1;
    $membres = $Membres->getMembres();
}
?>

<section id="Members">
    <div class="container-fluid col-md-9 col-lg-9 col-sm-10">
        <div class="row">
            <!-- Présentation -->
            <div class="d-flex col-12 info-page">
                <i class="fas fa-info-circle notification-icon"></i>
                <div class="info-content">
                    Ici, vous pourrez consulter la liste des membres du site, voir leur profil...
                </div>
            </div>
        </div>
        <!-- Membres -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 mb-3">
                <div class="form-group row searchPlayer">
                    <label for="searchPlayer" class="col-lg-4 col-md-12 col-sm-12 col-form-label">Rechercher un joueur : </label>
                    <input type="text" onChange="rechercheAjaxMembre();" class="form-control col-lg-8 col-md-12 col-sm-12" id="recherche" name="searchPlayer" placeholder="Ex: BadiiiX (Appuyez sur Entrée pour valider)" />
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Liste des Membres  -->
            <div class="col-md-12 col-lg9 col-sm-12">
                <table class="table table-dark table-striped table-hover">
                    <caption> Nombre de joueurs : <?= count($membres); ?> </caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Grade Site</th>
                            <th scope="col"><?=$_Serveur_['General']['moneyName'];?></th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableMembre">
                        <?php foreach ($membres as $value) : ?>
                            <tr>
                                <td scope="row">
                                    <?= $value['id']; ?></td>
                                <td>
                                    <img src='<?= $_ImgProfil_->getUrlHeadByPseudo($value['pseudo'], 32); ?>' style='width: 32px; height: 32px;' alt='image de profile de <?= $value["pseudo"] ?>' /> <?= $value["pseudo"]; ?>
                                </td>

                                <td>
                                    <?= Permission::getInstance()->gradeJoueur($value["pseudo"]); ?>
                                </td>

                                <td>
                                    <?= $value['tokens']; ?>
                                </td>

                                <td>
                                    <a href="?page=profil&profil=<?= $value['pseudo']; ?>" class="btn btn-reverse">Voir le compte</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php if ($page > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=membres&page_membre=<?= $page - 1 ?>" aria-label="Précédent">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Précédent</span>
                                </a>
                            </li>
                        <?php endif;
                        for ($i = 1; $i <= $Membres->nbPages; $i++) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=membres&page_membre=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php
                        endfor;
                        if ($page < $Membres->nbPages) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=membres&page_membre=<?= $page + 1 ?>" aria-label="Suivant">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Suivant</span>
                                </a>
                            </li>';
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>