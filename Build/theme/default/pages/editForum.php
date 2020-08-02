<?php
require('modele/forum/adminForum.class.php');

if (Permission::getInstance()->verifPerm("connect") and isset($_GET['id'], $_GET['objet'])) :
    $AdminForum = new AdminForum($bddConnection);
    $objet = htmlentities($_GET['objet']);
    $id = htmlentities($_GET['id']);

    if ($AdminForum->verifEdit($objet, $id, $_Joueur_)) :
        $table = ($objet == 1) ? 'cmw_forum_post' : 'cmw_forum_answer';
        $req = $bddConnection->prepare('SELECT * FROM ' . $table . ' WHERE id = :id');
        $req->execute(array(
            'id' => $id
        ));
        $donnee = $req->fetch(PDO::FETCH_ASSOC); ?>

        <section id="editForum">

            <div class="container-fluid col-md-9 col-lg-9 col-sm-10">
                <div class="row">
                    <form action="?action=editForum" method="POST" class="w-100 m-3">

                        <div class="card">

                            <div class="card-header">
                                <h4 class="ml-5">Edition de votre <?= ($objet == 1) ? 'topic' : 'réponse'; ?></h4>
                            </div>

                            <div class="card-body">

                                <input type="hidden" name="id" value="<?= $id; ?>" />
                                <input type="hidden" name="objet" value="<?= $objet; ?>" />

                                <div class="form-row py-3">
                                    <?php if ($objet == 1) : ?>
                                        <label for="titre">Modifier le titre: </label>
                                        <input type="text" name="titre" maxlength="40" id="titre" class="form-control custom-text-input" value="<?= $donnee['nom']; ?>" />
                                    <?php endif; ?>
                                </div>

                                <div class="form-row py-3">
                                    <div class="col-md-12 text-center">

                                        <a href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en gras', 'ce texte sera en gras', 'b')" style="text-decoration: none;" title="gras"><i class="fas fa-bold" aria-hidden="true"></i></a>
                                        <a href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en italique', 'ce texte sera en italique', 'i')" style="text-decoration: none;" title="italique"><i class="fas fa-italic"></i></a>
                                        <a href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en souligné', 'ce texte sera en souligné', 'u')" style="text-decoration: none;" title="souligné"><i class="fas fa-underline"></i></a>
                                        <a href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en barré', 'ce texte sera barré', 's')" style="text-decoration: none;" title="barré"><i class="fas fa-strikethrough"></i></a>
                                        <a href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en aligné à gauche', 'ce texte sera aligné à gauche', 'left')" style="text-decoration: none" title="aligné à gauche"><i class="fas fa-align-left"></i></a>
                                        <a href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en centré', 'ce texte sera centré', 'center')" style="text-decoration: none" title="centré"><i class="fas fa-align-center"></i></a>
                                        <a href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en aligné à droite', 'ce texte sera aligné à droite', 'right')" style="text-decoration: none" title="aligné à droite"><i class="fas fa-align-right"></i></a>
                                        <a href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en justifié', 'ce texte sera justifié', 'justify')" style="text-decoration: none" title="justifié"><i class="fas fa-align-justify"></i></a>
                                        <a href="javascript:ajout_text_complement('contenue', 'Ecrivez ici l\'adresse de votre lien', 'https://craftmywebsite.fr/forum', 'url', 'Entrez le titre de votre lien', 'CraftMyWebsite')" style="text-decoration: none" title="lien"><i class="fas fa-link"></i></a>
                                        <a href="javascript:ajout_text_complement('contenue', 'Ecrivez ici l\'adresse de votre image', 'https://craftmywebsite.fr/img/cat6.png', 'img', 'Entrez ici le titre de votre image (laisser vide si vous ne voulez pas compléter', 'Titre')" style="text-decoration: none" title="image"><i class="fas fa-image"></i></a>
                                        <a href="javascript:ajout_text_complement('contenue', 'Ecrivez ici votre texte en couleur', 'Ce texte sera coloré', 'color', 'Entrer le nom de la couleur en anglais ou en hexaécimal avec le  # : http://www.code-couleur.com/', 'red ou #40A497')" style="text-decoration: none" title="couleur"><i class="fas fa-font"></i></a>
                                        <a href="javascript:ajout_text_complement('contenue', 'Ecrivez ici votre message caché', 'contenue du spoiler', 'spoiler', 'Entrer le titre du message caché (si la case est vide le titre sera \'Spoiler\'', 'Spoiler')" style="text-decoration: none" title="spoiler"><i class="fas fa-flag"></i></a>
                                        <div class="dropdown">
                                            <a href="#" role="button" id="font" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-text-height"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="font">
                                                <a class="dropdown-item" href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en taille 2', 'ce texte sera en taille 2', 'font=2')"><span style="font-size: 2em;">2</span></a>
                                                <a class="dropdown-item" href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en taille 5', 'ce texte sera en taille 5', 'font=5')"><span style="font-size: 5em;">5</span></a>
                                            </div>
                                        </div>

                                        <!--<a href="javascript:ajout_text('contenue', 'Ecrivez ici ce que vous voulez mettre en rouge', 'ce texte sera en rouge', 'color=red')" class="redactor_color_link" style="background-color: rgb(255, 0, 0);"></a>-->
                                    </div>

                                    <label for="contenue">Editez votre <?= ($objet == 1) ? 'topic !' : 'réponse !'; ?></label>
                                    <textarea name="contenue" maxlength="10000" class="form-control custom-text-input" id="contenue" rows="10"><?= $donnee['contenue']; ?></textarea>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-main w-100">Envoyer</button>
                        </div>
                    </form>
                </div>
        </section>

    <?php endif; ?>
<?php else :
    header('Location: ?page=erreur&erreur=0');
endif;  ?>