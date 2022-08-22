	<script>
	

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
					contenu: CK.get(get('ckeditor')).getData(),
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
			$pourcent.style.color="#a2b5bf";

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