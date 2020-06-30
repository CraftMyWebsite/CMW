<?php
require_once('modele/support/title.class.php');
$ticketsObj = new TitleTickets($bddConnection);
$ticketReq = $ticketsObj->GetListTickets();

require_once('modele/support/commentaires.class.php');
$ticketsCommentaireObj = new CommentairesTickets($bddConnection);
$ticketCommentairesReq = $ticketsCommentaireObj->GetListTicketsCommentaires();

$j = 0;
while($a = $ticketCommentairesReq->fetch(PDO::FETCH_ASSOC)) 
{
	$i = $a['id_ticket'];
	if(!isset($ticketCommentaires[$i]))
		$j = 0;
		
	$ticketCommentaires[$i][$j] = $a;
	$j++;
}
?>