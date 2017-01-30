<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Nouveautés
            <small>Gestionnaire des Nouveautés</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a data-toggle="collapse" data-parent="#adminPanel" href="#informations">Informations</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Nouveautés
            </li>
        </ol>
        <hr>
        <?php if($_Joueur_['rang'] != 1 AND ($_PGrades_['PermsPanel']['news']['actions']['addNews'] == false AND $_PGrades_['PermsPanel']['news']['actions']['editNews'] == false)) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="alert alert-danger">
                    <strong>Vous avez aucune permission pour accéder aux nouveautés.</strong>
                </div>
            </div>
        <?php } else { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="alert-success">
                    <strong>Les news sont visibles sur l'accueil, elles informent vos joueurs des nouveautées relatives à votre communautée, pensez à rédiger des news souvent cela prouve votre activité, ça fait toujours plaisir à un joueur de voir un nouveau message!</strong>
                </div>
            </div>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['news']['actions']['addNews'] == true) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="row">
                    <h3>Création d'une nouveauté</h3>
                </div>
                <div class="row">
                    <div class="alert alert-success">
                        <strong>Pour ajouter une news, rien de plus simple, il suffit en effet de lui attribuer un titre, et... Un message !</strong>
                    </div>
                </div>
            </div>
            <form method="POST" action="?&action=postNews">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="col-lg-10 col-lg-offset-1">
                                <h3>Créer une nouveauté</h3>
                                <div class="row">
                                    <label class="control-label">Titre de la news</label>
                                    <input type="text" name="titre" class="form-control" placeholder="ex: Sortie du launcher !">
                                </div>
                                <div class="row">
                                    <label class="control-label">Contenu de la news</label>
                                    <textarea id="news_1" name="message"></textarea>
                                </div>
                                <hr>
                                <div class="row">
                                    <input type="submit" class="btn btn-success" value="Créer la nouveauté !"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-warning">
                        <strong>Sachez que le CMS n'affiche que les 10 dernières news, les anciennes disparaitrons donc au fur et à mesure. Je vous conseille de garder les vieilles news et de supprimer que les fails !</strong>
                    </div>
                </div>
            </form>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['news']['actions']['editNews'] == true) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="row">
                    <h3>Edition des nouveautés</h3>
                </div>
                <?php if(empty($tableauNews)) { ?>
                    <div class="row">
                        <div class="alert alert-warning">
                            <strong>Aucune nouveauté.</strong>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="row">
                        <div class="alert alert-success">
                            <strong>Editer une nouveauté si cela est nécessaire pour corriger des fautes ou tout simplement la supprimer de la liste des nouveautés.</strong>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php if(!empty($tableauNews)) { ?>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="col-lg-10 col-lg-offset-1">
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
                                                        <label class="control-label">Titre de la news</label>
                                                        <input type="text" class="form-control" name="titre" value="<?php echo $tableauNews[$i]['titre']; ?>">
                                                    </div>
                                                    <div class="row">
                                                        <label class="control-label">Supprimer la news définitivement</label>
                                                        <a href="?action=supprNews&newsId=<?php echo $tableauNews[$i]['id']; ?>" class="btn btn-danger form-control">Supprimer la News</a>
                                                    </div>
                                                    <div class="row">
                                                        <?php echo '<textarea id="news_' . $tableauNews[$i]['id'] . 'C" name="message" style="height: 275px; margin: 0px; width: 50%;">' . $tableauNews[$i]['message'] . '</textarea>';?>
                                                        <?php echo '<script type ="text/javascript"> CKEDITOR.replace( \'news_' . $tableauNews[$i]['id'] . 'C\' ); </script>';?>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <input type="submit" class="btn btn-success" value="Modifer le message"/>
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
        CKEDITOR.replace( 'news_1' );
        </script>
    </div>
</div>
<!-- /.row -->