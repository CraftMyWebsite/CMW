<?php
class VerifMailBdd
{
	private $reponseConnection;

	public function getReponseConnection()
	{
		return $this->reponseConnection;
	}

    public function __construct($get_Pseudo, $bdd)
    {	
		$reponseConnection = $bdd->prepare('SELECT ValidationMail FROM cmw_users WHERE pseudo like :pseudo');
		$reponseConnection->bindParam(':pseudo', $get_Pseudo);
        $reponseConnection->execute();
		$this->reponseConnection = $reponseConnection;
	}
}
?>