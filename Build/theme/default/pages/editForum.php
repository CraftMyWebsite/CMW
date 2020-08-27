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


                                    <label for="contenue">Editez votre <?= ($objet == 1) ? 'topic !' : 'réponse !'; ?></label>
                                    <textarea  data-UUID="0002" id="ckeditor" name="contenue" style="height: 275px; margin: 0px; width: 100%;"><?= $donnee['contenue']; ?></textarea>
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