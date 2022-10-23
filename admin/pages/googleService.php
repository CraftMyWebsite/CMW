<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2 gray">
        Gestion du SEO de votre site CMW
    </h2>
</div>
<div class="row">
    <?php if (!$_Permission_->verifPerm('PermsPanel', 'googleService', 'showPage')) {

        echo '<div class="col-md-12 text-center">
            <div class="alert alert-danger">
                <strong>Vous n\'avez aucune permission pour accéder aux réglages des services Google</strong>
            </div>
        </div>';
    } else { ?>
        <div class="alert alert-success">
            <strong>Gérez les services Google de votre site web grâce aux différents outils mis à votre disposition dont
                Google Search Console contribuant au SEO, ne négligez pas le SEO car c'est ce qui vous permet d'être
                mieux référencé sur internet !</strong>
        </div>

        <?php if ($_Permission_->verifPerm('PermsPanel', 'googleService', 'actions', 'analytics')) {


            ?>

            <div class="col-md-12 col-xl-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <div style="width: 100%;display: inline-block">
                            <div class="float-left">
                                <h3 class="card-title"><strong>Google Analytics</strong></h3>
                            </div>
                            <div class="float-right">
                                <label class="switch">
                                    <input type="checkbox" value="true" name="enable"
                                           onClick="if(get('googleAnalytics').style.display == 'none') { show('googleAnalytics'); } else { hide('googleAnalytics'); } sendDirectPost('admin.php?action=switchGoogleAnalytics');"
                                        <?= (googleService::isAnalyticsEnable2($_Serveur_)) ? 'checked' : ''; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-body"
                         id="googleAnalytics" <?php if (!googleService::isAnalyticsEnable2($_Serveur_)) {
                        echo 'style="display:none;"';
                    } ?>>
                        <label class="control-label">ID de suivi (voir tutoriel)</label>
                        <input type="text" name="id" class="form-control"
                               value="<?= $_Serveur_['googleService']['analytics']['id'] ?? '' ?>"
                               placeholder="Exemple: G-BTTGMMY3YH" required/>
                        <div style="margin-top:10px;">
                            <a href="https://analytics.google.com/analytics/web/" target="_blank"><small>Liens Google
                                    Analytics</small></a><br>
                            <a href="https://support.google.com/analytics/topic/3544906?hl=fr&ref_topic=10094551"
                               target="_blank"><small>Liens du tutoriel pour installer Google Analytics</small></a>
                        </div>
                    </div>
                    <script>initPost("googleAnalytics", "admin.php?action=editGoogleAnalytics");</script>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success w-100" onClick="sendPost('googleAnalytics')">
                            Envoyer
                        </button>
                    </div>
                </div>
            </div>

        <?php } ?>

        <?php if ($_Permission_->verifPerm('PermsPanel', 'googleService', 'actions', 'adsense')) { ?>

            <div class="col-md-12 col-xl-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <div style="width: 100%;display: inline-block">
                            <div class="float-left">
                                <h3 class="card-title"><strong>Google Adsense</strong></h3>
                            </div>
                            <div class="float-right">
                                <label class="switch">
                                    <input type="checkbox" value="true" name="enable"
                                           onClick="if(get('googleAdsenseblock').style.display == 'none') { show('googleAdsenseblock'); } else { hide('googleAdsenseblock'); } sendDirectPost('admin.php?action=switchGoogleAdsense');"
                                        <?= (googleService::isAdsenseEnable2($_Serveur_)) ? 'checked' : ''; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="googleAdsenseblock" style="<?=(!googleService::isAdsenseEnable2($_Serveur_)) ? 'display:none;' : 'display:block!important;' ?>">
                        <label class="control-label">ID du compte</label>
                        <input type="text" name="id" class="form-control" value="<?= isset($_Serveur_['googleService']['adsense']['id']) ? $_Serveur_['googleService']['adsense']['id'] : '' ?>" placeholder="Exemple: pub-3496294583914660" required/>
                        <label class="control-label">ID de la pub (à remplir plus tard, voir tutoriel)</label>
                        <input type="text" name="pub" class="form-control" value="<?= isset($_Serveur_['googleService']['adsense']['pub']) ? $_Serveur_['googleService']['adsense']['pub'] : '' ?>" placeholder="Exemple: 3128942591"/>
                        <div style="margin-top:10px;">
                            <a href="https://www.google.com/adsense/" target="_blank"><small>Liens Google Adsense</small></a><br>
                            <a href="https://support.google.com/adsense/answer/3180977?hl=fr&ref_topic=3136173&visit_id=637570438032031998-3559320501&rd=1" target="_blank"><small>Liens du tutoriel pour installer Google Adsense</small></a>
                        </div>
                    </div>
                    <script>initPost("googleAdsenseblock", "admin.php?action=editGoogleAdsense");</script>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success w-100" onClick="sendPost('googleAdsenseblock')">Envoyer</button>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($_Permission_->verifPerm('PermsPanel', 'seo', 'actions', 'searchConsole')) { ?>
            <div class="col-md-12 col-xl-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <div style="width: 100%;display: inline-block">
                            <div class="float-left">
                                <h3 class="card-title"><strong>Google Search Console</strong></h3>
                            </div>
                            <div class="float-right">
                                <label class="switch">
                                    <input type="checkbox" value="true" name="enable"
                                           onClick="if(get('googleSearchConsole').style.display == 'none') { show('googleSearchConsole'); } else { hide('googleSearchConsole'); } sendDirectPost('admin.php?action=switchGoogleSearchConsole');"
                                        <?= (googleService::isSearchConsoleEnable($_Serveur_)) ? 'checked' : '' ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-body"
                         id="googleSearchConsole" <?php if (!googleService::isSearchConsoleEnable($_Serveur_)) {
                        echo 'style="display:none;"';
                    } ?>>
                        <label>Url à utiliser (le fichier est unique pour chaque site, voir tutoriel):</label>
                        <?php
                        require_once('modele/app/urlRewrite.class.php');
                        require_once('modele/google/googleSearchConsole.class.php');

                        googleSearchConsole::call($_Serveur_, $bddConnection, false);
                        ?>
                        <h6><?= urlRewrite::getSiteUrl() ?>
                            <span id="">
                                <?=  empty($_Serveur_['googleService']['searchConsole']['id']) ?
                                    $_Serveur_['googleService']['searchConsole']['id'] . '.xml' : ''
                                 ?>
                            </span>
                        </h6>
                        <div style="margin-top:10px;">
                            <a href="https://search.google.com/search-console" target="_blank"><small>Liens Google
                                    Search Console</small></a><br>
                            <a href="https://support.google.com/webmasters/answer/9128668?hl=fr&ref_topic=9128571"
                               target="_blank"><small>Liens du tutoriel pour installer Google Search Console</small></a>
                        </div>
                    </div>
                </div>


            </div>


        <?php } ?>
    <?php } ?>
</div>
