<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2 gray">
        Historique de la boutique
    </h2>
</div>



<?php if(!Permission::getInstance()->verifPerm('PermsPanel', 'shop', 'boutiqueList', 'showPage'))
{
	echo '
		<div class="alert alert-danger">
			<strong>Vous avez aucune permission pour accéder à cette page.</strong>
		</div>';
} 
else
{ ?>


<div class="row">

    <div class="col-xs-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Liste des Achats <small id="infoState">(Croissant sur ID)</small>
                </h4>
            </div>
            <div class="card-body">
            	<div class="row" style="margin-bottom:20px;">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                    	
                        <h5>Nombre d'achat/pages: <input style="margin-top:3px;" type="number"
                                onchange="setMaxShow('input-changemax')" id="input-changemax" min="1"
                                max="<?php echo $data['count']; ?>" step="1" placeholder="2020 ?" class="input-disabled form-control"
                                value="<?php echo $data['count']>50 ? '50': $data['count'] ; ?>"> 
                                <button type="button" onclick="setMaxShow('input-changemax')" class="btn w-100 btn-success d-sm-block d-md-none">Mettre à jour</button></h5>
                        <h5 style="margin-top:20px;">Rechercher un membre: <input style="margin-top:3px;" type="text"
                                onkeyup="updateList();" id="input-search" class="input-disabled form-control"
                                placeholder="ex: Vladimir"></h5>
                    </div>
                </div>
                   <table class="table table-striped table-hover">
						<thead>
							<tr>
								<th style="width:75px;cursor:pointer;" onclick="setAxe('id')">ID</th>
                                <th style="cursor:pointer;" onclick="setAxe('pseudo');">Pseudo</th>
                                <th style="cursor:pointer;" onclick="setAxe('offre_id');">Offre</th>
                                <th style="cursor:pointer;" onclick="setAxe('prix');">Prix Unitaire</th>
                                <th >Quantité</th>
                                <th style="cursor:pointer;" onclick="setAxe('prixTotal');">Prix Total</th>
                                <th style="cursor:pointer;" onclick="setAxe('date_achat');">Date d'achat</th>

							</tr>
						</thead>
						<tbody id="allAchat">
					
						</tbody>
					</table>
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
</div>

	<?php  include('./admin/assets/js/boutiquelist.php');
}