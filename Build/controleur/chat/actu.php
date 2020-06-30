<?php
if($_POST['ajax'] == true)
{
	$active = htmlspecialchars($_POST['active']);
	require('modele/forum/forum.class.php');
	$_Forum_ = new Forum($bddConnection);
	$Chat = new Chat($jsonCon);
	for($i=0; $i < count($jsonCon); $i++)
	{
		$messages = $Chat->getMessages($i);
	?>
		<div id="categorie-<?php echo $i; ?>" class="tab-pane fade <?php if($active == $i) echo 'in active show'; ?>" aria-expanded="false">
			<div class="panel-body" style="background-color: #CCCCCC">
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
					echo '<div class="alert alert-danger">La connexion au serveur n\'a pas pu être établie. :\'(</div>';
				?>
			</div>
		</div>
	<?php 
	}
}
?>