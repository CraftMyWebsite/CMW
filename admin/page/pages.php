<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"> Pages
            <small>Gestionnaire des Pages</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a data-toggle="collapse" data-parent="#adminPanel" href="#informations">Informations</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Pages
            </li>
        </ol>
        <hr>
        <?php if($_Joueur_['rang'] != 1 AND ($_PGrades_['PermsPanel']['pages']['actions']['addPage'] == false AND $_PGrades_['PermsPanel']['pages']['actions']['editPage'] == false)) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="alert alert-danger">
                    <strong>Vous avez aucune permission pour accéder aux réglages des pages.</strong>
                </div>
            </div>
        <?php } else { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="alert alert-success">
                    <strong>En plus des pages de base du CMS, vous pouvez créer des pages personnalisées, ces pages peuvent être découpées en plusieurs "sections". Une fois la page créée vous pouvez faire un lien vers cette dernière dans la section "menus" de votre panel.</strong>
                </div>
            </div>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['pages']['actions']['addPage'] == true) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="row">
                    <h3>Création d'une nouvelle page</h3>
                </div>
                <div class="row">
                    <div class="alert alert-success">
                        <strong>Quand vous créez une page cette dernière ne contient qu'une section définie lors de la création, vous pourrez ensuite éditer votre page une fois créée et y ajouter jusqu'à 5 sections. Une section est constituée d'un sous titre et d'un bloc de texte. La page est constituée d'un titre et d'une ou plusieurs sections.</strong>
                    </div>
                </div>
            </div>
            <form method="POST" action="?&action=creerPage">
                <div class="col-lg-6 col-lg-offset-3 text-center">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="col-lg-10 col-lg-offset-1">
                                <h3>Créer une page</h3>
                                <div class="row">
                                    <label class="control-label">Titre de la page</label>
                                    <input type="text" name="titre" class="form-control" placeholder="ex: Nos plugins"/>
                                </div>
                                <div class="row">
                                    <label class="control-label">Sous-titre</label>
                                    <input type="text" name="sousTitre" class="form-control" placeholder="ex: Essentials"/>
                                </div>
                                <div class="row">
                                    <label class="control-label">Contenu de la section </label>
                                    <textarea id="page_1" name="message"></textarea>
                                </div>
                                <hr>
                                <div class="row">
                                    <input type="submit" class="btn btn-success" value="Ajouter la page !"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['pages']['actions']['editPage'] == true) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="row">
                    <h3>Edition des pages</h3>
                </div>
                <?php if(empty($pages)) { ?>
                    <div class="row">
                        <div class="alert alert-warning">
                            <strong>Aucune page est à modifier.</strong>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="row">
                        <div class="alert alert-success">
                            <strong>Vous pouvez rajouter des sections à chacunes de vos pages! Pour rappel: une page est un ensemble de minimum une section, vous pouvez modifier, ajouter ou supprimer une section.</strong>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php if(!empty($pages)) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="col-lg-10 col-lg-offset-1">
                            <div class="row">
                                <ul class="nav nav-tabs">
                                    <?php for($i = 0; $i < count($pages); $i++) { ?>
                                        <li><a <?php if($i == 0) echo 'class="active"'; ?> href="#page<?php echo $pages[$i]['id']; ?>" data-toggle="tab"><?php echo $pages[$i]['titre']; ?></a></li>
                                    <?php } ?>
                                </ul>
                                <div class="tab-content">
                                    <?php for($i = 0; $i < count($pages); $i++) { ?>
                                        <div class="tab-pane <?php if($i == 0) echo 'active'; ?>" id="page<?php echo $pages[$i]['id']; ?>">
                                            <form method="POST" action="?&action=editPage&id=<?php echo $pages[$i]['id']; ?>" class="well">
                                                <div class="row">
                                                    <label>Titre de la page</label>
                                                    <input type="text" class="form-control" name="titre" value="<?php echo $pages[$i]['titre']; ?>"/>
                                                </div>
                                                <div class="row">
                                                    <label>Supprimer la page et son contenu</label>
                                                    <a href="?action=supprPage&id=<?php echo $pages[$i]['id']; ?>" class="btn btn-danger form-control">Supprimer la page</a>
                                                </div>
                                                <div class="row">
                                                    <div class="panel-group" id="sections<?php echo $pages[$i]['id']; ?>">
                                                        <?php for($j = 0; $j < count($pages[$i]['tableauPages']); $j++) { ?>
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4 class="panel-title">
                                                                        <a data-toggle="collapse" class="btn btn-success" data-parent="#sections<?php echo $pages[$i]['id']; ?>" href="#section<?php echo $i . $j; ?>" style="color: white;">Editer section <strong>"<?php echo $pageContenu[$i][$j][0]; ?>"</strong> De la page <strong><?php echo $pages[$i]['titre']; ?></strong>.</a>
                                                                        <a href="?&action=supprSection&page=<?php echo $pages[$i]['id']; ?>&id=<?php echo $j; ?>" class="btn btn-danger btn-sm pull-right"/>Supprimer la section</a>
                                                                    </h4>
                                                                </div>
                                                                <div id="section<?php echo $i . $j; ?>" class="panel-collapse collapse">
                                                                    <div class="panel-body">
                                                                        <div class="row">
                                                                            <h4>Edition de la section</h4>
                                                                        </div>
                                                                        <div class="row">
                                                                            <label class="control-label">Sous-titre</label>
                                                                            <input type="text" class="form-control" name="sousTitre<?php echo $j; ?>" value="<?php echo $pageContenu[$i][$j][0]; ?>">
                                                                        </div>
                                                                        <div class="row">
                                                                            <label class="control-label">Contenu de la section</label>
                                                                            <textarea id="<?php echo 'T'.$i . $j; ?>" name="message<?php echo $j; ?>" style="height: 275px; margin: 0px; width: 100%;"><?php echo $pageContenu[$i][$j][1]; ?></textarea>
                                                                        </div>
                                                                        <?php echo "<script type='text/javascript'> CKEDITOR.replace( '".'T'.$i . $j."' ); </script>" ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <hr>
                                                        <div class="row">
                                                            <input type="submit" class="btn btn-success" value="Modifier"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <form method="POST" action="?&action=creerSection&id=<?php echo $pages[$i]['id']; ?>" class="well">
                                                <h4>Créer une section sur la page "<?php echo $pages[$i]['titre']; ?></a>"</h4>
                                                <div class="row">
                                                    <label class="control-label">Sous-titre</label>
                                                    <input type="text" class="form-control" name="sousTitre">
                                                </div>
                                                <div class="row">
                                                    <label>Contenu de la section</label>
                                                    <?php echo '<textarea id="page_' . $pages[$i]['id'] . 'section" name="message"></textarea>';?>
                                                    <?php echo '<script type ="text/javascript"> CKEDITOR.replace( \'page_' . $pages[$i]['id'] . 'section\' ); </script>';?>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <input type="submit" class="btn btn-success" value="Créer la section !"/>
                                                </div>
                                            </form>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
        } ?>
        <script type="text/javascript">
        CKEDITOR.replace( 'page_1' );
        </script>
    </div>
</div>