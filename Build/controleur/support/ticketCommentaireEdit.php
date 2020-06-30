<?php
if(Permission::getInstance()->verifPerm("connect")) {
    $pseudo = $_Joueur_['pseudo'];
    $id_ticket = urldecode($_GET['id_ticket']);
    $id_comm = urldecode($_GET['id_comm']);
    $auteur = urldecode($_GET['auteur']);
    $message = htmlspecialchars($_POST['editMessage']);
    if(Permission::getInstance()->verifPerm('PermsDefault', 'support', 'editMemberComm'))
        $adminMode = true;

    require_once('modele/support/commentaires.class.php');
    $commentairesTickets = new CommentairesTickets($bddConnection);
    $req_ExistTicket = $commentairesTickets->GetExistTicket($id_ticket);
    if($adminMode = true)
        $req_ExistCommentaire = $commentairesTickets->GetExistCommentaire($id_comm, $id_ticket, $auteur);
    else
        $req_ExistCommentaire = $commentairesTickets->GetExistCommentaire($id_comm, $id_ticket, $pseudo);
    $req_AuteurCommentaire = $commentairesTickets->GetAuteurCommentaire($id_comm, $id_ticket);
    $get_AuteurCommentaire = $req_AuteurCommentaire->fetch(PDO::FETCH_ASSOC);

    $AuteurCommentaire = $get_AuteurCommentaire['auteur'];
    $ExistCommentaire = $req_ExistCommentaire->rowCount();
    $ExistTicket = $req_ExistTicket->rowCount();
    if($ExistTicket == "0") {
    	header('Location: index.php?&page=support&TicketNotExist=true');
    } else {
    	if($ExistCommentaire == "0") {
            header('Location: index.php?&page=support&CommentaireNotExist=true');
        } else {
            if(!$AuteurCommentaire == $pseudo OR !$adminMode = true) {
             header('Location: index.php?&page=support&EditionImpossible=true');
         } else {
            $commentairesTickets->EditCommentaireTicket($message, $id_comm, $id_ticket, $AuteurCommentaire);
            header('Location: index.php?&page=support&EditCommentaire=true');
        }
    }
}
} else {
    header('Location: index.php?&page=support&NotOnline=true');
}
?>