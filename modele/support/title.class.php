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
        $tickets = $this->bdd->query('SELECT id, auteur, message, titre, etat, DAY(date_post) AS jour, MONTH(date_post) AS mois, HOUR(date_post) AS heure, MINUTE(date_post) AS minute FROM cmw_support ORDER BY date_post DESC');
        return $tickets;
    }
}
?>