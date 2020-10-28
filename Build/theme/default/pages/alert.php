<?php if (Permission::getInstance()->verifPerm("connect")) :
    $req_answer = $_JoueurForum_->get_like_dislike(); ?>

    <section id="Alerts">
        <div class="container-fluid col-md-9 col-lg-9 col-sm-10">

            <div class="row">
                <!-- Présentation -->
                <div class="d-flex col-12 info-page">
                    <i class="fas fa-info-circle notification-icon"></i>
                    <div class="info-content">
                        Ayez accès à tous vos alertes, n'importe quand, n'importe où.
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Liste des Alertes  -->

                <div class="col-md-12 col-lg9 col-sm-12">
                    <table class="table table-dark table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Topic suivi</th>
                                <th scope="col">Type d'alerte</th>
                                <th scope="col">Auteur de l'alerte</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if ($req_answer->fetch()) : ?>
                                <?php while ($answer_liked = $req_answer->fetch(PDO::FETCH_ASSOC)) :
                                    if ($answer_liked['vu'] == '0') :

                                        $a = $bddConnection->prepare('SELECT * FROM cmw_forum_answer WHERE id_topic = :id');
                                        $a->execute(array(
                                            'id' => $answer_liked['id_topic']
                                        ));
                                        $da = $a->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($da as $key => $value) {
                                            if ($da[$key]['id'] == $answer_liked['id_answer']) {
                                                $ligne = $key;
                                            }
                                        }
                                        $ligne++;
                                        unset($page);
                                        unset($d);

                                        $tour = 1;
                                        while ($d == FALSE) {
                                            $nb = 20 * $tour;
                                            if ($ligne <= $nb) {
                                                $page = $tour;
                                                $d = TRUE;
                                            } else {
                                                $tour++;
                                            }
                                        } ?>

                                        <tr>
                                            <td>
                                                <?php $topic = $bddConnection->prepare('SELECT * FROM cmw_forum_post WHERE id = :id');
                                                $topic->execute(array(
                                                    'id' => $answer_liked['id_topic']
                                                ));
                                                $topicd = $topic->fetch(PDO::FETCH_ASSOC); ?>

                                                <?= $topicd['nom']; ?>
                                            </td>


                                            <td><?php if ($answer_liked['Appreciation'] == 1) : ?>
                                                    <div> Quelqu'un a aimé votre réponse </div>
                                                <?php else : ?>
                                                    <div> Quelqu'un n'a pas aimé votre réponse </div>
                                                <?php endif; ?>
                                            </td>


                                            <td>
                                                <a href="index.php?action=alerts_vu&page=post&id=<?= $answer_liked['id_topic']; ?>&page_post=<?= $page; ?>&id_answer=<?= $answer_liked['id_answer']; ?>&likeur=<?= $answer_liked['pseudo_likeur']; ?>#<?= $answer_liked['id_answer']; ?>">
                                                    <?= $answer_liked['pseudo_likeur']; ?>
                                                </a>
                                            </td>
                                        </tr>

                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php else : ?>

                                <!-- Aucune alerte -->

                                <tr class="p-0 no-hover">
                                    <td colspan="3" class="p-0 no-hover">
                                        <div class="m-0 info-page bg-danger">
                                            <div class="text-center">Aucune alerte reçue pour l'instant</div>
                                        </div>
                                    </td>
                                </tr>
                                
                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>
    </section>

<?php else :
    header('Location: index.php');
?>
<?php endif; ?>