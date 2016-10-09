<div class="container">
<center>
<div class="alert alert-info" role="alert">
	Bienvenue sur le forum de <?php echo $_Serveur_['General']['name']; ?>,
	Ici vous pourrez échanger et partager avec toute la communauté du serveur ! </div>

<?php 
$forum = $bddConnection->query('SELECT * FROM cmw_forum');
while($fofo = $forum->fetch())
{ ?>
		</br><br/>
		<table class="table table-striped">
		<caption><div class="row"><div class="col-md-3"><h3><?php echo ucfirst($fofo['nom']); ?></h3></div><?php if(isset($_Joueur_) AND $_Joueur_['rang'] == 1){ ?><div class="col-md-9" style="text-align: right;"><a href="?action=remove_forum&id=<?php echo $fofo['id']; ?>" class="btn btn-danger" style="text-align: right;">Supprimer</a></div><?php } ?></div></caption>
		<thead>
			<tr>
				<th></th>
				<th>Nom</th>
				<th>Description</th>
				<th>Sous-Forum</th>
				<?php if($_Joueur_['rang'] == 1 )
				{
					?><th>Actions</th><?php
				}
				?>
			</tr>
		</thead>

<?php
unset($categorie);
unset($categorieReq);
unset($i);
$categorieReq = $bddConnection->prepare('SELECT * FROM cmw_forum_categorie WHERE forum = :forum');
$categorieReq->execute(array(
	'forum' => $fofo['id']
));
$i = 0;
while($categorieDonnees = $categorieReq->fetch())
{
    $categorie[$i]['id'] = $categorieDonnees['id'];
    $categorie[$i]['nom'] = $categorieDonnees['nom'];
    $categorie[$i]['description'] = $categorieDonnees['description'];
    $categorie[$i]['img'] = $categorieDonnees['img'];
    $categorie[$i]['sous-forum'] = $categorieDonnees['sous-forum'];
    $i++;
} ?>

    <tbody>
<?php   for($i = 0; $i < count($categorie); $i++) { ?>
            <tr>

				<td><?php if($categorie[$i]['img'] == NULL) { ?><a href="<?php echo $_Serveur_['General']['url']; ?>?&page=forum_categorie&id=<?php echo $categorie[$i]['id']; ?>"><i class="material-icons">chat</i></a><?php }
					else { ?><a href="<?php echo $_Serveur_['General']['url']; ?>?page=forum_categorie&id=<?php echo $categorie[$i]['id']; ?>"><i class="material-icons"><?php echo $categorie[$i]['img']; ?></a><?php }?></td>
				<td><a href="<?php echo $_Serveur_['General']['url']; ?>?&page=forum_categorie&id=<?php echo $categorie[$i]['id']; ?>"><?php echo $categorie[$i]['nom']; ?></a></td>
				<td><a href="<?php echo $_Serveur_['General']['url']; ?>?&page=forum_categorie&id=<?php echo $categorie[$i]['id']; ?>"><?php echo $categorie[$i]['description']; ?></a></td>
				<td><?php if(isset($categorie[$i]['sous-forum']) AND $categorie[$i]['sous-forum'] != NULL) {
							$sousforum = $bddConnection->prepare('SELECT * FROM cmw_forum_sous_forum WHERE id_categorie = :id_categorie');
							$sousforum->execute(array(
								'id_categorie' => $categorie[$i]['id']
							));
							$sousforum = $sousforum->fetch(); ?>
						<div class="dropdown">
						<button class="btn btn-default dropdown-toggle" type="button" id="sous-forum<?php echo $categorie[$i]['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="width: 99.5%;">
						Il y à <?php echo count($sousforum['id']); ?> sous-forum <?php if(count($sousforum['id']) != "0") { ?><span class="caret"></span><?php } ?>
						</button>
						<?php if(count($sousforum['id']) != "0") { ?>
						<ul class="dropdown-menu" aria-labelledby="sous-forum<?php echo $categorie[$i]['id']; ?>">
							<?php for($s = 0; $s < count($sousforum['id']); $s++) {
								?><li><a href="<?php echo $_Serveur_['General']['url']; ?>?&page=forum_categorie&id=<?php echo $categorie[$i]['id']; ?>&id_sous_forum=<?php echo $sousforum['id']; ?>"><?php echo $sousforum['nom']; ?></a></li>
							<?php } ?>
						</ul>
						<?php } ?>
						</div>
				<?php }	else { ?>
				Il n'y a pas de sous-forum
				<?php } ?>
				</td>
				<?php if(isset($_Joueur_) AND $_Joueur_['rang'] == 1)
				{
					?><td><a href="?action=remove_cat&id=<?php echo $categorie[$i]['id']; ?>">Supprimer la catégorie</a></td><?php
				}
?>
			</tr>
			<?php } ?>
	</tbody>
</table><br/><br/><br/><hr/>
<?php
}
if(isset($_Joueur_) AND $_Joueur_['rang'] == 1)
{
	?>
	<h3>Créer une catégorie : </h3>
	<div style="text-align: center">
		<form action="?action=create_cat" method="post">
			<div class="row">
				<div class="col-md-4">
					<label class="control-label" for="nom">Nom de la catégorie</label>
					<input type="text" name="nom" id="nom" maxlength="40" class="form-control" require />
				</div>
				<div class="col-md-4">
					<label class="control-label" for="img">Icon disponible sur : https://design.google.com/icons/</label>
					<input type="text" name="img" id="img" maxlength="300" class="form-control" />
				</div>
				<div class="col-md-4">
					<label class="control-label">Forum : </label>
					<select name="forum" require>
						<?php $whileforum = $bddConnection->query('SELECT * FROM cmw_forum');
						while($datawhile = $whileforum->fetch())
						{
							?><option value="<?php echo $datawhile['id']; ?>"><?php echo $datawhile['nom']; ?></option><?php
						}
						?></select>
			</div>
			<div class="row">
				<div class="col-md-8">
					<label class="control-label" for="desc">Description</label>
					<textarea maxlength="300" class="form-control" name="desc" id="desc" require ></textarea>
				</div>
			</div><br/>
			<div class="row">
				<div class="col-md-offset-2 col-md-4">
					<button type="submit" class="btn btn-success btn-lg btn-round">Créer une catégorie</button>
				</div>
			</div>
		</form>
	</div>
	
<br><hr/><a class="btn btn-primary btn-xs btn-block" role="button" data-toggle="collapse" href="#add_forum" aria-expanded="false" aria-controls="add_forum">
Ajouter un forum
</a>
<div class="collapse" id="add_forum">
	<div class="well">
		<form action="?action=create_forum" method="post">
			<div class="row">
				<div class="col-md-12">
					<label class="control-label" for="nom">Nom du forum</label>
					<input type="text" name="nom" id="nom" maxlength="80" class="form-control" require />
				</div>
			<br/>
			<div class="row">
				<div class="col-md-offset-2 col-md-4">
					<button type="submit" class="btn btn-success btn-lg btn-round">Créer un forum</button>
				</div>
			</div>
		</form>
	</div>
</div><?php

} ?>
</center>
</div>
