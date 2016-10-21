<?php
function SetHtpasswd() {
    $dir[0] = '../modele/.htpasswd';
    $dir[1] = '../controleur/.htpasswd';
    $dir[2] = '../admin/actions/.htpasswd';
    $rand = md5(uniqid(rand(), true)); 

    for($i = 0; $i < count($dir); $i++)
    {
        $htaccess = fopen($dir[$i], 'r+');
        fseek($htaccess, 0);
        fputs($htaccess, 'cms:'. $rand);
    }
}

function VerifieChmod() {

    $dirR[0] = 'install.yml';
    $dirR[1] = '../modele/config/accueil.yml';
    $dirR[2] = '../modele/config/config.yml';
    $dirR[3] = '../modele/config/configMenu.yml';
    $dirR[4] = '../modele/config/configServeur.yml';
    $dirR[5] = '../modele/config/configVotes.yml';
    $dirR[6] = '../modele/config/configWidgets.yml';
    $dirR[7] = '../modele/config/groups.yml';
    $dirR[8] = '../modele/.htpasswd';
    $dirR[9] = '../controleur/.htpasswd';
    $dirR[10] = '../admin/actions/.htpasswd';


    $dir[0] = 'installation/install.yml';
    $dir[1] = 'modele/config/accueil.yml';
    $dir[2] = 'modele/config/config.yml';
    $dir[3] = 'modele/config/configMenu.yml';
    $dir[4] = 'modele/config/configServeur.yml';
    $dir[5] = 'modele/config/configVotes.yml';
    $dir[6] = 'modele/config/configWidgets.yml';
    $dir[7] = 'modele/config/groups.yml';
    $dir[8] = 'modele/.htpasswd';
    $dir[9] = 'controleur/.htpasswd';
    $dir[10] = 'admin/actions/.htpasswd';

    $dirDossier[0] = array('theme/upload/', '../theme/upload/', '../theme/upload/slider/', '../theme/upload/slider/');

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
        for($j = 1; $j < count($dirDossier[$i]); $j++)
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
            $return['chmodDossier'][$i] = 'infèrieur à 777 sur certains fichiers';
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
    include '../include/version.php';
    ?>
    <div class="well well-install">
        <h1 class="animated slideInLeft" style="font-family: material;text-align: center;">CraftMyWebsite <?php echo $versioncms; ?></h1>
        <br/>
        <h2 style="font-family: material;text-align: center;">Droits d'accès insuffisant! <small> Veuillez les changer avant d'installer !</small></h2>
    </br>
    <div class="alert alert-success alert-chmod">Vos chmod ne sont pas réglés correctements ! Si vous ne les changez pas, votre CMS ne pourra marcher  
        normalement !</br>Le chmod correspond aux droits d'accès de vos fichier, il faut que votre serveur web aie le droit de modifier
        certains fichiers (les fichiers de configurations).
    </div>
    <div class="alert alert-success alert-chmod">
    <center>
        Voiçi un tutoriel afin de vous aider dans l'installation de CraftMyWebsite <?php echo $versioncms; ?>:<br/>
        <br/>
            <object style="max-width: 620px;width: 100%;max-height: 315px; height: 100%;" data="http://www.youtube.com/v/nV4kRY-kYFo"></object>
    </center>
</div> 
<h4 style="font-family: material;text-align: center;">Voici la liste des chmod qui ne sont pas réglés correctements: </h4>

<?php if(isset($return['chmodDossier'])) { ?>
<table class="table table-bordered table-chmod">
    <tr>
        <th>Chemin du Dossier</th>
        <th>Droits d'accès actuels</th>
        <th style="max-width: 175px;">Droits d'accès nécessaire</th>
    </tr>
    <?php for($i = 0; $i < count($return['chmodDossier']); $i++) { ?>
    <tr>
        <td><?php echo $return['dirDossier'][$i]; ?></td>
        <td><?php echo $return['chmodDossier'][$i]; ?></td>
        <td>777</td>
    </tr>
    <?php } ?>
</table>
<?php } ?>

<?php if(isset($return['chmod'])) { ?>
<table class="table table-bordered table-chmod">
    <tr>
        <th>Chemin du Fichier</th>
        <th style="max-width: 85px;">Droits d'accès actuels</th>
        <th style="max-width: 85px;">Droits d'accès nécessaire</th>
    </tr>
    <?php for($i = 0; $i < count($return['chmod']); $i++) { ?>
    <tr>
        <td><?php echo $return['dir'][$i]; ?></td>
        <td><?php echo $return['chmod'][$i]; ?></td>
        <td>777</td>
    </tr>
    <?php } ?>
</table>
<?php } ?>
<center><a href="index.php" class="btn btn-primary btn-installation">Relancer la vérification</a></center><br/>
<center><a onclick="ajax_chmod();" class="btn btn-primary btn-installation">Tenter de modifier les chmod automatiquement</a></center>
</div>
<script src="../theme/default/js/jquery.js"></script>
<script src="../theme/default/js/bootstrap.min.js"></script>
<script>
	function ajax_chmod(){
		var url = 'chmod.php';
		$.post(url, function(data){
        window.location = "index.php"
    });
	}
</script>
<?php } ?>
