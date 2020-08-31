<?php
$_Theme_ = new Lire('theme/' . $_Serveur_['General']['theme'] . "/config/config.yml");
$_Theme_ = $_Theme_->GetTableau();
?>
<footer id="Footer">
    <div class="footer-body">
        <div class="container-fluid col-12 mt-3">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-7">
                    <div class="about-title h4">
                        À Propos
                    </div>
                    <div class="about-content">
                        <?= $_Theme_['Pied']['about']; ?>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-5 ml-auto">
                    <div class="social-title h4">
                        Nos Réseaux
                    </div>
                    <div class="social-content">
                        <a href="<?= $_Theme_['Pied']['facebook']; ?>" class="col-12 discord-social ml-3">
                            <span class="fab fa-facebook social-logo"></span>
                            <span class="social-text"> Rejoignez-nous sur Facebook !</span>
                        </a>
                        <a href="<?= $_Theme_['Pied']['youtube']; ?>" class="col-12 discord-social ml-3">
                            <span class="fab fa-youtube social-logo"></span>
                            <span class="social-text"> Rejoignez-nous sur Youtube !</span>
                        </a>
                        <a href="<?= $_Theme_['Pied']['discord']; ?>" class="col-12 discord-social ml-3">
                            <span class="fab fa-discord social-logo"></span>
                            <span class="social-text"> Rejoignez-nous sur Discord !</span>
                        </a>
                        <a href="<?= $_Theme_['Pied']['twitter']; ?>" class="col-12 discord-social ml-3">
                            <span class="fab fa-twitter social-logo"></span>
                            <span class="social-text"> Rejoignez-nous sur Twitter !</span>
                        </a>
                    </div>
                </div>
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
                <div class="col text-right">
                    <div class="theme">Thème défaut fait par <i style="color: red;" class="fas fa-heart"></i> par BadiiiX</div>
                </div>
            </div>
        </div>
    </div>
</footer>
