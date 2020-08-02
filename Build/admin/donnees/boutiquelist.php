<?php 

$boutiqueListeReq = $bddConnection->query('SELECT cmw_boutique_stats.id AS id, cmw_boutique_stats.prix AS prixTotal, cmw_boutique_offres.prix AS prix, cmw_boutique_stats.pseudo AS pseudo, cmw_boutique_offres.nom AS titre, cmw_boutique_stats.date_achat AS date_achat FROM cmw_boutique_stats INNER JOIN cmw_boutique_offres ON offre_id = cmw_boutique_offres.id ORDER BY date_achat DESC LIMIT 0, 20');
$boutiqueListeData = $boutiqueListeReq->fetchAll(PDO::FETCH_ASSOC);
$req = $bddConnection->query('SELECT COUNT(id) AS count FROM cmw_boutique_stats');
$data = $req->fetch(PDO::FETCH_ASSOC);
$nbPage = ceil($data['count']/20);
$listeOffreReq = $bddConnection->query('SELECT id, nom FROM cmw_boutique_offres');
$listeOffreData = $listeOffreReq->fetchAll(PDO::FETCH_ASSOC);

$req = $bddConnection->query('SELECT COUNT(id) AS count FROM cmw_boutique_stats'); $data = $req->fetch(PDO::FETCH_ASSOC);  ?>