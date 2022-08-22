<?php
class PostCommentaireTicket
{
	private $bdd;
	
    public function __construct($bdd)
    {	
		$this->bdd = $bdd;
	}
	
	public function AddCommentaireTicket($id, $message, $pseudo)
	{
		$tickets = $this->bdd->prepare('INSERT INTO cmw_support_commentaires (id_ticket, auteur, message, date_post) VALUES (:id_ticket, :auteur, :message, NOW())');
		$tickets->execute(Array( 
			'id_ticket' => $id,
			'auteur' => $pseudo,
			'message' => $message ));
	}

	public function GetInfosTicket($id)
	{
		$get_ticketDisplay = $this->bdd->prepare('SELECT auteur, ticketDisplay FROM cmw_support WHERE id LIKE :id');
		$get_ticketDisplay->bindParam(':id', $id);
		$get_ticketDisplay->execute();
		return $get_ticketDisplay;
	}
}
?>