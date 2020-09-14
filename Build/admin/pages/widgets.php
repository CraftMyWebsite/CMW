<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h2 class="h2 gray">
		Gestion des grades du site
	</h2>
</div>
<?php if(!$_Permission_->verifPerm('PermsPanel', 'widgets', 'showPage')) {
	echo '
	<div class="row">
		<div class="col-md-12 text-center">
			<div class="alert alert-danger">
				<strong>Vous avez aucune permission pour accéder aux widgets..</strong>
			</div>
		</div>
	</div>';
} else { ?>
	<div class="row">
		<div class="col-md-12 text-center">
	        <div class="alert alert-success">
	             <strong>Les widgets sont disponibles uniquement sur certains thèmes</strong>
	         </div>
	    </div>
    <?php if($_Permission_->verifPerm('PermsPanel', 'widgets', 'actions', 'addWidgets')) { ?>
    	<div class="col-md-12 col-xl-6 col-12">
			<div class="card  ">
				<div class="card-header ">
					<h3 class="card-title"><strong>Création d'un widget</strong></h3>
				</div>
				<div class="card-body" id="addWidget">
	                <label class="control-label">Titre du Widget</label>
	                <input type="text" name="titre" class="form-control" placeholder="Partenaires...">

	                <label class="control-label">Type de Widget</label>
	                <select class="form-control" name="type">
	                    <option value="0">Gestion du compte</option>
	                    <option value="1">Status Serveurs</option>
	                    <option value="2">Joueurs en ligne</option>
	                    <option value="3">Champ Texte</option>
	                </select>

	                <label class="control-label">Message du widget<small> uniquement pour les "champs texte"</small></label>
	                <textarea class="form-control" id="ckeditor" data-UUID="0009" name="message"></textarea>

	            </div>

	            <script>initPost("addWidget", "admin.php?&action=newWidget",function(data) { if(data) { updateCont('admin.php?action=getWidgetsList', get('allWidgets'), null)}});</script>

	            <div class="card-footer">
	                <div class="row text-center">
	                    <input type="submit" onclick="sendPost('addWidget', null );" class="btn btn-success w-100"
	                        value="Envoyer !" />
	                </div>
	            </div>
	        </div>
	   	</div>

    <?php } if($_Permission_->verifPerm('PermsPanel', 'widgets', 'actions', 'editWidgets')) { ?>
    	<div class="col-md-12 col-xl-6 col-12">
			<div class="card  ">
				<div class="card-header ">
					<h3 class="card-title"><strong>Édition des Widgets</strong></h3>
				</div>
				<div class="card-body" id="allWidgets">
					<?php if(!empty($widgets)) { ?>
	                <ul class="nav nav-tabs">
	                    <?php for($i = 0; $i < count($widgets); $i++) { ?>
	                    <li class="nav-item" id="tab-widget-<?php echo $i; ?>"><a
	                            class="<?php if($i == 0) echo 'active'; ?> nav-link"
	                            href="#widget-<?php echo $i; ?>" data-toggle="tab"
	                            style="color: black !important"><?php echo $widgets[$i]['titre']; ?></a></li>
	                    <?php } ?>
	                </ul>
					<div class="tab-content">
						<?php for($i = 0; $i < count($widgets); $i++) { ?>
	                    	<div class="tab-pane well <?php if($i == 0) echo 'active'; ?>"id="widget-<?php echo $i; ?>">
	                    		<div class="row">
                                         <div class="col-md-6">
                                                <button class="btn btn-secondary w-100" onclick="sendDirectPost('admin.php?action=upWidget&id=<?php echo $i; ?>', function(data) { if(data) { updateCont('admin.php?action=getWidgetsList', get('allWidgets'), null); }} );" <?php if($i == 0) { echo 'disabled'; } ?>><i class="fas fa-arrow-up"></i> Monter le widget</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="btn btn-secondary w-100" onclick="sendDirectPost('admin.php?action=downWidget&id=<?php echo $i; ?>', function(data) { if(data) { updateCont('admin.php?action=getWidgetsList', get('allWidgets'), null); }} );" <?php if($i == count($widgets) - 1) { echo 'disabled'; }?> ><i class="fas fa-arrow-down"></i> Descendre le widget</button>
                                            </div>
     
                                        <div class="col-md-12" style="margin-top:20px;"">
                                            <button class="btn btn-danger w-100" onclick="sendDirectPost('admin.php?action=supprWidget&id=<?php echo $i; ?>', function(data) { if(data) { hide('widget-<?php echo $i; ?>');}} );">Supprimer ce widget</button>
                                        </div>
                                </div>
	                    	</div>
	                    <?php } ?>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>

    <?php } ?>
    </div>
<?php } ?>