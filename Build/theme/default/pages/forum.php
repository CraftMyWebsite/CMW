<header class="heading-pagination">
	<div class="container-fluid">
		<h1 class="text-uppercase wow fadeInRight" style="color:white;">Forum</h1>
	</div>
</header>
<section class="layout" id="page">
<div class="container">
<div class="alert alert-info" role="alert">
	Bienvenue sur le forum de <?php echo $_Serveur_['General']['name']; ?>,
	Ici vous pourrez échanger et partager avec toute la communauté du serveur ! </div>
<?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['modeJoueur'] == true)
 	{
 		?>
 			<p class="text-center">
 				<a href="?action=mode_joueur" class="btn btn-primary">Passer en mode visuel <?php echo ($_SESSION['mode']) ? "Administrateur" : "Joueur"; ?></a>
 			</p>
 		<?php 
 	}
$fofo = $_Forum_->affichageForum();
for($i = 0; $i < count($fofo); $i++)
{ 
	if($_PGrades_['PermsDefault']['forum']['perms'] >= $fofo[$i]['perms'] OR ($_Joueur_['rang'] == 1 AND !$_SESSION['mode']) OR $fofo[$i]['perms'] == 0)
	{
	?>
		<br><br/>
		<table class="table table-striped">
		<div class="row"><?php if(isset($_Joueur_) AND ($_PGrades_['PermsForum']['general']['deleteForum'] == true OR $_Joueur_['rang'] == 1) AND !$_SESSION['mode']){ ?>
		<div class="col-md-6 offset-md-6" style="text-align: right;">
			<div class="dropdown" style="display: inline;">
			  <button class="btn btn-info dropdown-toggle" type="button" id="ordreforum<?=$fofo[$i]['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Modifier l'ordre
			  </button>
			  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
			    <a class="dropdown-item" href="?action=ordreForum&ordre=<?=$fofo[$i]['ordre']; ?>&id=<?=$fofo[$i]['id']; ?>&modif=monter"><i class="fas fa-arrow-up"></i> Monter d'un cran</a>
			    <a class="dropdown-item" href="?action=ordreForum&ordre=<?=$fofo[$i]['ordre']; ?>&id=<?=$fofo[$i]['id']; ?>&modif=descendre"><i class="fas fa-arrow-down"></i> Descendre d'un cran</a>
			  </div>
			<a href="?action=remove_forum&id=<?php echo $fofo[$i]['id']; ?>" class="btn btn-danger" style="text-align: right;">Supprimer</a>
			</div>
			<a class="btn btn-info" data-toggle="modal" href="#NomForum" data-entite="0" data-nom="<?=$fofo[$i]['nom'];?>" data-id="<?=$fofo[$i]['id'];?>"><i class="fas fa-font"></i></a>
			<div class="dropdown" style="display: inline;">
				<button class="btn btn-info dropdown-toggle" type="button" id="perms<?=$fofo[$i]['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Modifier les Permissions
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<form action="?action=modifPermsForum" method="POST">
						<input type="hidden" name="id" value="<?=$fofo[$i]['id'];?>" />
						<a class="dropdown-item"><input type="number" name="perms" value="<?=$fofo[$i]['perms'];?>" class="form-control"></a>
						<button type="submit" class="dropdown-item text-center">Modifier</button>
					</form>
				</div>
			</div>
		</div><?php } ?></div>
		<thead>
			<tr>
				<th colspan="5" style="width: <?=(($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['deleteCategorie'] == true) AND !$_SESSION['mode']) ? '75%' : '100%';?>;"><h3 class="text-center"><?php echo ucfirst($fofo[$i]['nom']); ?></h3></th>
				<?php if(($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['deleteCategorie'] == true) AND !$_SESSION['mode'])
				{
					?><th>Actions</th>
					<?php
				}
				?>
			</tr>
		</thead>
<?php
$categorie = $_Forum_->infosForum($fofo[$i]['id']);
?>

    <tbody>
<?php   for($j = 0; $j < count($categorie); $j++) { 
			
			$derniereReponse = $_Forum_->derniereReponseForum($categorie[$j]['id']);
			if(($_Joueur_['rang'] == 1 AND !$_SESSION['mode']) OR $_PGrades_['Permsdefault']['forum']['perms'] >= $categorie[$j]['perms'] OR $categorie[$j]['perms'] == 0)
			{
			?>
            <tr>

				<td style="width: 3%;"><?php if($categorie[$j]['img'] == NULL) { ?><a href="?&page=forum_categorie&id=<?php echo $categorie[$j]['id']; ?>"><i class="material-icons">chat</i></a><?php }
					else { ?><a href="?page=forum_categorie&id=<?php echo $categorie[$j]['id']; ?>"><i class="material-icons"><?php echo $categorie[$j]['img']; ?></i></a><?php }?></td>
				<td style="width: 32%;"><a href="?&page=forum_categorie&id=<?php echo $categorie[$j]['id']; ?>"><?php echo $categorie[$j]['nom']; ?></a>
				<?php 	if($_Joueur_['rang'] == 1 AND !$_SESSION['mode'])
							$perms = 100;
						elseif($_PGrades_['PermsDefault']['forum']['perms'] > 0)
							$perms = $_PGrades_['PermsDefault']['forum']['perms'];
						else
							$perms = 0;

				$sousforum = $bddConnection->prepare('SELECT * FROM cmw_forum_sous_forum WHERE id_categorie = :id_categorie AND perms <= :perms');
							$sousforum->execute(array(
								'id_categorie' => $categorie[$j]['id'],
								'perms' => $perms
							));
							$sousforum = $sousforum->fetchAll(); 
							if(count($sousforum) != 0)
							{ ?><br/><small>
						<div class="dropdown">
						<a class="dropdown-toggle" href="sous-forum<?php echo $categorie[$j]['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="width: 99.5%;">
						Sous-forum  :<?php echo count($sousforum); ?>
						</a>
						<?php if(count($sousforum) != "0") { ?>
						<div class="dropdown-menu" aria-labelledby="sous-forum<?php echo $categorie[$j]['id']; ?>">
							<?php for($s = 0; $s < count($sousforum); $s++) {
								?><a class="dropdown-item" href="?&page=forum_categorie&id=<?php echo $categorie[$j]['id']; ?>&id_sous_forum=<?php echo $sousforum[$s]['id']; ?>"><?php echo $sousforum[$s]['nom']; ?></a>
							<?php } ?>
						</div>
						<?php } ?>
						</div></small>
				<?php } ?>
				</td>
			<td class="text-center"><a href="?&page=forum_categorie&id=<?php echo $categorie[$j]['id']; ?>"><?php echo $CountTopics = $_Forum_->compteTopicsForum($categorie[$j]['id']); ?><br/><span class="text-uppercase">Discussions</span></a></td>
			<td class="text-center"><a href="?page=forum_categorie&id=<?=$categorie[$j]['id']; ?>"><?=$_Forum_->compteMessages($categorie[$j]['id']) + $CountTopics; ?><br/><span class="text-uppercase">Messages</span></a></td>
			<td class="text-center"><?php if($derniereReponse) { ?> 
					<a href="?page=post&id=<?php echo $derniereReponse['id']; ?>" title="<?=$derniereReponse['titre'];?>">Dernier: <?php $taille = strlen($derniereReponse['titre']);
					echo substr($derniereReponse['titre'], 0, 15);
					if(strlen($taille > 15)){ echo '...'; } ?><br/><?=$derniereReponse['pseudo'];?>, Le <?php $date = explode('-', $derniereReponse['date_post']); echo '' .$date[2]. '/' .$date[1]. '/' .$date[0]. ''; ?></a>
			<?php
				}
				else { ?><p> Il n'y a pas de sujet dans ce forum </p> <?php } 
				?></td>
			<?php
				if(isset($_Joueur_) AND ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['deleteCategorie'] == true) AND !$_SESSION['mode'])
				{
					?><td><a href="?action=remove_cat&id=<?php echo $categorie[$j]['id']; ?>" style="text-align: left;"><i class="fas fa-trash-alt"></i></a>
					<div class="dropdown" style="display: inline; text-align: center;">
						<button type="button" class="btn btn-info dropdown-toggle" id="Perms<?=$categorie[$j]['id'];?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-edit"></i>
						</button>
						<div class="dropdown-menu">
							<form action="?action=modifPermsCategorie" method="POST">
								<input type="hidden" name="id" value="<?=$categorie[$j]['id'];?>" />
								<a class="dropdown-item"><input type="number" name="perms" value="<?=$categorie[$j]['perms'];?>" class="form-control"></a>
								<button type="submit" class="dropdown-item text-center">Modifier</button>
							</form>
						</div>
					</div>
					<a class="btn btn-info" data-toggle="modal" href="#NomForum" data-entite="1" data-nom="<?=$categorie[$j]['nom'];?>" data-icone="<?=($categorie[$j]['img'] == NULL) ? 'chat' : $categorie[$j]['img'];?>" data-id="<?=$categorie[$j]['id'];?>"><i class="fas fa-font"></i></a>
					<div class="dropdown" style="display: inline; text-align: center;">
						<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-list"></i>
						</button>
						<div class="dropdown-menu">
						    <a class="dropdown-item" href="?action=ordreCat&ordre=<?=$categorie[$j]['ordre']; ?>&id=<?=$categorie[$j]['id']; ?>&forum=<?=$categorie[$j]['forum'];?>&modif=monter"><i class="fas fa-arrow-up"></i> Monter d'un cran</a>
						    <a class="dropdown-item" href="?action=ordreCat&ordre=<?=$categorie[$j]['ordre']; ?>&id=<?=$categorie[$j]['id']; ?>&forum=<?=$categorie[$j]['forum'];?>&modif=descendre"><i class="fas fa-arrow-down"></i> Descendre d'un cran</a>
						</div>
					</div>
					<a href=<?php if($categorie[$j]['close'] == 0) { ?>"?action=lock_cat&id=<?=$categorie[$j]['id'];?>&lock=1" title="Fermer le forum"><i class="fa fa-unlock-alt"<?php } else { ?>"?action=unlock_cat&id=<?=$categorie[$j]['id'];?>&lock=0" title="Ouvrir le forum"><i class="fa fa-lock"<?php } ?> aria-hidden="true"></i></a></td><?php
				}
?>
			</tr>
			<?php }
			} ?>
	</tbody>
</table><hr/>
<?php
	}
}
if($_PGrades_['PermsForum']['general']['addForum'] == true OR $_Joueur_['rang'] == 1 AND !$_SESSION['mode'])
{
	?><a class="btn btn-primary btn-xs btn-block" role="button" data-toggle="collapse" href="#add_forum" aria-expanded="false" aria-controls="add_forum">
Ajouter une Catégorie
</a>
<div class="collapse" id="add_forum">
	<div class="well">
		<form action="?action=create_forum" method="post">
			<div>
				<p class="text-center"><label class="control-label" for="nomFo">Nom de la catégorie</label></p>
				<input type="text" name="nom" id="nomFo" maxlength="80" class="form-control" required>
			</div>
			<br/>
			<p class="text-right">
				<button type="submit" class="btn btn-success btn-lg btn-round">Créer une catégorie</button>
			</p>
		</form>
	</div>
</div><br><?php
}
if(isset($_Joueur_) AND ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['addCategorie'] == true ) AND !$_SESSION['mode'])
{
	?>
	<a class="btn btn-primary btn-xs btn-block" role="button" data-toggle="collapse" href="#add_categorie" aria-exepanded="false" aria-controls="add_categorie"> Ajouter un Forum</a>
	<div class="collapse" id="add_categorie">
			<form action="?action=create_cat" method="post"><br>
				<div class="from-group row">
						<label class="col-md-6 col-form-label" for="nomCat">Nom du Forum : </label>
						<div class="col-md-6">
							<input type="text" name="nom" id="nomCat" maxlength="40" class="form-control" required />
						</div>
				</div><br>
				<div class="froum-group row">
						<label class="col-md-6 col-form-label" for="img">Icon disponible sur : <a href="https://design.google.com/icons/" target="_blank">https://design.google.com/icons/</a></label>
						<div class="col-md-6">
							<input type="text" name="img" id="img" maxlength="300" class="form-control" />
						</div>
				</div><br>
				<div class="form-group row">
						<label class="col-md-6 col-form-label">Catégorie : </label>
						<div class="col-md-6">
							<select name="forum" class="form-control" required>
								<?php
								for($z = 0; $z < count($fofo); $z++)
								{
									?><option value="<?php echo $fofo[$z]['id']; ?>"><?php echo $fofo[$z]['nom']; ?></option><?php
								}
								?></select>
						</div><br/>
				</div><br>
				<p class="text-right">
					<button type="submit" class="btn btn-success btn-lg btn-round">Créer un Forum</button>
				</p>
			</form>
	</div>
<?php
}
?>
</div>
</section>