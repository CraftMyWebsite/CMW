<style>

.animate-top{
	position:relative;
	animation:animatetop 0.5s;
}
@keyframes animatetop{
	from{
		opacity:0;
	} to {
		opacity:1;
	}
}

.circle-container {
	display: flex;
	align-items: center;
	justify-content: center;
	width: 100%;
	height: 100vh;
}

.circle-r-progress-bar > circle {
	stroke-dashoffset: 0;
	transition: stroke-dashoffset 0.25s ease;
	stroke: #D3D3D3;
	stroke-width: 20px;
}

.circle-r-progress-bar > .circle-bar {
	stroke: <?php echo  $configFile["color"]["panel"]["main"]; ?>;
	stroke-linecap: round;
}

.circle-btn {
	display: inline-block;
	padding: 0 10px;
	height: 25px;
	line-height: 23px;
	color: #a2b5bf;
	font-size: 11px;
	text-transform: uppercase;
	background: transparent;
	border: 1px solid #a2b5bf;
	border-radius: 3px;
	transition: 0.3s all;
	outline: 0;
	cursor: pointer;
}

.circle-btn:hover,
.circle-btn:focus {
	color: #e60000;
	border-color: #e60000;
}

.circle-wrapper {
	position: relative;
	display: inline-block;
}
.circle-parent {
	-webkit-box-align:center;
    -webkit-box-pack:center;
    display:-webkit-box;
}

.circle-wrapper > .circle-inner-wrapper {
	position: absolute;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	text-align: center;
	transform: translateY(30%);
}


.circle-wrapper .circle-text {
	font-weight: bold;
	margin-top: 5px;
	margin-bottom: 10px;
	color: #a2b5bf;
}
</style>
<div class="cmw-page-content-header"><strong>Gestion</strong> - NewsLetter</div>
<div class="row">
	<?php if(!Permission::getInstance()->verifPerm('PermsPanel', 'newsletter', 'actions', 'send')) { ?>
	<div class="col-md-12 text-center">
		<div class="alert alert-danger">
			<strong>Vous avez aucune permission pour accéder aux newsletter.</strong>
		</div>
	</div>
	<?php } else {?>
	<div class="col-md-6">
		<div class="panel panel-default cmw-panel">
			<div class="panel-heading cmw-panel-header">
					<?php $news = $bddConnection->query('SELECT * FROM cmw_users WHERE newsletter = 1');?>
				<h3 class="panel-title"><strong>Liste des utilisateur recevant la newsletter |Total:<?= $news->rowCount()?> <?= ( 10 < $news->rowCount()) ? '</strong><span id="idtab" style="float:right">1</span>' : '';?></h3>
			</div>
			<div class="panel-body">
				<div class="row animate-top" id="BlockCircle" style="display:none;">
					<div class="col-12 col-md-6" style="text-align:center;">
					
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
			<div class="panel-body">
				<div class="row animate-top" id="ErrorCircle" style="display:none;">
					 <ul class="list-group" id="listerror">
					  
					</ul> 
				</div>
			</div>
			<div class="panel-body">
				 <table class="table" id="tableplayer" style="margin-top:10px;">
					<tr>
						<th>Pseudo</th>
						<th>Email</th>
					</tr>
					<?php 
						$i = 0;
						while ($i < 15 && $donneesnews = $news->fetch(PDO::FETCH_ASSOC)) { $i++;?>
					<tr>
						<td><?php echo $donneesnews['pseudo']; ?></td>
						<td><?php echo $donneesnews['email']; ?></td>
					</tr>
					<?php }?>
				</table>
				
				<div style="text-align: center;">
						<button id="btnlistleft" class="btn btn-primary" OnClick="showLessTab()" style="float:left; display:none;" type="button"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
						<button id="btnlistright" class="btn btn-primary" OnClick="showMoreTab()" style="float:right; <?= ( 15 < $news->rowCount()) ? '' : 'display:none';?>" type="button"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
				</div>
			</div>
			<div class="panel-heading cmw-panel-header">
				<h3 class="panel-title"><strong> Dernière NewsLetter envoyé: <span id="lastdate"><?=(isset($_Serveur_['Mail']['last'])) ? date('d/m/Y H:i:s', $_Serveur_['Mail']['last']): 'jamais.';?></span></strong></h3>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default cmw-panel">
			<div class="panel-heading cmw-panel-header">
				<h3 class="panel-title"><strong>Envoyer une newsletter</strong></h3>
			</div>
			<div class="panel-body">

					<input id="from" type="text"  <?=(isset($_Serveur_['Mail']['from'])) ? 'value="'.$_Serveur_['Mail']['from'].'"': '';?> class="form-control" placeholder="Avec quel adresse e-mail voulez vous envoyer la newsletter" />
					
					<div class="checkbox">
						<label>
							<input id="CheckSmtp" type="checkbox" class="custom-control-input"  OnClick="if(document.getElementById('CheckSmtp').checked) { document.getElementById('BlockSmtp').style.display='block'; } else { document.getElementById('BlockSmtp').style.display='none'; }" <?=(isset($_Serveur_['SMTPNEWS']['CheckSmtp']) && $_Serveur_['SMTPNEWS']['CheckSmtp'] == 1) ? 'checked' : '' ;?>>
							Utiliser un serveur SMTP ?
						</label>
						
					</div>
					<div id="BlockSmtp" class="animate-top" <?=(isset($_Serveur_['SMTPNEWS']['CheckSmtp']) && $_Serveur_['SMTPNEWS']['CheckSmtp'] == 1) ? '' : 'style="display:none"' ;?>>
						<input type="text" id="host" class="form-control" placeholder="Serveur SMTP: exemple : smtp.google.com" <?=(isset($_Serveur_['SMTPNEWS']['Host'])) ? 'value="'.$_Serveur_['SMTPNEWS']['Host'].'"': '';?>>
						<input type="text" id="username" class="form-control" placeholder="Utilisateur SMTP: exemple : adressemail@gmail.com" <?=(isset($_Serveur_['SMTPNEWS']['Username'])) ? 'value="'.$_Serveur_['SMTPNEWS']['Username'].'"': '';?>>
						<input type="password" id="password" class="form-control" placeholder="Mot de passe SMTP: exemple: votremdpSMTP" <?=(isset($_Serveur_['SMTPNEWS']['Password'])) ? 'value="'.$_Serveur_['SMTPNEWS']['Password'].'"': '';?>>
						<div class="form-group">
							<label class="sr-only" for="exampleInputAmount">Port SMTP (exemple 587)</label>
							<div class="input-group">
							  <div class="input-group-addon">Port SMTP</div>
							  <input type="number" class="form-control" id="port" placeholder="587" <?=(isset($_Serveur_['SMTPNEWS']['Port'])) ? 'value='.$_Serveur_['SMTPNEWS']['Port']: '';?>>
							</div>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" id="protocolTls" OnClick="if(document.getElementById('protocolTls').checked) { document.getElementById('protocolSsl').checked = false; } else { document.getElementById('protocolSsl').checked = true; }" <?=(isset($_Serveur_['SMTPNEWS']['Protocol']) && $_Serveur_['SMTPNEWS']['Protocol'] == "tls") ? 'checked': '';?>>
								Protocole TLS (à cocher par défaut)
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" value="ssl" id="protocolSsl" OnClick="if(document.getElementById('protocolSsl').checked) { document.getElementById('protocolTls').checked = false; } else { document.getElementById('protocolTls').checked = true; }" <?=(isset($_Serveur_['SMTPNEWS']['Protocol']) && $_Serveur_['SMTPNEWS']['Protocol'] == "ssl") ? 'checked': '';?>>
								Protocole SSL (si vous êtes sur de vous !)
							</label>
						</div>
					</div>
					
						<div class="checkbox">
							<label>
								<input type="checkbox" class="custom-control-input" id="Memoire" <?=(isset($_Serveur_['Mail']['Memoire']) && $_Serveur_['Mail']['Memoire'] == 1 ) ? 'checked' : '';?>>
								Conserver ses informations pour une prochaine utilisation ?
							</label>
						</div>
				
					<input id="reply" type="text" <?=(isset($_Serveur_['Mail']['reply'])) ? 'value='.$_Serveur_['Mail']['reply']: '';?> id="reply"  class="form-control" placeholder="Adresse mail de réponse (laissez vide si même que celle d'envoi)">
					<input id="sujet" type="text" value="" id="sujet" class="form-control" style="margin-bottom:10px;" placeholder="Le sujet de la newsletter"/>
					<textarea id="contenuNewsLetter" style="resize: vertical;width: 100%;height: 300px; ">Votre message ! Code HTML autorisé !</textarea>
					<button class="circle-btn-start btn btn-lg btn-primary btn-block" type="button"> Envoyer</button>
					
					
					
			</div>
		</div>
	</div>
	<script type="text/javascript">
    var editor = CKEDITOR.replace( 'contenuNewsLetter' );
	

	var $circle = document.querySelector('.circle-r-progress-bar > .circle-bar');
	var $wrapper = document.querySelector('.circle-wrapper');
	var $text = document.querySelector('.circle-wrapper > .circle-inner-wrapper > .circle-text');
	var $btn = document.querySelector('.circle-wrapper > .circle-inner-wrapper > .circle-increment-btn');
	var $btnstart = document.querySelector('.circle-btn-start');
	var $pourcent = document.querySelector('.circle-text');
	var $start = false;
	var $Error=0;
	var $Sucess=0;
	var $ListError=[];
	var $indexMailPlayer = 0;
	
	var stopRequest = false;
					<?php $news = $bddConnection->query('SELECT * FROM cmw_users WHERE newsletter = 1');?>
	var allEMail = [ <?php while ($donneesnews = $news->fetch(PDO::FETCH_ASSOC)) { echo '"'.$donneesnews['email'].'",'; } ?> "null"];
					<?php $news = $bddConnection->query('SELECT * FROM cmw_users WHERE newsletter = 1');?>
	var allSpeudo = [ <?php while ($donneesnews = $news->fetch(PDO::FETCH_ASSOC)) { echo '"'.$donneesnews['pseudo'].'",'; } ?> "null"];
	var indexListPlayer = 0;
	
	function showMoreTab() {
		indexListPlayer++;
		showTab(indexListPlayer);
	}
	
	function showLessTab() {
		indexListPlayer--;
		showTab(indexListPlayer);
	}
	
	function showTab(index) {
		var content = "<tr><th>Pseudo</th><th>Email</th></tr>";
		for(let i = index * 15; i < ((index * 15 +15) < allEMail.length -1 ? (index * 15 +15) : allEMail.length -1); i++)
		{
			content = content + "<tr><td>"+allSpeudo[i]+"</td><td>"+allEMail[i]+"</td></tr>";
		}
		document.getElementById('tableplayer').innerHTML = content;
		document.getElementById('btnlistleft').style.display= (0<indexListPlayer) ? 'block' : 'none';
		document.getElementById('btnlistright').style.display=((index * 15 +15) < allEMail.length -1) ? 'block' : 'none';
		document.getElementById('idtab').innerHTML = (index+1);
	}
	
	$btnstart.addEventListener('click', function(evt) {
		if(document.getElementById('CheckSmtp').checked && isNotNullAndNotif('host') & isNotNullAndNotif('username') & !isNotNullAndNotif('password') & !isNotNullAndNotif('port')) {			
		}else if(!$start && isNotNullAndNotif('from') & isNotNullAndNotif('sujet')){
			document.getElementById('from').style.border='';
			document.getElementById('sujet').style.border='';
			document.getElementById('BlockCircle').style.display='block';
			document.getElementById('ErrorCircle').style.display='none';
			document.getElementById('circle-text-8').style.display='none';
			$start = true;
			$Error=0;
			$Sucess=0;
			$indexMailPlayer = 0;
			increMail('<span style="color:#32CD32"><strong>Lancement</strong></span>', 1, 1);
			$text.innerText = '...';
			$.post("admin.php?action=newsletter",{
				from: document.getElementById('from').value,
				CheckSmtp: document.getElementById('CheckSmtp').checked ? 1 : 0,
				host: document.getElementById('host').value,
				username: document.getElementById('username').value,
				password: document.getElementById('password').value,
				port: document.getElementById('port').value,
				protocol: document.getElementById('protocolTls').checked ? "tls" : "ssl",
				Memoire: document.getElementById('Memoire').checked ? 1 : 0,
				reply: (document.getElementById('reply').value.length == 0) ? document.getElementById('from').value : document.getElementById('reply').value,
				data: 0
			},function(data, status){ 
				data = data.substring(data.indexOf('[DIV]')+5);
				document.getElementById('lastdate').innerHTML = timeConvert(data.replace("sucess", ""));
				increMail('<span style="color:#32CD32"><strong>Donnée mis à jour</strong></span>', 0, 1);
				sendMail($indexMailPlayer);
			});
		}
	});

		
	function sendMail() {
		i = $indexMailPlayer;
		if(i <= allEMail.length-2)
		{
			if(stopRequest)
			{
				stopRequest = false;
				increMail('<span style="color:#FF0000"><strong>arrêt en cours ...</strong></span>',i,allEMail.length-1);
				stopCircle();	
			}
			else if(allEMail[i] != "null") {
				$.post("admin.php?action=newsletter",{
					email: allEMail[i],
					from: document.getElementById('from').value,
					CheckSmtp: document.getElementById('CheckSmtp').checked ? 1 : 0,
					host: document.getElementById('host').value,
					username: document.getElementById('username').value,
					password: document.getElementById('password').value,
					port: document.getElementById('port').value,
					protocol: document.getElementById('protocolTls').checked ? "tls" : "ssl",
					reply: (document.getElementById('reply').value.length == 0) ? document.getElementById('from').value : document.getElementById('reply').value,
					sujet: document.getElementById('sujet').value,
					contenu: editor.getData(),
					data: 1
				},function(data, status){
					data = data.substring(data.indexOf('[DIV]')+5);
					if(data == "sucess")
					{
						increMail('<span style="color:#32CD32"><i class="fa fa-check"></i><strong> '+allEMail[i]+'</strong></span>',i+1,allEMail.length-1);
						$Sucess++;
						$indexMailPlayer++;
						sendMail($indexMailPlayer);
					} else {
						increMail('<span style="color:#FF0000"><i class="fa fa-exclamation-triangle"></i><strong> '+allEMail[i]+'</strong></span>', i+1, allEMail.length-1);
						$Error++;
						
						flag = true;
						for(let o = 0; o < $ListError.length; o++) {
							if($ListError[o] == data){
								flag = false;
							}
						}
						if(flag)
						{
							$ListError[$ListError.length] = data;
						}
						console.log(data);
						$indexMailPlayer++;
						sendMail($indexMailPlayer);
					}
				});
			}
		}else {
			stopCircle();		
		}
	}
	

	function stopCircle() {
		$start = false;
		increMail('<span style="color:#FF0000"><strong>Arrêt</strong></span>', 1, 1);
		increMail('<span style="color:#FF0000"><strong>'+$Error+' erreur(s) et '+$Sucess+' mail(s) envoyé !</strong></span>', 1, 1);
		if(0<$Error) {
			increMail('<span style="color:#FF0000; cursor:pointer;" OnClick="document.getElementById(\'ErrorCircle\').style.display=\'block\'"><strong>Cliquez pour voir les erreurs.</strong></span>', 1, 1);
			txt = "";
			for(let i = 0; i < $ListError.length; i++)
			{
				txt = txt + '<li class="list-group-item" style="border: 1px solid red">'+$ListError[i]+'</li>';
			}
			document.getElementById('listerror').innerHTML=txt;
		}
	}

	$btn.addEventListener('click', function(evt) {
		stopRequest = true;
	});


	function increMail(strg, i, max) {
		document.getElementById("circle-text-8").innerHTML = document.getElementById("circle-text-7").innerHTML;
		document.getElementById("circle-text-7").innerHTML = document.getElementById("circle-text-6").innerHTML;
		document.getElementById("circle-text-6").innerHTML = document.getElementById("circle-text-5").innerHTML;
		document.getElementById("circle-text-5").innerHTML = document.getElementById("circle-text-4").innerHTML;
		document.getElementById("circle-text-4").innerHTML = document.getElementById("circle-text-3").innerHTML;
		document.getElementById("circle-text-3").innerHTML = document.getElementById("circle-text-2").innerHTML;
		document.getElementById("circle-text-2").innerHTML = document.getElementById("circle-text-1").innerHTML;
		document.getElementById("circle-text-1").innerHTML = strg;
		var val = i*100/max;
		if(val == 0) {
			$pourcent.style.color="#a2b5bf";
		}else {
			<?php echo '$pourcent.style.color="'.$configFile["color"]["panel"]["main"].'";'; ?>
		}
		var r = $circle.getAttribute('r');
		var c = Math.PI * (r * 2);
		var pct = ((100 - val) / 100) * c;
	  
		$circle.style.strokeDashoffset = pct;
		$text.innerText = Math.round(val) + '%';
		$wrapper.setAttribute('data-percentage', val);
	}
	function timeConvert(timestamp){
	  var a = new Date(timestamp * 1000);
	  var year = a.getFullYear() ;
	  var month = a.getMonth();
	  var date = a.getDate();
	  var hour = a.getHours();
	  var min = a.getMinutes();
	  var sec = a.getSeconds();
	  var time = (date < 10 ? '0'+date : date )+ '/' +( month < 10 ? '0'+month : month)+ '/' + year + ' ' +( hour < 10 ? '0' + hour : hour )+ ':' +( min < 10 ? '0'+min : min )+ ':' + ( sec < 10 ? '0' + sec : sec);
	  return time;
	}
	function isNotNullAndNotif(el){
		if(document.getElementById(el).value.length == 0){
			document.getElementById(el).style.border='1px solid red';
			return false;
		} else {
			document.getElementById(el).style.border='';
			return true;
		}
		
	}
	
    </script>
	<?php }?>
</div>
