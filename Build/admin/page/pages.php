<div class="cmw-page-content-header"><strong>Pages personnalisées</strong> - Gérez les pages personnalisées de votre site</div>

    <?php if($_Joueur_['rang'] != 1 AND ($_PGrades_['PermsPanel']['pages']['actions']['addPage'] == false AND $_PGrades_['PermsPanel']['pages']['actions']['editPage'] == false)) { ?>

    <div class="row">
        <div class="alert alert-danger">
            <strong>Vous avez aucune permission pour accéder aux réglages des pages.</strong>
        </div>
    </div>
    <?php } else { ?>
    <div class="row">
        <div class="alert alert-success">
            <strong>En plus des pages de base du CMS, vous pouvez créer des pages personnalisées, ces pages peuvent être découpées en plusieurs "sections". Une fois la page créée vous pouvez faire un lien vers cette dernière dans la section "menus" de votre panel.</strong>
        </div>
    </div>
    <?php } ?> <div class="row"> <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['pages']['actions']['addPage'] == true) { ?>
    <div class="col-xs-12 col-md-6 text-center">
        <div class="panel panel-default cmw-panel">
            <div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Création d'une nouvelle page</strong></h3>
                </div>
            <div class="panel-body">
            <div class="alert alert-success">
                <strong>Quand vous créez une page cette dernière ne contient qu'une section définie lors de la création, vous pourrez ensuite éditer votre page une fois créée et y ajouter jusqu'à 5 sections. Une section est constituée d'un sous titre et d'un bloc de texte. La page est constituée d'un titre et d'une ou plusieurs sections.</strong>
            </div>        
            <form method="POST" action="?&action=creerPage">

                    <h3>Créer une page</h3>
                    <label class="control-label">Titre de la page</label>
                    <input type="text" name="titre" class="form-control" placeholder="ex: Nos plugins"/>
                    
                    <label class="control-label">Sous-titre</label>
                    <input type="text" name="sousTitre" class="form-control" placeholder="ex: Essentials"/>
                    
                    <label class="control-label">Contenu de la section </label>
                    <textarea id="page_1" name="message"></textarea>

                    <br/>
                    <input type="submit" class="btn btn-success" value="Ajouter la page !"/>
            </form>
        </div>
        </div>
    </div>

    <?php } if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['pages']['actions']['editPage'] == true) { ?>
    <div class="col-xs-12 col-md-6 text-center">
        <div class="panel panel-default cmw-panel">
            <div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Edition des pages</strong></h3>
            </div>
            <div class="panel-body">
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
                                                    <a href="?&action=supprSection&page=<?php echo $pages[$i]['id']; ?>&id=<?php echo $j; ?>" class="btn btn-danger btn-sm pull-right">Supprimer la section</a>
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
                                <h4>Créer une section sur la page "<?php echo $pages[$i]['titre']; ?>"</h4>
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

    <?php } ?> </div><?php } ?>

    <script type="text/javascript">
        CKEDITOR.replace( 'page_1' );
    </script>
</div>