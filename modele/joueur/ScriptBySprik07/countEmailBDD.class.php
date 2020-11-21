<?php
class CountEmailBdd
{
    private $reponseConnection;

    public function getReponseConnection()
    {
        return $this->reponseConnection;
    }

    public function __construct($get_Mail, $bdd)
    {   
        $reponseConnection = $bdd->prepare('SELECT email FROM cmw_users WHERE email LIKE :email');
        $reponseConnection->bindParam(':email', $get_Mail);
        $reponseConnection->execute();
        $this->reponseConnection = $reponseConnection;
    }
}
?>