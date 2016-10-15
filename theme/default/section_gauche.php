<section>
<?php for($i = 0; $i < count($_Widgets_['Widgets']); $i++) { ?>
	
	<?php if((
		$_Widgets_['Widgets'][$i]['type'] != 0 OR isset($_Joueur_)	)
		AND $_Widgets_['Widgets'][$i]['type'] != 2 	
		AND ( $_Widgets_['Widgets'][$i]['type'] != 1 OR !$tousDown ) ){ ?>

	<div class="widget">
		<h4><?php echo $_Widgets_['Widgets'][$i]['titre']; ?></h4>
		<div class="content_widget <?php if($_Widgets_['Widgets'][$i]['type'] == 1) echo 'players'; ?>">
			<?php if($_Widgets_['Widgets'][$i]['type'] == 0) { ?>
				<ul class="nav nav-pills nav-stacked">
					  <?php
					if($_Joueur_['rang'] == 1)
						echo '<li class="active"><a href="admin.php"><span class="glyphicon glyphicon-cog"></span> Administration</a></li>';
					
					?>
					<li><a href="?&page=profil&profil=<?php echo $_Joueur_['pseudo']; ?>"><span class="glyphicon glyphicon-pencil"></span> Mon Profil</a></li>
					<li><a href="?&page=token"><span class="glyphicon glyphicon-euro"></span> Acheter des Jetons</a></li>
					<li><a href="?&action=deco"><span class="glyphicon glyphicon-off"></span> Deconnexion</a></li>
				</ul>
				<p class="gestionCompteInfos">J'ai <?php echo $_Joueur_['tokens']; ?> Jeton<?php if($_Joueur_['tokens'] > 1) { echo 's'; } ?>.</p>
				
				<?php } elseif($_Widgets_['Widgets'][$i]['type'] == 1){ 
					for($j = 0; $j < count($lecture['Json']); $j++)
					{
						if($conEtablie[$j] == true)
						{
							foreach($serveurStats[$j]['joueurs'] as $cle => $element)
							{ 
							?>
								<a href="?&page=profil&profil=<?php echo $serveurStats[$j]['joueurs'][$cle]; ?>" class="icon-player">
								<?php echo '<img src="http://cravatar.eu/helmhead/' .$serveurStats[$j]['joueurs'][$cle]. '/56.png" title="Voir le profil de ' .$serveurStats[$j]['joueurs'][$cle]. '">'; ?>
								</a>
							<?php 
							}
						}					
					}	
				 } elseif($_Widgets_['Widgets'][$i]['type'] == 3) 
				 	echo $_Widgets_['Widgets'][$i]['message']; ?>
		</div>
	</div>

	<?php } ?>

<?php } ?>
</section>