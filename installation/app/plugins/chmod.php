<?php
function VerifieChmod() {
    $err = null;
    $errDossier = null;
    $errInstall = null;

    $dirInstall[0] = 'app/data/install.yml';
    for ($i = 0; $i < count($dirInstall); $i++) {
        $chmodi[$i] = substr(sprintf('%o', fileperms($dirInstall[$i])), -3);

        $chmodInstallU[$i]['pr'] = substr($chmodi[$i], -3, 1);
        $chmodInstallU[$i]['gr'] = substr($chmodi[$i], -2, 1);
        $chmodInstallU[$i]['pu'] = substr($chmodi[$i], -1, 1);

        if ($chmodInstallU[$i]['pr'] < 7 or $chmodInstallU[$i]['gr'] < 7 or $chmodInstallU[$i]['pu'] < 5) {
            if ($errInstall != null)
                $errInstall = $errInstall . ';' . (string)$i;
            else
                $errInstall = (string)$i;
        }
    }
    if ($errInstall != null) {
        $errInstall = explode(';', $errInstall);
        for ($i = 0; $i < count($errInstall); $i++) {
            $return['chmodInstall'][$i] = $chmodi[$errInstall[$i]];
            $return['dirInstall'][$i] = $dirInstall[$errInstall[$i]];
        }
    }

    $dirR[1] = '../modele/config/config.yml';
    $dirR[2] = '../modele/.htpasswd';
    $dirR[3] = '../controleur/.htpasswd';
    $dirR[4] = '../admin/actions/.htpasswd';
    for ($i = 0; $i < count($dirR); $i++) {
        $chmod[$i] = substr(sprintf('%o', fileperms($dirR[$i])), -3);

        $chmodu[$i]['pr'] = substr($chmod[$i], -3, 1);
        $chmodu[$i]['gr'] = substr($chmod[$i], -2, 1);
        $chmodu[$i]['pu'] = substr($chmod[$i], -1, 1);

        if ($chmodu[$i]['pr'] < 7 or $chmodu[$i]['gr'] < 5 or $chmodu[$i]['pu'] < 5) {
            if ($err != null)
                $err = $err . ';' . (string)$i;
            else
                $err = (string)$i;
        }
    }
    if ($err != null) {
        $err = explode(';', $err);
        for ($i = 0; $i < count($err); $i++) {
            $return['chmod'][$i] = $chmod[$err[$i]];
            $return['dir'][$i] = $dirR[$err[$i]];
        }
    }

    $dirDossier[0] = '../theme/upload/';
    $dirDossier[1] = '../theme/upload/navRap/';
    $dirDossier[2] = '../theme/upload/panel/';
    $dirDossier[3] = '../utilisateurs/';
    for ($i = 0; $i < count($dirDossier); $i++) {
        $chmodDossier[$i] = substr(sprintf('%o', fileperms($dirDossier[$i])), -3);

        $chmodDossierU[$i]['pr'] = substr($chmodDossier[$i], -3, 1);
        $chmodDossierU[$i]['gr'] = substr($chmodDossier[$i], -2, 1);
        $chmodDossierU[$i]['pu'] = substr($chmodDossier[$i], -1, 1);

        if ($chmodDossierU[$i]['pr'] < 7 or $chmodDossierU[$i]['gr'] < 7 or $chmodDossierU[$i]['pu'] < 7) {
            if ($errDossier != null)
                $errDossier = $errDossier . ';' . (string)$i;
            else
                $errDossier = (string)$i;
        }
    }
    if ($errDossier != null) {
        $errDossier = explode(';', $errDossier);
        for ($i = 0; $i < count($errDossier); $i++) {
            $return['chmodDossier'][$i] = 'inférieur à 777 sur certains dossiers';
            $return['dirDossier'][$i] = $dirDossier[$errDossier[$i]];
        }
    }


    if ($err == null and $errDossier == null and $errInstall == null)
        return null;
    else
        return $return;
}

function DrawChmod($return) {

    if ($return['chmodDossier'] != null or $return['chmod'] != null or $return['chmodInstall'] != null) { ?>
        <div class="pt-3">
            <div class="alert alert-danger">
                Veuillez modifier les chmod des dossiers/fichiers pour procéder à l'installation
            </div>
        </div>
        <div class="block border shadow bg-texture" style="border-radius: 2% !important;">

            <div class="row p-5">
                <div class="col-md-12">


                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Fichier/Dossier</th>
                            <th scope="col">Actuel</th>
                            <th scope="col">Requis</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if (isset($return['chmodInstall'])) {
                        for ($i = 0; $i < count($return['chmodInstall']); $i++) { ?>
                        <tr>
                            <td><?php echo $return['dirInstall'][$i]; ?></td>
                            <td><?php echo $return['chmodInstall'][$i]; ?></td>
                            <td>775</td>
                        </tr>
                        <?php }
                        }

                        if (isset($return['chmodDossier'])) {
                            for ($i = 0; $i < count($return['chmodDossier']); $i++) { ?>
                                <tr>
                                    <td><?php echo $return['dirDossier'][$i]; ?></td>
                                    <td><?php echo $return['chmodDossier'][$i]; ?></td>
                                    <td>777</td>
                                </tr>
                            <?php }
                        }

                        if (isset($return['chmod'])) {
                            for ($i = 0; $i < count($return['chmod']); $i++) { ?>
                                <tr>
                                    <td><?php echo $return['dir'][$i]; ?></td>
                                    <td><?php echo $return['chmod'][$i]; ?></td>
                                    <td>755</td>
                                </tr>
                            <?php }
                        } ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12">
                            <a onclick="ajax_chmod()" class="btn btn-primary text-white btn-block minecrafter">Tenter de
                                modifier les chmod automatiquement</a>
                            <a href="index.php" class="btn btn-primary btn-block minecrafter">Relancer la
                                verification</a><br/>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    <?php }
} ?>
