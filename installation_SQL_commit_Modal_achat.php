<?php 
require('controleur/config.php');
require_once ('controleur/connection_base.php');
$alteTable = $bddConnection->exec('ALTER TABLE cmw_boutique_offres ADD infos TEXT NOT NULL AFTER description');
header('Location: index.php');
?>