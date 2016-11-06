<style>
	section {
		display: none;
	}
</style>
<div class="container">
<?php
require('modele/forum/miseEnPage.php'); 
require('modele/forum/date.php');
if(isset($_GET['id']) AND isset($_Joueur_))
{
	$id = $_GET['id'];
	$_JoueurForum_->topic_lu($id, $bddConnection);
	$topic = $bddConnection->prepare('SELECT nom, d_edition, pseudo, contenue, DAY(date_creation) AS jour, MONTH(date_creation) AS mois, YEAR(date_creation) AS annee, id_categorie, sous_forum, last_answer, etat, id FROM cmw_forum_post WHERE id = :id');
	$topic->execute(array(
		'id' => $id
	));
	$topicd = $topic->fetch();
	if(!empty($topicd['id']))
	{
		
?>
	<ul class="nav nav-pills nav-justified">
		<?php if($_JoueurForum_->is_followed($id))
		{
			?>
			<li><a href="<?php echo $_Serveur_['General']['url']; ?>?&action=unfollow&id_topic=<?php echo $topicd['id']; ?>">Ne plus suivre cette discussion </a></li>
				<?php
		}
		else
		{
			?>
			<li><a href="<?php echo $_Serveur_['General']['url']; ?>?&action=follow&id_topic=<?php echo $topicd['id']; ?>">Suivre cette discussion</a></li>
				<?php
		}
		?>
		<li><a href="<?php echo $_Serveur_['General']['url']; ?>?&page=forum_categorie&id=<?php echo $topicd['id_categorie']; if(isset($topicd['sous_forum'])) { ?>&id_sous_forum=<?php echo $topicd['sous_forum']; } ?>">Revenir à l'index de la catégorie</a></li>
		<li><a href="<?php echo $_Serveur_['General']['url']; ?>?&page=forum">Revenir à l'index du forum</a></li>
	</ul><br/>
	<ol class="breadcrumb" style="front-size: 20px;">
		<li><a href="/">Accueil</a></li>
		<li><a href="?page=forum">Forum</a></li>
		<li><a href="?&page=forum_categorie&id=<?php echo $topicd['id_categorie']; ?>"><?php $nom = $bddConnection->prepare('SELECT nom FROM cmw_forum_categorie WHERE id = :id'); $nom->execute(array( 'id' => $topicd['id_categorie'] )); $nomd = $nom->fetch(); echo $nomd['nom']; ?></a></li>
		<?php if(isset($topicd['sous_forum'])) { ?><li><a href="?page=foum_categorie&id=<?php echo $topicd['id_categorie']; ?>&id_sous_forum=<?php echo $topicd['sous_forum']; ?>"><?php $nom = $bddConnection->prepare('SELECT nom FROM cmw_forum_sous_forum WHERE id = :id'); $nom->execute(array('id' => $topicd['sous_forum'])); $nomd = $nom->fetch(); echo $nomd['nom']; ?></a></li><?php } ?>
		<li class="active"><?php echo $topicd['nom']; ?></li>
	</ol>		
		<center><?php if(isset($_Joueur_) AND $_Joueur_['rang'] == 1) { ?>
	<div class="row">
		<div class="col-lg-8">
			<div class="dropdown">
				<button class="btn btn-link dropdown-toggle" type="button" id="Actions-Modération" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Actions de Modération .... <span class="caret"></span>
				</button>
				<ul class="dropdown-menu list-inline" aria-labeledby="Actions-Modérations">
				<?php 
					if($topicd['etat'] == 1)
					{
						?><li> <a href="<?php echo $_Serveur_['General']['url']; ?>?&action=forum_moderation&id_topic=<?php echo $id; ?>&choix=4">Ouvrir la discussion</a></li><?php
					}
					else
					{
						?><li><a href="<?php echo $_Serveur_['General']['url']; ?>?&action=forum_moderation&id_topic=<?php echo $id; ?>&choix=1">Fermer la discussion</a></li>
					<?php 
					}
					?>
					<li><a href="<?php echo $_Serveur_['General']['url']; ?>?&action=forum_moderation&id_topic=<?php echo $id; ?>&choix=2">Supprimer le topic</a></li>
					<li><a href="<?php echo $_Serveur_['General']['url']; ?>?&action=forum_moderation&id_topic=<?php echo $id; ?>&choix=3">Déplacer la discussion</a></li>
				</ul>
			</div>
		</div>
		</div><?php } ?></center>
	<h3>Sujet : <?php echo $topicd['nom']; ?></h3><br/>
	<div class="row">
		<div class="col-md-2">
		<!-- Div de droite où on met le profil de l'auteur -->
			<p> Pseudo : <?php echo $topicd['pseudo']; ?></p>
		</div>
		<div class="col-md-10">
		<!-- Contenue du topic de l'auteur -->
			<p><?php unset($contenue);
			$contenue = espacement($topicd['contenue']);
			$contenue = BBCode($contenue);
			echo $contenue;
			?></p><br/><div style="border-top: 0.5px grey solid;"></div>
			<p>Posté le <?php  echo $topicd['jour']; ?> <?php $mois = switch_date($topicd['mois']); echo $mois; ?> <?php echo $topicd['annee'];?>  <?php if($topicd['d_edition'] != NULL) { echo 'édité le '; $d_edition = explode('-', $topicd['d_edition']); echo $d_edition[2]; echo '/' .$d_edition[1]. '/' .$d_edition[0]. ''; } ?></p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
	<form action="?&action=signalement_topic" method="post">
		<input type="hidden" name="id_topic2" value='<?php echo $id; ?>' />
		<button type="submit" class="btn btn-primary">Signaler !</button>
	</form>
	</div>
	<?php if($_Joueur_['pseudo'] == $topicd['pseudo'] OR $_Joueur_['rang'] == 1)
	{
		?><div class="col-md-2"><form action="?page=edit_topic" method="post">
			<input type="hidden" name="id_topic" value="<?php echo $id; ?>" />
			<button type="submit" class="btn btn-rounded btn-default">Editer le topic</button>
		</form>
		</div><div class="col-md-2">
		<form action="?action=remove_topic" method="post">
			<input type="hidden" name="id_topic" value="<?php echo $id; ?>" />
			<a class="btn btn-round btn-default" role="button" data-toggle="collapse" href="#topic_<?php echo $id; ?>" aria-expanded="false" aria-controls="collapseExample" >
				Supprimer ce topic ? </a>
				<div class="collapse" id="topic_<?php echo $id; ?>">
					<div class="well">
						<button type="submit" class="btn btn-round btn-warning">Confirmer la suppression du topic </button>
					</div>
				</div>
		</form>
		</div><?php
	}
	?>
	</div>
	<!-- Affichage des réponses -->
	 <?php 
	
    $count = $bddConnection->prepare('SELECT id AS id FROM cmw_forum_answer WHERE id_topic LIKE :id_topic');
    $count->bindParam(':id_topic', $id);
    $count->execute();
    $count_Max = $count->rowCount();
    $count_PerPage = 20;
    $count_Total = $count_Max;
    $count_nbrOfPages = ceil($count_Total / $count_PerPage);

    if(isset($_GET['page_post']))
    {
        $page = $_GET['page_post'];
    } else {
        $page = 1;
    }

    $count_FirstDisplay = ($page - 1) * $count_PerPage;
    $answer = $bddConnection->prepare('SELECT id, id_topic, pseudo, contenue, d_edition, DAY(date_post) AS day, MONTH(date_post) AS mois, YEAR(date_post) AS annee FROM cmw_forum_answer WHERE id_topic LIKE :id_topic LIMIT '.$count_FirstDisplay.', '.$count_PerPage.'');
	$answer->bindParam(':id_topic', $id);
	$answer->execute();
	$boucle = 0;
    while($answerd = $answer->fetch())
	{ ?>
		<hr/>
		<div style="background-color: <?php if($boucle%2 == 0) { echo 'white'; } else { echo 'lightblue'; } ?>; border: 1px solid <?php 
		if($boucle%2 == 0) { echo 'white'; } else { echo 'lightblue'; } ?>; border-radius: 5px;">
		<div class="row">
			<div class="col-md-2">
				<div id="<?php echo $answerd['id']; ?>"> <!-- div de droite avec les infos joueurs -->
					<p>Pseudo : <?php echo $answerd['pseudo']; ?></p>
				</div>
			</div>
			<div class="col-md-10"> <!-- contenue de la réponse -->
			<?php// include('modele/forum/getBBCode.php'); ?>
				<p><?php $answere = $answerd['contenue'];
				$answere = espacement($answere);
				$answere = BBCode($answere);
				//$answere = preg_replace('#\[url(?:=(.+))?\](.+)\[/url\]#isU', '<a href="$1">' if(isset($2))) { '$2'; } else { '$1'; } '</a>', $answer);
				
				echo $answere;
				?></p>
				<br/><div style="border-top: 0.1px grey solid;" class="separator" ></div>
				<p><?php echo $answerd['day']; ?> <?php $answerd['mois'] = switch_date($answerd['mois']); echo $answerd['mois']; ?> <?php echo $answerd['annee']; ?> <?php if($answerd['d_edition'] != NULL){ echo 'édité le '; $d_edition = explode('-', $answerd['d_edition']); echo '' .$d_edition[2]. '/' .$d_edition[1]. '/' .$d_edition[0]. ''; } ?> </p>
			</div>
		</div>
		<div class="row">
		<div class="col-md-2">
			<form action="?&action=signalement" method="post">
				<input type="hidden" name="id_answer" value='<?php echo $answerd['id']; ?>' />
				<button type="submit" class="btn btn-primary">Signaler !</button>
			</form></div>
			<?php 
			$like = $bddConnection->prepare('SELECT * FROM cmw_forum_like WHERE id_answer = :id_answer AND Appreciation = 1');
			$like->bindParam(':id_answer', $answerd['id'], PDO::PARAM_INT);
			$like->execute();
			$countlike = $like->rowCount();
			if($countlike > 0)
			{
				if($countlike >= 3)
				{
					$ilike = 0;
					echo '<div class="col-md-2">';
					while($likedata = $like->fetch())
					{
						echo ' ';
						echo $likedata['pseudo'];
						echo ',';
						$ilike++;
					}
					echo ' aiment ça ';
					?><a href="?&page=list_like&id_answer=<?php echo $answerd['id']; ?>" title="liste des j'aimes">Liste</a></div><?php
				}
				if($countlike > 1 && $countlike < 3)
				{
					echo '<div class="col-md-2">';
					while($likedata = $like->fetch())
					{
						echo ' ';
						echo $likedata['pseudo'];
						echo ',';
					}
					echo ' aiment ça </div>';
				}
				elseif($countlike == 1)
				{
					echo '<div class="col-md-2">';
					$likedata = $like->fetch();
					echo ' ';
					echo $likedata['pseudo'];
					echo ' aime ça </div>';
				}
			}
			$dislike = $bddConnection->prepare('SELECT * FROM cmw_forum_like WHERE id_answer = :id_answer AND Appreciation = 2');
			$dislike->bindParam(':id_answer', $answerd['id'], PDO::PARAM_INT);
			$dislike->execute();
			$countdislike = $dislike->rowCount();
			if($countdislike > 0)
			{
				if($countdislike > 3)
				{
					$idislike = 0;
					echo '<div class="col-md-2">';
					while($dislikedata = $dislike->fetch())
					{
						echo ' ';
						echo $dislikedata['pseudo'];
						echo ',';
						$idislike++;
					}
					echo ' n\'aiment ça';
					?><a href="?&page=list_unlike&id_answer=<?php echo $answerd['id']; ?>" title="liste des Je n'aime pas">Liste</a></div><?php
				}
				if($countdislike > 1 AND $countdislike < 3)
				{
					echo '<div class="col-md-2">';
					while($dislikedata = $dislike->fetch())
					{
						echo ' ';
						echo $dislikedata['pseudo'];
						echo ',';
					}
					echo ' n\'aiment ça </div>';
				}
				elseif($countdislike == 1)
				{
					$dislikedata = $dislike->fetch();
					echo '<div class="col-md-2"> ';
					echo $dislikedata['pseudo'];
					echo ' n\'aime pas ça</div>';
				}
			}
			$test_vote = $bddConnection->prepare('SELECT * FROM cmw_forum_like WHERE pseudo = :pseudo AND id_answer = :id_answer');
			$test_vote->execute(array(
				'pseudo' => $_Joueur_['pseudo'],
				'id_answer' => $answerd['id']
			));
			$test_votedata = $test_vote->fetch();
			if(empty($test_votedata['id']) && $_Joueur_['pseudo'] != $answerd['pseudo'])
			{
				?><div class="col-md-1">
				<form class="form-inline" action="?&action=like" method="post">
					<input type="hidden" name="choix" value="1" />
					<input type="hidden" name="id_answer" value="<?php echo $answerd['id']; ?>" />
					<button type="submit" class="btn btn-primary" title="J'aime" ><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></button>
				</form></div><div class="col-md-1">
				<form class="form-inline" action="?&action=like" method="post">
					<input type="hidden" name="choix" value="2" />
					<input type="hidden" name="id_answer" value="<?php echo $answerd['id']; ?>" />
					<button type="submit" class="btn btn-primary" title="Je n'aime pas"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></button>
				</form></div>
				<?php
			}
			elseif($_Joueur_['pseudo'] != $answerd['pseudo'] AND !empty($test_votedata['id']))
			{
				?><div class="col-md-1">
				<form class='form-inline' action="?&action=unlike" method="post">
					<input type="hidden" name="id_answer" value="<?php echo $answerd['id']; ?>" />
					<button type="submit" class="btn btn-primary" title="Ne plus aimer">Retirer</button>
				</form></div>
				<?php
			}
			if($_Joueur_['pseudo'] === $answerd['pseudo'] OR $_Joueur_['rang'] == 1)
			{
				?><div class="col-md-2"><form action="?page=edit_answer" method="post">
					<input type="hidden" name="id_answer" value="<?php echo $answerd['id']; ?>" />
					<button type="submit" class="btn btn-default">Editer ce message</button>
				</form></div><div class="col-md-2">
				<form action="?action=remove_answer" method="post">
					<input type="hidden" name="id_answer" value="<?php echo $answerd['id']; ?>" />
					<input type="hidden" name="page" value="<?php if(isset($_GET['page_post'])) { echo $_GET['page_post']; } else { echo '1'; }?>" />
					<a role="button" class="btn btn-primary" data-toggle="collapse" href="#answer_<?php echo $answerd['id']; ?>" aria-expanded="false" aria-controls="collapseExample">
						Supprimer ce message ? </a>
						<div class="collapse" id="answer_<?php echo $answerd['id']; ?>">
							<div class="well">
								<button type="submit" class="btn btn-round btn-warning">Confirmer </button>
							</div>
						</div>
				</form></div><?php
			}
			?>
		</div></div><?php 
		$boucle++;
	}

	?>
	<nav>
		<ul class="pagination"><?php
			for($i = 1; $i <= $count_nbrOfPages; $i++)
			{
                ?><li><a href="?&page=post&id=<?php echo $id; ?>&page_post=<?php echo $i; ?>"><?php echo $i;
                ?></a></li><?php
			} ?>    
        </ul>
	</nav>
	 <br/><?php 
	 
	 if($topicd['etat'] == 1)
	 {
		 ?><div class="alert alert-info" role="alert">Le topic est fermé ! Aucune réponse n'est possible ! </div><?php 
	 }
	 elseif($topicd['etat'] == 0)
	 {
		 ?><hr/><div class="separator" style="border-top: 1px solid black;"></div>
	<form action="?&action=post_answer" method="post">
		<p>
		<input type='hidden' name="id_topic" value="<?php echo $id; ?>"/>
		<div class="form-group row">
			<label for="contenue" class="col-sm-2 form-control-label">Contenue de votre réponse ( 10 000 caractères max ! ) : </label>
			<div class="col-sm-10">
				<textarea class="form-control" name="contenue" id="contenue" max="10 000" min="1" require ></textarea>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary">Poster votre réponse</button>
			</div>
		</div>
		</p>
	</form>
	<?php 
	 }
}
else
{
	?><script>
		document.location.href="?page=forum";
		</script><?php
}
}

?></div>