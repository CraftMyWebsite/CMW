<?php
class CountIpBdd
{
	private $reponseConnection;

	public function getReponseConnection()
	{
		return $this->reponseConnection;
	}

    public function __construct($getIp, $bdd)
    {	
		$reponseConnection = $bdd->prepare('SELECT ip FROM cmw_users WHERE ip LIKE :ip');
		$reponseConnection->bindParam(':ip', $getIp);
        $reponseConnection->execute();
        $this->reponseConnection = $reponseConnection;
	}
}
?>