<?php
class Inscription
{
	private $reponseConnection;
	
    public function __construct($pseudo, $mdp, $email, $temps, $newletter, $rang, $getIp, $bdd)
    {	
		$reponseConnection = $bdd->prepare('INSERT INTO cmw_users (pseudo, mdp, email, anciennete, newsletter, rang, ip) VALUES (:pseudo, :mdp, :email, :anciennete, :newsletter, :rang, :getIp)');
		$reponseConnection->execute(array(
			'pseudo' => $pseudo,
			'mdp' => $mdp,
			'email' => $email,
			'anciennete' => $temps,
			'newsletter' => $newletter,
			'rang' => $rang,
			'getIp' => $getIp
			));
	}
	
	public function getReponseConnection()
	{
		return $this->reponseConnection;
	}
}
?>