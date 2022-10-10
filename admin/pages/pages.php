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
				<strong>Vous n\'avez aucune permission pour accéder aux réglages des pages.</strong>
			</div>
		</div>
	</div>';
}
else
	{
		?>
	<div class="alert alert-success">
		<strong>En plus des pages de base du CMS, vous pouvez créer des pages personnalisées. Vous pouvez utiliser ces pages par la suite dans diverses configurations du CMS. Le PHP est autorisé exclusivement pour la création des pages et doit être activé dans la barre de menus de l'éditeur, mais à vos risques et périls ! Le nom de la page que vous inscrirez ( peut être modifié par la suite ) sera celle que vous utiliserez pour retrouver votre page, exemple: https://votreSite.fr/index.php?page=LeNomDeLaPage. Et pour finir, vous pouvez créer vos pages manuellement ( conseillé pour les pages complexes ) en créant simplement un fichier (.php obligatoire) dans le dossier 'include/CustomPage/' tout simplement.</strong>
	</div>

	 <div class="row"> <?php if($_Permission_->verifPerm('PermsPanel','pages', 'actions', 'addPage')) { ?>

		<div class="col-md-12 col-xl-6 col-12">
			<div class="card  ">
				<div class="card-header ">
					<h3 class="card-title"><strong>Création d'une nouvelle page</strong></h3>
				</div>
				<div class="card-body" id="addPage">
                    <label class="control-label">Nom de la page </label>
                    <input type="text" name="titre" class="form-control" placeholder="ex: Nos plugins" required/>
                    
                    <label class="control-label">Contenu de la page</label>
                    <textarea data-UUID="PHP0005" id="ckeditor" name="content" style="height: 275px; margin: 0px; width: 50%;"></textarea>
	            </div>

	            <script>initPost("addPage", "admin.php?&action=creerPage",function(data) { if(data) { clearAllInput("addPage");pagesUpdate(); } });</script>

	            <div class="card-footer">
	                <div class="row text-center">
	                    <input type="submit" onclick="sendPost('addPage', null, true);" class="btn btn-success w-100"
	                        value="Envoyer" />
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

                 	<ul class="nav nav-tabs">
                        <?php for($i = 0; $i < count($pages); $i++) { ?>
                        <li class="nav-item" id="tabpage-<?php echo $i; ?>"><a
                            class="<?php if($i == 0) echo 'active'; ?> nav-link"
                            href="#page<?php echo $i; ?>" data-toggle="tab"
                            style="color: black !important" id="pagetab-<?php echo $i; ?>"><?php echo $pages[$i]['titre']; ?></a></li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content">
                    	<?php for($i = 0; $i < count($pages); $i++) { ?>

                        <div class="tab-pane well <?php if($i == 0) echo 'active'; ?>" id="page<?php echo $i; ?>">
                            	<div style="width: 100%;display: inline-block">
                                    <div class="float-left">
                                        <h3 id="pageTitle-<?php echo $i; ?>"><?php echo $pages[$i]['titre']; ?></h3>
                                    </div>
                                    <div class="float-right">
                                        <button  onclick="sendDirectPost('admin.php?action=supprPage&name=<?php echo $pages[$i]['titre']; ?>', function(data, otherdata) { if(data && jsonDataIsOk(otherdata)) { hide('tabpage-<?php echo $i; ?>'); hide('page<?php echo $i; ?>'); } }, true);" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                                    </div>
                                </div>

                                <label class="control-label">Titre de la page</label>
                                <input type="text" id="titre<?php echo $i; ?>" class="form-control" onkeyup="get('pageTitle-<?php echo $i; ?>').innerText = get('pagetab-<?php echo $i; ?>').innerText = this.value; " name="titre" value="<?php echo $pages[$i]['titre']; ?>" required/>

                                 <input type="hidden" name="oldtitre" value="<?php echo $pages[$i]['titre']; ?>"/>

                                <hr/>

                                <div id="ckeditorPHP<?php echo $i; ?>" data-UUID="PHP0006-<?php echo $i; ?>" ><?php echo $pages[$i]['content']; ?></div>
                                <input type="hidden" name="content" id="content-<?php echo $i; ?>" value=""/>
                                <hr/>

		                        <script> initPost('page<?php echo $i; ?>', 'admin.php?&action=editPage', function(data,other) { pagesUpdate(); }); </script>
		                        <div class="text-center" style="margin-top:20px;margin-bottom:20px;">
	                                 <input type="submit" onclick="get('content-<?php echo $i; ?>').value= CK.get(get('ckeditorPHP<?php echo $i; ?>')).getData();sendPost('page<?php echo $i; ?>', null, true);" class="btn btn-success w-100" value="Valider les changements"/>
                                    <button type="button" onclick="get('content-<?php echo $i; ?>').value= CK.get(get('ckeditorPHP<?php echo $i; ?>')).getData();setShowPopUpPage(get('titre<?php echo $i; ?>').value);sendPost('page<?php echo $i; ?>', null, true);" class="btn btn-primary w-100">Prévisualiser</button>
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