<?php
class UserValidateMail
{
	private $reponseConnection;

	public function getReponseConnection()
	{
		return $this->reponseConnection;
	}

    public function __construct($get_Pseudo, $bdd)
    {	
		$reponseConnection = $bdd->prepare('UPDATE cmw_users SET ValidationMail = 1 WHERE pseudo like :pseudo');
		$reponseConnection->bindParam(':pseudo', $get_Pseudo);
        $reponseConnection->execute();
	}
}
?>