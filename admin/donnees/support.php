<?php
$req = $bddConnection->query('SELECT id, auteur, message, titre, etat, DAY(date_post) AS jour, MONTH(date_post) AS mois, HOUR(date_post) AS heure, MINUTE(date_post) AS minute FROM cmw_support ORDER BY date_post DESC');

$aucunTicket = false;
$i = 0;

if(!empty($req))
    while($donnees = $req->fetch())
    {
        $donneesSupport[$i]['id'] = $donnees['id'];
        $donneesSupport[$i]['auteur'] = $donnees['auteur'];
        $donneesSupport[$i]['titre'] = $donnees['titre'];
        $donneesSupport[$i]['message'] = $donnees['message'];
        $donneesSupport[$i]['etat'] = $donnees['etat'];
        $donneesSupport[$i]['jour'] = $donnees['jour'];
       $donneesSupport[$i]['mois'] = $donnees['mois'];
       $donneesSupport[$i]['heure'] = $donnees['heure'];
       $donneesSupport[$i]['minute'] = $donnees['minute'];
  
        $i++;
    }
if(empty($req) OR !isset($donneesSupport) OR empty($donneesSupport))
    $aucunTicket = true;
?>