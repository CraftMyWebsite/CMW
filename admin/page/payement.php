<h2><center><B>Offres d'achats de jetons</B></center></h2>
<center><div style="width: 50%" class="alert alert-dismissable alert-success">
    <center>Les jetons sont la monnaie virtuelle du site. Les joueurs achètent des jetons avec leurs dons, et les utilisent dans la boutique.</center>
</div></center>


<h3><center>Dedipass/Paypal ID</center></h3>
<center><div style="width: 50%" class="alert alert-dismissable alert-success">
    <center>Vous trouverez ces informations sur le site officiel de votre méthode de payement !</center>
</div></center>
<form class="form-horizontal default-form" method="post" action="?&action=editPayement">
	<center>
	<h4>Activer le payement par:</h4>
	<label class="checkbox-inline">
	  	<input type="checkbox" name="paypal" <?php if($lectureP['paypal'] == true) echo 'checked'; ?>> Paypal
	</label>
	<label class="checkbox-inline">
	  	<input type="checkbox" name="dedipass" <?php if($lectureP['dedipass'] == true) echo 'checked'; ?>> Dedipass
	</label>
	</center>
	</br>
	<center><h4>Dedipass</h4></center>
	<div class="form-group">
		<label class="col-sm-4 control-label">Dedipass PublicKey</label>
		<div class="col-sm-8">
			<input style="width: 50%" type="text" name="dedipass_public" class="form-control" value="<?php echo $lectureP['dedipass_public']; ?>" placeholder="Trouvez le sur votre panel dedipass..." >
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Dedipass PrivateKey</label>
		<div class="col-sm-8">
			<input style="width: 50%" type="text" name="dedipass_private" class="form-control" value="<?php echo $lectureP['dedipass_private']; ?>" placeholder="Egalement sur votre panel dedipass" >
		</div>
	</div>
	</br>
    <center><h4>PayPal</h4></center>
    <center><div class="radio">
    	<label>
    		<input type="radio" name="paypalMethodeAPI" value="1"<?php if($lectureP['paypalMethodeAPI'] == 1) echo ' checked'; ?>>
    		Utiliser mon email pour être payé par paypal.
    	</label>
    </div></center>
    <div class="form-group">
		<label class="col-sm-4 control-label">Email paypal</label>
		<div class="col-sm-8">
			<input style="width: 50%" type="text" name="paypalEmail" class="form-control" value="<?php echo $lectureP['paypalEmail']; ?>" placeholder="L'email lié à votre compte paypal." >
		</div>
    </div>
    <center><div class="radio">
    	<label>
    		<input type="radio" name="paypalMethodeAPI" value="2"<?php if($lectureP['paypalMethodeAPI'] == 2) echo ' checked'; ?>>
    		Utiliser mon compte buisness paypal pour être payé.
    	</label>
    </div></center>
	<div class="form-group">
		<label class="col-sm-4 control-label">User Paypal</label>
		<div class="col-sm-8">
			<input style="width: 50%" type="text" name="paypalUser" class="form-control" value="<?php echo $lectureP['paypalUser']; ?>" placeholder="Demmandez une signature API pour connaitre cette donnée" >
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Mot de passe Paypal</label>
		<div class="col-sm-8">
			<input style="width: 50%" type="text" name="paypalPass" class="form-control" value="<?php echo $lectureP['paypalPass']; ?>" >
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Signature API Paypal</label>
		<div class="col-sm-8">
			<input style="width: 50%" type="text" name="paypalSignature" class="form-control" value="<?php echo $lectureP['paypalSignature']; ?>" >
		</div>
	</div>
	</br>
    <center><input type="submit" class="btn btn-success" value="Valider les changements !" /></center>
</form>
</br>
</br>
<h3><center>Créer une offre paypal</center></h3>
<center><div style="width: 50%" class="alert alert-dismissable alert-success">
    <center>Une fois votre compte paypal config, vous devez créer une offre paypal pour que les joueurs puissent l'acheter !</center>
</div></center>
<form class="form-horizontal default-form" method="post" action="?&action=creerOffrePaypal">
	<div class="form-group">
		<label class="col-sm-4 control-label">Titre de l'offre</label>
		<div class="col-sm-8">
			<input style="width: 50%" type="text" name="nom" class="form-control" placeholder="ex: 5€ - 1500Jetons" >
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Message de l'offre</label>
		<div class="col-sm-8">
			<input style="width: 50%" type="text" name="description" class="form-control" placeholder="ex: < img src=... / >" >
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Prix de l'offre</label>
		<div class="col-sm-8">
			<input style="width: 50%" type="number" name="prix" class="form-control" placeholder="ex: 5" >
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Jetons donnés</label>
		<div class="col-sm-8">
			<input style="width: 50%" type="number" name="jetons_donnes" class="form-control" placeholder="ex: 1500" >
		</div>
	</div>
    <center><input type="submit" class="btn btn-success" value="Créer l'offre !" /></center>
</form>
</br>
</br>
<h3><center>Mes offres PayPal</center></h3>
<?php  if(isset($paypalOffres) AND !empty($paypalOffres)){ ?>
<center><div style="width: 50%" class="alert alert-dismissable alert-success">
    <center>Vous pouvez avoir une multitude d'offres paypal, vous pourrez gérer ces offres en les modifiants ou les supprimant !</center>
</div></center>
<ul class="nav nav-tabs">
<?php for($i = 0; $i < count($paypalOffres) ; $i++)   { ?>
  <li <?php if($i == 0) echo 'class="active"'; ?>><a href="#payementPaypal<?php echo $i; ?>" data-toggle="tab">Offre #<?php echo $i; ?></a></li>
<?php } ?>
</ul>

<!-- Tab panes -->
<div class="tab-content">
<?php for($i = 0; $i < count($paypalOffres) ; $i++)   { ?>
<div class="tab-pane well <?php if($i == 0) echo 'active'; ?>" id="payementPaypal<?php echo $i; ?>">
    <form class="form-horizontal default-form" method="post" action="?&action=modifierOffrePaypal&id=<?php echo $paypalOffres[$i]['id']; ?>">
	    <div class="form-group">
		    <label class="col-sm-4 control-label">Titre de l'offre</label>
		    <div class="col-sm-8">
			    <input style="width: 50%" type="text" name="nom" value="<?php echo $paypalOffres[$i]['nom']; ?>" class="form-control" placeholder="ex: 5€ - 1500Jetons" >
		    </div>
	    </div>
	    <div class="form-group">
		    <label class="col-sm-4 control-label">Message de l'offre</label>
		    <div class="col-sm-8">
			    <input style="width: 50%" type="text" name="description" value="<?php echo $paypalOffres[$i]['description']; ?>" class="form-control" placeholder="ex: < img src=... / >" >
		    </div>
	    </div>
	    <div class="form-group">
		    <label class="col-sm-4 control-label">Prix de l'offre</label>
		    <div class="col-sm-8">
			    <input style="width: 50%" type="number" name="prix" value="<?php echo $paypalOffres[$i]['prix']; ?>" class="form-control" placeholder="ex: 5" >
		    </div>
	    </div>
	    <div class="form-group">
		    <label class="col-sm-4 control-label">Jetons donnés</label>
		    <div class="col-sm-8">
			    <input style="width: 50%" type="number" name="jetons_donnes" value="<?php echo $paypalOffres[$i]['jetons_donnes']; ?>" class="form-control" placeholder="ex: 1500" >
		    </div>
	    </div>
        <center><a href="?&action=supprimerPaypalOffre&id=<?php echo $paypalOffres[$i]['id']; ?>" class="btn btn-danger">Supprimer</a></center>
        </br>
        <center><input type="submit" class="btn btn-success" value="Modifier Les changements !" /></center>
    </form>    
	</br>
	</br>
</div>
<?php } echo '</div>';  } else echo '<div class="alert alert-dismissable alert-success">Vous devez créer une offre paypal !</div>'; ?> 
