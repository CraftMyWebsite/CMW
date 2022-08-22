<style>
:disabled{
    cursor: not-allowed;
    display: inherit;
}
.inputwithoutarrow::-webkit-outer-spin-button,
.inputwithoutarrow::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
.inputwithoutarrow[type=number] {
  -moz-appearance: textfield;
}
</style>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h2 class="h2 gray">
		Gestion - Gestion des Membres
	</h2>
</div>
        <?php if(!$_Permission_->verifPerm('PermsPanel', 'members', 'showPage')) { ?>
            <div class="text-center">
    <div class="alert alert-danger">
        <strong>Vous n'avez aucune permission pour accéder à cette page !</strong>
    </div>
</div>
           <?php } else { ?>
    <div class="text-center">
        <div class="alert alert-success">
            <strong>
                Modifiez ici les informations concernant les membres de votre site.
            </strong>
        </div>
    </div>
<div class="row">

    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>Édition des membres</strong> <small id="infoState">(Croissant sur
                        id)</small></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <h5>Nombre de membres/pages: <input style="margin-top:3px;" type="number"
                                onchange="setMaxShow('input-changemax')" id="input-changemax" min="1"
                                max="<?php echo count($membres); ?>" step="1" placeholder="2020 ?" class="input-disabled form-control"
                                value="<?php echo count($membres)>50 ? '50':count($membres) ; ?>"> 
                                <button type="button" onclick="setMaxShow('input-changemax')" class="btn w-100 btn-success d-sm-block d-md-none">Mettre à jour</button></h5>
                        <h5 style="margin-top:20px;">Rechercher un membre: <input style="margin-top:3px;" type="text"
                                onkeyup="updateList();" id="input-search" class="input-disabled form-control"
                                placeholder="ex: Vladimir"></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>Membres de votre site</strong></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            <div class="text-center">
                                <p>
                                    <i class="fas fa-info-circle"></i> Vous pouvez cliquer sur les noms des colonnes pour obtenir une recherche plus avancée / conforme à vos attentes.
                                </p>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <table class="table table-striped table-hover table-responsive">
                        <thead>
                            <tr>
                                <th style="width:75px;cursor:pointer;" onclick="setAxe('id')">ID</th>
                                <th style="cursor:pointer;" onclick="setAxe('pseudo');">Pseudo</th>
                                <th style="cursor:pointer;" onclick="setAxe('email');">Email</th>
                                <th style="cursor:pointer;" onclick="setAxe('tokens');"><?=$_Serveur_['General']['moneyName'];?></th>
                                <th style="cursor:pointer;" onclick="setAxe('rang');">Rang</th>
                                <th>Mot de passe</th>
                                <?php if($_Permission_->verifPerm('PermsPanel', 'members', "actions","editMember")) { ?>
                                    <th style="cursor:pointer;" onclick="setAxe('ValidationMail');">Valid. manuelle</th>    
                                    <th>Suppression</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody id="allUser">
                        </tbody>
                    </table>
                </div> 
                </div>
                <div class="card-footer">

                    <div class="row">

                        <div class="offset-md-4"></div>
                        <div class="col-md-4">

                            <div class="d-flex justify-content-center">

                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <button class="page-link" onclick="lessIndex();" aria-hidden="true"
                                                id="left">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </button>
                                        </li>
                                        <input min="0" step="1" class="text-center inputwithoutarrow" max="9999" onchange="setIndex();"
                                            id="block" type="number" value="0" />

                                        <li class="page-item">
                                            <button class="page-link" onclick="moreIndex();" aria-hidden="true"
                                                id="right">
                                                <span aria-hidden="true">&raquo;</span>
                                                <span class="sr-only">Next</span>
                                            </button>
                                        </li>
                                    </ul>
                                </nav>


                            </div>
                            <div class="from-group" style="display: block !important">
                                <button class="btn btn-success w-100" id="confirm-change" onclick="sendChange()"
                                    disabled>Modifier le / les comptes</button>
                            </div>
                        </div>



                    </div>
                    </div>

                </div>
            </div>
        </div>
        <br/>
    </div>

<?php  include('./admin/assets/js/membres.php');

 } ?>