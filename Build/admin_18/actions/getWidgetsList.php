 <?php if($_Permission_->verifPerm('PermsPanel', 'widgets', 'actions', 'editWidgets')) { 
require_once('./admin/donnees/widgets.php'); ?>
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
 <?php } ?>