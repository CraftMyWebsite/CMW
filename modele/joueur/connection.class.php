<?php
class Connection
{
	private $reponseConnection;
	
    public function __construct($pseudo, $bdd)
    {	
		$reponseConnection = $bdd->prepare('SELECT * FROM cmw_users WHERE pseudo = :pseudo');
		$reponseConnection->execute(array(
			'pseudo' => $pseudo,
			));
		$this->reponseConnection = $reponseConnection;
	}
	
	public function getReponseConnection()
	{
		return $this->reponseConnection;
	}
}
?>