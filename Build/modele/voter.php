<?php
//Fonction de fonctionnement de la page	
function TempsTotal($tempsRestant)
{
    $tempsH = 0;
    $tempsM = 0;
    while ($tempsRestant >= 3600) {
        $tempsH = $tempsH + 1;
        $tempsRestant = $tempsRestant - 3600;
    }
    while ($tempsRestant >= 60) {
        $tempsM = $tempsM + 1;
        $tempsRestant = $tempsRestant - 60;
    }
    if ($tempsH == 0) {
        return $tempsM . ' minute(s)';
    } else if ($tempsM <= 9) {
        return $tempsH . 'H0' . $tempsM;
    } else {
        return $tempsH . 'H' . $tempsM;
    }
}
function RecupJoueur($pseudo, $id, $bddConnection)
{
    $line = $bddConnection->prepare('SELECT * FROM cmw_votes WHERE pseudo = :pseudo AND site = :site');
    $line->execute(array(
        'pseudo' => $pseudo,
        'site' => $id
    ));
    $donnees = $line->fetch(PDO::FETCH_ASSOC);
    return $donnees;
}

function Vote($pseudo, $id, $bddConnection, $donnees, $temps)
{
    if ($donnees['date_dernier'] + $temps < time()) {
        return true;
    } else
        return false;
}

function ExisteJoueur($pseudo, $id, $bddConnection)
{
    $line = $bddConnection->prepare('SELECT * FROM cmw_votes WHERE pseudo = :pseudo AND site = :site');
    $line->execute(array(
        'pseudo' => $pseudo,
        'site' => $id
    ));

    $donnees = $line->fetch(PDO::FETCH_ASSOC);

    if (empty($donnees['pseudo']))
        return false;
    else
        return true;
}

function CreerJoueur($pseudo, $id, $bddConnection)
{
    $req = $bddConnection->prepare('INSERT INTO cmw_votes(pseudo, site) VALUES(:pseudo, :site)');
    $req->execute(array(
        'pseudo' => $pseudo,
        'site' => $id
    ));
}

function GetTempsRestant($temps, $tempsTotal, $donnees)
{
    $tempsEcoule = time() - $temps;
    $tempsRestant = $tempsTotal - $tempsEcoule;
    $tempsH = 0;
    $tempsM = 0;
    while ($tempsRestant >= 3600) {
        $tempsH = $tempsH + 1;
        $tempsRestant = $tempsRestant - 3600;
    }
    while ($tempsRestant >= 60) {
        $tempsM = $tempsM + 1;
        $tempsRestant = $tempsRestant - 60;
    }
    if ($tempsM <= 9) {
        return $tempsH . 'H0' . $tempsM;
    } else {
        return $tempsH . 'H' . $tempsM;
    }
}

function LectureVote($id, $bddConnection)
{
    $req = $bddConnection->prepare('SELECT * FROM cmw_votes_config WHERE id = :id');
    $req->execute(array('id' => $id));
    return $req->fetch(PDO::FETCH_ASSOC);
}
?>