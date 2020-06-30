<div class="cmw-page-content-header"><strong>Réglages site</strong> - Modifiez votre accès MySQL ou les informations de votre site</div>

<?php if($_Joueur_['rang'] != 1 AND !$_PGrades_['PermsPanel']['general']['actions']['editGeneral']) { ?>

<div class="text-center">
    <div class="alert alert-danger">
        <strong>Vous avez aucune permission pour accéder aux réglages généraux.</strong>
    </div>
</div>

<?php } else { ?>

<div class="text-center">
    <div class="alert alert-success">
        <strong>Modifiez ici les informations principales de votre serveur. La plupart des autres données du site dépendent de la base de données, qui est donc essentielle, changez les identifiants de la base seulement si vous savez ce que vous faites ! </strong>
    </div>
</div>

<?php } if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['general']['actions']['editGeneral'] ) { ?>

<form method="POST" action="?&action=general">
    <div class="text-center">
        <div class="panel panel-default cmw-panel">
			<div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Configuration des données de base</strong></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                  <div class="col-xs-12 col-md-6" style="padding: 10px;">
                    <h3>Informations</h3>
                    
                        <label class="control-label">Adresse du site</label>
                        <input type="url" name="adresseWeb" class="form-control text-center" placeholder="http://monsiteminecraft.fr/" value="<?php echo $lecture['General']['url']; ?>">
                    
                        <label class="control-label">Nom du serveur</label>
                        <input type="text" name="nom" class="form-control text-center" placeholder="MineServeur" value="<?php echo $lecture['General']['name']; ?>">

                        <label class="control-label">Description</label>
                        <input type="text" name="description" class="form-control text-center" placeholder="Mon super serveur minecraft !" value="<?php echo $lecture['General']['description']; ?>">

                        <label class="control-label">Adresse de votre serveur Minecraft (textuel)</label>
                        <input type="text" name="ipTexte" class="form-control text-center" placeholder="cmw.minesr.com" value="<?php echo $lecture['General']['ipTexte']; ?>">

                        <label class="control-label">Adresse de votre serveur Minecraft (sous forme d'IP, sans le port !)</label>
                        <input type="text" name="ip" class="form-control text-center" placeholder="172.16.254.1" value="<?php echo $lecture['General']['ip']; ?>">

                        <label class="control-label">Port de votre serveur Minecraft</label>
                        <input type="number" name="port" class="form-control text-center" placeholder="25565" value="<?php echo $lecture['General']['port']; ?>">

                        <label class="control-label">Statut de votre serveur</label>
                        <select name="statut" class="form-control text-center" style="text-align-last: center;">
                            <option value="0" class="text-center" <?=($lecture['General']['statut'] == 0) ? 'selected' : '';?>>Hors-Ligne</option>
                            <option value="1" class="text-center" <?=($lecture['General']['statut'] == 1) ? 'selected' : '';?>>En Ligne</option>
                            <option value="2" class="test-center" <?=($lecture['General']['statut'] == 2) ? 'selected' : '';?>>En Maintenance</option>
                        </select>
                </div>

                <div class="col-xs-12 col-md-6" style="padding: 10px;">
                    <h3>Base de données</h3>
                        <label class="control-label">Adresse</label>
                        <input type="text" name="adresse" class="form-control text-center" placeholder="localhost" value="<?php echo $lecture['DataBase']['dbAdress']; ?>">

                        <label class="control-label">Nom de la base</label>
                        <input type="text" name="dbNom" class="form-control text-center" placeholder="BaseSite" value="<?php echo $lecture['DataBase']['dbName']; ?>">

                        <label class="control-label">Nom d'utilisateur</label>
                        <input type="text" name="dbUtilisateur" class="form-control text-center" placeholder="root" value="<?php echo $lecture['DataBase']['dbUser']; ?>">

                        <label class="control-label">Mot de passe</label>
                        <input type="password" name="dbMdp" class="form-control text-center" placeholder="Balançoire" value="<?php echo $lecture['DataBase']['dbPassword']; ?>">
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <input type="submit" class="btn btn-danger" value="Valider les changements" />
            </div>
            <br/>
        </div>
    </div>
</form>
<div class="row">
	<form action="?action=ajout_favicon" method="POST" enctype="multipart/form-data">
		<div class="col-md-6 col-xs-12">
			<div class="panel panel-default cmw-panel">
			   <div class="panel-heading cmw-panel-header">
					<h3 class="panel-title"><strong>Configuration du favicon</strong></h3>
				</div>
				<div class="panel-body">
					<div class="row text-center">
						<div class="col">
							<h3>Favicon du site</h3>

							<label class="control-label">Fichier favicon (le précédent sera écrasé)
							<input type="file" id="file" name="favicon" class="custom-file-input">
							<span class="custom-file-control"></span>
							</label>
						</div>
					</div>
				</div>
				<div class="text-center">
					<input type="submit" class="btn btn-danger" value="Envoyer le Favicon"/>
				</div>
			</div>
		</div>
	</form>
	<form action="?action=editMail" method="POST" enctype="multipart/form-data">
		<div class="col-md-6 col-xs-12">
			<div class="panel panel-default cmw-panel" >
			   <div class="panel-heading cmw-panel-header">
					<h3 class="panel-title"><strong><input type="checkbox" value="true" name="enable" style="display:inline;" onClick="if(document.getElementById('panel-mail').style.display == 'none') { document.getElementById('panel-mail').style.display = 'block'; } else { document.getElementById('panel-mail').style.display = 'none'; }"<?=(isset($_Serveur_['SMTP'])) ? 'checked': '';?>>  Utiliser le protocole SMTP pour l'envoie de mail</strong></h3>
				</div>
				<div class="panel-body" id="panel-mail" style="<?=(!isset($_Serveur_['SMTP'])) ? 'display:none;': '';?>">
					<div class="row">
						<div class="col">
							<input name="from" type="email"  <?=(isset($_Serveur_['SMTP']['From'])) ? 'value="'.$_Serveur_['SMTP']['From'].'"': '';?> class="form-control" placeholder="Adresse mail fournie" required>
							<input name="reply" type="email"  <?=(isset($_Serveur_['SMTP']['Reply'])) ? 'value="'.$_Serveur_['SMTP']['Reply'].'"': '';?> class="form-control" placeholder="Adresse mail de réponse" required>
					
							<input type="text" name="host" class="form-control" placeholder="Serveur SMTP: exemple : smtp.google.com" <?=(isset($_Serveur_['SMTP']['Host'])) ? 'value="'.$_Serveur_['SMTP']['Host'].'"': '';?> required>
							<input type="text" name="username" class="form-control" placeholder="Utilisateur SMTP: exemple : adressemail@gmail.com" <?=(isset($_Serveur_['SMTP']['Username'])) ? 'value="'.$_Serveur_['SMTP']['Username'].'"': '';?> required> 
							<input type="password" name="password" class="form-control" placeholder="Mot de passe SMTP: exemple: votremdpSMTP" <?=(isset($_Serveur_['SMTP']['Password'])) ? 'value="'.$_Serveur_['SMTP']['Password'].'"': '';?> required>
							<div class="form-group">
								<label class="sr-only" for="exampleInputAmount">Port SMTP (exemple 587)</label>
								<div class="input-group">
								  <div class="input-group-addon">Port SMTP</div>
								  <input type="number" class="form-control" name="port" placeholder="587" <?=(isset($_Serveur_['SMTP']['Port'])) ? 'value="'.$_Serveur_['SMTP']['Port'].'"': '';?> required>
								</div>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="protocol" value="tls" id="protocolTls" OnClick="if(document.getElementById('protocolTls').checked) { document.getElementById('protocolSsl').checked = false; } else { document.getElementById('protocolSsl').checked = true; }" <?=(isset($_Serveur_['SMTP']['Protocol']) && $_Serveur_['SMTP']['Protocol'] == "tls") ? 'checked': ((isset($_Serveur_['SMTP']['Protocol']) && $_Serveur_['SMTP']['Protocol'] == "ssl") ? '': 'checked');?>>
									Protocole TLS (à cocher par défaut)
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" value="ssl" name="protocol" id="protocolSsl" OnClick="if(document.getElementById('protocolSsl').checked) { document.getElementById('protocolTls').checked = false; } else { document.getElementById('protocolTls').checked = true; }" <?=(isset($_Serveur_['SMTP']['Protocol']) && $_Serveur_['SMTP']['Protocol'] == "ssl") ? 'checked': '';?>>
									Protocole SSL (si vous êtes sur de vous !)
								</label>
							</div>
							<textarea id="footer" name="footer"><?php if(isset($_Serveur_['SMTP']['Footer'])) { echo $_Serveur_['SMTP']['Footer']; } else { echo '(Footer des mails) HTML autorisé'; } ?></textarea>
							
						
						</div>
					</div>
				</div>
				<div class="text-center">
					<input type="submit" class="btn btn-danger" value="Mettre à jour l'envoie de mail"/>
					<input type="button" id="btn-test" class="btn btn-primary" onClick="testMail()" value="Tester l'envoie de mail"/>
					
				</div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
CKEDITOR.replace( 'footer' );

function testMail() {
	document.getElementById('btn-text').disabled = true;
	$.post("admin.php?action=testMail",{
	},function(data, status){
		if(data == "1") {
			alert("Le mail a bien été envoyé !");
		} else {
			alert("Le mail n'a pas été envoyé, avez vous mis à jour les informations ? ou avez vous bien rentré les informations ?");
		}
		document.getElementById('btn-text').disabled = false;
	}
}
</script>
<?php } ?>
