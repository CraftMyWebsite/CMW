<section id="Messagerie">
    <div class="container-fluid col-md-9 col-lg-9 col-sm-10">
        <div class="row">
            <!-- Présentation -->
            <div class="d-flex col-12 info-page">
                <i class="fas fa-info-circle notification-icon"></i>
                <div class="info-content">
                    Découvrez tous vos nouveaux messages !
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Création d'un nouveau message -->
            <div class="col-12 ml-auto">
                <a class="btn btn-reverse" href="#modalRep" data-toggle="modal">Nouveau Message</a>
            </div>

            <div class="tab-pane active" style="margin-top: 10px;" id="infos">
                <?php
                $Messagerie = new Messagerie($bddConnection, $_Joueur_['pseudo']);
                $messages = $Messagerie->getConversations();
                if (!empty($messages['conv'])) {
                ?>
                    <h3 class="text-center" style="margin-bottom: 15px;">Vous avez <?= $messages['nbConversations']; ?> conversations</h3>
                    <div id="accordion">
                        <?php echo $messages['conv']; ?>
                    </div>
                    <br>
                    <!-- Pagination -->
                    <nav aria-label="Pages Conversation">
                        <ul class="pagination" style="float: right;">
                            <?php
                            for ($i = 1; $i <= $messages['nbPages']; $i++) {
                                echo '<li class="page-item"><a class="page-link" onClick="getConversations(' . $i . ');">' . $i . '</a></li>';
                            }
                            ?>
                        </ul>
                    </nav>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>