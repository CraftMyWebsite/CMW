<style>
	section {
		display: none;
	}
</style>
<?php if(isset($_GET['id']) AND isset($_Joueur_))
{
	if(!isset($_GET['id_sous_forum']))
	{
		$id = $_GET['id'];
		$categorie = $bddConnection->prepare('SELECT nom AS nom FROM cmw_forum_categorie WHERE id = :id');
		$categorie->execute(array(
			'id' => $id
		));
		$categoried = $categorie->fetch();
		$sousforum = $bddConnection->prepare('SELECT * FROM cmw_forum_sous_forum WHERE id_categorie = :id_categorie');
		$sousforum->execute(array(
			'id_categorie' => $id
		));
		$sousforumd = $sousforum->fetch();
		?><div class="container"><ol class="breadcrumb" style="font-size: 30px;">
		  <li><a href="/">Accueil</a></li>
		  <li><a href="?page=forum">Forum</a></li>
		  <li class="active"><?php echo $categoried['nom']; ?></li>
		</ol><?php
		if(!empty($sousforumd['id']))
		{
		?>
		<h3>Les sous-Catégories de <?php echo $categoried['nom']; ?></h3>
		<table class="table table-striped">
			<tr>
				<th></th>
				<th>Nom</th>
				<th>Description</th>
				<?php if($_Joueur_['rang'] == 1)
				{
					?><th>Actions</th><?php 
				} ?>
			</tr>
			<?php
			$sousforum->execute(array(
				'id_categorie' => $id 
			));
			while($sousforumd = $sousforum->fetch())
			{
				?>
			<tr>
				<td><?php if($sousforumd['img'] == NULL) { ?><a href="<?php echo $_Serveur_['General']['url']; ?>?&page=forum_categorie&id=<?php echo $id; ?>&id_sous_forum=<?php echo $sousforumd['id']; ?>"><i class="material-icons">chat</i></a><?php }
					else { ?><a href="<?php echo $_Serveur_['General']['url']; ?>?page=forum_categorie&id=<?php echo $id; ?>&id_sous_forum=<?php echo $sousforumd['id']; ?>"><i class="material-icons"><?php echo $sousforumd['img']; ?></a><?php }?></td>
				<td><a href="<?php echo $_Serveur_['General']['url']; ?>?&page=forum_categorie&id=<?php echo $id; ?>&id_sous_forum=<?php echo $sousforumd['id']; ?>"><?php echo $sousforumd['nom']; ?></a></td>	
				<td><?php if(isset($sousforumd['description']) AND $sousforumd['description'] != NULL) { ?><a href="<?php echo $_Serveur_['General']['url']; ?>?&page=forum_categorie&id=<?php echo $id; ?>&id_sous_forum=<?php echo $sousforumd['id']; ?>"><?php echo $sousforumd['description']; ?></a><?php } ?></td>
				<?php if($_Joueur_['rang'] == 1)
				{
					?><td><a href="?action=remove_sf&id_cat=<?php echo $id; ?>&id_sf=<?php echo $sousforumd['id']; ?>">Supprimer le Sous-Forum</a></td><?php 
				} ?>
			</tr>
			<?php 
			} 
			?>
		</table>
		<?php 
		}
		if($_Joueur_['rang'] == 1)
		{
			?>
			<div class="col-md-offset-8 col-md-4">
				<a class="btn btn-primary" role="button" data-toggle="collapse" href="#sous_cat" aria-expanded="false" aria-controls="collapseExample">
				  Créez une sous-catégorie
				</a>
			</div>
				<div class="collapse" id="sous_cat">
					<div class="well">
						<form action="?action=create_sf" method="post">
							<div class="row">
								<div class="col-md-6">
									<input type="hidden" name="id_categorie" value="<?php echo $id; ?>" />
									<label class="control-label" for="nom">Nom</label>
									<input type="text" require class="form-control" name="nom" id="nom" maxlength="40" />
								</div>
								<div class="col-md-6">	
									<label class="control-label" for="img">Material icône : <a href="https://design.google.com/icons" target="_blank" >https://design.google.com/icons</a></label>
									<input type="text" maxlength="300" name="img" id="img" class="form-control" />
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<label class="control-label" for="desc">Description</label>
									<textarea maxlength="300" name="desc" id="desc" require class="form-control"></textarea>
								</div>
							</div>
							<div class="row">
								<div class="col-md-offset-4 col-md-6">
									<button type="sublmit" class="btn btn-success">Créer un sous-forum</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			<?php 
		}
		?>
		<br/>
		<h3> Les topics de <?php echo $categoried['nom']; ?></h3>
		<?php 
		$count_topic2 = $bddConnection->prepare('SELECT * FROM cmw_forum_post WHERE id_categorie = :id_categorie AND sous_forum IS NULL');
		$count_topic2->bindParam(':id_categorie', $id);
		$count_topic2->execute();
		$count_topic_max2 = $count_topic2->rowCount();
		$count_topic_PerPage2 = 20;
		$count_topic_Total2 = $count_topic_max2;
		$count_topic_nbrOfPages2 = ceil($count_topic_Total2 / $count_topic_PerPage2);
		
		if(isset($_GET['page_topic']))
		{
			$page = $_GET['page_topic'];
		}
		else
		{
			$page = 1;
		}
		
		$count_topic_FirstDisplay2 = ($page - 1) * $count_topic_PerPage2;
		
		$topic = $bddConnection->prepare('SELECT * FROM cmw_forum_post WHERE id_categorie = :id_categorie AND sous_forum IS NULL LIMIT '.$count_topic_FirstDisplay2.', '.$count_topic_PerPage2.'');
		$topic->bindParam(':id_categorie', $id);
		$topic->execute();
		$topicd = $topic->fetch();
		if(isset($topicd['id']))
		{
			?>
			<table class="table table-striped">
				<tr>
					<th></th>
					<th>Nom du topic</th>
					<th>Description</th>
					<th>Dernière réponse</th>
				</tr>
				<?php 
				$topic->execute();
				while($topicd = $topic->fetch())
				{
					?>
					<tr>
						<td><?php if($_JoueurForum_->is_read($topicd['id']))
						{
							?><i class="material-icons">done</i><?php
						}
						else 
						{
							?><i class="material-icons">message</i><?php
						} ?>
						</td>
						<td><a href="<?php echo $_Serveur_['General']['url']; ?>?&page=post&id=<?php echo $topicd['id']; ?>"><?php echo $topicd['nom']; ?></a></td>
						<td><a href="<?php echo $_Serveur_['General']['url']; ?>?&page=post&id=<?php echo $topicd['id']; ?>"><?php echo $topicd['description']; ?><?php if($topicd['etat'] == 1) { echo ' Lock '; }?></a></td>
						<td><a href="<?php echo $_Serveur_['General']['url']; ?>?&page=post&id=<?php echo $topicd['id']; ?>"><?php echo $topicd['last_answer']; ?></td>
					</tr>
					<?php 
				}
				?>
			</table>
			<nav>
		<ul class="pagination"><?php
			for($i = 1; $i <= $count_topic_nbrOfPages2; $i++)
			{
                ?><li><a href="?&page=forum_categorie&id=<?php echo $id; ?>&page_topic=<?php echo $i; ?>"><?php echo $i;
                ?></a></li><?php
			} ?>    
        </ul>
	</nav>
			<?php 
		}
		else 
		{
			?>
			<div class="alert alert-warning" role="alert">
				Aucun sujet n'a été posté :( 
			</div>
			<?php
		}
	}
	elseif(isset($_GET['id_sous_forum']))
	{
		$id = $_GET['id'];
		$id_sous_forum = $_GET['id_sous_forum'];
		$sousforum = $bddConnection->prepare('SELECT * FROM cmw_forum_sous_forum WHERE id = :id');
		$sousforum->execute(array(
			'id' => $id_sous_forum
		));
		$sousforumd = $sousforum->fetch();

        $count_topic = $bddConnection->prepare('SELECT * FROM cmw_forum_post WHERE sous_forum LIKE :sous_forum');
		$count_topic->bindParam(':sous_forum', $id_sous_forum);
        $count_topic->execute();
        $count_topic_max = $count_topic->rowCount();
        $count_topic_PerPage = 20;
        $count_topic_Total = $count_topic_max;
        $count_topic_nbrOfPages = ceil($count_topic_Total / $count_topic_PerPage);

        if(isset($_GET['page_sous_forum']))
        {
            $page_topic = $_GET['page_sous_forum'];
        } else {
            $page_topic = 1;
        }

        $count_topic_FirstDisplay = ($page_topic - 1) * $count_topic_PerPage;

		$topic = $bddConnection->prepare('SELECT * FROM cmw_forum_post WHERE sous_forum LIKE :sous_forum LIMIT '.$count_topic_FirstDisplay.', '.$count_topic_PerPage.'');
		$topic->bindParam(':sous_forum', $id_sous_forum);
        $topic->execute();
		$topicd = $topic->fetch();
		
		$cat = $bddConnection->prepare('SELECT nom FROM cmw_forum_categorie WHERE id = :id');
		$cat->execute(array(
			'id' => $sousforumd['id_categorie']
		));
		$catdonnees = $cat->fetch();
		?>
		<ol class="breadcrumb" style="font-size: 30px;">
		  <li role="presentation"><a href="/">Accueil</a></li>
		  <li role="presentation"><a href="?page=forum">Forum</a></li>
		  <li role="presentation"><a href="?page=forum_categorie&id=<?php echo $sousforumd['id_categorie']; ?>"><?php echo $catdonnees['nom']; ?></a></li>
		  <li role="presentation" class="active"><?php echo $sousforumd['nom']; ?></li>
		</ol>
		<?php
		if(isset($topicd['id']))
		{
			?>
			<h3>Les topic du sous-forum <?php echo $sousforumd['nom']; ?></h3>
			<table class="table table-striped">
				<tr>
					<th></th>
					<th>Nom du topic</th>
					<th>Description</th>
					<th>Dernière réponse</th>
				</tr>
				<?php 
				$topic->closeCursor();
				$topic->execute();
				while($topicd = $topic->fetch())
				{
					?>
					<tr>
						<td><?php if($_JoueurForum_->is_read($topicd['id']))
						{
							?><i class="material-icons">done</i><?php
						}
						else 
						{
							?><i class="material-icons">message</i><?php
						} ?></td>
						<td><a href="<?php echo $_Serveur_['General']['url']; ?>?&page=post&id=<?php echo $topicd['id']; ?>"><?php echo $topicd['nom']; ?></a></td>
						<td><a href="<?php echo $_Serveur_['General']['url']; ?>?&page=post&id=<?php echo $topicd['id']; ?>"><?php echo $topicd['description']; if($topicd['etat'] == 1) { echo ' Lock '; }?></a></td>
						<td><a href="<?php echo $_Serveur_['General']['url']; ?>?&page=post&id=<?php echo $topicd['id']; ?>"><?php echo $topicd['last_answer']; ?></a></td>
					</tr>
					<?php 
				}
				?>
			</table>
    <nav>
		<ul class="pagination"><?php
			for($i = 1; $i <= $count_topic_nbrOfPages; $i++)
			{
                ?><li><a href="?&page=forum_categorie&id=<?php echo $id; ?>&id_sous_forum=<?php echo $id_sous_forum; ?>&page_sous_forum=<?php echo $i; ?>"><?php echo $i;
                ?></a></li><?php
			} ?>    
        </ul>
	</nav>
			<?php 
		}
		else 
		{
			?><h3>Aucun sujet n'a été posté encore :( </h3><?php
		}

	}
	else
	{
		?><div class="alert alert-danger" role="alert">
		Erreur : Cette page n'existe pas ! </div>
		<br/>
		<div class="alert alert-info" role="alert">
		<a href="<?php echo $_Serveur_['General']['url']; ?>?&page=forum">Revenir à l'index du forum</a></div><?php
	}

	$categorie2 = $bddConnection->prepare('SELECT * FROM cmw_forum_categorie WHERE id = :id');
	$categorie2->execute(array(
		'id' => $id
	));
	$categorie2d = $categorie2->fetch();

	// if(isset($_GET['id_sous_forum']))
	// {
		// $sousforum2 = $bddConnection->prepare('SELECT * FROM cmw_forum_sous_forum WHERE id_categorie = :id');
		// $sousforum2->execute(array(
			// 'id' => $id
		// ));
		// $sousforum2d = $sousforum2->fetch();
	// }

	?>
	<hr/>
	<!-- J'ai remplacer categorie2d par categoried, idem pour sousforum2d en sousforumd -->
	<h4>Poster un topic dans la catégorie <?php echo $categorie2d['nom']; if(isset($_GET['id_sous_forum'])) { echo ' et le sous-forum ' .$sousforumd['nom']. ''; } ?></h4>
	<form action="?&action=create_topic" method="post">
		<p>
		<input type="hidden" name="id_categorie" value="<?php echo $_GET['id']; ?>"/>
		<input type="hidden" name="sous-forum" value="<?php if(isset($_GET['id_sous_forum'])) { echo $_GET['id_sous_forum']; } else { echo 'NULL'; } ?>"/>
		<div class="form-group row">
			<label for="nom" class="col-sm-2 form-control-label">Rentrez le nom de votre sujet/topic</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="nom" name="nom" placeholder="Le titre de votre topic ici" require />
			</div>
		</div>
		<div class="form-group row">
			<label for="description" class="col-sm-2 form-control-label">Insérez une description de votre topic ( 200 caractères max ! )</label>
			<div class="col-sm-10">
				<textarea id="description" name="description" max="200" min="0" class="form-control" require ></textarea>
			</div>
		</div>
		<div class="form-group row">
			<label for="contenue" class="col-sm-2 form-control-label">Insérez le contenue de votre topic ! ( Max 15 000 caractères )</label>
			<div class="col-sm-10">
				<textarea id="contenue" name="contenue" max="15000" min="1" class="form-control" rows="10" require ></textarea>
			</div>
		</div>
		<div class="form-group row">
			<center><div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary">Poster</button>
			</div></center>
		</div>
	</form>
	</div>
	<?php 

}
else
{
	?><div class="alert alert-danger" role="alert">
	Erreur : Cette page n'existe pas ! Ou vous n'êtes pas connecter :O </div>
	<br/>
	<div class="alert alert-info" role="alert">
	<a href="<?php echo $_Serveur_['General']['url']; ?>?&page=forum">Revenir à l'index du forum</a></div><?php
} ?>