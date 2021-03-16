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
		Historique des votes
	</h2>
</div>
        <?php if(!$_Permission_->verifPerm('PermsPanel', 'vote', 'voteHistory', 'showPage')) { ?>
            <div class="text-center">
    <div class="alert alert-danger">
        <strong>Vous n'avez aucune permission pour accéder à cette page !</strong>
    </div>
</div>
           <?php } else { ?>
<div class="row">

    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>Configurer la liste des voteurs</strong> <small id="infoState">(Croissant sur
                        nombre)</small></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <h5>Nombre de voteurs/pages: <input style="margin-top:3px;" type="number"
                                onchange="setMaxShow('input-changemax')" id="input-changemax" min="1"
                                max="<?php echo $data['count']; ?>" step="1" placeholder="2020 ?" class="input-disabled form-control"
                                value="<?php echo $data['count']>50 ? '50':$data['count'] ; ?>"> 
                                <button type="button" onclick="setMaxShow('input-changemax')" class="btn w-100 btn-success d-sm-block d-md-none">Mettre à jour</button></h5>
                        <h5 style="margin-top:20px;">Rechercher un voteur: <input style="margin-top:3px;" type="text"
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
                 <div style="width: 100%;display: inline-block">
                    <div class="float-left">
                        <h3 class="card-title"><strong>Liste des voteurs</strong></h3>
                    </div>
                    <div class="float-right">
                        <button  onclick="sendDirectPost('admin.php?action=suppAllVoteHistory', function(data) { if(data) { hide('allUser'); } });" class="btn btn-sm btn-outline-secondary">Rénitialiser</button>
                    </div>
                </div>
            </div>
            <div class="card-body">

                     <div class="col-md-12">
                            <div class="alert alert-success">
                                <div class="text-center">
                                    <p>
                                        <i class="fas fa-info-circle"></i> Vous pouvez cliquer sur les noms des colonnes pour obtenir une recherche plus avancé / conforme à vos attentes.
                                    </p>
                                </div>
                            </div>
                        <br/>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="cursor:pointer;" onclick="setAxe('pseudo');">Pseudo</th>
                                    <th style="cursor:pointer;" onclick="setAxe('ip');">IP</th>
                                    <th style="cursor:pointer;" onclick="setAxe('nombre');">Nombre de votes</th>
                                    <th style="cursor:pointer;" onclick="setAxe('date_dernier');">Date du dernier vote</th>
                                    <th >Dernier vote sur le site:</th>
                                     <?php if($_Permission_->verifPerm('PermsPanel', 'vote', 'voteHistory', 'actions', 'removeVote')) { ?>
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
                        </div>
                        </div>
                    </div>

                </div>
            </div>
<?php if(!empty($oldHistory)) { ?>
    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                 <div style="width: 100%;display: inline-block">
                    <div class="float-left">
                        <h3 class="card-title"><strong>Liste des anciens voteurs</strong></h3>
                    </div>
                    <div class="float-right">
                        <button  onclick="sendDirectPost('admin.php?action=suppAllOldVoteHistory', function(data) { if(data) { hide('allUser'); } });" class="btn btn-sm btn-outline-secondary">Rénitialiser</button>
                    </div>
                </div>
            </div>
            <div class="card-body">

                     <div class="col-md-12">
                           
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th >Pseudo</th>
                                    <th >IP</th>
                                    <th >Nombre de votes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; foreach($oldHistory as $value) {  if($i < 20) {?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td ><?php echo $value['pseudo']; ?></td>
                                        <td ><?php echo $value['ip']; ?></td>
                                        <td ><?php echo $value['nbre_votes']; ?></td>
                                    </tr>

                                <?php $i++;}else { break;} }  ?>

                            </tbody>
                        </table>
                    </div>
             </div> 
                </div>
            </div>
        <?php } ?>
    </div>

<?php  include('./admin/assets/js/voteHistory.php');

 } ?>