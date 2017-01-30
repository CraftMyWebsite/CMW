<?php

if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['info']['showPage'] == true) {
//Statistiques de la Boutique

    $boutiquesStatsReq = $bddConnection->query('SELECT * FROM cmw_boutique_stats ORDER BY id DESC LIMIT 0, 12;');
    $i = 0;
    while($boutiquesStatsDonnees = $boutiquesStatsReq->fetch())
    {
        $boutiquesStats[$i]['id'] = $boutiquesStatsDonnees['id'];
        $boutiquesStats[$i]['offre_id'] = $boutiquesStatsDonnees['offre_id'];
        $boutiquesStats[$i]['date_achat'] = $boutiquesStatsDonnees['date_achat'];
        $boutiquesStats[$i]['prix'] = $boutiquesStatsDonnees['prix'];
        $boutiquesStats[$i]['pseudo'] = $boutiquesStatsDonnees['pseudo'];
        $i++;
    }
    ?>

    <?php
    $lastOffreReq = $bddConnection->query('SELECT * FROM cmw_boutique_offres ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastOffreDonnees = $lastOffreReq->fetch())
    {
        $lastOffre[$i]['id'] = $lastOffreDonnees['id'];
        $lastOffre[$i]['nom'] = $lastOffreDonnees['nom'];
        $lastOffre[$i]['categorie_id'] = $lastOffreDonnees['categorie_id'];
        $lastOffre[$i]['prix'] = $lastOffreDonnees['prix'];
        $i++;
    }
    ?>

    <?php
    $lastOffrePaypalReq = $bddConnection->query('SELECT * FROM cmw_jetons_paypal_offres ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastOffrePaypalDonnees = $lastOffrePaypalReq->fetch())
    {
        $lastOffrePaypal[$i]['id'] = $lastOffrePaypalDonnees['id'];
        $lastOffrePaypal[$i]['nom'] = $lastOffrePaypalDonnees['nom'];
        $lastOffrePaypal[$i]['prix'] = $lastOffrePaypalDonnees['prix'];
        $lastOffrePaypal[$i]['jetons_donnes'] = $lastOffrePaypalDonnees['jetons_donnes'];
        $i++;
    }
    ?>

    <!-- Statistiques des membres -->

    <?php
    $membresStatsReq = $bddConnection->query('SELECT * FROM cmw_users ORDER BY id DESC LIMIT 0, 8;');
    $i = 0;
    while($membresStatsDonnees = $membresStatsReq->fetch())
    {
        $membresStats[$i]['id'] = $membresStatsDonnees['id'];
        $membresStats[$i]['pseudo'] = $membresStatsDonnees['pseudo'];
        $membresStats[$i]['tokens'] = $membresStatsDonnees['tokens'];
        $membresStats[$i]['anciennete'] = $membresStatsDonnees['anciennete'];
        $membresStats[$i]['ip'] = $membresStatsDonnees['ip'];
        $membresStats[$i]['ValidationMail'] = $membresStatsDonnees['ValidationMail'];
        $i++;
    }
    ?>

    <!-- Statistiques du dernier inscrit -->

    <?php
    $lastMembreReq = $bddConnection->query('SELECT * FROM cmw_users ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastMembreDonnees = $lastMembreReq->fetch())
    {
        $lastMembre[$i]['id'] = $lastMembreDonnees['id'];
        $lastMembre[$i]['pseudo'] = $lastMembreDonnees['pseudo'];
        $lastMembre[$i]['anciennete'] = $lastMembreDonnees['anciennete'];
        $i++;
    }
    ?>

    <!-- Statistiques du dernier Ticket -->

    <?php
    $lastTicketReq = $bddConnection->query('SELECT * FROM cmw_support ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastTicketDonnees = $lastTicketReq->fetch())
    {
        $lastTicket[$i]['id'] = $lastTicketDonnees['id'];
        $lastTicket[$i]['auteur'] = $lastTicketDonnees['auteur'];
        $lastTicket[$i]['titre'] = $lastTicketDonnees['titre'];
        $lastTicket[$i]['date_post'] = $lastTicketDonnees['date_post'];
        $lastTicket[$i]['etat'] = $lastTicketDonnees['etat'];
        $i++;
    }
    ?>

    <!-- Statistiques du dernier Commentaire Support -->

    <?php
    $lastCommentaireSuppReq = $bddConnection->query('SELECT * FROM cmw_support_commentaires ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastCommentaireDonneesSupp = $lastCommentaireSuppReq->fetch())
    {
        $lastCommentaireSupp[$i]['id'] = $lastCommentaireDonneesSupp['id'];
        $lastCommentaireSupp[$i]['id_ticket'] = $lastCommentaireDonneesSupp['id_ticket'];
        $lastCommentaireSupp[$i]['auteur'] = $lastCommentaireDonneesSupp['auteur'];
        $lastCommentaireSupp[$i]['date_post'] = $lastCommentaireDonneesSupp['date_post'];
        $i++;
    }
    ?>

    <!-- Statistiques du dernier Commentaire nouveauté -->

    <?php
    $lastCommentaireNewsReq = $bddConnection->query('SELECT * FROM cmw_news_commentaires ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastCommentaireDonneesNews = $lastCommentaireNewsReq->fetch())
    {
        $lastCommentaireNews[$i]['id'] = $lastCommentaireDonneesNews['id'];
        $lastCommentaireNews[$i]['id_news'] = $lastCommentaireDonneesNews['id_news'];
        $lastCommentaireNews[$i]['pseudo'] = $lastCommentaireDonneesNews['pseudo'];
        $lastCommentaireNews[$i]['date_post'] = $lastCommentaireDonneesNews['date_post'];
        $i++;
    }
    ?>

    <!-- Statistiques de la dernière nouveauté -->

    <?php
    $lastNewsReq = $bddConnection->query('SELECT * FROM cmw_news ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastNewsDonnees = $lastNewsReq->fetch())
    {
        $lastNews[$i]['id'] = $lastNewsDonnees['id'];
        $lastNews[$i]['titre'] = $lastNewsDonnees['titre'];
        $lastNews[$i]['auteur'] = $lastNewsDonnees['auteur'];
        $lastNews[$i]['date'] = $lastNewsDonnees['date'];
        $i++;
    }
    ?>

    <!-- Variable de nombre d'inscription par ip -->

    <?php
    $nbrPerIPReq = $bddConnection->query('SELECT * FROM cmw_sysip ORDER BY idPerIP = 1');
    $i = 0;
    while($nbrPerIPDonnees = $nbrPerIPReq->fetch())
    {
        $nbrPerIP[$i]['nbrPerIP'] = $nbrPerIPDonnees['nbrPerIP'];
        $nbrPerIP[$i]['idPerIP'] = $nbrPerIPDonnees['idPerIP'];
        $i++;
    }
    ?>

    <!-- "API" pour les mails à l'inscription -->

    <?php
    $sysMailReq = $bddConnection->query('SELECT * FROM cmw_sysmail WHERE idMail = 1');
    $i = 0;
    while($sysMailDonnees = $sysMailReq->fetch())
    {
        $sysMail[$i]['idMail'] = $sysMailDonnees['idMail'];
        $sysMail[$i]['fromMail'] = $sysMailDonnees['fromMail'];
        $sysMail[$i]['sujetMail'] = $sysMailDonnees['sujetMail'];
        $sysMail[$i]['msgMail'] = $sysMailDonnees['msgMail'];
        $sysMail[$i]['strictMail'] = $sysMailDonnees['strictMail'];
        $sysMail[$i]['etatMail'] = $sysMailDonnees['etatMail'];
        $i++;
    }
    ?>

    <!-- Dernier voteur -->

    <?php
    $lastVoteReq = $bddConnection->query('SELECT * FROM cmw_votes ORDER BY date_dernier DESC LIMIT 1;');
    $i = 0;
    while($lastVoteDonnees = $lastVoteReq->fetch())
    {
        $lastVote[$i]['id'] = $lastVoteDonnees['id'];
        $lastVote[$i]['pseudo'] = $lastVoteDonnees['pseudo'];
        $lastVote[$i]['date_dernier'] = $lastVoteDonnees['date_dernier'];
        $i++;
    }
    ?>

    <!-- Dernière maintenance -->

    <?php
    $lastMaintenanceReq = $bddConnection->query('SELECT maintenanceTime, maintenanceEtat FROM cmw_maintenance WHERE maintenanceId = 1');
    $i = 0;
    while($lastMaintenanceDonnees = $lastMaintenanceReq->fetch())
    {
        $lastMaintenance[$i]['maintenanceId'] = $lastMaintenanceDonnees['maintenanceId'];
        $lastMaintenance[$i]['maintenanceEtat'] = $lastMaintenanceDonnees['maintenanceEtat'];
        $lastMaintenance[$i]['maintenanceTime'] = $lastMaintenanceDonnees['maintenanceTime'];
        $i++;
    }
    ?>

    <!-- Dernière achat dedipass -->

    <?php
    $lastAchatDedipassReq = $bddConnection->query('SELECT * FROM cmw_dedipass ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastAchatDedipassDonnees = $lastAchatDedipassReq->fetch())
    {
        $lastAchatDedipass[$i]['id'] = $lastAchatDedipassDonnees['id'];
        $lastAchatDedipass[$i]['pseudo'] = $lastAchatDedipassDonnees['pseudo'];
        $lastAchatDedipass[$i]['date_achat'] = $lastAchatDedipassDonnees['date_achat'];
        $lastAchatDedipass[$i]['payout'] = $lastAchatDedipassDonnees['payout'];
        $i++;
    }

}
?>