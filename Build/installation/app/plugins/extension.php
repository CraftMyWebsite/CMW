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
    if(PHP_VERSION_ID < 50400)
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
    ?>
    <div class="pt-3">
        <div class="alert alert-danger">
            Veuillez installer les extensions manquantes pour procéder à l'installation
        </div>
    </div>
    <div class="block border shadow bg-texture" style="border-radius: 2% !important;">

        <div class="row p-5">
            <div class="col-md-12">


                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">Nom de l'extension</th>
                        <th scope="col">Commande d'installation (Debian/Ubuntu)</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php for($i = 0; $i <= count($retour); $i++) { 
                            if(strpos($retour[$i], 'PHP') !== false) {
                                    ?>
                                        <div class="alert alert-danger">
                                        <?php echo $retour[$i]; ?>
                                        </div>
                                <?php
                                }else{
                                    if(isset($retour[$i])){ ?>
                                        <tr>
                                            <td><?php echo $retour[$i]; ?></td>
                                            <td><code>apt-get install php-<?php echo $retour[$i]; ?></code></td>
                                        </tr>
                                <?php 
                                    }
                                }
                            } ?>
                    </tbody>
                </table>

            </div>
            
            <a href="index.php" class="btn btn-primary btn-block minecrafter">Relancer la vérification</a><br/>
            <small style="font-style: italic;">Avant de relancer la vérification redémmarer votre serveur web</small>

        </div>

     </div>

<?php } ?>