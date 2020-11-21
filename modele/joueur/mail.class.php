<?php
class Mail
{
	private $reponseConnection;
	
    public function __construct($mail, $bdd)
    {	
		$reponseConnection = $bdd->prepare('SELECT * FROM cmw_users WHERE email = :email');
		$reponseConnection->execute(array(
			'email' => $mail,
			));
		$this->reponseConnection = $reponseConnection;
	}
	
	public function getReponseConnection()
	{
		return $this->reponseConnection;
	}
}
?>