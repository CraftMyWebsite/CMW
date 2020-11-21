<?php
class PostTicket
{
	private $bdd;
	
    public function __construct($bdd)
    {	
		$this->bdd = $bdd;
	}
	
	public function AddTicket($titre, $message, $pseudo, $ticketDisplay)
	{
		$tickets = $this->bdd->prepare('INSERT INTO cmw_support (auteur, titre, message, date_post, ticketDisplay) VALUES (:auteur, :titre, :message, NOW(), :ticketDisplay)');
		$tickets->execute(Array( 
			'auteur' => $pseudo,
			'titre' => $titre,
			'message' => $message,
			'ticketDisplay' => $ticketDisplay ));
		return $tickets;
	}
}
?>