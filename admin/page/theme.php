<center><h1><center><strong>Réglages généraux de votre thème</center></strong></h1>

<h3>Choisissez votre thème.</h3>


<div style="width: 50%" class="alert alert-dismissable alert-success"><center>Si vous souhaitez modifier un thème, modifiez une copie de l'original en créant un nouveau thème. Cela vous évitera de perdre votre thème lors d'une mise à jours !</center></a></div>
<form class="form-horizontal default-form" method="post" action="?action=editTheme">

	<div style="width: 50%" class="form-group">
		<label class="col-sm-4 control-label">Thème</label>
		<div class="col-sm-8">
			<select class="form-control" name="theme">
				<option value="<?php echo $lecture['General']['theme']; ?>"><?php echo $lecture['General']['theme']; ?></option>
				<?php foreach($themes as $element){ if($element != 'upload' AND $element != 'smileys' AND $element != $lecture['General']['theme'] AND $element != '..') { ?>
				<option value="<?php echo $element; ?>"><?php echo $element; ?></option><?php } } ?>
			</select>
		</div>
	</div><?php if($themesOptions != null) { ?>
	<div style="width: 50%" class="form-group">
		<label class="col-sm-4 control-label">Option du thème</label>
		<div class="col-sm-8">
			<select class="form-control" name="themeOption">
				<option value="<?php echo $lecture['General']['themeOption']; ?>"><?php echo $lecture['General']['themeOption']; ?></option>
				<?php foreach($themesOptions as $element){ if($element != $lecture['General']['themeOption']) { ?>
				<option value="<?php echo $element; ?>"><?php echo $element; ?></option><?php } } ?>
			</select>
		</div>
	</div><?php } ?>
  
	<div style="width: 50%" class="form-group">
		<div class="col-sm-offset-8 col-sm-2">
			<input type="submit" class="btn btn-success" value="Valider les changements" />
		</div>
	</div>
</form>


<h3>Choisissez le fond d'écran de votre site</h3>

<div style="width: 50%" class="alert alert-dismissable alert-success"><center>Si vous voulez mettre une image, l'image doit être en 1920*1080 minimum pour s'adapater aux ecran et pour avoir une qualité optimal ! Vous pouvez aussi mettre une petite image qui se répettera !</center></a></div>
<form class="form-horizontal default-form" method="post" action="?&action=postBG" enctype="multipart/form-data">
    <div style="width: 50%" class="form-group">
        <label class="col-sm-4 control-label">Votre image</label>
		<div class="col-sm-8">
    		<input type="file" name="img">
        </div>	
    </div>
  
	<div style="width: 50%" class="form-group">
		<div class="col-sm-offset-8 col-sm-2">
			<input type="submit" class="btn btn-success" value="Valider les changements" />
		</div>
	</div>
</form>


<h3>Quel type de fond d'écran utilisez vous ?</h3>

<div style="width: 50%" class="alert alert-dismissable alert-success"><center>Choisissez si vous préférez utiliser une grande image en fond de site ou une répétition de petits images ! </center></a></div>

<form style="width: 50%" class="form-horizontal default-form" method="post" action="?action=typeBG">
    <div class="radio">
        <label class="col-sm-8 control-label">Image sans répétition, taille conseillée: min 1920*1080</label>
        <div class="col-sm-4">        
            <input type="radio" name="bgType" value="0" <?php if($lecture['General']['bgType'] == 0) echo 'checked'; ?>>
        </div>        
    </div>	
    <div class="radio">
        <label class="col-sm-8 control-label">Image se répétant, taille conseillée infèrieure à 100*100</label>
        <div class="col-sm-4">        
            <input type="radio" name="bgType" value="1" <?php if($lecture['General']['bgType'] == 1) echo 'checked'; ?>>
        </div>        
    </div>
  
	<div class="form-group">
		<div class="col-sm-offset-8 col-sm-2">
			<input type="submit" class="btn btn-success" value="Valider les changements" />
		</div>
	</div>	
</form>
</center>