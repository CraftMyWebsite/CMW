<script>
    $(function () {
        $('[data-toggle="popover"]').popover({html: true})
    })
</script>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2 gray">Thèmes</h2>
</div>
<?php if (!$_Permission_->verifPerm('PermsPanel', 'theme', 'showPage')) { ?>
<div class="alert alert-danger">
    <strong>Vous n'avez aucune permission pour accéder aux thèmes.</strong>
</div>
<div class="row">
    <?php } else {
        echo '<div class="row">';
        if ($_Permission_->verifPerm('PermsPanel', 'theme', 'actions', 'editTheme')) { ?>
            <div class="col-md-12 col-xl-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Choisissez votre thème</h4>
                    </div>
                    <form action="admin.php?action=editTheme" method="post">
                        <div class="card-body" id="changeTheme">
                            <div class="alert alert-success">
                                <strong>Si vous souhaitez modifier un thème, modifiez une copie de l'original en créant un nouveau thème. Cela vous évitera de perdre votre thème lors d'une mise à jour !</strong>
                            </div>
                            <label class="control-label" for="theme">
                                <a data-toggle="popover" data-trigger="hover" title="Besoin d'un nouveau thème ?" data-content="Découvrez et Télécharger un thème sur la <a href='https://craftmywebsite.fr/forum/index.php?resources/featured' target='_blank'>page officiel de craftmywebsite</a>!">Thèmes<i class="fas fa-info-circle"></i></a>
                            </label>
                            <select class="form-control text-center" name="theme" id="theme">
                                <option value="<?php echo $_Serveur_['General']['theme']; ?>" selected><?php echo $_Serveur_['General']['theme']; ?></option>
                                <?php if (isset($themes)) {
                                    foreach ($themes as $element) {
                                        if ($element != 'upload' and $element != $_Serveur_['General']['theme'] and $element != '..') { ?>
                                            <option value="<?php echo $element; ?>"><?php echo $element; ?></option><?php }
                                    }
                                } ?>
                            </select>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success w-100">Envoyer!</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php }
        if ($_Permission_->verifPerm('PermsPanel', 'theme', 'actions', 'editBackground')) { ?>
            <div class="col-md-12 col-xl-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Choisissez le fond d'écran</h4>
                    </div>
                    <form method="POST" action="?&action=postBG" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="alert alert-warning">
                                <strong>Attention, tous les thèmes ne prennent pas en charge cette fonctionnalité.</strong>
                            </div>
                            <div class="alert alert-success">
                                <strong>Si vous voulez mettre une image, l'image doit être en 1920*1080 minimum pour s'adapter aux écrans et pour avoir une qualité optimale ! Vous pouvez aussi mettre une petite image qui se répètera !</strong>
                            </div>
                            <div class="input-group file-input-group">
                                <input class="form-control" id="file-text" type="text" placeholder="No file selected" readonly>
                                <input type="file" name="img" id="File" style="display:none;" required>
                                <div class="input-group-append">
                                    <label class="btn btn-secondary mb-0" for="File">Choisir un fichier</label>
                                </div>
                            </div>
                            <script>
                                const fileInput = get('File');
                                const label = get('file-text');
                                fileInput.onchange =
                                    fileInput.onmouseout = function () {
                                        if (!fileInput.value) return
                                        var value = fileInput.value.replace(/^.*[\\\/]/, '')
                                        label.value = value
                                    }
                            </script>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success w-100">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php }
        if ($_Permission_->verifPerm('PermsPanel', 'theme', 'actions', 'editTheme')) { ?>
            <div class="col-md-12">
                <?php include('theme/' . $_Serveur_['General']['theme'] . '/config/configAdminVue.php'); ?>
            </div>
            <br/>
        <?php }
        echo '</div>';
    } ?>
