<?php 
require('modele/grades/NOT_TOUCH/perms.config.php');

class Permission {

	private $joueur;
	private $bdd;
	private $_Perm_;
	private $grade;

	private static $instance = null; //Instance de la classe singleton

	//Constructeur
	private function __construct($joueur, $bdd) {
		$this->joueur = $joueur;
		$this->bdd = $bdd;
	}

	//Gestion du Singleton
	public static function getInstance() {
		global $bddConnection;
		global $_Joueur_;
		if(is_null(self::$instance))
		{
			self::$instance = new Permission($_Joueur_, $bddConnection);
		}
		return self::$instance;
	}

	public function verifPerm(...$perm)
	{
		if(isset($this->grade))
			$grade = $this->grade;
		else
		{
			$grade = $this->getGrade();
			$this->grade = $grade;
		}
		if($grade == 0)
		{
			if($perm[0] == "connect")
				return true;
			return false;
		}
		if($grade == -1)
			return false;
		if($grade == 1)
			return true;
		else
		{
			if($perm[0] == "connect")
				return true;
			if(isset($this->_Perm_))
				$TableauPerm = $this->_Perm_;
			else
			{
				$TableauPerm = $this->readPerm($grade);
				$this->_Perm_ = $TableauPerm;
			}
			$retour = false;
			foreach($perm as $value)
			{
				if(!array_key_exists($value, $TableauPerm))
					return false;
				if(!is_array($TableauPerm[$value]))
				{
					if($TableauPerm[$value] == 'on' || $TableauPerm[$value] === true)
						$retour = true;
					elseif(is_numeric($TableauPerm[$value]))
						return $TableauPerm[$value];
				}
				else
					$TableauPerm = $TableauPerm[$value];
			}
			return $retour;
		}

	}

	public function getNom($grade = -1)
	{
		global $_Serveur_;
		if(isset($this->grade) && $grade == -1)
		{
			if(!isset($this->_Perm_))
				$this->_Perm_ = $this->readPerm($this->grade);
			return "<span class='prefix ".$this->_Perm_['prefix']." ".$this->_Perm_['effets']."'>".$this->_Perm_['Grade']."</span>";
		}
		elseif($grade != -1)
		{
			if($grade == 0)
				return $_Serveur_['General']['joueur'];
			if($grade == 1)
				return "<span class='prefix ".$_Serveur_['General']['createur']['prefix']." ".$_Serveur_['General']['createur']['effets']." ''>".$_Serveur_['General']['createur']['nom']."</span></p>";
			$recup = $this->readPerm($grade);
			return "<span class='prefix ".$recup['prefix']." ".$recup['effets']."'>".$recup['Grade']."</span>";
		}
	}

	private function readPerm($grade)
	{
		$lecture = new Lire('modele/grades/'.$grade.'.yml');
		$lecture = $lecture->GetTableau();
		return $lecture;
	}


	//Récupère le grade du joueur
	private function getGrade() {
		if($this->exist($this->joueur))
		{
			$req = $this->bdd->prepare('SELECT rang FROM cmw_users WHERE pseudo = :pseudo');
			$req->execute(array(
				'pseudo' => $this->joueur['pseudo']
			));
			$data = $req->fetch(PDO::FETCH_ASSOC);
			return $data['rang'];
		}
		return -1;
	}

	private function exist($pseudo)
	{
		if(!is_null($this->joueur))
			return true;
		return false;
	}

}

?>