<div class="cmw-page-content-header"><strong>Membres</strong> - Gérez les API d'email et d'IP</div>
<?php if($_Joueur_['rang'] != 1 AND !$_PGrades_['PermsPanel']['info']['stats']['members']['showTable'] AND !$_PGrades_['PermsPanel']['info']['stats']['members']['editLimitIp'] AND !$_PGrades_['PermsPanel']['info']['stats']['members']['editEmail'])
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
  <?php 
  }
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['info']['stats']['members']['editLimitIp'] == true) {
  for($i = 0; $i < count($nbrPerIP); $i++) { 
?>
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default cmw-panel">
      <div class="panel-heading cmw-panel-header">
        <h3 class="panel-title"><strong>Limitation des IP</strong></h3>
      </div>
      <form method="post" action="?action=editNbrPerIP&idPerIP=<?php echo $nbrPerIP[$i]['id'];?>">
      <div class="panel-body">
        <div class="row">
          <label class="form-control-label">Modifiez ici le nombres <span style="color: red;">limite</span> d'inscriptions par IP. (Entrez -1 pour <span style="color: green">illimité</span>)</label>
          <input type="number" style="text-align: center;" name="nbrPerIP" class="form-control" placeholder="1" value="<?php echo $nbrPerIP[$i]['nbrPerIP']; ?>"/>
        </div>
        <div class="row text-center">
          <input type="submit" class="btn btn-info" value="Valider" />
        </div>
      </div>
    </form>
  </div>
</div>
<?php 
  }
}
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['info']['stats']['members']['editEmail'] == true)
{
  for($i = 0; $i < count($sysMail); $i++)
  {
    ?>
    <div class="row">
      <div class="col-md-6">
        <div class="panel panel-default cmw-panel">
          <div class="panel-heading cmw-panel-header">
            <h3 class="panel-title"><strong>Système d'API: Email de vérification</strong></h3>
          </div>
          <div class="panel-body">
        <?php if($sysMail[$i]['etatMail'] == "0") {
          ?><div class="row">
              <div class="alert alert-danger">L'API est actuellement désactivée.</div>
              <form method="POST" action="?&action=switchSysMail&idMail=<?php echo $sysMail[$i]['idMail']; ?>">
                <center><button type="submit" name="etatMail" class="btn btn-danger" value="1" />L'activer ?</button></center>
              </form>
            </div><?php 
        }
        else
        {
          ?>
          <div class="row">
            <div class="alert alert-success">L'API est activée</div>
            <form method="POST" action="?&action=switchSysMail&idMail=<?php echo $sysMail[$i]['idMail']; ?>">
              <center><button type="submit" name="etatMail" class="btn btn-danger" value="0" />La désactiver ?</button></center>
            </form>
          </div><form method="POST" action="?&action=editSysMail&idMail=<?php echo $sysMail[$i]['idMail']; ?>">
          <div class="row">
                <label class="form-control-label">Modifiez ici le nombres <span style="color: red;">limite</span> d'utilisation d'une email par compte.</label>
                <input type="number" style="text-align: center;" name="strictMail" class="form-control" placeholder="1" value="<?php echo $sysMail[$i]['strictMail']; ?>">
            </div>
            <hr/>
            <div class="row">
              <div class="alert alert-success text-center">
                <strong>Modifier le contenue de l'API</strong>
              </div>
            </div>
            <div class="row">
              <label class="form-control-label">Email</label>
              <input type="text" style="text-align: center;" class="form-control" name="fromMail" value="<?php echo $sysMail[$i]['fromMail']; ?>" placeholder="no-reply@infectedz.fr">
            </div>
            <div class="row">
              <label class="form-control-label">Sujet</label>
              <input type="text" style="text-align: center;" class="form-control" name="sujetMail" value="<?php echo $sysMail[$i]['sujetMail']; ?>" placeholder="Votre lien d'activation !">
            </div>
            <div class="row">
              <div class="alert alert-info">
                <strong><i class="fa fa-question-circle"></i> Détails importants <i class="fa fa-question-circle"></i></strong>
                <div class="row">
                  Voici les syntaxes à respecter dans votre message :<br>
                  - <B>{JOUEUR}</B> = Au nom du joueur. (Optionnel.)<br>
                  - <B>{LIEN}</B> = Au lien pour confirmer l'inscription. (<B>Obligatoire !</B>)<br>
                  - <B>{MDP}</B> = Au mot de passe du joueur. (Optionnel.)<br>
                  - <B>{IP}</B> = A l'adresse IP de l'endroit où à étais effectué l'inscription. (Optionnel.)
                </div>
              </div>
            </div>
            <div class="row">
              <label class="form-control-label">Message</label>
              <textarea style="resize: vertical;height: 250px" class="form-control" name="msgMail" placeholder="Bienvenue[...] Voici votre lien d'activation..."><?php echo $sysMail[$i]['msgMail']; ?></textarea>
            </div>
            <div class="row text-center">
              <input type="submit" class="btn btn-info" value="Valider" />
            </div></form>
    <?php } ?>
        </div>
    </div>
  </div>
</div>
    <?php 
  }
}
?>
