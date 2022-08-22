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
		$top = $this->bdd->query('SELECT pseudo, SUM(nbre_votes) as nbre_votes FROM cmw_votes WHERE isOld=0 group by pseudo ORDER BY nbre_votes DESC');
		return $top;
	}
	
	public function getNbreVotes($pseudo){
        $req = $this->bdd->prepare("SELECT SUM(nbre_votes) AS nbre_votes FROM cmw_votes WHERE pseudo = :pseudo and isOld=0");
        $req->execute(array("pseudo" => $pseudo));
        $nbre = $req->fetch(PDO::FETCH_ASSOC)["nbre_votes"];
        return (empty($nbre)) ? 0 : $nbre;
    }
}
?>