<?php
class checkToken
{
    private $bdd;
   
    public function __construct($token, $bdd)
    {   
        $reponseConnection = $bdd->prepare('SELECT * FROM cmw_users WHERE resettoken = :token');
		$reponseConnection->execute(array(
			'token' => $token,
			));
		$this->reponseConnection = $reponseConnection;
	}
	
	public function getReponseConnection()
	{
		return $this->reponseConnection;
	}
}
?>