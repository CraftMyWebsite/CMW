<div class="cmw-page-content-header"><strong>Gestion</strong> - Gérez vos nouveautés</div>
<div class="row">
        <?php if($_Joueur_['rang'] != 1 AND ($_PGrades_['PermsPanel']['news']['actions']['addNews'] == false AND $_PGrades_['PermsPanel']['news']['actions']['editNews'] == false)) { ?>
            <div class="col-md-12 text-center">
                <div class="alert alert-danger">
                    <strong>Vous avez aucune permission pour accéder aux nouveautés.</strong>
                </div>
            </div>
        </div><div class="row" style="padding-top: 5px;">
        <?php } else { ?>
            <div class="col-md-12 text-center">
                <div class="alert-success">
                    <strong>Les news sont visibles sur l'accueil, elles informent vos joueurs des nouveautés relatives à votre communauté, pensez à rédiger des news souvent, cela prouve votre activité, ça fait toujours plaisir à un joueur de voir un nouveau message!</strong>
                </div>
            </div>
        </div><div class="row" style="padding-top: 5px;">
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['news']['actions']['addNews'] == true) { ?>
            <div class="col-md-6">
                <div class="panel panel-default cmw-panel">
                    <div class="panel-heading cmw-panel-header">
                        <h3 class="panel-title"><strong>Création d'une nouveauté</strong></h3>
                    </div>
                <div class="panel-body">
                    <div class="alert alert-success">
                        <strong>Pour ajouter une news il suffit de lui attribuer un titre, et... Un message !</strong>
                    </div>
                    <form method="POST" action="?&action=postNews">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Créer une nouveauté</h3>
                            </div>
                            <div class="col-md-12">
                                <label class="control-label">Titre de la news</label>
                                <input type="text" name="titre" class="form-control" placeholder="ex: Sortie du launcher !">
                            </div>
                            <div class="col-md-12">
                                <label class="control-label">Contenu de la news</label>
                                <textarea id="news_1" name="message"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center" style="margin-top: 5px;">
                                <input type="submit" class="btn btn-success" value="Créer la nouveauté !"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="alert alert-warning">
                                <strong>Sachez que le CMS n'affiche que les 10 dernières news, les anciennes disparaitrons donc au fur et à mesure. Je vous conseille de garder les vieilles news et de supprimer que les fails !</strong>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['news']['actions']['editNews'] == true) { ?>
            <div class="col-md-6">
                <div class="panel panel-default cmw-panel">
                    <div class="panel-heading cmw-panel-header">
                        <h3 class="panel-title"><strong>Édition des nouveautés</strong></h3>
                    </div>
                    <div class="panel-body">
                <?php if(empty($tableauNews)) { ?>
                        <div class="alert alert-warning">
                            <strong>Aucune nouveauté.</strong>
                        </div>
                <?php } else { ?>
                        <div class="alert alert-success">
                            <strong>Editer une nouveauté si cela est nécessaire pour corriger des fautes ou tout simplement la supprimer de la liste des nouveautés.</strong>
                        </div>
                <?php } 
                 if(!empty($tableauNews)) { ?>
                        <div class="col-md-12">
                            <h3>Editer une nouveauté</h3>
                            <div class="row">
                                <ul class="nav nav-tabs">
                                    <?php for($i = 0; $i < count($tableauNews); $i++) { ?>
                                        <li><a <?php if($i == 0) echo 'class="active"'; ?> href="#news<?php echo $tableauNews[$i]['id']; ?>" data-toggle="tab"><?php echo $tableauNews[$i]['titre']; ?></a></li>
                                    <?php } ?>
                                </ul>
                                <div class="tab-content">
                                    <?php for($i = 0; $i < count($tableauNews); $i++) { ?>
                                        <div class="tab-pane <?php if($i == 0) echo 'active'; ?>" id="news<?php echo $tableauNews[$i]['id']; ?>">
                                            <form method="POST" action="?&action=editNews&id=<?php echo $tableauNews[$i]['id']; ?>" class="well">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="control-label">Titre de la news</label>
                                                        <input type="text" class="form-control" name="titre" value="<?php echo $tableauNews[$i]['titre']; ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="control-label">Supprimer la news définitivement</label>
                                                        <a href="?action=supprNews&newsId=<?php echo $tableauNews[$i]['id']; ?>" class="btn btn-danger form-control">Supprimer la News</a>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="control-label"><?=($tableauNews[$i]['epingle'] == 1) ? 'Désépingler' : 'Épingler';?> la news</label>
                                                        <a href="?action=epingle&newsId=<?php echo $tableauNews[$i]['id']; ?>&epingle=<?=$tableauNews[$i]['epingle'];?>" class="btn btn-warning form-control"><?=($tableauNews[$i]['epingle'] == 1) ? 'Désépingler' : 'Épingler';?> la news</a>
                                                    </div>
                                                </div>
                                                <div class="row" style="padding-top: 5px;">
                                                    <?php echo '<textarea id="news_' . $tableauNews[$i]['id'] . 'C" name="message" style="height: 275px; margin: 0px; width: 50%;">' . $tableauNews[$i]['message'] . '</textarea>';?>
                                                    <?php echo '<script type ="text/javascript"> CKEDITOR.replace( \'news_' . $tableauNews[$i]['id'] . 'C\' ); </script>';?>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 text-center" style="margin-top: 5px;">
                                                        <input type="submit" class="btn btn-success" value="Modifer le message"/>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php 
        } ?>
        <script type="text/javascript">
        CKEDITOR.replace( 'news_1' );
        </script>
</div>
<!-- /.row -->