<?php if(isset($_Joueur_)){?>
<header class="heading-pagination">
    <div class="container-fluid">
        <h1 class="text-uppercase wow fadeInRight" style="color:white;">Boutique</h1>
    </div>
</header>
<section class="layout" id="page">
    <div class="container">
        <div class="text-center">
            <h4 class="text-primary"><i class="fa fa-shopping-basket"></i> Panier</h4>
            <p>Achetez plusieurs items en déboursant une seule fois</p>
        </div>
        <?php
            if(isset($_GET['success']) && $_GET['success'] == 'true')
            {
                echo '<div class="alert alert-success"><center><strong>Votre achat a été effectué !</strong></center></div>';
            }
            ?>
        <table class="table table-striped table-bordered">
            <thead class="thead-inverse">
                <tr>
                    <th>Item/Grade</th>
                    <th>Description</th>
                    <th>Quantite</th>
                    <th>Prix Unitaire</th>
                    <th>Sous-Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            	<?php $nbArticles = $_Panier_->compterArticle();
                $precedent = 0;
            	if($nbArticles == 0 )
            		echo '<tr><td colspan="6"><center>Votre panier est vide :\'( </center></td></tr>';
            	else
            	{
	            	for($i = 0; $i < $nbArticles; $i++)
	            	{
	            		?>
	            		<tr>
		                    <td><?php $_Panier_->infosArticle(htmlspecialchars($_SESSION['panier']['id'][$i]), $nom, $infos); echo $nom; ?></td>
		                    <td><?php echo $infos; ?></td>
		                    <td><?php echo htmlspecialchars($_SESSION['panier']['quantite'][$i]); ?></td>
		                    <td class="w-25 text-center"><?php echo htmlspecialchars($_SESSION['panier']['prix'][$i]); ?> <i class="fa fa-diamond"></i></td>
		                    <td class="w-25 text-center"><?php $precedent += htmlspecialchars($_SESSION['panier']['prix'][$i])*htmlspecialchars($_SESSION['panier']['quantite'][$i]);
		                    echo $precedent; ?> <i class="fas fa-gem"></i></td>
                            <td><a href="?action=supprItemPanier&id=<?php echo htmlspecialchars($_SESSION['panier']['id'][$i]); ?>" class="btn btn-danger link" title="supprimer l'item du panier"><i class="fa fa-trash"></i></a></td>
		                </tr>
		               <?php
		            } 
                    if(!empty($_SESSION['panier']['reduction']))
                    {
                        echo '<tr><td>'.htmlspecialchars($_SESSION['panier']['code']).'</td><td>'.htmlspecialchars($_SESSION['panier']['reduction_titre']).'</td><td>1</td><td class="w-25 text-center">-'. $_SESSION['panier']['reduction']*100 .'%</td><td></td><td><a href="?action=retirerReduction" class="btn btn-danger link" title="supprimer la réduction"><i class="fa fa-trash"></i></a></td></tr>';
                    }
		        }
		        ?>
		        <tr>
		        	<td>Total:</td>
		        	<td class="w-25 text-center" colspan="5"><?php echo number_format($_Panier_->montantGlobal(), 0, ',', ' '); ?> <i class="fas fa-gem"></i></td>
		        </tr>
            </tbody>
        </table>
        <form class="form-inline" action="?action=ajouterCode" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" id="codepromo" name="codepromo" placeholder="Code promo" style="border:0px;">
            </div>
            <button type="submit" class="btn btn-primary link" style="border:0px;">Envoyer</button>
        </form>
        <div class="text-right">
            <a href="?action=viderPanier"><button class="btn btn-lg btn-danger hvr-float-shadow">Vider le panier !</button></a>
            <a href="?action=achat"><button class="btn btn-lg btn-primary hvr-float-shadow">Acheter !</button></a>
        </div>
    </div>
</section>
<?php }else{ header('Location: ?page=boutique'); }?>