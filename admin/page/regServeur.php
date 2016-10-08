<center><h1><center><strong>Réglages du/des serveur(s) JSONAPI</center></strong></h1>

<h3><center>Ajouter un serveur</center></h3>
<div style="width: 50%" class="alert alert-dismissable alert-success"><center>Vous pouvez ajouter autant de serveurs minecraft que vous le souhaitez. La connection au(x) serveurs est essentiel !</center></a></div>


<form class="form-horizontal default-form" method="post" action="?&action=serveurJsonNew">
	<div class="form-group">
		<label class="col-sm-4 control-label">Nom du serveur</label>
		<div style="width: 50%" class="col-sm-8">
			<input type="text" name="JsonNom" class="form-control" placeholder="Ce nom n'a pas d'importance" >
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Ip du serveur</label>
		<div style="width: 50%" class="col-sm-8">
		      	<input type="text" name="JsonAddr" placeholder="ex: play.monserveur.fr ou 77.54.25.124" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Port JsonAPI</label>
		<div style="width: 50%" class="col-sm-8">
			<input type="text" name="JsonPort" class="form-control" placeholder="ex: 12548">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">User JSONAPI</label>
		<div style="width: 50%" class="col-sm-8">
			<input type="text" name="JsonUser" class="form-control" placeholder="ex: admin">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Mot de passe</label>
		<div style="width: 50%" class="col-sm-8">
			<input type="password" name="JsonMdp" class="form-control" placeholder="ex: monMdpSecret">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Salt</label>
		<div style="width: 50%" class="col-sm-8">
			<input type="password" name="JsonSalt" class="form-control" placeholder="Depuis la 1.7, merci d'ignorer ce champ !">
		</div>
	</div>
	<div class="form-group">
		<center><div class="col-sm-offset-8 col-sm-2">
			<button type="submit" class="btn btn-success">Ajouter mon serveur JSONAPI</button>
		</div></center>
	</div>
</form>

<h3><center>Modifier les serveurs déjà ajouté</center></h3>

<?php if(count($lecture['Json']) == 0)
{ ?>
<div style="width: 50%" class="alert alert-danger"><center>Merci de bien vouloir ajouter un serveur pour pouvoir le modifier !!!</center></div>
<?php } else { ?>
<div style="width: 50%" class="alert alert-dismissable alert-success"><center>Vous pouvez modifier les données de vos serveurs ajoutés. Pour cela rien de plus simple, il vous suffit de remplir le formulaire ci-contre.</center></a></div>


<form class="form-horizontal" method="post" action="?&action=serveurConfig">
	<div class="reglage-json">

        <ul class="nav nav-tabs">
	        <?php
	        for($i = 0; $i < count($lecture['Json']); $i++)
	        {
	        ?>
	        <li <?php if($i == 0) echo 'class="active"'; ?>><a href="#jsonReg<?php echo $i; ?>" data-toggle="tab">Serv' <?php echo $i + 1; ?></a></li>
            <?php } ?>
        </ul>

        <div class="tab-content">
        <?php
        for($i = 0; $i < count($lecture['Json']); $i++)
        {
        ?>
            <div class="tab-pane well <?php if($i == 0) echo 'active'; ?>" id="jsonReg<?php echo $i; ?>">
		
		        <h4><?php echo $lecture['Json'][$i]['nom']; ?>  <a class="btn btn-danger" href="?&action=supprJson&nom=<?php echo $lecture['Json'][$i]['nom']; ?>">Supprimer ce serveur</a></h4>
		        <div class="form-group">
			        <label class="col-sm-4 control-label">Nom du serveur</label>
			        <div style="width: 50%" class="col-sm-8">
				        <input type="text" name="JsonNom<?php echo $i; ?>" class="form-control" placeholder="Ca sert à mieux s'y retrouver" value="<?php echo $lecture['Json'][$i]['nom']; ?>">
			        </div>
		        </div>
		        <div class="form-group">
			        <label class="col-sm-4 control-label">Ip du serveur</label>
			        <div style="width: 50%" class="col-sm-8">
			              	<input type="text" name="JsonAddr<?php echo $i; ?>" class="form-control" placeholder="play.monserveur.fr" value="<?php echo $lecture['Json'][$i]['adresse']; ?>">
			        </div>
		        </div>
		        <div class="form-group">
			        <label class="col-sm-4 control-label">Port JsonAPI</label>
			        <div style="width: 50%" class="col-sm-8">
				        <input type="text" name="JsonPort<?php echo $i; ?>" class="form-control" placeholder="12548" value="<?php echo $lecture['Json'][$i]['port']; ?>">
			        </div>
		        </div>
		        <div  class="form-group">
			        <label class="col-sm-4 control-label">User JsonAPI</label>
			        <div style="width: 50%" class="col-sm-8">
				        <input type="text" name="JsonUser<?php echo $i; ?>" class="form-control" placeholder="admin" value="<?php echo $lecture['Json'][$i]['utilisateur']; ?>">
			        </div>
		        </div>
		        <div class="form-group">
			        <label class="col-sm-4 control-label">Mot de passe</label>
			        <div style="width: 50%" class="col-sm-8">
				        <input type="text" name="JsonMdp<?php echo $i; ?>" class="form-control" placeholder="Brouette" value="<?php echo $lecture['Json'][$i]['mdp']; ?>">
			        </div>
		        </div>
		        <div class="form-group">
			        <label class="col-sm-4 control-label">Salt</label>
			        <div style="width: 50%" class="col-sm-8">
				        <input type="text" name="JsonSalt<?php echo $i; ?>" class="form-control" placeholder="MonSaltSecret" value="<?php echo $lecture['Json'][$i]['salt']; ?>">
			        </div>
		        </div>
            </div>
		<?php } ?>
        </div>
	</div>
	
	<div class="form-group">
		<center><div class="col-sm-offset-8 col-sm-2">
			<input type="submit" class="btn btn-success" value="Valider les changements" />
		</div></center>
	</div>
</form>
<?php } ?>
</center>