<?php
$_Theme_ = new Lire('theme/' . $_Serveur_['General']['theme'] . "/config/config.yml");
$_Theme_ = $_Theme_->GetTableau();
?>
<footer id="Footer">
    <div class="footer-body">
        <div class="container-fluid col-12 mt-3">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-7">
                    <?php if(isset($_Theme_['Pied']['about']) && !empty(trim($_Theme_['Pied']['about']))) : ?>
                    <div class="about-title h4">
                        À Propos
                    </div>
                    <div class="about-content">
                        <?= $_Theme_['Pied']['about']; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if (isset($_Theme_['Pied']['social']) && !empty($_Theme_['Pied']['social'])) : ?>
                    <div class="col-md-12 col-sm-12 col-lg-5 ml-auto">
                        <div class="social-title h4">
                            Nos Réseaux
                        </div>
                        <div class="social-content">

                             <?php foreach ($_Theme_['Pied']['social'] as $value) : ?>

                                <a href="<?= $value['link'] ?>" class="col-12 discord-social ml-3">
                                    <span class="social-logo">
                                        <?= $value['icon'] ?>
                                    </span>
                                    <span class="social-text"> <?= $value['message'] ?> </span>
                                </a>

                            <?php endforeach; ?>

                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container col-11 mt-3">
            <div class="row">
                <div class="col-7">
                    <div class="copyright">
                        Tous droits réservés, site créé pour le serveur <?= $_Serveur_['General']['name']; ?> <br />
                        <small><a href="https://craftmywebsite.fr" target="_blank">CraftMyWebsite.fr</a>#<?= $versioncms; ?></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>