<h1><center>Gestion de la barre latérale</center></h1>
<h3><center>Les Widget dépendent du théme que vous avez !</center></h3>
<h3><center>Ajouter un Widget</center></h3>
<form class="form-horizontal default-form" method="post" action="?action=newWidget">
	<div class="form-group">
		<label class="col-sm-4 control-label">Titre du widget</label>
		<div class="col-sm-8">
			<input style="width: 50%" type="text" name="titre" class="form-control" placeholder="Partenaires...">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Type de Widget</label>
		<div style="width: 34%" class="col-sm-8">
            <select class="form-control" name="type">
                <option value="0">Gestion du compte</option>
                <option value="1">Status Serveurs</option>
                <option value="2">Joueurs en ligne</option>
                <option value="3">Champ Texte</option>
            </select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Message du widget<br /> <small> Uniquement pour les "Champ Texte"</small></label>
		<div style="width: 34%" class="col-sm-8">
			<textarea  class="form-control" name="message" style="height: 175px; margin: 0px; width: 100%;"></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-8 col-sm-2">
			<input type="submit" class="btn btn-primary" value="Valider / Créer ce Widget" />
		</div>
	</div>
</form>

<h3><center>Modifier mes widgets</center></h3>
<ul class="nav nav-tabs">
    <?php for($i = 0; $i < count($widgets); $i++) { ?>    
    <li <?php if($i == 0) echo 'class="active"'; ?>><a href="#widgets<?php echo $i; ?>" data-toggle="tab"><?php echo $widgets[$i]['titre']; ?></a></li>
    <?php } ?>
</ul>

<!-- Tab panes -->
<div class="tab-content well">
    <?php for($i = 0; $i < count($widgets); $i++) { ?> 
    <div class="tab-pane <?php if($i == 0) echo 'active'; ?>" id="widgets<?php echo $i; ?>">
        <?php if($i != 0) { ?>
        <a class="btn btn-primary btn-lg" href="?action=upWidget&id=<?php echo $i; ?>">
            <span class="glyphicon glyphicon-arrow-up"></span> Monter le widget d'un crant
        </a>
        <?php } ?>
        <?php if($i != count($widgets) - 1) { ?>
        <a class="btn btn-primary btn-lg" href="?action=downWidget&id=<?php echo $i; ?>">
            <span class="glyphicon glyphicon-arrow-down"></span> Descendre le widget d'un crant
        </a>
        <?php } ?>
        <a class="btn btn-danger btn-lg" href="?action=supprWidget&id=<?php echo $i; ?>">
            Supprimer ce widget...
        </a>

    </div>
    <?php } ?>
</div>
