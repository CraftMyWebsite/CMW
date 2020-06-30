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
				if($messages != false)
				{
					foreach($messages as $value)
					{
						//var_dump($value);
						$Img = new ImgProfil($value['player'], 'pseudo');

						?>
							<p class="username"><img class="rounded" src="<?=$Img->getImgToSize(32, $width, $height);?>" style="width: <?=$width;?>px; height: <?=$height;?>px;" alt="avatar de l'auteur" title="<?php echo $value['player']; ?>" /> <?=($value['player'] == '') ? 'Console': $value['player'].', '.$_Forum_->gradeJoueur($value['player']);?> à <span class="font-weight-light"><?=date('H:i:s', $value['time']);?></span> -> <?=$Chat->formattage(htmlspecialchars($value['message']));?></p>
						<?php
					}
				}
				else
					echo '<div class="alert alert-danger">La connexion au serveur n\'a pas pu être établie. :\'(</div>';
				?>
			</div>
		</div>
	<?php 
	}
}
?>