<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h2 class="h2 gray">
		Réglages site
	</h2>
</div>
<?php if(!$_Permission_->verifPerm('PermsPanel', 'general', 'showPage')) { ?>
 <div class="col-lg-12 text-justify">
    <div class="alert alert-danger">
        <strong>Vous avez aucune permission pour accéder aux réglages généraux.</strong>
    </div>
</div>
<?php } else { ?>
 <div class="col-lg-12 text-justify">
    <div class="alert alert-success">
        <strong>Modifiez ici les informations principales de votre serveur. La plupart des autres données du site dépendent de la base de données, qui est donc essentielle, changez les identifiants de la base seulement si vous savez ce que vous faites ! </strong>
    </div>
</div>
<div class="card-columns">
	<?php if($_Permission_->verifPerm('PermsPanel', 'general', 'actions','editGeneral')) { ?>
		<div class="card">
		    <div class="card-header">
		        <h4 class="card-title">
		            <i class="fas fa-info"></i> Informations
		 		</h4>
		    </div>
		    <div class="card-body" id="changeInfo">
				<label class="control-label">Adresse du site</label>
		        <input type="url" name="adresseWeb" class="form-control" placeholder="http://monsiteminecraft.fr/" value="<?php echo $_Serveur_['General']['url']; ?>">
		                    
		        <label class="control-label">Nom du serveur</label>
		        <input type="text" name="nom" class="form-control" placeholder="MineServeur" value="<?php echo $_Serveur_['General']['name']; ?>">

		        <label class="control-label">Description</label>
		        <input type="text" name="description" class="form-control" placeholder="Mon super serveur minecraft !" value="<?php echo $_Serveur_['General']['description']; ?>">

		        <label class="control-label">Adresse de votre serveur Minecraft (textuel)</label>
		        <input type="text" name="ipTexte" class="form-control" placeholder="cmw.minesr.com" value="<?php echo $_Serveur_['General']['ipTexte']; ?>">

		        <label class="control-label">Adresse de votre serveur Minecraft (sous forme d'IP, sans le port !)</label>
		        <input type="text" name="ip" class="form-control" placeholder="172.16.254.1" value="<?php echo $_Serveur_['General']['ip']; ?>">

		        <label class="control-label">Port de votre serveur Minecraft</label>
		        <input type="number" name="port" class="form-control" placeholder="25565" value="<?php echo $_Serveur_['General']['port']; ?>">

		        <label class="control-label">Statut de votre serveur</label>
		        <select name="statut" class="form-control" style="text-align-last: center;">
		            <option value="0" class="text-center" <?=($_Serveur_['General']['statut'] == 0) ? 'selected' : '';?>>Hors-Ligne</option>
		            <option value="1" class="text-center" <?=($_Serveur_['General']['statut'] == 1) ? 'selected' : '';?>>En Ligne</option>
		            <option value="2" class="test-center" <?=($_Serveur_['General']['statut'] == 2) ? 'selected' : '';?>>En Maintenance</option>
		        </select>
		        <script>initPost("changeInfo", "admin.php?action=general",null);</script>
		    </div>
		    <div class="card-footer">
		        <button type="submit" class="btn btn-success w-100" onClick="sendPost('changeInfo')">Envoyer !</button>
		    </div>
		</div>
		<div class="card">
		    <div class="card-header">
		        <h4 class="card-title">
		            <i class="fas fa-database"></i> Base de données
		 		</h4>
		    </div>
		    <div class="card-body" id="changeBdd">
		        <label class="control-label">Adresse</label>
		        <input type="text" name="adresse" class="form-control" placeholder="localhost" value="<?php echo $_Serveur_['DataBase']['dbAdress']; ?>">

		        <label class="control-label">Nom de la base</label>
		        <input type="text" name="dbNom" class="form-control" placeholder="BaseSite" value="<?php echo $_Serveur_['DataBase']['dbName']; ?>">

		        <label class="control-label">Nom d'utilisateur</label>
		        <input type="text" name="dbUtilisateur" class="form-control" placeholder="root" value="<?php echo $_Serveur_['DataBase']['dbUser']; ?>">

		        <label class="control-label">Mot de passe</label>

		        			<div class="input-group mb-3">
                             <input type="password" name="dbMdp" class="form-control" placeholder="Balançoire" value="<?php echo $_Serveur_['DataBase']['dbPassword']; ?>">
                              <div class="input-group-append">
                                <span onclick="switchTypePassword(this);" class="input-group-text" style="cursor:pointer;"><i class="far fa-eye"></i></span>
                              </div>
                            </div>
		        <script>initPost("changeBdd", "admin.php?action=editBdd",null);</script>
		    </div>
		    <div class="card-footer">
		        <button type="submit" class="btn btn-success w-100" onClick="sendPost('changeBdd')">Envoyer!</button>
		    </div>
		</div>

		<div class="card" id="changeSmtp">
		    <div class="card-header" id="changeEnableSmtp" style="width: 100%;display: inline-block">
		        <h4 class="card-title">
		        	<div class="float-left">
		        		<h4 class="card-title">
		        			<i class="fas fa-envelope"></i> Mail SMTP
		        		</h4>
		        	</div>
		        	<div class="float-right">
		        		<label class="switch">
		        			<input type="checkbox" value="true" name="enable"
		        				onClick="if(get('panel-mail').style.display == 'none') { show('panel-mail'); } else { hide('panel-mail'); }sendPost('changeEnableSmtp');"
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

					<div class="input-group mb-3">
                             <input type="password" name="password" class="form-control" placeholder="votremdpSMTP" <?=(isset($_Serveur_['SMTP']['Password'])) ? 'value="'.$_Serveur_['SMTP']['Password'].'"': '';?> required>
                              <div class="input-group-append">
                                <span onclick="switchTypePassword(this);" class="input-group-text" style="cursor:pointer;"><i class="far fa-eye"></i></span>
                              </div>
                            </div>

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
						<textarea id="ckeditor" data-UUID="0001" name="footer"><?php if(isset($_Serveur_['SMTP']['Footer'])) { echo $_Serveur_['SMTP']['Footer']; } else { echo 'HTML autorisé'; } ?></textarea>

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
					get('btn-mail').disabled = true;
					$.post("admin.php?action=testMail",{
					},function(data, status){
						if(data == "1") {
							alert("Le mail a bien été envoyé !");
						} else {
							alert("Le mail n'a pas été envoyé, avez vous mis à jour les informations ? Avez-vous bien entré les informations ?");
						}
						get('btn-mail').disabled = false;
					});
				}
			</script>
	<!-- <div class="col-xs-12 col-md-6" style="margin-top: 20px;"> -->
		<?php } if($_Permission_->verifPerm('PermsPanel', 'general', 'actions', 'editFavicon'))
		{
			?>
			<form action="?action=ajout_favicon" method="POST" enctype="multipart/form-data">
				<div class="card">
				    <div class="card-header">
				        <h4 class="card-title">
				            <i class="fas fa-icons"></i> Configuration du favicon
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
						  const fileInput = get('File');
						  const label = get('file-text');
						  
						  fileInput.onchange =
						  fileInput.onmouseout = function () {
						    if (!fileInput.value) return
						    
						    var value = fileInput.value.replace(/^.*[\\\/]/, '')
						    label.value = value
						  }

				   		</script>
				    </div>
				    <div class="card-footer">
				        <button type="submit" class="btn btn-success w-100">Envoyer !</button>
				    </div>
				</div>
			</form>
		<?php } if($_Permission_->verifPerm('PermsPanel', 'general', 'actions', 'editUploadImg')) { ?>

				<div class="card" >
				    <div class="card-header" style="width: 100%;display: inline-block">
				        <h4 class="card-title">
				        	<div class="float-left"><h4 class="card-title">
				        		<i class="fas fa-cloud-upload-alt"></i> Upload d'image sur l'éditeur de texte
				        	</h4></div>
				        	<div class="float-right">
				        		<label class="switch">
				        			<input type="checkbox" 
				        				onClick="if(get('panel-upload').style.display == 'none') { show('panel-upload');sendPost('panel-upload'); } else { hide('panel-upload'); sendDirectPost('admin.php?action=switchUploadImage'); }"
				        				<?=(isset($_Serveur_['uploadImage'])) ? 'checked': '';?>>
				        			<span class="slider round"></span>
				        		</label>

				        	</div>

				 		</h4>

				    </div>
				    <div id="panel-upload" <?=(isset($_Serveur_['uploadImage'])) ? '': 'style="display:none;"';?>>
				    	<div class="card-body" >
					    	 <div class="col-lg-12 text-justify">
							    <div class="alert alert-success">
							    	<strong>
							    		CraftMyWebSite a d'intégré un système d'upload d'image dans son éditeur de texte, vous pouvez éditer ces paramètres ici. Sachez que lorsque la taille total des fichiers dépasse la taille maximale de l'espace de stockage, les plus anciennes images sont supprimées <u>à jamais</u> jusqu'à rétablir l'équilibre.
							    	</strong><br/>
							        <ul>
					                    <li> Nombre total de fichier: <span id="allf"><?=$filetotal;?></span></li>
					                    <li> Taille total des fichiers: <span id="alls"><?=$sizetotal;?></span></li>
					                </ul>
					                <button type="button" class="btn btn-danger" onclick="sendDirectPost('admin.php?action=resetAllUploadImage', 
					                	function(data) { if(data) { get('allf').innerText = '0';get('alls').innerText = '0'; }});
					               ">Supprimer tous les fichiers (irréversible)</button>
							    </div>
							</div>

					    	<label class="control-label">Taille maximale des images: <span  id="rangValue1"><?=(isset($_Serveur_['uploadImage']['maxFileSize'])) ? ($_Serveur_['uploadImage']['maxFileSize'] >=1000 ? ($_Serveur_['uploadImage']['maxFileSize'] >=1000000 ? ($_Serveur_['uploadImage']['maxFileSize'] / 1000000).'GB' : ($_Serveur_['uploadImage']['maxFileSize'] / 1000).'MB') : $_Serveur_['uploadImage']['maxFileSize'].'KB'): '1MB';?></span></label>
							<input name="maxFileSize" id="rangeInput1" class="border-0" type="range" value="<?=(isset($_Serveur_['uploadImage']['maxFileSize'])) ? $_Serveur_['uploadImage']['maxFileSize']: '1000';?>" step="50" min="50" max="5000" />


							<label class="control-label">Taille maximale de l'espace de stockage: <span  id="rangValue2"><?=(isset($_Serveur_['uploadImage']['maxSize'])) ? ($_Serveur_['uploadImage']['maxSize'] >=1000 ? ($_Serveur_['uploadImage']['maxSize'] >=1000000 ? ($_Serveur_['uploadImage']['maxSize'] / 1000000).'GB' : ($_Serveur_['uploadImage']['maxSize'] / 1000).'MB') : $_Serveur_['uploadImage']['maxSize'].'KB'): '1MB';?></span></label>
							<input name="maxSize" id="rangeInput2" step="1000" value="<?=(isset($_Serveur_['uploadImage']['maxSize'])) ? $_Serveur_['uploadImage']['maxSize']: '1000';?>" type="range" min="1000" max="5000000" />


					    </div>
					    <script>
					    registerEvent(get('rangeInput1'), ["change", "keyup", "input"], function(evt) { let nb = parseInt(evt.target.value);if(nb>=1000) { if(nb>=1000000){get('rangValue1').innerText = (nb / 1000000)+"GB";} else {get('rangValue1').innerText = (nb / 1000)+"MB";}} else {get('rangValue1').innerText = nb+"KB";}});
					    registerEvent(get('rangeInput2'), ["change", "keyup", "input"], function(evt) { let nb = parseInt(evt.target.value);if(nb>=1000) { if(nb>=1000000){get('rangValue2').innerText = (nb / 1000000)+"GB";} else {get('rangValue2').innerText = (nb / 1000)+"MB";}} else {get('rangValue2').innerText = nb+"KB";}});
					    initPost("panel-upload", "admin.php?action=editUploadImage");</script>
					    <div class="card-footer">
					        <button type="submit" onclick="sendPost('panel-upload');"  class="btn btn-success w-100">Envoyer !</button>
					    </div>
				    </div>
				</div>
			<?php } ?>
	<!-- </div> -->
</div>
<?php } ?>
