<?php

class Inscription
{
    private $reponseConnection;

    public function __construct($pseudo, $mdp, $email, $temps, $newletter, $rang, $age, $getIp, $show_email, $UUID, $UUIDF, $bdd)
    {
        $reponseConnection = $bdd->prepare('INSERT INTO cmw_users (pseudo, mdp, email, anciennete, newsletter, rang, age, ip, show_email, UUID, UUIDF) VALUES (:pseudo, :mdp, :email, :anciennete, :newsletter, :rang, :age, :getIp, :show_email, :uuid, :uuidf)');
        $reponseConnection->execute(array(
            'pseudo' => $pseudo,
            'mdp' => $mdp,
            'email' => $email,
            'anciennete' => $temps,
            'newsletter' => $newletter,
            'rang' => $rang,
            'age' => $age,
            'getIp' => $getIp,
            'show_email' => $show_email,
            'uuid' => $UUID,
            'uuidf' => $UUIDF
        ));
    }

    public function getReponseConnection()
    {
        return $this->reponseConnection;
    }
}

?>