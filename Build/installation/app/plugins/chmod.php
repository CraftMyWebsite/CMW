<?php
function VerifieChmod() {

    $dirR[0] = 'app/data/install.yml';
    $dirR[1] = '../modele/config/accueil.yml';
    $dirR[2] = '../modele/config/config.yml';
    $dirR[3] = '../modele/config/configMenu.yml';
    $dirR[4] = '../modele/config/configServeur.yml';
    $dirR[5] = '../modele/config/configWidgets.yml';
    $dirR[6] = '../modele/.htpasswd';
    $dirR[7] = '../controleur/.htpasswd';
    $dirR[8] = '../admin/actions/.htpasswd';


    $dir[0] = 'installation/app/data/install.yml';
    $dir[1] = 'modele/config/accueil.yml';
    $dir[2] = 'modele/config/config.yml';
    $dir[3] = 'modele/config/configMenu.yml';
    $dir[4] = 'modele/config/configServeur.yml';
    $dir[5] = 'modele/config/configWidgets.yml';
    $dir[6] = 'modele/.htpasswd';
    $dir[7] = 'controleur/.htpasswd';
    $dir[8] = 'admin/actions/.htpasswd';

    $dirDossier[0] = array('../theme/upload/', '../theme/upload/slider/', '../theme/upload/panel/');
    $dirDossier[1] = array('../theme/smileys/');
    $dirDossier[2] = array('../utilisateurs/');

    $err = null;
    for($i = 0; $i < count($dir); $i++)
    {
        $chmod[$i] = substr(sprintf('%o', fileperms($dirR[$i])), -3);

        $chmodu[$i]['pr'] = substr($chmod[$i], -3, 1);
        $chmodu[$i]['gr'] = substr($chmod[$i], -2, 1);
        $chmodu[$i]['pu'] = substr($chmod[$i], -1, 1);
        if($chmodu[$i]['pr'] < 6 OR $chmodu[$i]['gr'] < 6 OR $chmodu[$i]['pu'] < 6)
        {
            if($err != null)        
                $err = $err . ';' . (string) $i;
            else
                $err = (string) $i; 
        }
    }
    
    $errDossier = null;
    for($i = 0; $i < count($dirDossier); $i++)
    {
        $compte[$i] = false;
        for($j = 0; $j < count($dirDossier[$i]); $j++)
        {
            $chmodDossier[$i][$j] = substr(sprintf('%o', fileperms($dirDossier[$i][$j])), -3);

            $chmodDossierU[$i][$j]['pr'] = substr($chmodDossier[$i][$j], -3, 1);
            $chmodDossierU[$i][$j]['gr'] = substr($chmodDossier[$i][$j], -2, 1);
            $chmodDossierU[$i][$j]['pu'] = substr($chmodDossier[$i][$j], -1, 1);
            if(($chmodDossierU[$i][$j]['pr'] < 7 OR $chmodDossierU[$i][$j]['gr'] < 7 OR $chmodDossierU[$i][$j]['pu'] < 7) AND !$compte[$i])
            {
                if($errDossier != null)        
                    $errDossier = $errDossier . ';' . (string) $i;
                else
                    $errDossier = (string) $i; 
                $compte[$i] = true;
            }
        }
    }

    if($err != null)
    {
        $err = explode(';', $err);
        for($i = 0; $i < count($err); $i++) 
        {    
            $return['chmod'][$i] = $chmod[$err[$i]];
            $return['dir'][$i] = $dir[$err[$i]];
        }
    }

    if($errDossier != null)
    {
        $errDossier = explode(';', $errDossier);
        for($i = 0; $i < count($errDossier); $i++) 
        {    
            $return['chmodDossier'][$i] = 'inférieur à 777 sur certains fichiers';
            $return['dirDossier'][$i] = $dirDossier[$errDossier[$i]][0];
        }
    }
    if($err == null AND $errDossier == null)
        return null;
    else
        return $return;
}

function DrawChmod($return)
{
    
    if($return['chmodDossier'] != null OR $return['chmod'] != null){ ?>
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
                    <?php if(isset($return['chmodDossier'])) {
                    for($i = 0; $i < count($return['chmodDossier']); $i++) { ?>
                        <tr>
                            <td><?php echo $return['dirDossier'][$i]; ?></td>
                            <td><?php echo $return['chmodDossier'][$i]; ?></td>
                            <td>777</td>
                        </tr>
                        <?php } 
                    }
                    
                    if(isset($return['chmod'])) {
                    for($i = 0; $i < count($return['chmod']); $i++) { ?>
                        <tr>
                            <td><?php echo $return['dir'][$i]; ?></td>
                            <td><?php echo $return['chmod'][$i]; ?></td>
                            <td>777</td>
                        </tr>
                        <?php } 
                    }?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-12">
                        <a onclick="ajax_chmod()" class="btn btn-primary text-white btn-block minecrafter">Tenter de modifier les chmod automatiquement</a>
                        <a href="index.php" class="btn btn-primary btn-block minecrafter">Relancer la verification</a><br/>
                    </div>
                </div>
            </div>
        </div>

     </div>


<?php }
} ?>
