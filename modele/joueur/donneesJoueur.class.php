<?php
class JoueurDonnees
{
	private $donnees;
	
    public function __construct($bdd, $pseudo)
    {	
		$req = $bdd->prepare('SELECT * FROM cmw_users WHERE pseudo = :pseudo');
		$req->execute(Array ( 'pseudo' => $pseudo ));
		$donnees = $req->fetch();
		$this->donnees = $donnees;
	}
	
	public function getTableauDonnees()
	{
		return $this->donnees;
	}
}
?>