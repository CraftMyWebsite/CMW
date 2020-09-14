<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h2 class="h2 gray">
		Gestion des pages personnalisées de votre site
	</h2>
</div>
<?php if(!$_Permission_->verifPerm('PermsPanel', 'pages', 'showPage'))
{
	echo '
	<div class="row">
		<div class="col-md-12 text-center">
			<div class="alert alert-danger">
				<strong>Vous avez aucune permission pour accéder aux réglages des pages.</strong>
			</div>
		</div>
	</div>';
}
else
	{
		?>
	<div class="alert alert-success">
		<strong>En plus des pages de base du CMS, vous pouvez créer des pages personnalisées, ces pages peuvent être découpées en plusieurs "sections". Une fois la page créée vous pouvez faire un lien vers cette dernière dans la section "menus" de votre panel.</strong>
	</div>

	 <div class="row"> <?php if($_Permission_->verifPerm('PermsPanel','pages', 'actions', 'addPage')) { ?>

		<div class="col-md-12 col-xl-6 col-12">
			<div class="card  ">
				<div class="card-header ">
					<h3 class="card-title"><strong>Création d'une nouvelle page</strong></h3>
				</div>
				<div class="card-body" id="addPage">
                    <label class="control-label">Titre de la page</label>
                    <input type="text" name="titre" class="form-control" placeholder="ex: Nos plugins"/>
                    
                    <label class="control-label">Sous-titre</label>
                    <input type="text" name="sousTitre" class="form-control" placeholder="ex: Essentials"/>
                    
                    <label class="control-label">Contenu de la section </label>
                    <textarea data-UUID="0005" id="ckeditor" name="message" style="height: 275px; margin: 0px; width: 50%;"></textarea>
	            </div>

	            <script>initPost("addPage", "admin.php?&action=creerPage",function(data) { if(data) { pagesUpdate(); } });</script>

	            <div class="card-footer">
	                <div class="row text-center">
	                    <input type="submit" onclick="sendPost('addPage', null);" class="btn btn-success w-100"
	                        value="Envoyer !" />
	                </div>
	            </div>
	        </div>
	   	</div>
	   <?php } if($_Permission_->verifPerm('PermsPanel', 'pages', 'actions', 'editPage')) { ?>
		<div class="col-md-12 col-xl-6 col-12">
			<div class="card  ">
				<div class="card-header ">
					<h3 class="card-title"><strong>Edition des pages</strong></h3>
				</div>
				<div class="card-body" id="allPage">
				  <?php if(empty($pages)) { ?>
			        <div class="alert alert-warning">
			            <strong>Aucune page est à modifier.</strong>
			        </div>
			        <?php } else { ?>
			        <div class="alert alert-success">
			            <strong>Vous pouvez rajouter des sections à chacunes de vos pages! Pour rappel: une page est un ensemble de minimum une section, vous pouvez modifier, ajouter ou supprimer une section.</strong>
			        </div>
			        <?php } ?>
                 <?php if(!empty($pages)) { ?>

                 	<ul class="nav nav-tabs">
                        <?php for($i = 0; $i < count($pages); $i++) { ?>
                        <li class="nav-item" id="tabpage-<?php echo $pages[$i]['id']; ?>"><a
                            class="<?php if($i == 0) echo 'active'; ?> nav-link"
                            href="#page<?php echo $pages[$i]['id']; ?>" data-toggle="tab"
                            style="color: black !important" id="pagetab-<?php echo $pages[$i]['id']; ?>"><?php echo $pages[$i]['titre']; ?></a></li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content">
                    	<?php for($i = 0; $i < count($pages); $i++) { ?>

                        <div class="tab-pane well <?php if($i == 0) echo 'active'; ?>" id="page<?php echo $pages[$i]['id']; ?>">
                            	<div style="width: 100%;display: inline-block">
                                    <div class="float-left">
                                        <h3 id="pageTitle-<?php echo $pages[$i]['id']; ?>"><?php echo $pages[$i]['titre']; ?></h3>
                                    </div>
                                    <div class="float-right">
                                        <button  onclick="sendDirectPost('admin.php?action=supprPage&id=<?php echo $pages[$i]['id']; ?>', function(data) { if(data) { hide('tabpage-<?php echo $pages[$i]['id']; ?>'); hide('page<?php echo $pages[$i]['id']; ?>'); } });" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                                    </div>
                                </div>

                                <label class="control-label">Titre de la page</label>
                                <input type="text" class="form-control" onkeyup="get('pageTitle-<?php echo $pages[$i]['id']; ?>').innerText = get('pagetab-<?php echo $pages[$i]['id']; ?>').innerText = this.value; " name="titre" value="<?php echo $pages[$i]['titre']; ?>"/>

                                <hr/>

                                <?php for($j = 0; $j < count($pages[$i]['tableauPages']); $j++) { 
                                	if($j != 0) { echo '<br/>'; } ?>
                                 	<button id="btnsection<?=$i; ?>-<?=$j; ?>" class="btn btn-secondary btn-block w-100" type="button" data-toggle="collapse" data-target="#section<?=$i; ?>-<?=$j; ?>" aria-expanded="false" aria-controls="section<?=$i; ?>-<?=$j; ?>">Éditer la section <strong >"<span id="pageSection-<?=$i; ?>-<?=$j; ?>"><?php echo $pageContenu[$i][$j][0]; ?></span>"</strong> De la page <strong><?php echo $pages[$i]['titre']; ?></strong>.
	                            	</button>
		                            <div class="collapse" id="section<?=$i; ?>-<?=$j; ?>" >
		                                <div class="row">
		                                    <div class="col-md-12">
		                                    	<div class="card card-body">
		                                    		<div style="width: 100%;display: inline-block">
					                                    <div class="float-left">
					                                        <h3 id="sectionTitre<?=$i; ?>-<?=$j; ?>"><?php echo $pageContenu[$i][$j][0]; ?></h3>
					                                    </div>
					                                    <div class="float-right">
					                                        <button onclick="sendDirectPost('admin.php?&action=supprSection&page=<?php echo $pages[$i]['id']; ?>&id=<?php echo $j; ?>', function(data) { if(data) { hide('section<?=$i; ?>-<?=$j; ?>'); hide('btnsection<?=$i; ?>-<?=$j; ?>') } });" class="btn btn-sm btn-outline-secondary">Supprimer</button>
					                                    </div>
					                                </div>
					                                <label class="control-label">Sous-titre</label>
                                                    <input onkeyup="get('sectionTitre<?=$i; ?>-<?=$j; ?>').innerText = get('pageSection-<?=$i; ?>-<?=$j; ?>').innerText = this.value; " type="text" class="form-control" name="sousTitre<?php echo $j; ?>" value="<?php echo $pageContenu[$i][$j][0]; ?>">

                                                    <label class="control-label">Contenu de la section</label>
  
                                                    <textarea data-UUID="0006-<?php echo $i; ?>-<?php echo $j; ?>" id="ckeditor" name="message<?php echo $j; ?>" style="height: 275px; margin: 0px; width: 50%;"><?php echo $pageContenu[$i][$j][1]; ?></textarea>
		                                    	</div>
		                                    </div>
		                                </div>
		                            </div>

		                        <?php } ?>
		                        <script> initPost('page<?php echo $pages[$i]['id']; ?>', 'admin.php?&action=editPage&id=<?php echo $pages[$i]['id']; ?>', null); </script>
		                        <div class="text-center" style="margin-top:20px;margin-bottom:20px;">
	                                <input type="submit" onclick="sendPost('page<?php echo $pages[$i]['id']; ?>', function(data) { if(data) { }});" class="btn btn-success col-md-6" value="Valider les changements"/>
	                            </div>
	                            <hr/>
    
                        <div id="newSection<?php echo $pages[$i]['id']; ?>">

                        	<h5>Créer une nouvelle section sur la page "<?php echo $pages[$i]['titre']; ?>"</h5>

                        	<label class="control-label">Sous-titre</label>
                            <input type="text" class="form-control" name="sousTitre">

							<label class="control-label">Contenu</label>
							 <textarea data-UUID="0007-<?php echo $i; ?>" id="ckeditor" name="message" style="height: 275px; margin: 0px; width: 50%;"><?php echo $pageContenu[$i][$j][1]; ?></textarea>

                        	<script> initPost('newSection<?php echo $pages[$i]['id']; ?>', 'admin.php?&action=creerSection&id=<?php echo $pages[$i]['id']; ?>', null); </script>
                        	 <div class="row text-center" style="margin-top:20px;">
	                            <input type="submit" onclick="sendPost('newSection<?php echo $pages[$i]['id']; ?>', function(data) { if(data) { }});" class="btn btn-success w-100" value="Créer"/>
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