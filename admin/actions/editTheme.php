<?php
if ($_Permission_->verifPerm('PermsPanel', 'theme', 'actions', 'editTheme')) {
    $lecture = new Lire('modele/config/config.yml');
    $lecture = $lecture->GetTableau();


    if (isset($_POST['theme']) and isset($_POST['themeOption'])) {
        $lecture['General']['theme'] = $_POST['theme'];
        $lecture['General']['themeOption'] = $_POST['themeOption'];

        $ecriture = new Ecrire('modele/config/config.yml', $lecture);

        header('Location: admin.php?page=theme');
    } elseif (isset($_POST['theme'])) {
        $lecture['General']['theme'] = $_POST['theme'];

        $ecriture = new Ecrire('modele/config/config.yml', $lecture);
        header('Location: admin.php?page=theme');
    }
}
?>
