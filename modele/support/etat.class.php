<?php
class etatTicket
{
    private $bdd;
   
    public function __construct($bdd)
    {   
        $this->bdd = $bdd;
    }
   
    public function ChangeEtat($id, $etat)
    {
        $tickets = $this->bdd->prepare('UPDATE cmw_support SET etat = :etat WHERE id = :id');
        $tickets->execute(Array(
			'etat' => $etat,
			'id' => $id ));
    }
}
?>