<?php

$lectureP = new Lire('modele/config/config.yml');
$lectureP = $lectureP->GetTableau();
$lectureP = $lectureP['Payement'];

$query = $bddConnection->query('SELECT * FROM cmw_jetons_paypal_offres');

$i = 0;
while($donneesQuery = $query->fetch())
{
    $paypalOffres[$i]['id'] = $donneesQuery['id'];
    $paypalOffres[$i]['nom'] = $donneesQuery['nom'];
    $paypalOffres[$i]['description'] = $donneesQuery['description'];
    $paypalOffres[$i]['prix'] = $donneesQuery['prix'];
    $paypalOffres[$i]['jetons_donnes'] = $donneesQuery['jetons_donnes'];
    $i++;
}

?>
