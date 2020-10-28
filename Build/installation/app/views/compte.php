<h4 class="mb-3"> <i class="fas fa-globe-africa"></i> Paramétrage du site</h4>
          <form class="" method="POST" action="?&action=compte">

            <div class="form-row">

              <div class="col-md-6 mb-3 form-group">
                <label for="pseudo">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Ex: CraftMyWebsite"
                  aria-describedby="pseudoaide" required>
                  <small id="hoteaide" class="form-text text-muted">(Votre pseudo In-Game)</small>
              </div>
              <div class="col-md-6 mb-3 form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="contact@craftmywebsite.fr"
                 required>
              </div>
              <div class="col-md-12 mb-3 form-group">
                <label for="email">Mot de passe</label>
                <input type="password" class="form-control" id="mdp" name="mdp" placeholder="**************"
                 required>
              </div>

            </div>

            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block minecrafter" type="submit">Etape suivante <i
                class="far fa-arrow-alt-circle-right"></i></button>
          </form>