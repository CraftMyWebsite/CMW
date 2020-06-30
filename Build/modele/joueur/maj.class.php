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
	public function setNouvellesDonneesSignature($signature)
	{
		$reqMaj = $this->bdd->prepare('UPDATE cmw_users SET signature = :signature WHERE pseudo = :pseudo');
		$reqMaj->execute(array(
			'signature' => $signature,
			'pseudo' => $this->pseudo
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
	public function setNouvellesDonneesReseaux($reseaux, $id)
	{
		$selectMaj = $this->bdd->prepare('SELECT id FROM cmw_reseaux WHERE idJoueur = :id');
		$selectMaj->execute(array(
			'id' => $id
		));
		$data = $selectMaj->fetch(PDO::FETCH_ASSOC);
		if(isset($data['id']))
		{
			foreach($reseaux as $key => $value)
			{
				$reqMaj = $this->bdd->prepare('UPDATE cmw_reseaux SET '.$key.' = :valeur WHERE idJoueur = :id');
				$reqMaj->execute(array(
					'valeur' => $value,
					'id' => $id
				));
			}
		}
		else
		{
			$nom = key($reseaux);
			$valeur = current($reseaux);
			$req = $this->bdd->prepare('INSERT INTO cmw_reseaux (idJoueur, '.$nom.') VALUES (:id, :valeur)');
			$req->execute(array(
				'id' => $id,
				'valeur' => $valeur
			));
			array_shift($reseaux);
			foreach($reseaux as $key => $value)
			{
				$reqMaj = $this->bdd->prepare('UPDATE cmw_reseaux SET '.$key.' = :valeur WHERE idJoueur = :id');
				$reqMaj->execute(array(
					'valeur' => $value,
					'id' => $id
				));
			}
		}
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
