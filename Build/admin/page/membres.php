<div class="cmw-page-content-header"><strong>Gestion</strong> - Gérez vos Membres</div>
<div class="row">
        <?php if($_Joueur_['rang'] != 1 AND $_PGrades_['PermsPanel']['members']['actions']['editMember'] == false) { ?>
            <div class="col-md-12 text-center">
                <div class="alert alert-danger">
                    <strong>Vous avez aucune permission pour accéder aux membres.</strong>
                </div>
            </div>
        <?php } else { ?>
            <div class="col-md-12 text-center">
                <div class="alert alert-success">
                    <strong>Modifiez ici les informations concernant les membres de votre site.</strong>
                </div>
            </div>
        <?php } 
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['members']['actions']['editMember'] == true) { ?>
    </div>
    <div class="row">
        <div class="col-md-12">
        <div class="panel panel-default cmw-panel">
            <div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Édition des membres</strong></h3>
            </div>
            <div class="panel-body">
                <form method="POST" action="?&action=modifierMembres">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Modifier des membres</h3>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <tr>
                            <th style='width:75px'>ID</th>
                            <th>Pseudo</th>
                            <th>Email</th>
                            <th>Jetons</th>
                            <th>Rang</th>
                            <th>Mot de passe</th>
                            <th>Valid. manuelle</th>
                            <th>Suppression</th>
                        </tr>
                        <?php for($i = 0; $i < count($membres); $i++) { ?>
                            <tr class="ligneMembres">
                            <td>
                                <input type="number" class="form-control membres-form" value="<?= $membres[$i]['id']?>" disabled>
                            </td>
                            <td>
                                <input type="text" class="form-control membres-form"  name="pseudo<?php echo $i; ?>" value="<?php echo $membres[$i]['pseudo']; ?>" placeholder="Pseudo">
                            </td>
                            <td>
                                <input type="text" class="form-control membres-form"  name="email<?php echo $i; ?>" value="<?php echo $membres[$i]['email']; ?>" placeholder="Email">
                            </td>
                            <td>
                                <input type="number" class="form-control membres-form"  name="jetons<?php echo $i; ?>" value="<?php echo $membres[$i]['tokens']; ?>" placeholder="Jetons">
                            </td>
                            <td>
                                <select name="rang<?php echo $i; ?>" size="1" class="form-control">
                                    <option value="0" <?php if($membres[$i]['rang'] == 0) { echo 'selected'; }?>>Joueur</option>
                                        <?php if($_Joueur_['rang'] == 1) { ?><option value="1" <?php if($membres[$i]['rang'] == 1) { echo 'selected'; }?>>Créateur</option><?php }
                                            for($j = 2; $j <= max($lastGrade); $j++) {
                                                if(file_exists($dirGrades.$j.'.yml') && $idGrade[$j]['Grade']) { ?>
                                                    <option value="<?php echo $j; ?>" <?php if($membres[$i]['rang'] == $j) echo 'selected'?>><?=$idGrade[$j]['Grade']?></option>
                                                <?php }
											} ?>
                                </select>
                            </td>
                            <td>
                                <input type="password" class="form-control membres-form"  name="mdp<?php echo $i; ?>" value="" placeholder="Changer MDP">
                            </td>
                            <td>
								<?php if($membres[$i]['ValidationMail'] == 0){?>
                                <a href="?&action=validMail&id=<?php echo $membres[$i]['id']; ?>" class="btn btn-danger">Valider e-mail</a>
								<?php } else {?>
                                <a href="#" class="btn btn-success disable">e-mail validé</a>
								<?php }?>
                            </td>
                            <td>
                                <a href="?&action=supprMembre&id=<?php echo $membres[$i]['id']; ?>" class="btn btn-danger">Supprimer</a>
                            </td>
                            </tr>
                            
                        <?php } ?><input type="hidden" name="nombreUsers" value="<?php echo $i; ?>" />
                    </table>
                    <div class="row">
                        <div class="col-md-12 text-center" style="margin-top: 5px;">
                            <input class="btn btn-success" type="submit" value="Modifier le / les comptes"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        <?php } ?>