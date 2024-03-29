<?php
if(isset($_Joueur_) && ($ticketCommentaires[$tickets['id']][$i]['auteur'] === $_Joueur_['pseudo'] || Permission::getInstance()->verifPerm('PermsDefault', 'support', 'deleteMemberComm'))) {
    $id_ticket = urldecode($_GET['id_ticket']);
    $id_comm = urldecode($_GET['id_comm']);
    $auteur = urldecode($_GET['auteur']);
    $pseudo = $_Joueur_['pseudo'];
    if(Permission::getInstance()->verifPerm('PermsDefault', 'support', 'deleteMemberComm')) {
        $adminMode = true;
    }

    require_once('modele/support/commentaires.class.php');
    $commentairesTickets = new CommentairesTickets($bddConnection);
    $req_ExistTicket = $commentairesTickets->GetExistTicket($id_ticket);
    if($adminMode = true) {
        $req_ExistCommentaire = $commentairesTickets->GetExistCommentaire($id_comm, $id_ticket, $auteur);
    }
    else {
        $req_ExistCommentaire = $commentairesTickets->GetExistCommentaire($id_comm, $id_ticket, $pseudo);
    }
    $req_AuteurCommentaire = $commentairesTickets->GetAuteurCommentaire($id_comm, $id_ticket);
    $get_AuteurCommentaire = $req_AuteurCommentaire->fetch(PDO::FETCH_ASSOC);

    $AuteurCommentaire = $get_AuteurCommentaire['auteur'];
	if($AuteurCommentaire === $_Joueur_['pseudo'] || Permission::getInstance()->verifPerm('PermsDefault', 'support', 'deleteMemberComm'))
	{
		$ExistCommentaire = $req_ExistCommentaire->rowCount();
		$ExistTicket = $req_ExistTicket->rowCount();
		if($ExistTicket === '0') {
			header('Location: index.php?page=support&TicketNotExist');
		} else if($ExistCommentaire === '0') {
            header('Location: index.php?page=support&CommentaireNotExist');
        } else {
            if($AuteurCommentaire !== $pseudo || $adminMode !== true) {
                 header('Location: index.php?page=support&SuppressionImpossible');
             } else {
                $commentairesTickets->DeleteCommentaireTicket($id_comm, $id_ticket, $AuteurCommentaire);
                header('Location: index.php?page=support&SuppressionCommentaire');
             }
        }
	} else {
		header('Location: index.php?page=support&SuppressionCommentaire');
	}
} else {
    header('Location: index.php?page=support&NotOnline');
}
