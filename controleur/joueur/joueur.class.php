<?php
/*
	Cette classe récupère un tableau de données à partir des sessions.
	Le but étant d'obtenir un nom de variable plus facile à utiliser.
*/
class Joueur
{
	private $_Joueur_;
	
	// Le constructeur, il crée le tableau.
    public function __construct()
    {	
		$_Joueur_ = array(
			'id' =>$_SESSION['Player']['id'],
			'pseudo' =>$_SESSION['Player']['pseudo'],
			'email' => $_SESSION['Player']['email'],
			'rang' => $_SESSION['Player']['rang'],
			'tokens' => $_SESSION['Player']['tokens'] ,
			'uuid' => $_SESSION['Player']['uuid'],
			'uuidf' => $_SESSION['Player']['uuidf']
		);
			
		$this->_Joueur_ = $_Joueur_;
	}
	
	// Met à jours le tableau qui est temporaire ainsi que les sessions.
	public function setArrayDonneesUtilisateur($_Joueur_)
	{
		// On met à jours les sessions pour que les changements soient pris en compte lors du prochain chargement de page.
		$_SESSION['Player']['id'] = $_Joueur_['id'];
		$_SESSION['Player']['pseudo'] = $_Joueur_['pseudo'];
		$_SESSION['Player']['email'] = $_Joueur_['email'];
		$_SESSION['Player']['rang'] = $_Joueur_['rang'];
		$_SESSION['Player']['tokens'] = $_Joueur_['tokens'];
		$_SESSION['Player']['uuid'] = $_Joueur_['uuid'];
		$_SESSION['Player']['uuidf'] = $_Joueur_['uuidf'];

		// On met à jours la variable privée de l'objet.
		$this->_Joueur_ = $_Joueur_;
	}
	
	// Retourne le tableau instancié avec le constructeur.
	public function getArrayDonneesUtilisateur()
	{
		return $this->_Joueur_;
	}

	//Mets à jours les données joueur 
	public function updateArrayDonneesUtilisateur($bdd)
	{
		$req = $bdd->prepare('SELECT * FROM cmw_users WHERE pseudo = :pseudo');
		$req->execute(array(
			'pseudo' => $this->_Joueur_['pseudo']
		));
		$fetch = $req->fetch(PDO::FETCH_ASSOC);
		if($fetch['pseudo'] != $this->_Joueur_['pseudo'])
		{
			session_destroy();
			setcookie('id', 0, time(), '/', null, false, false);
			setcookie('pass', 0, time(), '/', null, false, false);
		}
		else
		{
			$_SESSION['Player'] = array(
				'id' => $fetch['id'],
				'pseudo' => $fetch['pseudo'],
				'email' => $fetch['email'],
				'rang' => $fetch['rang'],
				'tokens' => $fetch['tokens'],
				'uuid' => $fetch['UUID'],
				'uuidf' => $fetch['UUIDF'],
				'temp' => time() 
			);
			$this->_Joueur_ = array(
				'id' => $_SESSION['Player']['id'],
				'pseudo' => $_SESSION['Player']['pseudo'],
				'rang' => $_SESSION['Player']['rang'],
				'tokens' => $_SESSION['Player']['tokens'],
				'uuid' => $_SESSION['Player']['uuid'],
				'uuidf' => $_SESSION['Player']['uuidf']
			);

			if(!isset($_SESSION['Player']['uuid'])) {

				$UUID = file_get_contents("https://api.mojang.com/users/profiles/minecraft/".$_SESSION['Player']['pseudo']);

				if ($UUID != NULL) {
					$obj = json_decode($UUID);
					$UUID = $obj->{'id'};
				}

				//CONVERSION UUIDF
				if ($UUID != "INVALIDE") {
					$UUIDF = substr_replace($UUID, "-", 8, 0);
					$UUIDF = substr_replace($UUIDF, "-", 13, 0);
					$UUIDF = substr_replace($UUIDF, "-", 18, 0);
					$UUIDF = substr_replace($UUIDF, "-", 23, 0);
				}else{
					$UUIDF = "INVALIDE";
					$UUID = "INVALIDE";
				}

				$requetebdduuid2 = $bdd->prepare('UPDATE cmw_users SET UUID = :uuid, UUIDF = :uuidf WHERE pseudo = :pseudo;');

				$requetebdduuid2->execute(Array (
					'pseudo' => $_SESSION['Player']['pseudo'],
					'uuid' => $UUID,
					'uuidf' => $UUIDF

				));
			}
		}
	}
}
?>
