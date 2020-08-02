<header class="heading-pagination">
	<div class="container-fluid">
		<h1 class="text-uppercase wow fadeInRight" style="color:white;">Messagerie</h1>
	</div>
</header>
<section class="layout" id="page">
	<div class="container">	
		<div class="categories-edit">
			<ul class="nav nav-tabs" id="modifProfil">
				<li class="col-md-12"><a class="btn btn-primary btn-block" style="margin-bottom: 15px" data-toggle="modal" data-backdrop="static" href="#modalRep"><center>Nouveau message</center></a></li>
			</ul>
		</div>
		<div class="tab-content">
			<div class="tab-pane active" style="margin-top: 10px;" id="infos">
				<?php
				$Messagerie = new Messagerie($bddConnection, $_Joueur_['pseudo']);
				$messages = $Messagerie->getConversations();
				if(!empty($messages['conv']))
				{
					?>
					<h3 class="text-center" style="margin-bottom: 15px;">Vous avez <?=$messages['nbConversations'];?> conversations</h3>
					<div id="accordion">
						<?php echo $messages['conv'];?>
						</div>
						<br>
						<nav aria-label="Pages Conversation">
						  <ul class="pagination" style="float: right;">
						  	<?php
						  	for($i = 1; $i <= $messages['nbPages']; $i++)
						  	{
						  		echo '<li class="page-item"><a class="page-link" onClick="getConversations('.$i.');">'.$i.'</a></li>';
						  	}
							?>
						  </ul>
						</nav>
					<?php 
				}
				?>
			</div>
	</div>
</section>