<div class="container" style="background-color: white;margin-top: -20px;margin-bottom: -20px;border-left: 4px solid #e74c3c;border-right: 4px solid #e74c3c;">
<h1 class="titre"><center>Voter</center></h1>
				<?php
				if(isset($_GET['erreur']))
				{
					if($_GET['erreur'] == 1)
					{
						?><div class="alert alert-danger">Vous devez encore attendre <?php echo $_GET['time']; ?> avant de pouvoir voter sur ce site !<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a><script>$(".alert").alert()</script></div><?php
					}
					if($_GET['erreur'] == 2)
					{
						?><div class="alert alert-danger">Vous devez vous connecter si vous voulez gagner une récompense...<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a><script>$(".alert").alert()</script></div><?php
					}
				}
				elseif(isset($_GET['success']))
				{
					?><div class="alert alert-success">Votre récompense arrive, si vous n'avez pas vu de fenêtre s'ouvrir pour voter, la fenêtre à dû s'ouvrir derrière votre navigateur, validez le vote et profitez de votre récompense In-Game !<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a><script>$(".alert").alert()</script></div><?php
				}
				?>	

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><h4 style="color: white;"><center><?php echo $_Serveur_['General']['name']; ?> à besoin de vous !</center></h4></h3>
  </div>
  <div class="panel-body">
    <p><center><strong>
		Voter pour le serveur permet d'améliorer son référencement ! Les votes sont récompensés par des items In-Game.<br /><br /><?php if(!isset($_Joueur_)) echo '<hr><a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-warning btn-lg" ><span class="glyphicon glyphicon-user"></span> Veuillez vous connecter.</a>'; ?>
	</strong></center></p>

  </div>
</div>	

			<h3 class="header-bloc">Voter pour votre serveur :</h3>
			<div class="corp-bloc">
				<form action="?&action=voter" method="post">
				<ul class="nav nav-tabs">
                
				<?php 
                if(!isset($jsonCon) OR empty($jsonCon))
                    echo '<p>Veuillez relier votre serveur à votre site avec JsonAPI depuis le panel pour avoir les liens de votes !</p>';
                
                for($i = 0; $i < count($jsonCon); $i++) { ?>
					
					<li <?php if($i == 0) echo 'class="active"'; ?>><a href="#voter<?php echo $i; ?>" data-toggle="tab"><?php echo $lecture['Json'][$i]['nom']; ?></a></li>
					
				<?php } ?>
				</ul>
				
				
				<div class="tab-content">
				<?php for($i = 0; $i < count($jsonCon); $i++) { ?>
				
					<div class="tab-pane<?php if($i == 0) echo ' active'; ?>" id="voter<?php echo $i; ?>">  
					
                    
					<?php $k = 0; for($j = 0; $j < count($liensVotes); $j++) { if($i == $liensVotes[$j]['serveur']) {?>
						<button type="submit" class="btn btn-primary bouton-vote" name="site" value="<?php echo $j + 1; ?>" onclick="window.open('<?php echo $liensVotes[$j]['lien']; ?>','Fiche','toolbar=no,status=no,width=1350 ,height=900,scrollbars=yes,location=no,resize=yes,menubar=yes')" >
							<?php echo $liensVotes[$j]['titre']; ?>
                        </button>					
					<?php	} else{ $k++;	 } }
                        if($k == $j)    echo '</br><p>Aucun lien de vote n\'est disponible pour ce serveur...</p>';
                    ?>
					
					</div>
				
				<?php } ?>
				</div>
				
				
				</form>				
				
			</div>
			<div class="footer-bloc">
			</div>		

			<h3 class="header-bloc">Top voteurs</h3>
			<div class="corp-bloc">

				<table class="table table-hover">

					<thead>
						<tr><th>#</th><th>Pseudo</th><th>Votes</th></tr>
					</thead>
				
						<?php for($i = 0; $i < count($topVoteurs) AND $i < 10; $i++) { ?>
						<tr><td><?php echo $i ?></td><td><img src="http://api.craftmywebsite.fr/skin/face.php?u=<?php echo $topVoteurs[$i]['pseudo']; ?>&s=30&v=front" alt="none" /> <strong><?php echo $topVoteurs[$i]['pseudo']; ?></strong></td><td><?php echo $topVoteurs[$i]['nbre_votes']; ?></td></tr>
						<?php }?>
				</table>
			</div>
</div>

