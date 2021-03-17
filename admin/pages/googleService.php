<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2 gray">
        Gestion du SEO de votre site CMW
    </h2>
</div>
<div class="row">
<?php if(!$_Permission_->verifPerm('PermsPanel', 'googleService', 'showPage')) {

    echo '<div class="col-md-12 text-center">
            <div class="alert alert-danger">
                <strong>Vous avez aucune permission pour accéder aux réglages des services Google</strong>
            </div>
        </div>';
}
else
{ ?>
    <div class="alert alert-success">
        <strong>Gérez les services Google de votre site web grâce aux différents outils mis à votre disposition dont Google Search Console contribuant au SEO, ne négligez pas le SEO car c'est ce qui vous permet d'être mieux référencé sur internet !</strong>
    </div>

 <?php if($_Permission_->verifPerm('PermsPanel', 'seo', 'actions', 'analytics')) { ?>



<?php }
}
?>
</div>
