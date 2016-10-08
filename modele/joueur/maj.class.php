<?php
class Maj
{
	private $reponseConnection;
	private $bdd;
    private $pseudo;
	
    public function __construct($player, $bdd)
    {	
        if(is_int($player))
            $requete = 'SELECT * FROM cmw_users WHERE id = :pseudo';
        else
            $requete = 'SELECT * FROM cmw_users WHERE pseudo = :pseudo';

		$reponseConnection = $bdd->prepare($requete);
		$reponseConnection->execute(array(
			'pseudo' => $player,
			));
		$this->reponseConnection = $reponseConnection;
		$this->bdd = $bdd;
		$this->pseudo = $player;
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
	public function setNouvellesDonneesTokensID($donnees)
	{
		$reqMaj = $this->bdd->prepare('UPDATE cmw_users SET tokens = :tokens WHERE id = :id');
		$reqMaj->execute(array(
			'tokens' => $donnees['tokens'],
			'id' => $donnees['id']
			));
	}
	public function setNouvellesDonneesEmail($email)
	{
		$reqMaj = $this->bdd->prepare('UPDATE cmw_users SET email = :email WHERE pseudo = :pseudo');
		$reqMaj->execute(array(
			'email' => $email,
			'pseudo' => $this->pseudo
			));
	}
	public function setNouvellesDonneesSkype($skype)
	{
		$reqMaj = $this->bdd->prepare('UPDATE cmw_users SET skype = :skype WHERE pseudo = :pseudo');
		$reqMaj->execute(array(
			'skype' => $skype,
			'pseudo' => $this->pseudo
			));
	}
	public function setNouvellesDonneesAge($age)
	{
		$reqMaj = $this->bdd->prepare('UPDATE cmw_users SET age = :age WHERE pseudo = :pseudo');
		$reqMaj->execute(array(
			'age' => $age,
			'pseudo' => $this->pseudo
			));
	}
	public function setNouvellesDonneesMdp($mdp)
	{
		$reqMaj = $this->bdd->prepare('UPDATE cmw_users SET mdp = :mdp WHERE pseudo = :pseudo');
		$reqMaj->execute(array(
			'mdp' => $mdp,
			'pseudo' => $this->pseudo
			));
	}
	public function setNouvellesDonneesResetToken($token)
	{
		$reqMaj = $this->bdd->prepare('UPDATE cmw_users SET resettoken = :token WHERE pseudo = :pseudo');
		$reqMaj->execute(array(
			'token' => $token,
			'pseudo' => $this->pseudo
			));
	}
}
?>
