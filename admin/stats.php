<?php
if(!$admin)
    header('Location: index.php');

require_once('stats/php/donnees.class.php');
$donnees = new Donnees($bddConnection);


require_once('stats/php/donneesTraitement.class.php');
require_once('stats/php/print.class.php');

$print = new Draw();
$traitement = new Traitement($donnees->GetCategories(), $donnees->GetOffres(), $donnees->GetAchats());

$revenusTout = $traitement->Revenus();

$topCategoriesTout = $traitement->topCategories(Traitement::QUANTITE);
$topCategoriesSemaine = $traitement->topCategories(Traitement::QUANTITE, 7);
$topCategoriesMois = $traitement->topCategories(Traitement::QUALITE, 30);

$topAcheteurs = $traitement->topAcheteurs(5);
$derniersAcheteurs = $traitement->derniersAcheteurs(5);

$derniersMois = $traitement->derniersMois();
$histVentes = $traitement->getVentesParMoi($derniersMois);

include('stats/stats.php');
?>
<h1>Top categories:</h1>
<div class="row">
    
    <div class="col-md-4">
    <h2>Quantité tout</h2>
    <ul>
        <?php foreach($topCategoriesTout As $cle => $element){
            echo '<li>La catégorie '. $element[2] .' représente '. $element[1] .'% des achats avec un total de '. $element[0] .' ventes.</li>'; 
        } ?>
    </ul>
    </div>

    <div class="col-md-4">
    <h2>Quantité 7j</h2>
    <ul>
        <?php foreach($topCategoriesSemaine As $cle => $element){
            echo '<li>La catégorie '. $element[2] .' représente '. $element[1] .'% des achats avec un total de '. $element[0] .' ventes.</li>'; 
        } ?>
    </ul>
    </div>

    <div class="col-md-4">
    <h2>Quantité 1m</h2>
    <ul>
        <?php foreach($topCategoriesMois As $cle => $element){
            echo '<li>La catégorie '. $element[2] .' représente '. $element[1] .'% des achats avec un total de '. $element[0] .' ventes.</li>'; 
        } ?>
    </ul>
    </div>
</div>
