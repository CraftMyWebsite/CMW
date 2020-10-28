<h4 class="mb-3"> <i class="fas fa-globe-africa"></i> Paramétrage du site</h4>
          <form class="" method="POST" action="?&action=infos">

            <div class="form-row">

              <div class="col-md-6 mb-3 form-group">
                <label for="nom">Nom du site</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Ex: CraftMyCube"
                  required>
              </div>

              <div class="col-md-6 mb-3 form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Exemple: Serveur full vanilla survival en 1.10.2">
              </div>

              <div class="col-md-12 mb-6 form-group">
                <label for="adresse">URL</label>
                <input type="text" class="form-control" id="adresse" name="adresse" aria-describedby="adresseaide"
                  placeholder="Ex: https://craftmycube.fr" required>
                <small id="adresseaide" class="form-text text-muted">(Ne pas inclure de "/" à la fin de l'URL)</small>
              </div>

              <div class="col-md-8 mb-6 form-group">
                <label for="ip">Adresse IP du serveur</label>
                <input type="text" class="form-control" id="ip" name="ip" aria-describedby="ipaide" placeholder="Ex: 192.168.49.3">
                <small id="ipaide" class="form-text text-muted">(sous forme de chiffre & sans le port)</small>
              </div>

              <div class="col-md-4 mb-6 form-group">
                <label for="port">Port du serveur</label>
                <input type="number" class="form-control" id="port" name="port" value="25565">
              </div>

              <div class="col-md-12 mb-6 form-group">
                <label for="ipTexte">Adresse IP textuel</label>
                <input type="text" class="form-control" id="ipTexte" name="ipTexte" placeholder="Ex: play.craftmycube.fr">
              </div>

            </div>

            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block minecrafter" type="submit">Etape suivante <i
                class="far fa-arrow-alt-circle-right"></i></button>
          </form>