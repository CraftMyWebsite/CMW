<header class="heading-pagination">
	<div class="container-fluid">
		<h1 class="text-uppercase wow fadeInRight" style="color:white;">Chat Minecraft</h1>
	</div>
</header>
<section class="layout" id="page">
	<div class="container">		
		<h3 class="header-bloc">Chat Minecraft</h3>
		<?php 
		if(count($jsonCon) >= 1)
		{
			echo '<div class="alert alert-info">Commencez par choisir le serveur ! :)</div>';
			$Chat = new Chat($jsonCon);
			?>
			<div class="tabbable">
				<ul class="nav nav-tabs" style="margin-bottom:1vh;">
				<?php
				foreach($lectureJSON as $i => $serveur)
				{
				?>
					<li class="nav-item">
						<a href="#categorie-<?php echo $i; ?>" data-toggle="tab" class="nav-link <?php if($i == 0) echo 'active'; ?>"><?php echo $serveur['nom']; ?></a>
					</li>
				<?php 
				}
				?>
				</ul>
				<div class="tab-content" id="messages">
				<?php
				for($i=0; $i < count($jsonCon); $i++)
				{
					$messages = $Chat->getMessages($i);
				?>
					<div id="categorie-<?php echo $i; ?>" class="tab-pane fade <?php if($i==0) echo 'in active show'; ?>" aria-expanded="false">
						<div class="panel-body" style="background-color: #CCCCCC;">
							<?php 
							if($messages != false && $messages != "erreur" && $messages != "query")
							{
								foreach($messages as $value)
								{
									?>
										<p class="username"><img class="rounded" src="<?=$_ImgProfil_->getUrlHeadByPseudo($value['player']);?>" style="width: 32px; height: 32px;" alt="avatar de l'auteur" title="<?php echo $value['player']; ?>" /> <?=($value['player'] == '') ? 'Console': $value['player'].', '.$_Forum_->gradeJoueur($value['player']);?> à <span class="font-weight-light"><?=date('H:i:s', $value['time']);?></span> -> <?=$Chat->formattage(htmlspecialchars($value['message']));?></p>
									<?php
								}
							}
							elseif($messages == "query")
								echo '<div class="alert alert-warning">La connexion au serveur ne peut pas être établie avec ce protocole. </div>';
							elseif($messages == "erreur")
								echo '<div class="alert alert-info">Il n\'y a pas de messages actuellement ! </div>';
							else
								echo '<div class="alert alert-danger">La connexion au serveur n\'a pas pu être établie. </div>';
							?>
						</div>
					</div>
				<?php 
				}
				?>
				</div>
			<?php 
			if(Permission::getInstance()->verifPerm("connect"))
			{
				?>
				<form action="?action=sendChat" method="POST">	
					<div class="row">
						<div class="col-md-8">
							<input type="text" name="message" placeholder="Votre message ici ! (§ et & pour les couleurs si vous y êtes autorisé)" max="100" class="form-control">
						</div>
						<div class="col-md-2">
							<select name="i" class="form-control">
								<?php 
								foreach($lectureJSON as $i => $serveur)
								{
									?><option value="<?=$i;?>"><?=$serveur['nom'];?></option><?php 
								}
								?>
							</select>
						</div>
						<div class="col-md-2">
							<button class="btn btn-success" type="submit">Envoyer :)</button>
						</div>
					</div>
				</form>
				<?php 
			}
			?>
			</div>
		<?php
		}
		?>
	</div>
</section>
<script>
	setInterval(AJAXActuChat, 10000);
	function AJAXActuChat()
	{
		<?php for($i = 0; $i < count($jsonCon); $i++)
		{
			?>if($('#categorie-<?=$i;?>').hasClass("active"))
			{
				var active = <?=$i;?>;
			}
			<?php
		}
		?>
		$.ajax({
			url: 'index.php?action=chatActu',
			type: 'POST',
			data: 'ajax=true&active='+active,
			success: function(code, statut){
				$("#messages").html(code);
			}
		});
	}
</script>