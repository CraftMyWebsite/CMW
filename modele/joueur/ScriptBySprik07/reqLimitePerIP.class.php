<?php
class LimiteIpBdd
{
	private $reponseConnection;

	public function getReponseConnection()
	{
		return $this->reponseConnection;
	}

    public function __construct($bdd)
    {	
		$reponseConnection = $bdd->prepare('SELECT nbrPerIP FROM cmw_sysip WHERE idPerIP = 0');
        $reponseConnection->execute();
        $this->reponseConnection = $reponseConnection;
	}
}
?>