<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"> Membres
            <small>Gestionnaire des Membres</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a data-toggle="collapse" data-parent="#adminPanel" href="#informations">Informations</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Membres
            </li>
        </ol>
        <hr>
        <?php if($_Joueur_['rang'] != 1 AND $_PGrades_['PermsPanel']['members']['actions']['editMember'] == false) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="alert alert-danger">
                    <strong>Vous avez aucune permission pour accéder aux membres.</strong>
                </div>
            </div>
        <?php } else { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="alert alert-success">
                    <strong>Modifiez ici les informations concernant les membres de votre site.</strong>
                </div>
            </div>
        <?php } 
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['members']['actions']['editMember'] == true) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <h3>Edition des membres</h3>
            </div>
            <form method="POST" action="?&action=modifierMembres">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="col-lg-10 col-lg-offset-1">
                                <h3>Modifier des membres</h3>
                                <div class="row">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>Pseudo</th>
                                            <th>Email</th>
                                            <th>Jetons</th>
                                            <th>Rang</th>
                                            <th>Mot de passe</th>
                                            <th>Suppression</th>
                                        </tr>
                                        <?php for($i = 0; $i < count($membres); $i++) { ?>
                                            <tr class="ligneMembres">
                                            <td>
                                                <input type="text" class="form-control membres-form"  name="pseudo<?php echo $i; ?>" value="<?php echo $membres[$i]['pseudo']; ?>" placeholder="Pseudo">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control membres-form"  name="email<?php echo $i; ?>" value="<?php echo $membres[$i]['email']; ?>" placeholder="Email">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control membres-form"  name="jetons<?php echo $i; ?>" value="<?php echo $membres[$i]['jetons']; ?>" placeholder="Jetons">
                                            </td>
                                            <td>
                                                <select name="rang<?php echo $i; ?>" size="1" class="form-control">
                                                    <option value="0" <?php if($membres[$i]['rang'] == 0) { echo 'selected'; }?>>Joueur</option>
                                                        <?php if($_Joueur_['rang'] == 1) { ?><option value="1" <?php if($membres[$i]['rang'] == 1) { echo 'selected'; }?>>Créateur</option><?php }
                                                            for($j = 2; $j <= end($lastGrade); $j++) {
                                                                if(file_exists($dirGrades.$j.'.yml')) {
                                                                    if($idGrade[$j]['Grade']) { ?><option value="<?php echo $j; ?>" <?php if($membres[$i]['rang'] == $j) { echo 'selected'; } echo '>'.$idGrade[$j]['Grade']; } ?></option>
                                                                <?php }
																} ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="password" class="form-control membres-form"  name="mdp<?php echo $i; ?>" value="" placeholder="Changer MDP">
                                            </td>
                                            <td>
                                                <a href="?&action=supprMembre&id=<?php echo $membres[$i]['id']; ?>" class="btn btn-danger">Supprimer</a>
                                            </td>
                                            </tr>
                                            
                                        <?php } ?><input type="hidden" name="nombreUsers" value="<?php echo $i; ?>" />
                                    </table>
                                    
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <input class="btn btn-success" type="submit" value="Modifier le / les comptes"/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
</div>
<!-- /.row -->