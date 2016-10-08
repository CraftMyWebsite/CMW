<center><h1><center><strong>Edition et création de pages</strong></center></h1>
<div style="width: 50%" class="alert alert-dismissable alert-success"><center>En plus des pages de base du CMS, vous pouvez créer des pages personnalisées, ces pages peuvent être découpées en plusieurs "sections". Une fois la page créée vous pouvez faire un lien vers cette dernière dans la section "menus" de votre panel.</center></div>


<h3><center><strong>Créer une page</strong></center></h3>
<div style="width: 50%" class="alert alert-dismissable alert-success"><center>Quand vous créez une page cette dernière ne contient qu'une section définie lors de la création, vous pourrez ensuite éditer votre page une fois créée et y ajouter jusqu'à 5 sections. Une section est constituée d'un sous titre et d'un bloc de texte. La page est constituée d'un titre et d'une ou plusieurs sections</center></div>
<form class="form-horizontal" role="form" method="post" action="?&action=creerPage">
	<div class="form-group">
		<label class="col-sm-4 control-label">Titre de la page</label>
		<div style="width: 25%" class="col-sm-8">
		    <input type="text" name="titre" class="form-control" placeholder="ex: Nos plugins" />
        </div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-4 control-label">Sous-titre</label>
		<div style="width: 25%" class="col-sm-8">
		    <input type="text" name="sousTitre" class="form-control" placeholder="ex: Essentials" />
        </div>
	</div>
	<div class="form-group">
		<label class="control-label">Contenu de la section </label>
		<div style="width: 50%">
			<textarea id="page_1" name="message" style="height: 275px; margin: 0px; width: 100%;"></textarea>
        </div>
	</div>
	<div class="form-group">
		<div>
			<button type="submit" class="btn btn-primary">Ajouter cette page !</button>
		</div>
	</div>

</form>

<?php if(!empty($pages)) { ?>
<h3>Editer vos pages</h3>
<div class="alert alert-dismissable alert-success">Vous pouvez rajouter des sections à chacunes de vos pages! Pour rappel: une page est un ensemble de minimum une section, vous pouvez modifier, ajouter ou supprimer une section.</div>


<ul class="nav nav-tabs">
    <?php for($i = 0; $i < count($pages); $i++) { ?>
    <li><a <?php if($i == 0) echo 'class="active"'; ?> href="#page<?php echo $pages[$i]['id']; ?>" data-toggle="tab"><?php echo $pages[$i]['titre']; ?></a></li>
    <?php 	} ?>
</ul>


<div class="tab-content">
    <?php for($i = 0; $i < count($pages); $i++) { ?>
 	<div class="tab-pane <?php if($i == 0) echo 'active'; ?>" id="page<?php echo $pages[$i]['id']; ?>">

 		<form method="post" action="?&action=editPage&id=<?php echo $pages[$i]['id']; ?>" class="well">
		  	
            <div class="row">
                <div class="form-group col-md-8">
		       	 	<label>Titre de la page</label>
		       	 	<input type="text" class="form-control" name="titre" value="<?php echo $pages[$i]['titre']; ?>">
			    </div>
                <div class="form-group col-md-4">
                    <label>Supprimer la page et son contenu</label>
                    <a href="?action=supprPage&id=<?php echo $pages[$i]['id']; ?>" class="btn btn-danger form-control">Supprimer la page</a>
                </div>
            </div>

    <div class="panel-group" id="sections<?php echo $pages[$i]['id']; ?>">

			    <?php for($j = 0; $j < count($pages[$i]['tableauPages']); $j++) { ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" class="btn btn-success" data-parent="#sections<?php echo $pages[$i]['id']; ?>" href="#section<?php echo $i . $j; ?>" style="color: white;">
                        Editer section <strong>"<?php echo $pageContenu[$i][$j][0]; ?>"</strong> De la page <strong><?php echo $pages[$i]['titre']; ?></strong>.
                    </a>
                    <a href="?&action=supprSection&page=<?php echo $pages[$i]['id']; ?>&id=<?php echo $j; ?>" class="btn btn-danger btn-sm pull-right"/>Supprimer la section</a>
                </h4>
				</br>
            </div>
            <div id="section<?php echo $i . $j; ?>" class="panel-collapse collapse">
                <div class="panel-body">
                    
			        <div class="row">
				        <h4 class="col-md-7">Edition de la section:</h4>
                        
			        </div>
		          	<div class="form-group">
		           	 	<label>Sous-titre</label>
		           	 	<input type="text" class="form-control" name="sousTitre<?php echo $j; ?>" value="<?php echo $pageContenu[$i][$j][0]; ?>">
			        </div>
		          	<div class="form-group">
		           	 	<label>Contenu de la section</label>
		            	<textarea id="<?php echo 'T'.$i . $j; ?>" name="message<?php echo $j; ?>" style="height: 275px; margin: 0px; width: 100%;"><?php echo $pageContenu[$i][$j][1]; ?></textarea>
			        </div>	
					<?php echo "<script type='text/javascript'> CKEDITOR.replace( '".'T'.$i . $j."' ); </script>" ?>
                </div>
            </div>
        </div>			
			    <?php } ?>

        <div class="pull-right col-md-4">
			<input type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px; margin-left: 4px;" value="Modifier"/>
        </div>
		</br>
    </div>
			

 		</form>

 		<form method="post" action="?&action=creerSection&id=<?php echo $pages[$i]['id']; ?>" class="well">
 			<h4>Créer une section sur la page "<?php echo $pages[$i]['titre']; ?></a>"</h4> 
 			<div class="form-group">
		   	 	<label>Sous-titre</label>
		   	 	<input type="text" class="form-control" name="sousTitre">
			</div>
		  	<div class="form-group">
		   	 	<label>Contenu de la section</label>
				<?php echo '<textarea id="page_' . $pages[$i]['id'] . 'section" name="message" style="height: 275px; margin: 0px; width: 100%;"></textarea>';?>
				<?php echo '<script type ="text/javascript"> CKEDITOR.replace( \'page_' . $pages[$i]['id'] . 'section\' ); </script>';?>
			</div>	

			<input type="submit" class="btn btn-success" value="Créer la section..."/>
 		</form>

 	</div>
 	<?php 	} ?>
</div>
<?php } ?>
<script type="text/javascript">
    CKEDITOR.replace( 'page_1' );
</script>
</center>