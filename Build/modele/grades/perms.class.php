<?php 
require('modele/grades/NOT_TOUCH/perms.config.php');

class Permission {

	private $joueur;
	private $bdd;
	private $_PermDefault_;
	private $_PermPanel_;
	private $_PermForum_;
	private $grade;
	private $options;

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
			switch($perm[0]) {
				case 'PermsDefault':
					if(isset($this->_PermDefault_))
						$TableauPerm = $this->_PermDefault_;
					else
					{
						$TableauPerm = $this->readPerm($grade, 0);
						$this->_PermDefault_ = $TableauPerm;
					}
				break;

				case 'PermsPanel':
					if(isset($this->_PermPanel_))
						$TableauPerm = $this->_PermPanel_;
					else
					{
						$TableauPerm = $this->readPerm($grade, 1);
						$this->_PermPanel_ = $TableauPerm;
					}
				break;

				case 'PermsForum':
					if(isset($this->_PermForum_))
						$TableauPerm = $this->_PermForum_;
					else
					{
						$TableauPerm = $this->readPerm($grade, 2);
						$this->_PermForum_ = $TableauPerm;
					}
				break;
			}
			$perm = array_shift($perm);
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

	public function readPerm($grade, $ordre = 3) //0 : default, 1: panel, 2: forum, 3: tout
	{
		if($ordre == 0)
			$req = $this->bdd->prepare('SELECT permDefault AS result FROM cmw_grades WHERE id = :id');
		elseif($ordre == 1)
			$req = $this->bdd->prepare('SELECT permPanel AS result FROM cmw_grades WHERE id = :id');
		elseif($ordre == 2)
			$req = $this->bdd->prepare('SELECT permForum AS result FROM cmw_grades WHERE id = :id');
		else
			$req = $this->bdd->prepare('SELECT permDefault AS result, permForum AS result1, permPanel AS result2 FROM cmw_grades WHERE id = :id');
		$req->execute(array('id' => $grade));
		$data = $req->fetch(PDO::FETCH_ASSOC);
		if(isset($data['result1']))
		{
			$lecture['PermsDefault'] = unserialize($data['result']);
			$lecture['PermsPanel'] = unserialize($data['result2']);
			$lecture['PermsForum'] = unserialize($data['result1']);
		}
		else
			$lecture = unserialize($data['result']);
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