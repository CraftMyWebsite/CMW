<?php
 $nbrPerIPReq = $bddConnection->query('SELECT * FROM cmw_sysip ORDER BY idPerIP = 1');
$i = 0;
while($nbrPerIPDonnees = $nbrPerIPReq->fetch(PDO::FETCH_ASSOC))
{
    $nbrPerIP[$i] = $nbrPerIPDonnees;
    $i++;
}
$sysMailReq = $bddConnection->query('SELECT * FROM cmw_sysmail WHERE idMail = 1');
$i = 0;
while($sysMailDonnees = $sysMailReq->fetch(PDO::FETCH_ASSOC))
{
    $sysMail[$i] = $sysMailDonnees;
    $i++;
}
?>