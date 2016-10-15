<center>  <?php if($_Joueur_['rang'] == 1) { ?>  
  
<h1><center>L'accueil de votre site</center></h1>
<div style="width: 75%" class="alert alert-dismissable alert-success"><center>L'accueil de votre site, la vitrine de votre serveur, ne négligez jamais cette page, ajoutez de belles images de slider ou encore des liens de navigations rapides les plus ergonomiques possibles !</center></a></div>
<hr>
	<h2><center>Slider</center></h2>
<h3><center>Configuration de votre slider</center></h3>
</br>

<div style="width: 50%" class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><center>Uploader une image pour le slider</center></h3>
  </div>
  <div class="panel-body">
    	<form method="post" action="?&action=postSlider" enctype="multipart/form-data" style="margin: 0 auto;width: 530px;">
		<div class="form-group col-md-7">
			<input type="file" name="img">
			<p class="help-block">Image de slider (1400 x 500)</p>
		</div>
		<div class="form-group col-md-5">
			<input type="submit" class="btn btn-success">
		</div>
	</form>
  </div>
</div>

<form method="post" action="?&action=changeSlider">

	<div style="width: 50%" class="form-group">
		<label>Titre au dessus du slider</label>
		<input type="text" class="form-control" name="titre" value="<?php echo $lectureAccueil['SliderTitre']; ?>" />
	</div>
	<h3>Slider</h3>
	<ul class="nav nav-tabs">
		<?php
		for($i = 0; $i < count($lectureAccueil['Slider']); $i++)
		{
		?>
		<li <?php if($i == 0) echo 'class="active"'; ?>><a href="#slider<?php echo $i; ?>" data-toggle="tab">Image <?php echo $i + 1; ?></a></li>
		<?php } ?>
		<li><a href="#newSlider" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span></a></li>
	</ul>

	<div class="tab-content">
		<?php
		for($i = 0; $i < count($lectureAccueil['Slider']); $i++)
		{
		?>
		<div style="width: 50%" class="tab-pane well <?php if($i == 0) echo 'active"'; ?>" id="slider<?php echo $i; ?>">
			<div class="form-group">
				<label>Message de l'image</label>   <a href="?action=supprSlider&id=<?php echo $i; ?>" class="btn btn-danger btn-xs">Supprimer</a>
				<input type="text" class="form-control" name="message<?php echo $i; ?>" value="<?php echo $lectureAccueil['Slider'][$i]['message']; ?>">
			</div>
			
			<label>Choisissez une image , uploadez la votre au dessus<small>(les images se trouvent dans theme/upload/slider/)</small></label>
			<select class="form-control" name="image<?php echo $i; ?>">
				<option value="<?php echo $lectureAccueil['Slider'][$i]['image']; ?>"><?php echo $lectureAccueil['Slider'][$i]['image']; ?></option>
				<?php
				for($j = 2; $j < count($imagesSlider); $j++)
				{ 
					if($lectureAccueil['Slider'][$i]['image'] != $imagesSlider[$j])  echo '<option value="' .$imagesSlider[$j]. '">' .$imagesSlider[$j]. '</option>'; 
				} ?>
			</select>
			
		</div>
		<?php } ?>
	</div>

	<input type="submit" class="btn btn-success" value="Modifier le slider"/>
</form>
<hr>
<h2><center>Miniature de navigation rapide</center></h2>
<div style="width: 75%" class="alert alert-dismissable alert-success"><center>Ces liens sont essentiels à l'ergonomie de votre site, ils permettent de décrire les pages principales de votre site et de leur attribuer un accès facile. Vous étes limité à 3 miniatures , en fonction de votre thème cela peut différer, vous ne pouvez ni les supprimer ni en ajouter.</center></div>
<div style="width: 50%" class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><center>Uploader une image pour les minatures de liens rapide</center></h3>
  </div>
  <div class="panel-body">
	<form method="post" action="?&action=postNavRap" enctype="multipart/form-data" style="margin: 0 auto;width: 530px;">
		<div class="form-group col-md-7">
			<input type="file" name="img">
			<p class="help-block">Image Nav Rapide(400 x 160)</p>
		</div>
		<div class="form-group col-md-5">
			<input type="submit" class="btn btn-success">
		</div>
	</form>
  </div>
</div>
</br>
<form method="post" action="?&action=editRapNav">

<ul class="nav nav-tabs">
	<?php
	for($i = 0; $i < 3; $i++)
	{
	?>
	<li <?php if($i == 0) echo 'class="active"'; ?>><a href="#navRap<?php echo $i; ?>" data-toggle="tab">Lien rapide <?php echo $i + 1; ?></a></li>
    <?php } ?>
</ul>

<div class="tab-content">
<?php
for($i = 0; $i < 3; $i++)
{
?>
<div style="width: 50%" class="tab-pane well <?php if($i == 0) echo 'active'; ?>" id="navRap<?php echo $i; ?>">

<h3>Lien #<?php echo $i + 1; ?></h3>
	<div class="row">
		<img class="col-md-4 thumbnail" src="theme/upload/navRap/<?php echo $lectureAccueil['Infos'][$i]['image']; ?>" />
		
		<div class="col-md-8">
			<div class="form-group">
				<label>Message</label>
				<textarea class="form-control" placeholder="Petit message qui se situera en dessous de l'image ^^" rows="3" name="message<?php echo $i;?>"><?php echo $lectureAccueil['Infos'][$i]['message']; ?></textarea>
			</div>
        </div>
    </div>
			<label>Image</label>
			<select class="form-control" name="image<?php echo $i;?>">
				<?php for($j = 2; $j < count($images); $j++)
				{ ?>
				<?php if($images[$j] == $lectureAccueil['Infos'][$i]['image']) { ?><option value="<?php echo $images[$j]; ?>"><?php echo $images[$j]; ?></option> <?php }
				} 
				for($j = 2; $j < count($images); $j++)
				{ ?>
				<option value="<?php echo $images[$j]; ?>"><?php echo $images[$j]; ?></option>
				<?php } ?>
			</select>
			</br>
			<label>Nom de la page (Option 1)</label>
            <select name="page<?php echo $i; ?>" class="form-control">
                <?php
                if($typeNavRap[$i] == 1)
                    echo '<option value="'. $pageActive[$i] .'">'. $pageActive[$i] .'</option>';
                else
                    echo '<option value="#">-- Page --</option>';
                ?>
                <option value="boutique">Boutique</option>
                <option value="support">Support</option>
                <option value="voter">Voter</option>
                <option value="tokens">Jetons</option>
                <?php $j = 0;
                while($j < count($pages))
				{
					?><option value="<?php echo $pages[$j]; ?>"><?php echo $pages[$j]; ?></option><?php $j++;
				} ?>
            </select>
			</br>
			<label>Adresse du lien (Option 2)</label>
			<input type="text" class="form-control"  name="lien<?php echo $i;?>" value="<?php if($typeNavRap[$i] == 2) echo $lectureAccueil['Infos'][$i]['lien']; ?>" placeholder="http://minecraft.net/" />
	
	</br>
	<h3><center>Choisissez quel mode de redirection vous souhaitez</center></h3></br>
    <label>
        <input type="radio" name="typeLien<?php echo $i; ?>" value="page" <?php if($typeNavRap[$i] == 1) echo 'checked'; ?>>
        Option 1: Je souhaite rediriger vers une page existante
    </label></br>
    <label>
        <input type="radio" name="typeLien<?php echo $i; ?>" value="lien" <?php if($typeNavRap[$i] == 2) echo 'checked'; ?>>
        Option 2: Je souhaite rediriger vers un lien personnalisé
    </label></br>
</div>	
<?php
}
?>
</div>
	<input type="submit" class="btn btn-warning" value="Modifier la navigation rapide"/>

</form>

<div class="modal fade" id="newSlider" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Créer un slider</h4>
      </div>
      <div class="modal-body">

		<form class="inline-form" method="post" action="?action=newSlider">
			<div class="form-group">
				<label>Message de l'image</label>
				<input type="text" class="form-control" name="message">
			</div>
			
			<div class="form-group">
				<label>Choisissez une image <small>(les images se trouvent dans theme/upload/img/slider/</small></label>
				<select class="form-control" name="image">
					<?php
					for($j = 2; $j < count($imagesSlider); $j++)
					{ 
						echo '<option value="' .$imagesSlider[$j]. '">' .$imagesSlider[$j]. '</option>'; 
					} ?>
				</select>
			</div>
			
			<input type="submit" class="btn btn-primary" value="Ajouter une image au slider">

		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"> Fermer</button>
      </div>
    </div>
  </div>
</div>
<?php } else { } ?>
</center>