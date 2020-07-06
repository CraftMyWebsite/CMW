<?php // Vérification des perms
if (Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'seeSignalement')) :
    $req = $bddConnection->query('SELECT * FROM cmw_forum_report WHERE vu = 0');
    $nbr_signalement = 0 //COmpter le nombre de signalement
?>
    <section id="Signalement">
        <div class="container-fluid col-md-9 col-lg-9 col-sm-10">
            <div class="row">
                <!-- Présentation -->
                <div class="d-flex col-12 info-page">
                    <i class="fas fa-info-circle notification-icon"></i>
                    <div class="info-content">
                        Voici tous les signalements du forum, vous pouvez les gérer comme vous le souhaitez !
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Tableau des signalements -->
                    <table class="table table-dark table-striped table-hover">
                        <thead>
                            <!-- Affichage des signalements -->
                            <tr>
                                <th scope="col">Type de report</th>
                                <th scope="col">Raison</th>
                                <th scope="col">Reporteur</th>
                                <th scope="col">Lien</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($data = $req->fetch(PDO::FETCH_ASSOC)) :
                                $nbr_signalement++; ?>

                                <tr>
                                    <td scope="row">
                                        <?= ($data['type'] == 0) ? 'Topic' : 'Réponse' ?>
                                    </td>

                                    <td>
                                        <?= $data['reason']; ?>
                                    </td>

                                    <td>
                                        <?= $data['reporteur']; ?>
                                    </td>

                                    <td>
                                        <?php if ($data['type'] != 0) :
                                            //Affichage de la réposne 
                                            $req_topic = $bddConnection->prepare('SELECT * FROM cmw_forum_answer WHERE id = :id');
                                            $req_topic->execute(array(
                                                'id' => $data['id_topic_answer']
                                            ));

                                            $id = $req_topic->fetch(PDO::FETCH_ASSOC);

                                            $req_page = $bddConnection->prepare('SELECT * FROM cmw_forum_answer WHERE id_topic = :id');
                                            $req_page->execute(array(
                                                'id' => $id['id_topic']
                                            ));
                                            $d_page = $req_page->fetchAll();


                                            foreach ($d_page as $key => $value) :
                                                if ($d_page[$key]['id'] == $data['id_topic_answer']) {
                                                    $ligne = $key;
                                                }
                                            endforeach;

                                            $ligne++;

                                            $tour = 1;
                                            unset($d);
                                            unset($page);

                                            while ($d != TRUE) :

                                                $nb = 20 * $tour;
                                                if ($nb >= $ligne) :
                                                    $page = $tour;
                                                    $d = TRUE;
                                                else :
                                                    $tour++;
                                                endif;

                                            endwhile; ?>


                                            <a class="btn btn-reverse" href="index.php?action=r_a_vu&id_a=<?= $data['id_topic_answer']; ?>&id=<?= $id['id_topic']; ?>&page_post=<?= $page; ?>">
                                                Lien vers la réponse
                                            </a>

                                        <?php else : ?>

                                            <a class="btn btn-reverse no-hover" href="index.php?action=r_t_vu&id=<?= $data['id_topic_answer']; ?>">Voir le topic</a>

                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>

                            <?php if ($nbr_signalement == 0) : //Si il n'y a aucun signelement 
                            ?>
                                <tr class="p-0 no-hover">
                                    <td colspan="4" class="p-0 no-hover">
                                        <div class="m-0 info-page bg-danger">
                                            <div class="text-center">Aucun signalement actuellement !</div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <caption>
                            Nombre de signalements : <?= $nbr_signalement ?>
                        </caption>
                    </table>
                </div>
            </div>
        </div>
    </section>
<?php else :
    //Redirection à une page d'erreur si l'utilisateur n'a pas les droits.

    header('Location: index.php?page=erreur&erreur=12');
?>


<?php endif; ?>