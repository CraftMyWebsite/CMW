<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h2 class="h2 gray">
		Réglages site
	</h2>
</div>
<?php if(!Permission::getInstance()->verifPerm('PermsPanel', 'general', 'actions', 'editGeneral')) { ?>
<div class="text-center">
    <div class="alert alert-danger">
        <strong>Vous n'avez pas la permission pour accéder aux réglages généraux.</strong>
    </div>
</div>
<?php } else { ?>
<div class="text-center">
    <div class="alert alert-success">
        <strong>Modifiez ici les informations principales de votre serveur. La plupart des autres données du site dépendent de la base de données, qui est donc essentielle, changez les identifiants de la base seulement si vous savez ce que vous faites ! </strong>
    </div>
</div>
<div class="card-columns">
	<!-- <div class="col-xs-12 col-md-6"> -->
		<div class="card">
		    <div class="card-header">
		        <h4 class="card-title">
		            <i class="fas fa-info"></i> Informations
		 		</h4>
		    </div>
		    <div class="card-body" id="changeInfo">
				<label class="control-label">Adresse du site</label>
		        <input type="url" name="adresseWeb" class="form-control text-center" placeholder="http://monsiteminecraft.fr/" value="<?php echo $_Serveur_['General']['url']; ?>">
		                    
		        <label class="control-label">Nom du serveur</label>
		        <input type="text" name="nom" class="form-control text-center" placeholder="MineServeur" value="<?php echo $_Serveur_['General']['name']; ?>">

		        <label class="control-label">Description</label>
		        <input type="text" name="description" class="form-control text-center" placeholder="Mon super serveur minecraft !" value="<?php echo $_Serveur_['General']['description']; ?>">

		        <label class="control-label">Adresse de votre serveur Minecraft (textuel)</label>
		        <input type="text" name="ipTexte" class="form-control text-center" placeholder="cmw.minesr.com" value="<?php echo $_Serveur_['General']['ipTexte']; ?>">

		        <label class="control-label">Adresse de votre serveur Minecraft (sous forme d'IP, sans le port !)</label>
		        <input type="text" name="ip" class="form-control text-center" placeholder="172.16.254.1" value="<?php echo $_Serveur_['General']['ip']; ?>">

		        <label class="control-label">Port de votre serveur Minecraft</label>
		        <input type="number" name="port" class="form-control text-center" placeholder="25565" value="<?php echo $_Serveur_['General']['port']; ?>">

		        <label class="control-label">Statut de votre serveur</label>
		        <select name="statut" class="form-control text-center" style="text-align-last: center;">
		            <option value="0" class="text-center" <?=($_Serveur_['General']['statut'] == 0) ? 'selected' : '';?>>Hors-Ligne</option>
		            <option value="1" class="text-center" <?=($_Serveur_['General']['statut'] == 1) ? 'selected' : '';?>>En Ligne</option>
		            <option value="2" class="test-center" <?=($_Serveur_['General']['statut'] == 2) ? 'selected' : '';?>>En Maintenance</option>
		        </select>
		        <script>initPost("changeInfo", "admin.php?action=general",null);</script>
		    </div>
		    <div class="card-footer">
		        <button type="submit" class="btn btn-success w-100" onClick="sendPost('changeInfo')">Envoyer!</button>
		    </div>
		</div>
	<!-- </div> -->
	<!-- <div class="col-xs-12 col-md-6"> -->
		<div class="card">
		    <div class="card-header">
		        <h4 class="card-title">
		            <i class="fas fa-database"></i> Base de données
		 		</h4>
		    </div>
		    <div class="card-body" id="changeBdd">
		        <label class="control-label">Adresse</label>
		        <input type="text" name="adresse" class="form-control text-center" placeholder="localhost" value="<?php echo $_Serveur_['DataBase']['dbAdress']; ?>">

		        <label class="control-label">Nom de la base</label>
		        <input type="text" name="dbNom" class="form-control text-center" placeholder="BaseSite" value="<?php echo $_Serveur_['DataBase']['dbName']; ?>">

		        <label class="control-label">Nom d'utilisateur</label>
		        <input type="text" name="dbUtilisateur" class="form-control text-center" placeholder="root" value="<?php echo $_Serveur_['DataBase']['dbUser']; ?>">

		        <label class="control-label">Mot de passe</label>
		        <input type="password" name="dbMdp" class="form-control text-center" placeholder="Balançoire" value="<?php echo $_Serveur_['DataBase']['dbPassword']; ?>">
		        <script>initPost("changeBdd", "admin.php?action=editBdd",null);</script>
		    </div>
		    <div class="card-footer">
		        <button type="submit" class="btn btn-success w-100" onClick="sendPost('changeBdd')">Envoyer!</button>
		    </div>
		</div>
	<!-- </div> -->
	<!-- <div class="col-xs-12 col-md-6" style="margin-top: 20px;"> -->
		<div class="card" id="changeSmtp">
		    <div class="card-header" id="changeEnableSmtp" style="width: 100%;display: inline-block">
		        <h4 class="card-title">
		        	<div class="float-left">
		        		<i class="fas fa-envelope"></i> Mail SMTP
		        	</div>
		        	<div class="float-right">
		        		<label class="switch">
		        			<input type="checkbox" value="true" name="enable"
		        				onClick="if(document.getElementById('panel-mail').style.display == 'none') { document.getElementById('panel-mail').style.display = 'block'; } else { document.getElementById('panel-mail').style.display = 'none'; }sendPost('changeEnableSmtp');"
		        				<?=(isset($_Serveur_['SMTP'])) ? 'checked': '';?>>
		        			<span class="slider round"></span>
		        		</label>
		        	</div>

		 		</h4>

		    </div>
			<div class="section-mail" id="panel-mail" style="<?=(!isset($_Serveur_['SMTP'])) ? 'display:none;': '';?>">

				<div class="card-body fadeInDown">
					<label class="control-label">Adresse mail fournie</label>
					<input name="from" type="email"  <?=(isset($_Serveur_['SMTP']['From'])) ? 'value="'.$_Serveur_['SMTP']['From'].'"': '';?> class="form-control" placeholder="votremail@gmail.com" required>

					<label class="control-label">Adresse mail de réponse</label>
					<input name="reply" type="email"  <?=(isset($_Serveur_['SMTP']['Reply'])) ? 'value="'.$_Serveur_['SMTP']['Reply'].'"': '';?> class="form-control" placeholder="votremail@gmail.com" required>
								
					<label class="control-label">Serveur SMTP</label>
					<input type="text" name="host" class="form-control" placeholder="smtp.google.com" <?=(isset($_Serveur_['SMTP']['Host'])) ? 'value="'.$_Serveur_['SMTP']['Host'].'"': '';?> required>

					<label class="control-label">Utilisateur SMTP</label>
					<input type="text" name="username" class="form-control" placeholder="adressemail@gmail.com" <?=(isset($_Serveur_['SMTP']['Username'])) ? 'value="'.$_Serveur_['SMTP']['Username'].'"': '';?> required> 

					<label class="control-label">Mot de passe SMTP</label>
					<input type="password" name="password" class="form-control" placeholder="votremdpSMTP" <?=(isset($_Serveur_['SMTP']['Password'])) ? 'value="'.$_Serveur_['SMTP']['Password'].'"': '';?> required>

					<label class="control-label">Port SMTP</label>
					<input type="number" class="form-control" name="port" placeholder="587" <?=(isset($_Serveur_['SMTP']['Port'])) ? 'value="'.$_Serveur_['SMTP']['Port'].'"': '';?> required>

					<label for="tlsradio" class="control-label">Protocole d'envoie:</label>
					<div class="custom-control custom-radio">
						<input type="radio" id="tlsradio" name="protocol" value="tls" class="custom-control-input" <?=(isset($_Serveur_['SMTP']['Protocol']) && $_Serveur_['SMTP']['Protocol'] == "tls") ? 'checked': ((isset($_Serveur_['SMTP']['Protocol']) && $_Serveur_['SMTP']['Protocol'] == "ssl") ? '': 'checked');?> >
						<label class="custom-control-label" for="tlsradio">TLS (Par default)</label>
					</div>

					<div class="custom-control custom-radio">
						<input type="radio" id="sslradio" name="protocol" value="ssl" class="custom-control-input" <?=(isset($_Serveur_['SMTP']['Protocol']) && $_Serveur_['SMTP']['Protocol'] == "ssl") ? 'checked': '';?>>
						<label class="custom-control-label" for="sslradio">SSL</label>
					</div>
					<label class="control-label" for="ckeditor">Footer des mails</label>
						<textarea id="ckeditor" name="footer"><?php if(isset($_Serveur_['SMTP']['Footer'])) { echo $_Serveur_['SMTP']['Footer']; } else { echo 'HTML autorisé'; } ?></textarea>

				</div>
				<div class="card-footer">
					<div class="row">
						<div class="col-md-6">
							<button type="submit" id="btn-mail" class="btn btn-primary w-100" onClick="sendPost('changeSmtp',testMail()); ">Tester !</button>
						</div>
						<div class="col-md-6">
							<button type="submit" class="btn btn-success w-100" onClick="sendPost('changeSmtp')">Envoyer !</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<!-- </div> -->
	 <script >
				initPost("changeSmtp", "admin.php?action=editMail",null);
				initPost("changeEnableSmtp", "admin.php?action=editMail",null);
				function testMail() {
					document.getElementById('btn-mail').disabled = true;
					$.post("admin.php?action=testMail",{
					},function(data, status){
						if(data == "1") {
							alert("Le mail a bien été envoyé !");
						} else {
							alert("Le mail n'a pas été envoyé, avez vous mis à jour les informations ? ou avez vous bien rentré les informations ?");
						}
						document.getElementById('btn-mail').disabled = false;
					});
				}
			</script>
	<!-- <div class="col-xs-12 col-md-6" style="margin-top: 20px;"> -->
		<form action="?action=ajout_favicon" method="POST" enctype="multipart/form-data">
		<div class="card">
		    <div class="card-header">
		        <h4 class="card-title">
		            <i class="fas fa-database"></i> Configuration du favicon
		 		</h4>
		    </div>
		    <div class="card-body" id="changeFavicon">

		      	<label class="control-label">Fichier favicon (le précédent sera écrasé)</label>

				<div class="input-group file-input-group" style="margin-top:10px;">
				  <input class="form-control" id="file-text" type="text" placeholder="No file selected" readonly>
				  <input type="file" name="favicon" id="File" style="display:none;" required>
				  <div class="input-group-append">
				    <label class="btn btn-secondary mb-0" for="File">Choisir un fichier</label>
				  </div>
				</div>

		        <script>
				  const fileInput = document.getElementById('File');
				  const label = document.getElementById('file-text');
				  
				  fileInput.onchange =
				  fileInput.onmouseout = function () {
				    if (!fileInput.value) return
				    
				    var value = fileInput.value.replace(/^.*[\\\/]/, '')
				    label.value = value
				  }

		   		</script>
		    </div>
		    <div class="card-footer">
		        <button type="submit" class="btn btn-success w-100">Envoyer!</button>
		    </div>
		</div>
		</form>
	<!-- </div> -->
</div>
<?php } ?>
