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
		$tickets = $this->bdd->query('SELECT id_ticket, auteur, message, DAY(date_post) AS jour, MONTH(date_post) AS mois, HOUR(date_post) AS heure, MINUTE(date_post) AS minute FROM cmw_support_commentaires ORDER BY date_post DESC');
		return $tickets;
	}
}
?>