<?php
class InsertCleUnique
{
	private $reponseConnection;

	public function getReponseConnection()
	{
		return $this->reponseConnection;
	}

    public function __construct($get_CleUnique, $get_Pseudo, $bdd)
    {	
		$reponseConnection = $bdd->prepare('UPDATE cmw_users SET CleUnique = :CleUnique WHERE pseudo like :pseudo');
		$reponseConnection->bindParam(':CleUnique', $get_CleUnique);
		$reponseConnection->bindParam(':pseudo', $get_Pseudo);
        $reponseConnection->execute();
	}
}
?>