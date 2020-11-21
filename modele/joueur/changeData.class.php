<?php
class Maj
{
	private $reponseConnection;
	private $bdd;
	
    public function __construct($pseudo, $bdd)
    {	
		$reponseConnection = $bdd->prepare('SELECT * FROM cmw_users WHERE pseudo = :pseudo');
		$reponseConnection->execute(array(
			'pseudo' => $pseudo,
			));
		$this->reponseConnection = $reponseConnection;
		$this->bdd = $bdd;
	}
	
	public function getReponseConnection()
	{
		return $this->reponseConnection;
	}
	
	public function setReponseConnection($reponseConnection)
	{
		$this->reponseConnection = $reponseConnection;	
	}
	
	public function setNouvellesDonneesTokens($donnees)
	{
		$reqMaj = $this->bdd->prepare('UPDATE cmw_users SET tokens = :tokens WHERE pseudo = :pseudo');
		$reqMaj->execute(array(
			'tokens' => $donnees['tokens'],
			'pseudo' => $donnees['pseudo']
			));
	}
	public function setNouvellesDonneesEmail($donnees)
	{
		$reqMaj = $this->bdd->prepare('UPDATE cmw_users SET tokens = :tokens WHERE pseudo = :pseudo');
		$reqMaj->execute(array(
			'tokens' => $donnees['tokens'],
			'pseudo' => $donnees['pseudo']
			));
	}
}
?>