<h4 class="mb-3"> <i class="fas fa-database"></i> Configuration MySQL</h4>
<?php if($installEtape == 1) { 
	    if(isset($erreur))
		{
			if($erreur['type'] == 'sql_mode')
		    	echo '<div class="alert alert-danger text-center">ATTENTION ! Votre base de donnée est mal configurée ! La configuration MySQL ne doit pas contenir de STRICT_ALL_TABLES dans son sql_mode. Si vous ne savez pas résoudre ce problème, contactez-nous sur <a href="https://discord.gg/wMVAeug" target="_blank">discord</a> en envoyant l\'information suivante : <pre>'.$erreur['data'].'</pre></div>';
		    elseif($erreur['type'] == 'pass')
				echo '<div class="alert alert-danger text-center">ATTENTION ! Vos identifiants sont incorrects.</div>';
        }
     } ?>
          <form class="" method="POST" action="?&action=sql">

            <div class="form-row">

              <div class="col-md-10 mb-6 form-group">
                <label for="hote">Adresse de connexion</label>
                <input type="text" class="form-control" id="hote" name="hote" aria-describedby="hoteaide"
                  placeholder="localhost" required>
                <small id="hoteaide" class="form-text text-muted">Ex: sql.hebergeur.fr ou 51.38.13.38</small>
              </div>

              <div class="col-md-2 mb-6 form-group">
                <label for="port">Port
                  <a href="#port" class="btn-outline-info" data-toggle="popover" data-placement="top"
                    title="Aide > Port MySQL" data-content="Le port par défaut de MySQL / MariaDB est 3306">
                    <i class="fas fa-info-circle"></i>
                  </a>
                </label>
                <input type="number" class="form-control" id="port" name="port" placeholder="3306" value="3306"
                  required>
              </div>

              <div class="col-md-6 mb-3 form-group">
                <label for="utilisateur">Nom d'utilisateur de la base</label>
                <input type="text" class="form-control" id="utilisateur" name="utilisateur" placeholder="Ex: root"
                  required>
              </div>

              <div class="col-md-6 mb-3 form-group">
                <label for="mdp">Mot de passe de la base</label>
                <input type="password" class="form-control" id="mdp" name="mdp" placeholder="**************">
              </div>

              <div class="col-md-12 mb-6 form-group">
                <label for="nomBase">Nom de la base</label>
                <input type="text" class="form-control" id="nomBase" name="nomBase" placeholder="Ex: site" required>
              </div>

            </div>

            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block minecrafter" type="submit">Etape suivante <i
                class="far fa-arrow-alt-circle-right"></i></button>
          </form>