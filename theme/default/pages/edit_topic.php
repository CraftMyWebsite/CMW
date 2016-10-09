<?php 

if(isset($_Joueur_) AND isset($_POST['id_topic']))
{
	$id = htmlspecialchars($_POST['id_topic']);
	$req = $bddConnection->prepare('SELECT * FROM cmw_forum_post WHERE id = :id');
	$req->execute(array(
		'id' => $id
	));
	$donnee = $req->fetch();
	?><form action="?action=edit_topic" method="POST">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-2 col-md-6">
				<h4 class="title">Edition du topic <?php echo $donnee['nom']; ?></h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-offset-2 col-md-10">
				<input type="hidden" name="id_topic" value="<?php echo $id; ?>"/>
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