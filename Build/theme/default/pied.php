<footer>
        <div class="card card-inverse card-primary text-xs-center">
            <div class="card-block">
                <div class="container text-center">
                    <h4 style="color:white;">Rejoignez-nous sur les réseaux sociaux</h4>
                    <h6 style="margin:0px;">&nbsp;</h6>
                    <div class="row">
                        <div class="col-sm-3 text-center wow fadeInLeft">
                            <a href="<?php echo $_Theme_['Pied']['facebook']; ?>" target="about_blank" class="fa-stack fa-2x hvr-grow">
                                <i class="fa fa-square fa-stack-2x text-facebook"></i>
                                <i class="fab fa-facebook fa-stack-1x fa-inverse"></i>
                            </a>
                        </div>
                        <div class="col-sm-3 text-center wow fadeInLeft" data-wow-delay="0.3s">
                            <a href="<?php echo $_Theme_['Pied']['youtube']; ?>" target="about_blank" class="fa-stack fa-2x hvr-grow">
                                <i class="fa fa-square fa-stack-2x text-youtube"></i>
                                <i class="fab fa-youtube fa-stack-1x fa-inverse"></i>
                            </a>
                        </div>
                        <div class="col-sm-3 text-center wow fadeInRight" data-wow-delay="0.4s">
                            <a href="<?php echo $_Theme_['Pied']['discord']; ?>" target="about_blank" class="fa-stack fa-2x hvr-grow">
                                <i class="fa fa-square fa-stack-2x text-discord"></i>
                                <i class="fab fa-discord fa-stack-1x fa-inverse"></i>
                            </a>
                        </div>
                        <div class="col-sm-3 text-center wow fadeInRight" data-wow-delay="0.7s">
                            <a href="<?php echo $_Theme_['Pied']['twitter']; ?>" target="about_blank" class="fa-stack fa-2x hvr-grow">
                                <i class="fa fa-square fa-stack-2x text-twitter"></i>
                                <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-inverse card-inverse text-xs-center bg-inverse">
            <div class="card-block container">
                <div style="display:inline-block;">Tous droits réservés, site créé pour le serveur <?php echo $_Serveur_['General']['name']; ?></div><br/>
                <small style="display:inline-block;"><a href="http://craftmywebsite.fr">CraftMyWebsite.fr</a>#<?php echo $versioncms; ?></small>
                <div style="display:inline-block;float:right;">
                    <span class="badge badge-primary" style="font-size: 100%;"><?=($playeronline) ? $playeronline : 0; ?></span> Joueurs connectés au serveur / <span class="badge badge-secondary" style="font-size: 100%;"><?php $req = $bddConnection->query('SELECT COUNT(id) AS count FROM cmw_users');
                    $fetch = $req->fetch(PDO::FETCH_ASSOC);
                    echo $fetch['count']; ?></span><a href="?page=membres" style="color: inherit;"> Membres inscrits</a>
                </div>
            </div>
        </div>
    </footer>