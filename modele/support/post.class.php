<?php
class PostTicket
{
	private $bdd;
	
    public function __construct($bdd)
    {	
		$this->bdd = $bdd;
	}
	
	public function AddTicket($titre, $message, $pseudo)
	{
		$tickets = $this->bdd->prepare('INSERT INTO cmw_support (auteur, titre, message, date_post) VALUES (:auteur, :titre, :message, NOW())');
		$tickets->execute(Array( 
			'auteur' => $pseudo,
			'titre' => $titre,
			'message' => $message ));
		return $tickets;
	}
}
?>