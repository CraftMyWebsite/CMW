<div class="container"><!-- Titre page--><h3>Page de confirmation des actions de modérations</h3><br/>

<?php 
if(isset($_GET['choix']))
{
	if(isset($_GET['id_topic']))
	{
		$id = htmlspecialchars($_GET['id_topic']);
	}
	$choix = htmlspecialchars($_GET['choix']);
	if($_Joueur_['rang'] == 1 AND isset($id))
	{
		//vérification + initialisation variable
		if(is_numeric($id) AND is_numeric($choix))
		{
			switch($choix)
			{
				//On switch 
				case '2':
					//si le $_GET['choix'] == 2 alors c'est une suppression de topic 
					//On demande donc une raison et une confirmation
					?>
					<div class="alert alert-danger">
						ATTENTION ! Si vous supprimez cette discussion elle ne sera plus accessible :( ! Plus jamais !!!
					</div>
					<form action="<?php echo $_Serveur_['General']['url']; ?>?&action=forum_moderation&id_topic=<?php echo $id; ?>&choix=2&confirmation=true" method="post">
						<div class="form-group row">
							<label for="reason" class="col-sm-2 form-control-label">Raison de la suppression</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="reason" name="reason" placeholder="Votre raison" require />
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-primary">Supprimer ce topic :(</button>
							</div>
						</div>
					</form><?php
				break;
				
				case '3':
					//Là c'est un déplacement du topic 
					//On affiche donc un <select> pour que l'admin choisisse la bonne catégorie
					?>
					<form action="<?php echo $_Serveur_['General']['url']; ?>?&action=forum_moderation&id_topic=<?php echo $id; ?>&choix=3&confirmation=true" method="post">
						<div class="form-group row">
							<label for="emplacement" class="col-sm-2 form-control-label">Déplacez la discussion vers : </label>
							<div class="col-sm-10">
								<select class="c-select" name="emplacement" id="emplacement" require >
									<?php 
									$emplacement = $bddConnection->query('SELECT * FROM cmw_forum_categorie');
									while($emplacementd = $emplacement->fetch())
									{
										if(isset($emplacementd['sous-forum']))
										{
											?><optgroup label="<?php echo $emplacementd['nom']; ?>">
											<option value="<?php echo $emplacementd['id']; ?>">Déplacer dans la catégorie</option>
											<?php
											$sous_forum = $bddConnection->prepare('SELECT * FROM cmw_forum_sous_forum WHERE id_categorie = :id');
											$sous_forum->execute(array(
												'id' => $emplacementd['id']
											));
											while($sous_forumd = $sous_forum->fetch())
											{
												?><option value="<?php echo $emplacementd['id']; ?>_<?php echo $sous_forumd['id']; ?>"><?php echo $sous_forumd['nom']; ?></option><?php
											}
											?></optgroup><?php
										}
										else 
										{
											?><option value="<?php echo $emplacementd['id']; ?>_0"><?php echo $emplacementd['nom']; ?></option>
										<?php 
										}
									}
								?></select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-primary">Déplacer la discussion </button>
							</div>
						</div>
					</form>
					<?php
				break;
			}
		}
	}
	if($choix == 4)
		{
			//la j'ai décidé de stopper le switch chai pas pk x))) 
			//La c'est un signalement de réponse qui nécessite donc une raison
			?>
			<form action="?&action=signalement&confirmation=true" method="post">
				<div class="row">
					<label for="reason" class="form-control-label col-sm-2">Indiquez une raison</label>
					<input type="text" class="form-control col-sm-10" name="reason" id="reason" placeholder="Indiquez une raison" require />
				</div>
				<input type="hidden" name="id_answer" value="<?php echo $_GET['id']; ?>" />
				<div class="row">
					<div class="col-sm-offset-2 col-sm-10">
						<button class="btn btn-primary" type="submit">Signaler ! </button>
					</div>
				</div>
			</form>
			<?php 
		}
	if($choix == 5)
	{
		//Pareil mais signalement de topic
		?>
		<form action="?&action=signalement_topic&confirmation=true" method="post">
			<div class="form-group row">
				<label for="reason" class="col-sm-2 form-control-label">Indiquez une raison ! </label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="reason" id="reason" placeholder="Indiquez une raison" require />
					<input type="hidden" name="id_topic2" value='<?php echo $id; ?>' />
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">Signaler ce topic !</button>
				</div>
			</div>
		</form>
		<?php
	}
}
else
{
	?><div class="alert alert-warning">
		Une erreur est survenue lors de l'opération :( 
	</div><?php
}
?></div>