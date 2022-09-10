<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h2 class="h2 gray">
		NewsLetter
	</h2>
</div>
<?php if(!$_Permission_->verifPerm('PermsPanel', 'newsletter', 'showPage')) 
{
	echo '
	<div class="row">
		<div class="col-md-12 text-center">
			<div class="alert alert-danger">
				<strong>Vous avez aucune permission pour accéder aux newsletter.</strong>
			</div>
		</div>
	</div>';
}
else
	{
		?>
<div class="row">
   	<div class="col-md-12 col-xl-6 col-12">
		<div class="card  ">
			<div class="card-header ">
				<h3 class="card-title"><strong>Liste des utilisateurs recevant la newsletter</strong></h3>
			</div>
			<div class="card-body">
				<div class="animate-top text-center" id="BlockCircle" style="display:none;">
					<div class="row">
						<div class="col-12 col-md-6 ">
						
							<h6 id="circle-text-1"></h6>
							<h6 id="circle-text-2"></h6>
							<h6 id="circle-text-3"></h6>
							<h6 id="circle-text-4"></h6>
							<h6 style="opacity:0.8" id="circle-text-5"></h6>
							<h6 style="opacity:0.6" id="circle-text-6"></h6>
							<h6 style="opacity:0.4" id="circle-text-7"></h6>
							<h6 style="opacity:0.2" id="circle-text-8"></h6>
						
						</div>
						<div class="col-12 col-md-6">
							<div class="circle-parent">
								<div class="circle-wrapper" data-percentage="0">
									<div class="circle-inner-wrapper">
										<h3 class="circle-text">...</h3>
										<button type="button" class="circle-increment-btn circle-btn">Stop</button>
									</div>
									<svg class="circle-r-progress-bar" width="200" height="200" viewPort="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
										<circle r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
										<circle class="circle-bar" r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
									</svg>
								</div>
							</div>
						</div>
					</div>

				</div>

				<div class="row animate-top" id="ErrorCircle" style="display:none;margin-top:15px;">
					 <ul class="list-group" id="listerror">
					  
					</ul> 
				</div>

				<table class="table table-striped table-hover" id="tableplayer" style="margin-top:15px;">
					<tr>
						<th><span style="margin-left: 20px;"></span></th>
						<th>Pseudo</th>
						<th>Email</th>
						<th>Total:<?= $news->rowCount()?> <?= ( 10 < $news->rowCount()) ? '</strong><span id="idtab" style="float:right">1</span>' : '';?></th>
					</tr>
					<?php 
						$i = 0;
						while ($i < 15 && $donneesnews = $news->fetch(PDO::FETCH_ASSOC)) { $i++;?>
					<tr>
						<td> <img src="https://api.craftmywebsite.fr/skin/face.php?u=<?php echo $donneesnews['pseudo']; ?>&s=26" class="rounded-circle imageusercard"
                                    style="max-width: 26px;max-height: 26px;margin-left: 15px;"></td>
						<td><?php echo $donneesnews['pseudo']; ?></td>
						<td><?php echo $donneesnews['email']; ?></td>
						<td></td>
					</tr>
					<?php }?>
				</table>
				<div class="text-center">
					<button id="btnlistleft" class="btn btn-primary" OnClick="showLessTab()" style="float:left; display:none;" type="button"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
					<button id="btnlistright" class="btn btn-primary" OnClick="showMoreTab()" style="float:right; <?= ( 15 < $news->rowCount()) ? '' : 'display:none';?>" type="button"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
				</div>
            </div>

			<div class="card-footer">
				<h5 class="card-title">Dernière NewsLetter envoyé: <span id="lastdate"><?=(isset($_Serveur_['Mail']['last'])) ? date('d/m/Y H:i:s', $_Serveur_['Mail']['last']): 'jamais.';?></span></h5>
			</div>
        </div>
   	</div>
   	<?php if($_Permission_->verifPerm('PermsPanel', 'newsletter', 'actions', 'send'))  { ?>
   	<div class="col-md-12 col-xl-6 col-12">
		<div class="card  ">
			<div class="card-header ">
				<h3 class="card-title"><strong>Envoyer une newsletter</strong></h3>
			</div>
			<div class="card-body">
				<label class="control-label">Adresse e-mail de l'envoie</label>
				<input id="from" type="text"  <?=(isset($_Serveur_['Mail']['from'])) ? 'value="'.$_Serveur_['Mail']['from'].'"': '';?> class="form-control" placeholder="Ex: contact@<?php echo $_Serveur_['General']['name']; ?>.fr" />
				<div class="custom-control custom-switch" style="padding-top: 20px">
					<input type="checkbox" class="custom-control-input" id="CheckSmtp" name="CheckSmtp" OnClick="if(get('CheckSmtp').checked) { show('BlockSmtp'); } else { hide('BlockSmtp'); }" <?=(isset($_Serveur_['SMTPNEWS']['CheckSmtp']) && $_Serveur_['SMTPNEWS']['CheckSmtp'] == 1) ? 'checked' : '' ;?>>
					<label class="custom-control-label" for="CheckSmtp">Utiliser un serveur SMTP ?</label>
				</div>

					<div id="BlockSmtp" class="animate-top" style="<?=(isset($_Serveur_['SMTPNEWS']['CheckSmtp']) && $_Serveur_['SMTPNEWS']['CheckSmtp'] == 1) ? '' : 'display:none;' ;?>margin-top:20px;">

						<label class="control-label">Serveur SMTP</label>
						<input type="text" id="host" class="form-control" placeholder="Ex: smtp.google.com" <?=(isset($_Serveur_['SMTPNEWS']['Host'])) ? 'value="'.$_Serveur_['SMTPNEWS']['Host'].'"': '';?>>

						<label class="control-label">Utilisateur SMTP</label>
						<input type="text" id="username" class="form-control" placeholder="Ex: adressemail@gmail.com" <?=(isset($_Serveur_['SMTPNEWS']['Username'])) ? 'value="'.$_Serveur_['SMTPNEWS']['Username'].'"': '';?>>

						<label class="control-label">Mot de passe SMTP</label>
						<input type="password" id="password" class="form-control" placeholder="Ex: votremdpSMTP" <?=(isset($_Serveur_['SMTPNEWS']['Password'])) ? 'value="'.$_Serveur_['SMTPNEWS']['Password'].'"': '';?>>

						<label class="control-label">Port SMTP</label>
						<input type="number" class="form-control" id="port" placeholder="587" <?=(isset($_Serveur_['SMTPNEWS']['Port'])) ? 'value='.$_Serveur_['SMTPNEWS']['Port']: '';?>>


						<div class="custom-control custom-switch" style="padding-top: 20px">
							<input type="checkbox" value="tls" class="custom-control-input" id="protocolTls" name="protocolTls" OnClick="if(get('protocolTls').checked) { get('protocolSsl').checked = false; } else { get('protocolSsl').checked = true; }" <?=(isset($_Serveur_['SMTPNEWS']['Protocol'])) ? ($_Serveur_['SMTPNEWS']['Protocol'] == 'tls' ? 'checked': '') : 'checked';?>>
							<label class="custom-control-label" for="protocolTls">Protocole TLS (à cocher par défaut)</label>
						</div>

						<div class="custom-control custom-switch" style="padding-top: 20px">
							<input type="checkbox" value="ssl" class="custom-control-input" id="protocolSsl" name="protocolSsl" OnClick="if(get('protocolSsl').checked) { get('protocolTls').checked = false; } else { get('protocolTls').checked = true; }" <?=(isset($_Serveur_['SMTPNEWS']['Protocol']) && $_Serveur_['SMTPNEWS']['Protocol'] == 'ssl') ? 'checked': '';?>>
							<label class="custom-control-label" for="protocolSsl">Protocole SSL (si vous êtes sur de vous !)</label>
						</div>
					</div>

						<div class="custom-control custom-switch" style="padding-top: 20px">
							<input type="checkbox" value="ssl" class="custom-control-input" id="Memoire" name="Memoire" <?=(isset($_Serveur_['Mail']['Memoire']) && $_Serveur_['Mail']['Memoire'] == 1 ) ? 'checked' : '';?>>
							<label class="custom-control-label" for="Memoire">Conserver ses informations pour une prochaine utilisation ?</label>
						</div>

						<label class="control-label">Adresse mail de réponse (laissez vide si même que celle d'envoi)</label>
						<input id="reply" type="text" <?=(isset($_Serveur_['Mail']['reply'])) ? 'value='.$_Serveur_['Mail']['reply']: '';?> id="reply"  class="form-control" placeholder="Ex: contact@<?php echo $_Serveur_['General']['name']; ?>.fr">

						<label class="control-label">Le sujet de la newsletter</label>
						<input id="sujet" style="margin-bottom:20px;" type="text" value="" id="sujet" class="form-control" />

						<textarea id="ckeditor" data-UUID="0011">Votre message ! Code HTML autorisé !</textarea>
		</div>
		<div class="card-footer">
	        <div class="row text-center">
	            <button type="button" class="circle-btn-start btn btn-success w-100" >Envoyer la newsletter !</button>
	        </div>
	    </div>
	</div>
	</div>
<?php } ?>
</div>

<br/>
	<?php if($_Permission_->verifPerm('PermsPanel', 'newsletter', 'showPage')) { include('./admin/assets/js/newsletter.php'); }
	}
?>
