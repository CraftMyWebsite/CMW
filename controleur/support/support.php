<?php
require_once('modele/support/title.class.php');
$ticketsObj = new TitleTickets($bddConnection);
$ticketReq = $ticketsObj->GetListTickets();

require_once('modele/support/commentaires.class.php');
$ticketsCommentaireObj = new CommentairesTickets($bddConnection);
$ticketCommentairesReq = $ticketsCommentaireObj->GetListTicketsCommentaires();

$j = 0;
while($a = $ticketCommentairesReq->fetch()) 
{
	$i = $a['id_ticket'];
	if(!isset($ticketCommentaires[$i]))
		$j = 0;
		
	$ticketCommentaires[$i][$j]['auteur'] = $a['auteur'];
	$ticketCommentaires[$i][$j]['message'] = $a['message'];
	$ticketCommentaires[$i][$j]['jour'] = $a['jour'];
	$ticketCommentaires[$i][$j]['mois'] = $a['mois'];
	$ticketCommentaires[$i][$j]['heure'] = $a['heure'];
	$ticketCommentaires[$i][$j]['minute'] = $a['minute'];
	$j++;
}
?>