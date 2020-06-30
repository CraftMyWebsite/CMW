<?php

if($_Permission_->verifPerm('PermsPanel', 'info', 'showPage')) {

    $lastticketreq = $bddConnection->query('SELECT id,auteur,titre,etat FROM `cmw_support` ORDER BY `id` DESC LIMIT 1');
    $LastTicket = $lastticketreq->fetch(PDO::FETCH_ASSOC);

    $lastnewsreq = $bddConnection->query('SELECT id,auteur,titre FROM `cmw_news` ORDER BY `id` DESC LIMIT 1');
    $LastNews = $lastnewsreq->fetch(PDO::FETCH_ASSOC);

    $lastachatreq = $bddConnection->query('SELECT * FROM `cmw_boutique_stats` ORDER BY `id` DESC LIMIT 10');



    $nbnews = $bddConnection->query('SELECT count(id) as nb FROM `cmw_news`');
    $nbne = $nbnews->fetch(PDO::FETCH_ASSOC);
    $TotalNews = $nbne["nb"];

    $nboffreboutique = $bddConnection->query('SELECT count(id) as nb FROM `cmw_boutique_offres`');
    $nboffre = $nboffreboutique->fetch(PDO::FETCH_ASSOC);
    $TotalOffre = $nboffre["nb"];
    

    $nbsupport = $bddConnection->query('SELECT count(id) as nb FROM `cmw_support`');
    $nbsupportwait = $nbsupport->fetch(PDO::FETCH_ASSOC);
    $TotalSupport = $nbsupportwait["nb"];
    
    $req_etatMail = $bddConnection->query("SELECT etatMail FROM cmw_sysmail WHERE idMail = 1");
    $get_etatMail = $req_etatMail->fetch(PDO::FETCH_ASSOC);
    $ShowMail = $get_etatMail['etatMail'] == 1;

    $all_message_staff = $bddConnection->query('SELECT id, auteur, message FROM cmw_postit ORDER BY id DESC');


    $lastRegisterMember = $bddConnection->query('SELECT id,pseudo,tokens,email,anciennete'.(($ShowMail)? ",ValidationMail":"").''.($_Permission_->verifPerm('PermsPanel', 'info', 'stats', 'members', 'showIP') ? ",ip" : "").' FROM cmw_users ORDER BY id DESC LIMIT 0, 10;');

}
?>