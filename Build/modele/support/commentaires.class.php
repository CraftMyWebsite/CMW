<?php
class CommentairesTickets
{
	private $bdd;
	
    public function __construct($bdd)
    {	
		$this->bdd = $bdd;
	}
	
	public function GetListTicketsCommentaires()
	{
		$tickets = $this->bdd->query('SELECT id_ticket, auteur, message, DATE_FORMAT(date_post, "%d") AS jour, DATE_FORMAT(date_post, "%m") AS mois, DATE_FORMAT(date_post, "%h") AS heure, DATE_FORMAT(date_post, "%i") AS minute FROM cmw_support_commentaires ORDER BY date_post DESC');
		return $tickets;
	}

	public function EditCommentaireTicket($edit_message, $id_comm, $id_ticket, $auteur)
	{
		$ticket_editCommentaire = $this->bdd->prepare('UPDATE cmw_support_commentaires SET message LIKE :message WHERE id LIKE :id_comm AND id_ticket LIKE :id_ticket AND auteur LIKE :auteur');
		$ticket_editCommentaire->bindParam(':message', $edit_message);
		$ticket_editCommentaire->bindParam(':id_comm', $id_comm);
        $ticket_editCommentaire->bindParam(':id_ticket', $id_ticket);
        $ticket_editCommentaire->bindParam(':auteur', $auteur);
		$ticket_editCommentaire->execute();
	}

	public function DeleteCommentaireTicket($id_comm, $id_ticket, $auteur)
	{
		$ticket_deleteCommentaire = $this->bdd->prepare('DELETE FROM cmw_support_commentaires WHERE id LIKE :id_comm AND id_ticket LIKE :id_ticket AND auteur LIKE :auteur');
		$ticket_deleteCommentaire->bindParam(':id_comm', $id_comm);
        $ticket_deleteCommentaire->bindParam(':id_ticket', $id_ticket);
        $ticket_deleteCommentaire->bindParam(':auteur', $auteur);
		$ticket_deleteCommentaire->execute();
	}

	public function GetExistTicket($id_ticket)
	{
		$ticket_getExist = $this->bdd->prepare('SELECT * FROM cmw_support WHERE id LIKE :id_ticket');
		$ticket_getExist->bindParam(':id_ticket', $id_ticket);
		$ticket_getExist->execute();
		return $ticket_getExist;
	}

	public function GetExistCommentaire($id_comm, $id_ticket, $auteur)
	{
		$ticket_getExistCommentaire = $this->bdd->prepare('SELECT * FROM cmw_support_commentaires WHERE id LIKE :id_comm AND id_ticket LIKE :id_ticket AND auteur LIKE :auteur');
		$ticket_getExistCommentaire->bindParam(':id_comm', $id_comm);
		$ticket_getExistCommentaire->bindParam(':id_ticket', $id_ticket);
		$ticket_getExistCommentaire->bindParam(':auteur', $auteur);
		$ticket_getExistCommentaire->execute();
		return $ticket_getExistCommentaire;
	}

	public function GetAuteurCommentaire($id_comm, $id_ticket)
	{
		$ticket_getAuteurCommentaire = $this->bdd->prepare('SELECT auteur AS auteur FROM cmw_support_commentaires WHERE id LIKE :id_comm AND id_ticket LIKE :id_ticket');
		$ticket_getAuteurCommentaire->bindParam(':id_comm', $id_comm);
		$ticket_getAuteurCommentaire->bindParam(':id_ticket', $id_ticket);
		$ticket_getAuteurCommentaire->execute();
		return $ticket_getAuteurCommentaire;
	}

}
?>