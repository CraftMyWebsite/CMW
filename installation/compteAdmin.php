<?php
class CompteAdmin
{
    public function __construct($bdd, $pseudo, $mdp, $email)
    {	
		$req = $bdd->prepare('INSERT INTO cmw_users(pseudo, mdp, email, anciennete, newsletter, rang, ValidationMail) VALUES(:pseudo, :mdp, :email, :date, 1, 1, 1)');
		$req->execute(Array (
			'pseudo' => $pseudo,
			'mdp' => md5(sha1($mdp)),
			'email' => $email,
			'date' => time() 	));
	}		
}
?>
