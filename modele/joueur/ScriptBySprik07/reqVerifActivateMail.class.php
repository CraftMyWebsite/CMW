<?php
class VerifActivateMail
{
	private $reponseConnection;

	public function getReponseConnection()
	{
		return $this->reponseConnection;
	}

    public function __construct($get_Pseudo, $bdd)
    {	
		$reponseConnection = $bdd->prepare('SELECT CleUnique,ValidationMail FROM cmw_users WHERE pseudo LIKE :pseudo');
		$reponseConnection->bindParam(':pseudo', $get_Pseudo);
        $reponseConnection->execute();
		$this->reponseConnection = $reponseConnection;
	}
}
?>