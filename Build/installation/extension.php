<?php
function VerifieExtension() {

    $extension[0] = "curl";
    $extension[1] = "pdo";
    $extension[2] = "zip";
	$i2 = 0;
	for($i=0;$i < count($extension);$i++){
		if(!extension_loaded($extension[$i])){
			$erreur[$i2] = "".$extension[$i]."";
			$i2++;
		}
	}
    if(PHP_VERSION_ID < 50600)
    {
        $erreur[$i2]="Version de PHP obsolète requis 7.0 minimum, vous avez :  ".phpversion();
    }
	
    if(empty($erreur)){
        return "";
    }else{
        return $erreur;
	}
}

function AfficherExtension($retour)
{
    include '../include/version.php';
    ?>
    <div class="well well-install">
        <h1 class="animated slideInLeft" style="font-family: material;text-align: center;">CraftMyWebsite <?php echo $versioncms; ?></h1>
        <br/>
        <h2 style="font-family: material;text-align: center;">Il manque des extensions ! <small> Veuillez les installer !</small></h2>
    <br>
    <div class="alert alert-success alert-chmod">Il vous manques des extensions pour que ce cms fonctionne sur votre site web, il faut les installer.
	Si vous ne savez pas comment, n'hésitez pas à venir sur le formum présent <a href="http//craftmywebsite.fr/forum">ici</a>
    </div>
    <div class="alert alert-success alert-chmod">
    <center>
        Voici un tutoriel afin de vous aider dans l'installation de CraftMyWebsite <?php echo $versioncms; ?>:<br/>
        <br/>
            <object style="max-width: 620px;width: 100%;max-height: 315px; height: 100%;" data="http://www.youtube.com/v/nV4kRY-kYFo"></object>
    </center>
</div> 
<h4 style="font-family: material;text-align: center;">Voici la liste des extensions qui ne sont installer ou activer: </h4>

<table class="table table-bordered table-chmod">
    <tr>
        <th>Nom de l'extension</th>
    </tr>
    <?php for($i = 0; $i <= count($retour); $i++) { ?>
    <tr>
        <td><?php echo $retour[$i]; ?></td>
    </tr>
    <?php } ?>
</table>
<center><a href="index.php" class="btn btn-primary btn-installation">Relancer la vérification</a></center><br/>
</div>
<script src="../theme/default/js/jquery.js"></script>
<script src="../theme/default/js/bootstrap.min.js"></script>
<?php } ?>
