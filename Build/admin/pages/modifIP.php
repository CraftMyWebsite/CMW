<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2 class="h2 gray">
                    Gestions de l'API email et des limites d'inscription par Adresse IP
                    </h2>
                </div>
<?php if(!$_Permission_->verifPerm('PermsPanel', 'info', 'stats', 'members', 'showPage'))
{
  echo '<div class="col-lg-6 col-lg-offset-3 text-center">
    <div class="alert alert-danger">
      <strong>Vous avez aucune permission pour accéder à cette page.</strong>
    </div>
  </div>';
}
else
  {
    ?><div class="alert alert-success">
      <strong>Sur cette section, vous pouvez gérer les système de limitation de comptes par IP, et la vérification lors de l'inscription de l'email</strong>
    </div>
  <div class="row"><?php 
if($_Permission_->verifPerm('PermsPanel', 'info', 'stats', 'members', 'editLimitIp')) {
  for($i = 0; $i < count($nbrPerIP); $i++) { 
?>
  <div class="col-md-12 col-xl-6 col-12">
    <div class="card">
      <div class="card-header ">
        <h3 class="card-title"><strong>Limitation des IP</strong></h3>
      </div>
      <div class="card-body" id="ip<?php echo $nbrPerIP[$i]['id'];?>">

          <label class="control-label" for="nbrPerIP">Modifiez ici le nombres <span style="color: red;">limite</span> d'inscriptions par IP. (Entrez -1 pour <span style="color: green">illimité</span>)</label>
          <input type="number" style="text-align: center;" name="nbrPerIP" id="nbrPerIP" class="form-control" placeholder="1" value="<?php echo $nbrPerIP[$i]['nbrPerIP']; ?>"/>
        </div>

      <script>initPost("ip<?php echo $nbrPerIP[$i]['id'];?>", "admin.php?action=editNbrPerIP&idPerIP=<?php echo $nbrPerIP[$i]['id'];?>",null);</script>
      <div class="card-footer">
        <div class="text-center">
            <input type="submit" onclick="sendPost('ip<?php echo $nbrPerIP[$i]['id'];?>');" class="btn btn-success btn-block w-100" value="Valider" />
        </div>
      </div>
  </div>

</div>
<?php 
  }
}
if($_Permission_->verifPerm('PermsPanel', 'info', 'stats', 'members', 'editEmail'))
{
  for($i = 0; $i < count($sysMail); $i++)
  {
    ?><div class="col-md-12 col-xl-6 col-12">
        <div class="card">
          <div class="card-header ">
            <h3 class="card-title"><strong>Système d'API: Email de vérification</strong></h3>
          </div>
          <div class="card-body">
        
          <div class="row">

              <div class="col-md-8 offset-md-2" <?php if($sysMail[$i]['etatMail'] == "1") { echo 'style="display:none;"'; }?> id="active<?php echo $sysMail[$i]['idMail']; ?>">
                <div class="alert alert-success text-center">
                  <span style="text-align: center">
                  L'API est actuellement activé.
                  </span>
                </div>
              </div>

              <div class="col-md-8 offset-md-2" <?php if($sysMail[$i]['etatMail'] == "0") { echo 'style="display:none;"'; }?>id="desact<?php echo $sysMail[$i]['idMail']; ?>">
                <div class="alert alert-danger text-center">
                  <span style="text-align: center">
                  L'API est actuellement désactivée.
                  </span>
                </div>
              </div>

            <div class="col-md-12 text-center" id="switch<?php echo $sysMail[$i]['idMail']; ?>">

                        <input type="hidden"  value="<?php if($sysMail[$i]['etatMail'] == "0") { echo '1'; } else { echo '0'; } ?>" id="value-<?php echo $sysMail[$i]['idMail']; ?>" name="etatMail"/>
                        <button type="submit"  id="btn-<?php echo $sysMail[$i]['idMail']; ?>" onclick="sendPost('switch<?php echo $sysMail[$i]['idMail']; ?>');" class="btn btn-<?php if($sysMail[$i]['etatMail'] == "1") { echo 'success'; } else { echo 'danger'; } ?> center-block w-50" /><?php if($sysMail[$i]['etatMail'] == "1") { echo 'Activer'; } else { echo 'Désactiver'; } ?></button>
                        <script>initPost("switch<?php echo $sysMail[$i]['idMail']; ?>", "admin.php?&action=switchSysMail&idMail=<?php echo $sysMail[$i]['idMail']; ?>",function(data) { if(data) {
                            if(get("desact<?php echo $sysMail[$i]['idMail']; ?>").style.display == "none") {
                              show("desact<?php echo $sysMail[$i]['idMail']; ?>");
                              hide("active<?php echo $sysMail[$i]['idMail']; ?>");
                              get("btn-<?php echo $sysMail[$i]['idMail']; ?>").innerText = "Activer";
                              get("btn-<?php echo $sysMail[$i]['idMail']; ?>").classList.remove("btn-danger");
                              get("btn-<?php echo $sysMail[$i]['idMail']; ?>").classList.add("btn-success");
                              get("value-<?php echo $sysMail[$i]['idMail']; ?>").value = "0";
                            } else {
                              hide("desact<?php echo $sysMail[$i]['idMail']; ?>");
                              show("active<?php echo $sysMail[$i]['idMail']; ?>");
                              get("btn-<?php echo $sysMail[$i]['idMail']; ?>").innerText = "Désactiver";
                              get("btn-<?php echo $sysMail[$i]['idMail']; ?>").classList.remove("btn-success");
                              get("btn-<?php echo $sysMail[$i]['idMail']; ?>").classList.add("btn-danger");
                              get("value-<?php echo $sysMail[$i]['idMail']; ?>").value = "1";
                            }

                        }});
                      </script>
            </div>
          </div>
          <div class="card-body" id="editSysMail&idMail=<?php echo $sysMail[$i]['idMail']; ?>">
            <div class="container-fluid">

                  <label class="control-label">Modifiez ici le nombres <span style="color: red;">limite</span>
                    d'utilisation d'une email par compte.</label>
                  <input type="number" style="text-align: center;" name="strictMail" class="form-control" placeholder="1"
                    value="<?php echo $sysMail[$i]['strictMail']; ?>">

                <hr />
                <div class="row">
                  <a class="btn btn-info w-100 text-center" data-toggle="collapse" href="#editContentapi" role="button" aria-expanded="false" aria-controls="editContentapi">
                    Modifier le contenue de l'API
                  </a>
                </div>
                <div class="collapse" id="editContentapi">
                <br/>


                      <div class="alert alert-success">
                        <strong><i class="fas fa-question-circle"></i> Syntaxe</strong>
                        <p>
                          Voici les variables disponible pour customisé le mail de validation / bienvenue :<br>
                          <ul>
                            <li>
                              <code>{LIEN}</code> equivaut et affichera le lien pour confirmer l'inscription ( <span
                                style="display: inline-block;background-color: darkred;color:#fff">&nbsp; Obligatoire
                                &nbsp;</span> ) <i class="fas fa-exclamation-circle"></i>
                            </li>
                            <li>
                              <code>{JOUEUR}</code> equivaut et affichera le nom du joueur
                            </li>
                            <li>
                              <code>{IP}</code> equivaut et affichera l'adresse ip enregistrer à l'inscription
                            </li>
                          </ul>
                        </p>
                      </div>


                    <label class="control-label" for="fromMail">Email</label>
                    <input type="text" style="text-align: center;" class="form-control" name="fromMail"
                      value="<?php echo $sysMail[$i]['fromMail']; ?>" id="fromMail" placeholder="no-reply@infectedz.fr">

                    <label class="control-label" for="sujetMail">Sujet</label>
                    <input type="text" style="text-align: center;" class="form-control" name="sujetMail"
                      value="<?php echo $sysMail[$i]['sujetMail']; ?>" id="sujetMail" placeholder="Votre lien d'activation !">

                    <label class="control-label" for="msgMail">Message</label>
                    <textarea  name="msgMail" id="ckeditor" data-UUID="0012"
                      placeholder="Bienvenue[...] Voici votre lien d'activation..."><?php echo $sysMail[$i]['msgMail']; ?></textarea>

                </div>
            </div>
          </div>
             <script>initPost("editSysMail&idMail=<?php echo $sysMail[$i]['idMail']; ?>", "admin.php?action=editSysMail&idMail=<?php echo $sysMail[$i]['idMail']; ?>",null);</script>
          <div class="card-footer">
            <div class="row text-center">
              <input type="submit" onclick="sendPost('editSysMail&idMail=<?php echo $sysMail[$i]['idMail']; ?>');" class="btn btn-success w-100" value="Valider" />
            </div>
          </div>
  </div>
</div>
</div>
<br/>
    <?php 
  }
}
?>
</div>
<?php 
  }

?>