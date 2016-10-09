<?php 

if(isset($_Joueur_) AND isset($_POST['id_answer']))
{
	$id = htmlspecialchars($_POST['id_answer']);
	$req = $bddConnection->prepare('SELECT * FROM cmw_forum_answer WHERE id = :id');
	$req->execute(array(
		'id' => $id
	));
	$donnee = $req->fetch();
	?><form action="?action=edit_answer" method="POST">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-2 col-md-6">
				<h4 class="title">Edition d'une réponse</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-offset-2 col-md-10">
				<input type="hidden" name="id_answer" value="<?php echo $id; ?>"/>
				<label for="contenue" class="control-label">Editer votre contenue</label><br/>
				<textarea name="contenue" maxlength="10000" class="form-control" id="contenue"><?php echo $donnee['contenue']; ?></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-md-offset-5 col-md-7">
				<button type="submit" class="btn btn-primary">Envoyer</button>
			</div>
		</div>
      </div>
	  </form>
      <?php 
}