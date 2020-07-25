<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h2 class="h2 gray">
        Gestion des tickets support
	</h2>
</div>
<div class="row">
	<?php if(!$_Permission_->verifPerm('PermsPanel', 'support', 'tickets', 'actions', 'editEtatTicket') AND !$_Permission_->verifPerm('PermsPanel', 'support', 'tickets', 'actions', 'deleteTicket')) { ?>
	    <div class="col-md-12 text-center">
	    	<div class="alert alert-danger">
	            <strong>Vous avez aucune permission pour accéder aux tickets.</strong>
	        </div>
	    </div>
	<?php } if($aucunTicket) { ?>
        <div class="col-md-12 text-center">
            <div class="alert alert-warning">
                <strong>Aucun ticket n'a été créé par les membres jusqu'à présent !</strong>
            </div>
        </div>
    <?php } else { ?>
    	<div class="col-md-6 col-xl-4 col-12">
			<div class="card  " >
				<div class="card-header ">
					<h3 class="card-title"><strong></strong></h3>
				</div>
				<div class="card-body" id="change-support">
					<select name="visibilite" class="form-control" required>
						<option value="both"<?php if(isset($_Serveur_["support"]["visibilite"]) && $_Serveur_["support"]["visibilite"] == "both") echo " selected"?>> Au choix</option>
						<option value="prive"<?php if(isset($_Serveur_["support"]["visibilite"]) && $_Serveur_["support"]["visibilite"] == "prive") echo " selected"?>> Privée</option>
						<option value="public"<?php if(isset($_Serveur_["support"]["visibilite"]) && $_Serveur_["support"]["visibilite"] == "public") echo " selected"?>> Publique</option>
					</select>
	            </div>
	            <script>initPost('change-support', 'admin.php?&action=switchTypeSupport', null);</script>
	            <div class="card-footer">
					<div class="row text-center">
						<input type="submit" onclick="sendPost('change-support', null);"class="btn btn-success w-100" value="Modifier !" />
					</div>
				</div>
	        </div>
   		</div>
   		<div class="col-md-6 col-xl-8 col-12" id="all-ticket">
			<div class="card  " >
				<div class="card-header ">
					<div class="float-left">
		        		<strong>Édition des tickets</strong>
		        	</div>
		        	<div class="float-right">
		        		<button class="btn btn-sm btn-outline-secondary" onclick="sendDirectPost('admin.php?action=supprAllTickets', function(data) { if(data) { hide('all-ticket')}});">Tout supprimer</button>
		        	</div>
				</div>
				<div class="card-body" >
						<table class="table table-striped table-hover">
							<thead>
	                            <tr>
	                                <th>Titre</th>
	                                <th >Auteur</th>
	                                <?php if($_Permission_->verifPerm('PermsPanel', 'support', 'tickets', 'actions', 'deleteTicket')) { ?>
	                                    <th>Supprimer</th>
	                                <?php }
	                                if($_Permission_->verifPerm('PermsPane', 'support', 'tickets', 'actions', 'editEtatTicket')) { ?>
	                                    <th >Action</th>
	                                <?php } ?>
	                            </tr>
                        	</thead>
                        	<tbody >
	                            <?php for($i = 0; $i < count($donneesSupport); $i++) { ?>
	                                    <tr id="ticket<?php echo $donneesSupport[$i]['id']; ?>">
	                                        <td><?php echo $donneesSupport[$i]['titre']; ?></td>
	                                        <td><?php echo $donneesSupport[$i]['auteur']; ?></td>
	                                        <?php if($_Permission_->verifPerm('PermsPanel', 'support', 'tickets', 'actions', 'deleteTicket')) { ?>
	                                            <td><button onclick="sendDirectPost('admin.php?action=supprTicket&id=<?php echo $donneesSupport[$i]['id']; ?>', function(data) { if(data) { hide('ticket<?php echo $donneesSupport[$i]['id']; ?>');}});" class="btn btn-danger">Supprimer</button></td>
	                                        <?php } ?>

	                                        <?php if($_Permission_->verifPerm('PermsPanel', 'support', 'tickets', 'actions', 'editEtatTicket')) { $etat = $donneesSupport[$i]['etat'] == 0; ?>
	                                        <td><button value="<?php echo $etat ? '0':'1'; ?>" id="btn-<?php echo $donneesSupport[$i]['id']; ?>" class="btn btn-<?php echo $etat ? 'danger':'success'; ?>"  onclick="sendDirectPost('admin.php?&action=etatTickets&id=<?php echo $donneesSupport[$i]['id']; ?>', function(data) { if(data) { 
	                                        	let btn = get('btn-<?php echo $donneesSupport[$i]['id']; ?>');
	                                        	if(parseInt(btn.value) == 0) {
	                                        		btn.value = 1;
	                                        		btn.innerText = 'Ouvrir le ticket';
	                                        		btn.classList.remove('btn-danger');
	                                        		btn.classList.add('btn-success');
	                                        	} else {
	                                        		btn.value = 0;
	                                        		btn.innerText = 'Fermer le ticket';
	                                        		btn.classList.remove('btn-success');
	                                        		btn.classList.add('btn-danger');
	                                        	}
	                                        }})"><?php echo $etat ? 'Fermer':'Ouvrir'; ?> le ticket</button></td><?php } ?>

	                                    </tr>
	                            <?php } ?>
	                        </tbody>
                        </table>
	            </div>
	        </div>
   		</div>

   	<?php } ?>
</div>