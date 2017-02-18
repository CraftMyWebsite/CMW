<?php
$microTokens = new Lire('modele/config/configAlloconv.yml');
$microTokens = $microTokens->GetTableau();
$type = array('1' => "Audiotel", '2' => "SMS+", '3' => "Carte Bancaire", '4' => "Prépayée");

$api = 'https://secure.alloconv.fr/api/1.1/?idclient='.$microTokens['Infos']['idClient'].'&idsite='.$microTokens['Infos']['idSite'].'&cle='.$microTokens['Infos']['cle'].'&action=getnumber&code_palier='.$microTokens['palier'];
$raw = file_get_contents($api);
$alloconv = json_decode($raw, true);
?>