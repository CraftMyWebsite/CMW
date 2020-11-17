<?php 
if(!class_exists('Forum'))
	require('modele/forum/forum.class.php');

class AdminForum extends Forum
{
	private $success;
	private $actions;

	public function __construct($bdd)
	{
		Forum::__construct($bdd);
		$this->success = 0;
		$this->actions = 0;
	}

	public function setNewsPermsForum($id, $perms)
	{
		++$this->actions;
		$req = $this->bdd->prepare('UPDATE cmw_forum SET perms = :perms WHERE id = :id');
		if($req->execute(array(
			'perms' => $perms,
			'id' => $id
		)) !== TRUE)
			$this->success[$this->actions-1] = 'ERREUR AdminForum::setNewsPermsForum req UPDATE';
	}

	public function setNewsPermsCategorie($id, $perms)
	{
		++$this->actions;
		$req = $this->bdd->prepare('UPDATE cmw_forum_categorie SET perms = :perms WHERE id = :id');
		if($req->execute(array('perms' => $perms, 'id' => $id)) !== TRUE)
			$this->success[$this->actions-1] = 'ERREUR AdminForum::setNewsPermsCategorie req UPDATE';
	}

	public function setNewsPermsSousForum($id, $perms)
	{
		++$this->actions;
		$req = $this->bdd->prepare('UPDATE cmw_forum_sous_forum SET perms = :perms WHERE id = :id');
		if($req->execute(array('perms' => $perms, 'id' => $id)) !== TRUE)
			$this->success[$this->actions-1] = 'ERREUR AdminForum::setNewsPermsSousForum req UPDATE';
	}

	public function setNewsPermsTopic($id, $perms)
	{
		++$this->actions;
		$req = $this->bdd->prepare('UPDATE cmw_forum_post SET perms = :perms WHERE id = :id');
		if($req->execute(array('perms' => $perms, 'id' => $id)) !== TRUE)
			$this->success[$this->actions-1] = 'ERREUR AdminForum::setNewsPermsTopic req UPDATE';
	}

	public function getErreurs(&$e)
	{
		if($this->success == 0)
			return 0;
		else
		{
			$e['type'] = 'Erreur Forum';
			$e['titre'] = 'Erreur Administration';
			$e['contenue'] = '';
			for($i = 0; $i < $this->actions; $i++)
			{
				if(!empty($this->success[$i]))
					$e['contenue'] .= $this->success[$i].'<br/>';
			}
			return 1;
		}
	}

	public function verifEdit($objet, $id, $joueur)
	{
		++$this->actions;
		if($joueur['rang'] == 1)
			return true;
		elseif($objet == 1 && Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'editTopic'))
			return true;
		elseif($objet == 2 && Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'editMessage'))
			return true;
		else
		{
			$table = ($objet == 1) ? 'cmw_forum_post' : 'cmw_forum_answer';
			$req = $this->bdd->prepare('SELECT pseudo FROM '.$table.' WHERE id = :id');
			$req->execute(array(
				'id' => $id,
			));
			$fetch = $req->fetch(PDO::FETCH_ASSOC);
			if($fetch['pseudo'] == $joueur['pseudo'])
				return true;
			else
			{
				$this->success[$this->action-1] = 'ERREUR, vous ne détenez pas le droit d\'éditer !';
				return false;
			}
		}
	}

	public function editObjet($objet, $id, $pseudo, $contenue, &$id_topic, $titre = null)
	{
		++$this->actions;
		if($objet == 1)
		{
			$req = $this->bdd->prepare('SELECT contenue, nom FROM cmw_forum_post WHERE id = :id');
			$req->execute(array(
				'id' => $id
			));
			$id_topic = $id;
			$data = $req->fetch(PDO::FETCH_ASSOC);
			$table = 'cmw_forum_post';
		}
		else
		{
			$req = $this->bdd->prepare('SELECT contenue, id_topic FROM cmw_forum_answer WHERE id = :id');
			$req->execute(array(
				'id' => $id
			));
			$data = $req->fetch(PDO::FETCH_ASSOC);
			$id_topic = $data['id_topic'];
			$table = 'cmw_forum_answer';
		}
		if($data['contenue'] != $contenue OR (isset($data['nom'], $titre) && $data['nom'] != $titre))
		{
			$update = $this->bdd->prepare('UPDATE '.$table.' SET contenue = :contenue, d_edition = NOW() WHERE id = :id');
			$update->execute(array(
				'contenue' => $contenue,
				'id' => $id
			));
			if(isset($titre, $data['nom']))
			{
				echo true;
				$update = $this->bdd->prepare('UPDATE cmw_forum_post SET nom = :nom, d_edition = NOW() WHERE id = :id');
				$update->execute(array(
					'nom' => $titre,
					'id' => $id
				));
			}
			return true;
		}
		else
			return true;
	}

	public function setNewNomForum($nom, $id, $entite, $icone = null)
	{
		++$this->actions;
		if($entite == 1)
		{
			$req = $this->bdd->prepare('UPDATE cmw_forum_categorie SET nom = :nom, img = :icone WHERE id = :id');
		}
		elseif($entite == 0)
		{
			$req = $this->bdd->prepare('UPDATE cmw_forum SET nom = :nom WHERE id = :id');
		}
		elseif($entite == 2)
		{
			$req = $this->bdd->prepare('UPDATE cmw_forum_sous_forum SET nom = :nom, img = :icone WHERE id = :id');
		}
		if($entite > 0)
		{
			$req->execute(array(
				'nom' => $nom,
				'icone' => $icone,
				'id' => $id
			));
		}
		else
		{
			$req->execute(array(
				'nom' => $nom,
				'id' => $id
			));
		}

	}

	public function getPage($entite, $id)
	{
		if($entite == 1)
			return 'forum';
		elseif($entite == 2)
			return 'forum';
		elseif($entite == 3)
		{
			$data = $this->SousForum($id);
			return 'forum_categorie&id='.$data['id_categorie'];
		}
		else
			return 'post&id='.$id;
	}
}

?>