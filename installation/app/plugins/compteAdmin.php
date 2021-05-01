<?php
class CompteAdmin
{
    public function __construct($bdd, $pseudo, $mdp, $email)
    {	
		//Gestion UUID
        $UUID = file_get_contents("https://api.mojang.com/users/profiles/minecraft/".$pseudo);
        $obj = json_decode($UUID);
        $UUID = $obj->{'id'};

        if ($UUID == NULL) {
            $UUID = "INVALIDE";
        }

        //CONVERSION UUIDF
       if ($UUID != "INVALIDE") {
            $UUIDF = substr_replace($UUID, "-", 8, 0);
            $UUIDF = substr_replace($UUIDF, "-", 13, 0);
            $UUIDF = substr_replace($UUIDF, "-", 18, 0);
            $UUIDF = substr_replace($UUIDF, "-", 23, 0);
       }else{
            $UUIDF = "INVALIDE";
       }

		$mot_de_passe = password_hash($mdp, PASSWORD_DEFAULT);
		$req = $bdd->prepare('INSERT INTO cmw_users (pseudo, mdp, email, anciennete, newsletter, rang, tokens, age, resettoken, ip, CleUnique, ValidationMail, UUID, UUIDF) VALUES (:pseudo, :mdp, :email, :date, 0, 1, 0, 0, 0, 0, 0, 1, :uuid, :uuidf)');
		$req->execute(Array (
			'pseudo' => $pseudo,
			'mdp' => $mot_de_passe,
			'email' => $email,
			'date' => time(),
			'uuid' => $UUID,
			'uuidf' => $UUIDF
		));
	}		
}