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
			'tokens' => $_SESSION['Player']['tokens'] );
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
		
		// On met à jours la variable privée de l'objet.
		$this->_Joueur_ = $_Joueur_;
	}
	
	// Retourne le tableau instancié avec le constructeur.
	public function getArrayDonneesUtilisateur()
	{
		return $this->_Joueur_;
	}
}
?>
