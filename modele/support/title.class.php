<?php
class TitleTickets
{
    private $bdd;
   
    public function __construct($bdd)
    {   
        $this->bdd = $bdd;
    }
   
    public function GetListTickets()
    {
        $tickets = $this->bdd->query('SELECT id, auteur, message, titre, etat, date_post, ticketDisplay FROM cmw_support ORDER BY date_post DESC');
        return $tickets;
    }
}
?>