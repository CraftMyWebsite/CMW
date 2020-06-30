<?php
class GetApiMailBdd
{
    private $reponseConnection;

    public function getReponseConnection()
    {
        return $this->reponseConnection;
    }

    public function __construct($bdd)
    {   
        $reponseConnection = $bdd->prepare('SELECT * FROM cmw_sysmail WHERE idMail = 1');
        $reponseConnection->execute();
        $this->reponseConnection = $reponseConnection;
    }
}
?>