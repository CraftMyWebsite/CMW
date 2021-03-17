<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2 gray">
        Gestion du SEO de votre site CMW
    </h2>
</div>
<?php if(!$_Permission_->verifPerm('PermsPanel', 'seo', 'showPage')) {

    echo '
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="alert alert-danger">
                <strong>Vous avez aucune permission pour accéder aux réglages du SEO</strong>
            </div>
        </div>
    </div>';
}
else
{ echo '<div class="row">'; if($_Permission_->verifPerm('PermsPanel', 'seo', 'actions', 'analytics')) { ?>
    <div class="alert alert-success">
        <strong>Gérez le SEO de votre site web grâce aux différents outils mis à votre disposition, ne négligez pas le SEO car c'est ce qui vous permet d'être mieux référencé sur internet !</strong>
    </div>

    <div class="col-md-12 col-xl-6 col-12">
        <div class="card  ">

            <div class="card-header ">
                <h3 class="card-title"><strong>GOOGLE  <span id="co-title">Analytics</span></strong></h3>
            </div>

            <div class="card-body" id="analytics">

                <label class="control-label">ID de suivi</label>
                <input type="text" name="Analytics-ID" class="form-control" placeholder="Exemple: UA-291773314-3" required/>
                <a href="https://analytics.google.com/analytics/web/" target="_blank"><small>Liens gogle analytics</small></a><br>
                <a href="https://craftmywebsite.fr"><small>Liens tu tutoriel pour installer google analytics</small></a>


            </div>
            <!--<script>initPost('analytics', 'admin.php?&action=seoAnalytics', function(data) { if(data) {  clearAllInput('analytics'); serverUpdate(); }});</script>-->
            <div class="card-footer">
                <div class="row text-center">
                    <input type="submit" onclick="sendPost('analytics');" class="btn btn-success w-100" value="Envoyer !" />
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>
    <!-- <script>initPost('analytics', 'admin.php?&action=seo');</script> -->
    <div class="card-footer">
        <div class="row text-center">
            <input type="submit" onclick="sendPost('seo', null);" class="btn btn-success w-100" value="Valider les changements !" />
        </div>
    </div>
    </div>
    </div>


<?php }
    echo '</div>';
}
?>
