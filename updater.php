<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//error_reporting(0);
require_once('controleur/config.php');
require_once('controleur/connection_base.php');

if (isset($_POST['go']) and $_POST['go'] == 1) {
    //Modifcation des fichiers
    $archiveUpdate = new ZipArchive;
    if ($archiveUpdate->open('update.zip') === TRUE) {
        $archiveUpdate->extractTo(__DIR__);
        $archiveUpdate->close();

        bdd183to19($bddConnection);
        file183to19();

        unlink('update.zip');
        echo 'Mise à jour réussie ! <a href="index.php?&removeUpdater=true">Aller sur votre site</a>';
    }
} else {
    ?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="CraftMyWebsite">
        <link rel="stylesheet" href="https://getbootstrap.com/docs/4.4/dist/css/bootstrap.min.css">
        <style>
            .bg-light2 {
                background-color: rgb(240, 240, 240) !important;
            }

            .container {
                max-width: 960px;
            }
        </style>
        <title>CraftMyWebsite | Mise à jour - 1.9 - LTS</title>
    </head>

    <body class="bg-light2">

    <div class="container">

        <div class="pt-5 text-center">
            <img class="d-block mx-auto mb-4 img"
                 src="https://cdn.discordapp.com/attachments/382840368099753984/775433866777198622/craftmywebsite.png"
                 alt="CraftMyWebsite - Logo" width="94"
                 height="94" style="border-radius: 9px;">
            <h2>Mise à jour de votre site ! 😃</h2>
            <p class="lead">
                Bienvenue sur la page de mise à jour de votre site internet<br/>
            </p>
            <p style="display: none">
                Si tu lis ce message, sâches que nous travaillons sur CMW 2.0 et que cette version sera donc la fin de
                CMW 1.X.
            </p>
            <div class="alert alert-danger">
                <p class="text">
                    Attention: la mise à jour de votre site web et irréversible ! Pensez à sauvegarder vos fichiers et
                    bases
                    de données avant de procéder à celle-ci.
                </p>
            </div>
            <hr/>
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <p class="text">
                    Cette version réinitialisera votre choix thème (Défault), les thèmes autre que Default ne seront pas
                    forcément compatible avec cette version - en cas de doute contactez le créateur du thème que vous
                    souhaitez utiliser !
                </p>
            </div>
            <?php
            if (!file_exists('update.zip')) {
                ?>
                <div class="alert alert-danger">
                    <p class="text">
                        ALERTE ! Il vous manque le fichier <strong>update.zip</strong>, vous ne pouvez pas commencer la
                        migration sans ce fichier !!!
                    </p>
                </div>
                <?php
            }
            ?>

            <div class="block border" style="border-radius: 2% !important;">

                <div class="row p-5">
                    <div class="col-md-12">


                        <div class="accordion" id="accordionExample">

                            <h2 class="mb-3">
                                <button class="btn btn-block btn-primary" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Changelog
                                </button>
                            </h2>
                            <div id="collapseOne" class="collapse bg-light" aria-labelledby="headingOne"
                                 data-parent="#accordionExample" style="margin:0px;">
                                <div class="card-body">
                                    <div style="max-height: 300px !important;overflow-y: scroll !important;">
                                        <div class="container-fluid">

                                            <p class="card-text" style="text-align: left !important;">

                                                Changelog CraftMyWebsite 1.9 - LTS - Dernière version de CMW 1.X (Long
                                                Term Support)<br>
                                                <br>
                                                Ajouts ([+]), modifications ([=]) et suppressions ([-]), ([|]) Bugs
                                                Fix<br>
                                                <br>
                                                [|] : Fix de la quantité d'articles dans le panier<br>
                                                [|] : Les CMS peut être installé sur Windows (Uniquement pour un
                                                environnement de dev)<br>
                                                [|] : Affichage résolu/non résolu dans l'espace support<br>

                                                [=] : Ajouts des sites de vote: meilleurs-serveurs.com et
                                                yserveur.fr<br>
                                                [=] : Fautes d'ortographes<br>
                                                [=] : Amélioration de la compatibilité avec certaines bases de
                                                données<br>
                                                [=] : Plusieurs modifications dans la boutique<br>
                                                [=] : Fix sécurité<br>

                                                [+] : Ajouts de nouvelles vérifications pour voter<br>
                                                [+] : Prise en charge d'images sur les articles en boutique<br>
                                                [+] : Affichage du solde restant dans l'espace panier<br>
                                                [+] : Ajout d'un message si pas assez de token lors d'un achat <br>

                                                <br><br>
                                                Contributeurs : Teyir, Emilien52, CapDrake, Nassim-K, WIBORR,
                                                Dancuo-Lohan, Zomb, Florentlife


                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="" method="post">
                                <input type="hidden" name="go" value="1">
                                <button type="submit" class="btn btn-success btn-block">Mettre à jour le CMS
                                    (irréversible)
                                </button>
                            </form>
                        </div>


                    </div>
                </div>

            </div>


        </div>

    </div>

    <footer class="my-4 text-muted text-center text-small">
        <p class="mb-1">&copy; 2014 - <?= date('Y') ?>
            CraftMyWebsite
        </p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="https://craftmywebsite.fr/forum/index.php" target="_blank">Forum</a>
            </li>
            <li class="list-inline-item"><a href="https://discord.gg/P94b7d5" target="_blank"> <i
                            class="fab fa-discord"></i> Discord</a></li>
            <li class="list-inline-item"><a href="https://github.com/CraftMyWebsite" target="_blank"> <i
                            class="fab fa-github"></i> GitHub</a></li>
        </ul>

        <p>Cette nouvelle version est dédié à notre chère Ping et ses proches.</p>

    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </body>

    </html>

    <?php
}


function file183to19(): void
{
    unlink('.gitignore');
    unlink('.htaccess');
    unlink('README.md');
    unlink('admin.php');
    unlink('admin/action.php');
    unlink('admin/actions/addGrade.php');
    unlink('admin/actions/addMenu.php');
    unlink('admin/actions/addMiniature.php');
    unlink('admin/actions/addWidgets.php');
    unlink('admin/actions/creerOffre.php');
    unlink('admin/actions/creerPage.php');
    unlink('admin/actions/editBoutique.php');
    unlink('admin/actions/editGrade.php');
    unlink('admin/actions/editMenu.php');
    unlink('admin/actions/editMiniature.php');
    unlink('admin/actions/editNews.php');
    unlink('admin/actions/editPage.php');
    unlink('admin/actions/editPayement.php');
    unlink('admin/actions/editResetVote.php');
    unlink('admin/actions/editWidgets.php');
    unlink('admin/actions/getGradesList.php');
    unlink('admin/actions/getJsonAchat.php');
    unlink('admin/actions/getJsonMember.php');
    unlink('admin/actions/getJsonVoteHistory.php');
    unlink('admin/actions/getLienVote.php');
    unlink('admin/actions/getMiniaList.php');
    unlink('admin/actions/getNewsList.php');
    unlink('admin/actions/getOffreBoutique.php');
    unlink('admin/actions/getOffrePaypal.php');
    unlink('admin/actions/getRecompenseList.php');
    unlink('admin/actions/getWidgetsList.php');
    unlink('admin/actions/modifierLien.php');
    unlink('admin/actions/modifierMembres.php');
    unlink('admin/actions/mooveMenu.php');
    unlink('admin/actions/mooveMinia.php');
    unlink('admin/actions/mooveWidgets.php');
    unlink('admin/actions/newsletter.php');
    unlink('admin/actions/pageBan.php');
    unlink('admin/actions/postNews.php');
    unlink('admin/actions/removeBan.php');
    unlink('admin/actions/resetAllUploadImage.php');
    unlink('admin/actions/supprGrade.php');
    unlink('admin/actions/supprMenu.php');
    unlink('admin/actions/supprMiniature.php');
    unlink('admin/actions/supprPage.php');
    unlink('admin/actions/supprWidgets.php');
    unlink('admin/actions/switchMaintenance.php');
    unlink('admin/actions/switchTypeSupport.php');
    unlink('admin/actions/testMail.php');
    unlink('admin/actions/themeColor.php');
    unlink('admin/actions/uploadImg.php');
    unlink('admin/assets/js/PostManager.js');
    unlink('admin/assets/js/bootstrap.js');
    unlink('admin/assets/js/jquery.js');
    unlink('admin/assets/js/main.js');
    unlink('admin/assets/js/membres.php');
    unlink('admin/donnees/accueil.php');
    unlink('admin/donnees/boutique.php');
    unlink('admin/donnees/configVoter.php');
    unlink('admin/donnees/general.php');
    unlink('admin/donnees/grades.php');
    unlink('admin/donnees/informations.php');
    unlink('admin/donnees/maintenance.php');
    unlink('admin/donnees/menu.php');
    unlink('admin/donnees/miniatures.php');
    unlink('admin/donnees/pages.php');
    unlink('admin/donnees/payement.php');
    unlink('admin/donnees/voteHistory.php');
    unlink('admin/donnees/widgets.php');
    unlink('admin/include/entete.php');
    unlink('admin/include/footer.php');
    unlink('admin/include/side.php');
    unlink('admin/index.php');
    unlink('admin/page.php');
    unlink('admin/pages/accueil.php');
    unlink('admin/pages/ban.php');
    unlink('admin/pages/boutique.php');
    unlink('admin/pages/boutiquelist.php');
    unlink('admin/pages/configVoter.php');
    unlink('admin/pages/forum.php');
    unlink('admin/pages/general.php');
    unlink('admin/pages/googleService.php');
    unlink('admin/pages/grades.php');
    unlink('admin/pages/informations.php');
    unlink('admin/pages/maintenance.php');
    unlink('admin/pages/membres.php');
    unlink('admin/pages/menu.php');
    unlink('admin/pages/miniatures.php');
    unlink('admin/pages/modifIP.php');
    unlink('admin/pages/news.php');
    unlink('admin/pages/newsletter.php');
    unlink('admin/pages/pages.php');
    unlink('admin/pages/payement.php');
    unlink('admin/pages/regServeur.php');
    unlink('admin/pages/reseaux.php');
    unlink('admin/pages/support.php');
    unlink('admin/pages/theme.php');
    unlink('admin/pages/update.php');
    unlink('admin/pages/upload.php');
    unlink('admin/pages/voteHistory.php');
    unlink('admin/pages/voter.php');
    unlink('admin/pages/widgets.php');
    unlink('changelog.txt');
    unlink('controleur/.htaccess');
    unlink('controleur/accueil/newsCommentaire.php');
    unlink('controleur/accueil/newsDeleteCommentaire.php');
    unlink('controleur/accueil/newsEditCommentaire.php');
    unlink('controleur/accueil/newsLike.php');
    unlink('controleur/accueil/newsReport.php');
    unlink('controleur/action.php');
    unlink('controleur/app/rechercheMembre.php');
    unlink('controleur/boutique/achat.php');
    unlink('controleur/boutique/addOffrePanier.php');
    unlink('controleur/chat/actu.php');
    unlink('controleur/chat/send.php');
    unlink('controleur/config.php');
    unlink('controleur/dedipass.php');
    unlink('controleur/erreur.php');
    unlink('controleur/forum/create_cat.php');
    unlink('controleur/forum/create_sf.php');
    unlink('controleur/forum/create_topic.php');
    unlink('controleur/forum/edit.php');
    unlink('controleur/forum/editForum.php');
    unlink('controleur/forum/editSousForum.php');
    unlink('controleur/forum/forum_signalement.php');
    unlink('controleur/forum/forum_signalement_topic.php');
    unlink('controleur/forum/post_answer.php');
    unlink('controleur/forum/remove_answer.php');
    unlink('controleur/forum/remove_topic.php');
    unlink('controleur/forum/rep.php');
    unlink('controleur/forum/searchTopic.php');
    unlink('controleur/forum/unfollow.php');
    unlink('controleur/forum/unlike.php');
    unlink('controleur/forum/vu.php');
    unlink('controleur/joueur/changeMdpMail.php');
    unlink('controleur/joueur/inscription.php');
    unlink('controleur/joueur/joueur.class.php');
    unlink('controleur/joueur/profil/editReseau.php');
    unlink('controleur/joueur/recuperationMailLink.php');
    unlink('controleur/maintenance.php');
    unlink('controleur/page.php');
    unlink('controleur/paypal/paypalMail.php');
    unlink('controleur/paypal/verif_paypal_curl.php');
    unlink('controleur/profil/profil.class.php');
    unlink('controleur/recompenseAuto.php');
    unlink('controleur/recompenseList.php');
    unlink('controleur/recupVotesTemp.php');
    unlink('controleur/security/security.php');
    unlink('controleur/support/ticket.php');
    unlink('controleur/support/ticketCommentaire.php');
    unlink('controleur/support/ticketCommentaireDelete.php');
    unlink('controleur/support/ticketCommentaireEdit.php');
    unlink('controleur/supprInstall.php');
    unlink('controleur/upload.class.php');
    unlink('controleur/voteCron.php');
    unlink('controleur/voter.php');
    unlink('include/MinecraftPing/MinecraftPing.class.php');
    unlink('include/contributeurs.json');
    unlink('include/note_dev.php');
    unlink('include/purecaptcha/purecaptcha.php');
    unlink('include/version.php');
    unlink('include/version_distant.php');
    unlink('index.php');
    unlink('installation/app/controller/action.php');
    unlink('installation/app/miscellaneous/install.sql');
    unlink('installation/app/plugins/chmod.php');
    unlink('installation/app/plugins/extension.php');
    unlink('installation/app/plugins/installInfos.php');
    unlink('installation/app/plugins/utils.php');
    unlink('installation/app/ressources/js/main.js');
    unlink('installation/app/views/modalHtaccess.php');
    unlink('installation/app/views/modalSQL.php');
    unlink('installation/app/views/site.php');
    unlink('installation/index.php');
    unlink('modele/.htaccess');
    unlink('modele/UploadImage.class.php');
    unlink('modele/accueil/miniature.class.php');
    unlink('modele/app/chat.class.php');
    unlink('modele/app/ckeditor.class.php');
    unlink('modele/app/page.class.php');
    unlink('modele/app/urlRewrite.class.php');
    unlink('modele/ban.class.php');
    unlink('modele/base.php');
    unlink('modele/boutique/offres.class.php');
    unlink('modele/boutique/panier.class.php');
    unlink('modele/config/config.yml');
    unlink('modele/config/ymlapi.class.php');
    unlink('modele/forum/forum.class.php');
    unlink('modele/forum/joueurforum.class.php');
    unlink('modele/google/googleAdsense.class.php');
    unlink('modele/google/googleSearchConsole.class.php');
    unlink('modele/google/googleSearchConsole.thread.class.php');
    unlink('modele/google/googleService.class.php');
    unlink('modele/grades/NOT_TOUCH/perms.config.php');
    unlink('modele/grades/perms.class.php');
    unlink('modele/joueur/donneesJoueur.class.php');
    unlink('modele/joueur/imgProfil.class.php');
    unlink('modele/json/BaseSocket.php');
    unlink('modele/json/Exception/SourceQueryException.php');
    unlink('modele/json/GoldSourceRcon.php');
    unlink('modele/json/SourceQuery.php');
    unlink('modele/json/json.class.php');
    unlink('modele/json/json.php');
    unlink('modele/json/src/MinecraftQuery.php');
    unlink('modele/menu.class.php');
    unlink('modele/recompenseAuto.class.php');
    unlink('modele/topVotes.class.php');
    unlink('modele/vote.class.php');
    unlink('modele/widgets.class.php');
    unlink('theme/default/assets/php/custom.php');
    unlink('theme/default/ban.php');
    unlink('theme/default/config/configAdminTraitement.php');
    unlink('theme/default/config/configAdminVue.php');
    unlink('theme/default/entete.php');
    unlink('theme/default/formulaires.php');
    unlink('theme/default/index.php');
    unlink('theme/default/maintenance.php');
    unlink('theme/default/maintenance/entete.php');
    unlink('theme/default/pages/banlist.php');
    unlink('theme/default/pages/boutique.php');
    unlink('theme/default/pages/chat.php');
    unlink('theme/default/pages/confirmation.php');
    unlink('theme/default/pages/fichier_installation.php');
    unlink('theme/default/pages/forum.php');
    unlink('theme/default/pages/forum_categorie.php');
    unlink('theme/default/pages/membres.php');
    unlink('theme/default/pages/panier.php');
    unlink('theme/default/pages/post.php');
    unlink('theme/default/pages/profil.php');
    unlink('theme/default/pages/signalement.php');
    unlink('theme/default/pages/support.php');
    unlink('theme/default/pages/tokens.php');
    unlink('theme/default/pages/voter.php');
    unlink('theme/default/preload.php');
    unlink('utilisateurs/architecture.txt');

}

function bdd183to19($bddConnection): void
{
    //Update resettoken for the new reset system
    $bddConnection->exec('ALTER TABLE `cmw_users` CHANGE `resettoken` `resettoken` VARCHAR(500)');
    //Fix support default value
    $bddConnection->exec('ALTER TABLE `cmw_support` CHANGE `etat` `etat` INT(1) NULL DEFAULT 0');
    $bddConnection->exec('UPDATE cmw_support SET etat = 0 WHERE etat = NULL;');

}


function startsWith($string, $startString): bool
{
    return (str_starts_with($string, $startString));
}



/*
    Ceci est le dernier updater de CraftMyWebsite 1.X,
    on se retrouve très vite pour découvrir la nouvelle vision des CMS web par CraftMyWebsite avec la 2.0.
*/

/*
        CCCCCCCCCCCCCRRRRRRRRRRRRRRRRR                  AAA               FFFFFFFFFFFFFFFFFFFFFFTTTTTTTTTTTTTTTTTTTTTTTMMMMMMMM               MMMMMMMMYYYYYYY       YYYYYYYWWWWWWWW                           WWWWWWWWEEEEEEEEEEEEEEEEEEEEEEBBBBBBBBBBBBBBBBB      SSSSSSSSSSSSSSS IIIIIIIIIITTTTTTTTTTTTTTTTTTTTTTTEEEEEEEEEEEEEEEEEEEEEE       1111111                999999999                                LLLLLLLLLLL       TTTTTTTTTTTTTTTTTTTTTTT   SSSSSSSSSSSSSSS
     CCC::::::::::::CR::::::::::::::::R                A:::A              F::::::::::::::::::::FT:::::::::::::::::::::TM:::::::M             M:::::::MY:::::Y       Y:::::YW::::::W                           W::::::WE::::::::::::::::::::EB::::::::::::::::B   SS:::::::::::::::SI::::::::IT:::::::::::::::::::::TE::::::::::::::::::::E      1::::::1              99:::::::::99                              L:::::::::L       T:::::::::::::::::::::T SS:::::::::::::::S
   CC:::::::::::::::CR::::::RRRRRR:::::R              A:::::A             F::::::::::::::::::::FT:::::::::::::::::::::TM::::::::M           M::::::::MY:::::Y       Y:::::YW::::::W                           W::::::WE::::::::::::::::::::EB::::::BBBBBB:::::B S:::::SSSSSS::::::SI::::::::IT:::::::::::::::::::::TE::::::::::::::::::::E     1:::::::1            99:::::::::::::99                            L:::::::::L       T:::::::::::::::::::::TS:::::SSSSSS::::::S
  C:::::CCCCCCCC::::CRR:::::R     R:::::R            A:::::::A            FF::::::FFFFFFFFF::::FT:::::TT:::::::TT:::::TM:::::::::M         M:::::::::MY::::::Y     Y::::::YW::::::W                           W::::::WEE::::::EEEEEEEEE::::EBB:::::B     B:::::BS:::::S     SSSSSSSII::::::IIT:::::TT:::::::TT:::::TEE::::::EEEEEEEEE::::E     111:::::1           9::::::99999::::::9                           LL:::::::LL       T:::::TT:::::::TT:::::TS:::::S     SSSSSSS
 C:::::C       CCCCCC  R::::R     R:::::R           A:::::::::A             F:::::F       FFFFFFTTTTTT  T:::::T  TTTTTTM::::::::::M       M::::::::::MYYY:::::Y   Y:::::YYY W:::::W           WWWWW           W:::::W   E:::::E       EEEEEE  B::::B     B:::::BS:::::S              I::::I  TTTTTT  T:::::T  TTTTTT  E:::::E       EEEEEE        1::::1           9:::::9     9:::::9                             L:::::L         TTTTTT  T:::::T  TTTTTTS:::::S
C:::::C                R::::R     R:::::R          A:::::A:::::A            F:::::F                     T:::::T        M:::::::::::M     M:::::::::::M   Y:::::Y Y:::::Y     W:::::W         W:::::W         W:::::W    E:::::E               B::::B     B:::::BS:::::S              I::::I          T:::::T          E:::::E                     1::::1           9:::::9     9:::::9                             L:::::L                 T:::::T        S:::::S
C:::::C                R::::RRRRRR:::::R          A:::::A A:::::A           F::::::FFFFFFFFFF           T:::::T        M:::::::M::::M   M::::M:::::::M    Y:::::Y:::::Y       W:::::W       W:::::::W       W:::::W     E::::::EEEEEEEEEE     B::::BBBBBB:::::B  S::::SSSS           I::::I          T:::::T          E::::::EEEEEEEEEE           1::::1            9:::::99999::::::9                             L:::::L                 T:::::T         S::::SSSS
C:::::C                R:::::::::::::RR          A:::::A   A:::::A          F:::::::::::::::F           T:::::T        M::::::M M::::M M::::M M::::::M     Y:::::::::Y         W:::::W     W:::::::::W     W:::::W      E:::::::::::::::E     B:::::::::::::BB    SS::::::SSSSS      I::::I          T:::::T          E:::::::::::::::E           1::::l             99::::::::::::::9      ---------------        L:::::L                 T:::::T          SS::::::SSSSS
C:::::C                R::::RRRRRR:::::R        A:::::A     A:::::A         F:::::::::::::::F           T:::::T        M::::::M  M::::M::::M  M::::::M      Y:::::::Y           W:::::W   W:::::W:::::W   W:::::W       E:::::::::::::::E     B::::BBBBBB:::::B     SSS::::::::SS    I::::I          T:::::T          E:::::::::::::::E           1::::l               99999::::::::9       -:::::::::::::-        L:::::L                 T:::::T            SSS::::::::SS
C:::::C                R::::R     R:::::R      A:::::AAAAAAAAA:::::A        F::::::FFFFFFFFFF           T:::::T        M::::::M   M:::::::M   M::::::M       Y:::::Y             W:::::W W:::::W W:::::W W:::::W        E::::::EEEEEEEEEE     B::::B     B:::::B       SSSSSS::::S   I::::I          T:::::T          E::::::EEEEEEEEEE           1::::l                    9::::::9        ---------------        L:::::L                 T:::::T               SSSSSS::::S
C:::::C                R::::R     R:::::R     A:::::::::::::::::::::A       F:::::F                     T:::::T        M::::::M    M:::::M    M::::::M       Y:::::Y              W:::::W:::::W   W:::::W:::::W         E:::::E               B::::B     B:::::B            S:::::S  I::::I          T:::::T          E:::::E                     1::::l                   9::::::9                                L:::::L                 T:::::T                    S:::::S
 C:::::C       CCCCCC  R::::R     R:::::R    A:::::AAAAAAAAAAAAA:::::A      F:::::F                     T:::::T        M::::::M     MMMMM     M::::::M       Y:::::Y               W:::::::::W     W:::::::::W          E:::::E       EEEEEE  B::::B     B:::::B            S:::::S  I::::I          T:::::T          E:::::E       EEEEEE        1::::l                  9::::::9                                 L:::::L         LLLLLL  T:::::T                    S:::::S
  C:::::CCCCCCCC::::CRR:::::R     R:::::R   A:::::A             A:::::A   FF:::::::FF                 TT:::::::TT      M::::::M               M::::::M       Y:::::Y                W:::::::W       W:::::::W         EE::::::EEEEEEEE:::::EBB:::::BBBBBB::::::BSSSSSSS     S:::::SII::::::II      TT:::::::TT      EE::::::EEEEEEEE:::::E     111::::::111              9::::::9                                LL:::::::LLLLLLLLL:::::LTT:::::::TT      SSSSSSS     S:::::S
   CC:::::::::::::::CR::::::R     R:::::R  A:::::A               A:::::A  F::::::::FF                 T:::::::::T      M::::::M               M::::::M    YYYY:::::YYYY              W:::::W         W:::::W          E::::::::::::::::::::EB:::::::::::::::::B S::::::SSSSSS:::::SI::::::::I      T:::::::::T      E::::::::::::::::::::E     1::::::::::1 ......      9::::::9                                 L::::::::::::::::::::::LT:::::::::T      S::::::SSSSSS:::::S
     CCC::::::::::::CR::::::R     R:::::R A:::::A                 A:::::A F::::::::FF                 T:::::::::T      M::::::M               M::::::M    Y:::::::::::Y               W:::W           W:::W           E::::::::::::::::::::EB::::::::::::::::B  S:::::::::::::::SS I::::::::I      T:::::::::T      E::::::::::::::::::::E     1::::::::::1 .::::.     9::::::9                                  L::::::::::::::::::::::LT:::::::::T      S:::::::::::::::SS
        CCCCCCCCCCCCCRRRRRRRR     RRRRRRRAAAAAAA                   AAAAAAAFFFFFFFFFFF                 TTTTTTTTTTT      MMMMMMMM               MMMMMMMM    YYYYYYYYYYYYY                WWW             WWW            EEEEEEEEEEEEEEEEEEEEEEBBBBBBBBBBBBBBBBB    SSSSSSSSSSSSSSS   IIIIIIIIII      TTTTTTTTTTT      EEEEEEEEEEEEEEEEEEEEEE     111111111111 ......    99999999                                   LLLLLLLLLLLLLLLLLLLLLLLLTTTTTTTTTTT       SSSSSSSSSSSSSSS

*/