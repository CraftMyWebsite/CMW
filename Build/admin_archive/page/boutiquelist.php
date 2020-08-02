<div class="cmw-page-content-header"><strong>Boutique</strong> - Visualisez les achats effectués</div>

<?php if(!Permission::getInstance()->verifPerm('PermsPanel', 'shop', 'boutiqueList', 'showPage'))
{
	echo '<div class="col-lg-6 col-lg-offset-3 text-center">
		<div class="alert alert-danger">
			<strong>Vous avez aucune permission pour accéder à cette page.</strong>
		</div>
	</div>';
} 
elseif(Permission::getInstance()->verifPerm('PermsPanel', 'shop', 'boutiqueList', 'showPage'))
{
	?>
<div class="row">
	<div class="alert alert-info">Dans cette catégorie vous pourrez visualiser les achats affectués dans votre boutique, mais aussi récupérer tout les achats effectué par une certaine personne, et plein d'autres sortes de trie ! </div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default cmw-panel">
			<div class="panel-heading cmw-panel-header">
				<h3 class="panel-title"><strong>Liste des Achats</strong></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<center>
					<div class="col-md-4">
						<a class="btn btn-info" onClick="showAvanceeBoutique('Pseudo');">Recherche par Pseudo</a>
						<div id="recherchePseudo" class="d-none">
							<input type="text" class="form-control" name="pseudo" id="pseudo" />
							<a class="btn btn-success" onClick="getBoutiqueListe('pseudo')">Rechercher</a>
						</div>
					</div>
					<div class="col-md-4">
						<a class="btn btn-info" onClick="showAvanceeBoutique('Date');">Recherche par date d'achat</a>
						<div id="rechercheDate" class="d-none">
							<input type="text" class="form-control" name="date" id="date" placeholder="date sous la forme: jj-mm-aaaa" />
							<a class="btn btn-success" onClick="getBoutiqueListe('date')">Rechercher</a>
						</div>
					</div>
					<div class="col-md-4">
						<a class="btn btn-info" onClick="showAvanceeBoutique('Offre');">Recherche par offre</a>
						<div id="rechercheOffre" class="d-none">
							<select name="offre" id="offre" class="form-control">
								<?php for($o = 0; $o < count($listeOffreData); $o++)
								{
									?><option value="<?=$listeOffreData[$o]['id'];?>"><?=$listeOffreData[$o]['nom'];?></option><?php
								}
								?>
							</select>
							<a class="btn btn-success" onClick="getBoutiqueListe('offre')">Rechercher</a>
						</div>
					</div>
					</center>
				</div><br/>
				<div id="boutiqueListe">
					<table class="table table-striped table-hover">
						<tr>
							<th>ID</th>
							<th>Pseudo</th>
							<th>Offre</th>
							<th>Prix Unitaire</th>
							<th>Quantité</th>
							<th>Prix Total</th>
							<th>Date d'achat</th>
						</tr>
					<?php
						for($i = 0; $i < count($boutiqueListeData); $i++)
						{
							?><tr>
								<td><?=$boutiqueListeData[$i]['id'];?></td>
								<td><?=$boutiqueListeData[$i]['pseudo'];?></td>
								<td><?=$boutiqueListeData[$i]['titre'];?></td>
								<td><?=$boutiqueListeData[$i]['prix'];?></td>
								<td><?=($boutiqueListeData[$i]['prixTotal'] > 0) ? ceil($boutiqueListeData[$i]['prixTotal']/$boutiqueListeData[$i]['prix']) : 'Non renseigné';?></td>
								<td><?=$boutiqueListeData[$i]['prixTotal'];?></td>
								<td><?=date('d-m-Y', strtotime($boutiqueListeData[$i]['date_achat']));?></td>
							</tr><?php
						}
					?>
					</table>
					<center><nav aria-label="Page navigation example">
					  <ul class="pagination">
					    <li class="page-item active"><a class="page-link">1</a></li>
					    <?php 
					    $page = 2;
					    while($page <= $nbPage)
					    {
					    	echo '<li class="page-item"><a class="page-link" onClick="BoutiqueListePage('.$page.');">'.$page.'</a></li>';
					    	$page++;
					    }
					    ?>
					  </ul>
					</nav></center>
				</div>
			</div>
		</div>
	</div>
</div>
	<?php 
}