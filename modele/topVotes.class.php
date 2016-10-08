<?php
class TopVotes
{
	private $bdd;
	
    public function __construct($bdd)
    {	
		$this->bdd = $bdd;
	}
	
	public function GetTopVoteurs()
	{
		$top = $this->bdd->query('SELECT * FROM cmw_votes ORDER BY nbre_votes DESC');
		return $top;
	}
}
?>