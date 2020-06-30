<?php 

class MembresPage
{
	private $bdd;
	public $nbPages;

	public function __construct($bdd)
	{
		$this->bdd = $bdd;
	}

	public function getMembres($page = 1)
	{
		$maxMembre = $this->countMembres();
		$this->nbPages = ceil($maxMembre / 20);
		if($page > $this->nbPages)
			echo '<div class="alert alert-warning text-center">Cette page n\'existe pas !</div>';
		$premierAffichage = ($page - 1) * 20;
		$req = $this->bdd->query('SELECT id, pseudo, rang, tokens FROM cmw_users ORDER BY id ASC LIMIT '.$premierAffichage.', 20');
		$return = $req->fetchAll(PDO::FETCH_ASSOC);
		return $return;
	}

	private function countMembres()
	{
		$req = $this->bdd->query('SELECT COUNT(id) AS max FROM cmw_users');
		$fetch = $req->fetch(PDO::FETCH_ASSOC);
		return $fetch['max'];
	}

	public function gradeJoueur($pseudo)
	{
		global $_Serveur_;
		$req = $this->bdd->prepare('SELECT rang FROM cmw_users WHERE pseudo = :pseudo');
		$req->execute(array('pseudo' => $pseudo ));
		$joueurDonnees = $req->fetch(PDO::FETCH_ASSOC);
		if($joueurDonnees['rang'] == 0) {
			$gradeSite = $_Serveur_['General']['joueur'];
		} elseif($joueurDonnees['rang'] == 1) {
			$gradeSite = "<span class='prefix ".$_Serveur_['General']['createur']['effets']." ".$_Serveur_['General']['createur']['prefix']."'>".$_Serveur_['General']['createur']['nom']."</span>";
		} elseif(fopen('./modele/grades/'.$joueurDonnees['rang'].'.yml', 'r')) {
			$openGradeSite = new Lire('./modele/grades/'.$joueurDonnees['rang'].'.yml');
			$readGradeSite = $openGradeSite->GetTableau();
			$gradeSite = "<span class='prefix ".$readGradeSite['prefix']." ".$readGradeSite['effets']."'>".$readGradeSite['Grade']."</span>";
			if(empty($readGradeSite['Grade']))
				$gradeSite = $_Serveur_['General']['joueur'];
		} else {
			$gradeSite = $_Serveur_['General']['joueur'];
		}
		return $gradeSite;
	}

	public function rechercheMembre($recherche)
	{
		$req = $this->bdd->prepare('SELECT id, pseudo, rang, tokens FROM cmw_users WHERE pseudo LIKE :recherche ORDER BY id ASC LIMIT 0,20');
		$req->execute(array(
			'recherche' => '%'.$recherche.'%'
		));
		return $req->fetchAll(PDO::FETCH_ASSOC);
	}
}