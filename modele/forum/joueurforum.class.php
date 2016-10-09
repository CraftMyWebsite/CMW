<?php 

class JoueurForum {
	
	private $_JoueurForum_;
	private $bdd;
	
	//Fonction de création de la classe ( initialisation de la variable $_JoueurForum_ disponible sur toutes les pages du theme
	// et initialisation de la variable $bdd uniquement disponible dans la class avec le $this->bdd 
	public function __construct($pseudo, $id, $bdd)
	{
		$_JoueurForum_ = array(
			'pseudo' => $pseudo,
			'id' => $id
		);
		$this->_JoueurForum_ = $_JoueurForum_;
		$this->bdd = $bdd;
	}
	
	//Fonction permettant d'ajouter le topic vu en tant que topic lu ( cette fonction est appelé au début de la page post.php qui permet que pour 
	// n'importe quel sujet regardé la fonction sera appelé )
	public function topic_lu($id_topic)
	{
		$req = $this->bdd->prepare('SELECT * FROM cmw_forum_lu WHERE id_topic = :id AND pseudo = :pseudo');
		$req->execute(array(
			'id' => $id_topic,
			'pseudo' => $this->_JoueurForum_['pseudo']
		));
		$exist = $req->fetch();
		if(isset($exist['pseudo']))
		{
			$update = $this->bdd->prepare('UPDATE cmw_forum_lu SET vu = 1 WHERE id_topic = :id AND pseudo = :pseudo');
			$update->execute(array(
				'id' => $id_topic,
				'pseudo' => $this->_JoueurForum_['pseudo']
			));
		}
		else
		{
			$insert = $this->bdd->prepare('INSERT INTO cmw_forum_lu (pseudo, id_topic, vu) VALUES (:pseudo, :id_topic, 1) ');
			$insert->execute(array(
				'pseudo' => $this->_JoueurForum_['pseudo'],
				'id_topic' => $id_topic
			));
		}
	}
	
	//Fonction vérifiant si le topic a déjà été lu ou pas ( appelé sur la page forum_categorie et permettant de savoir notamment quelle icône afficher dans le tableau des posts)
	public function is_read($id_topic)
	{
		$req = $this->bdd->prepare('SELECT vu FROM cmw_forum_lu WHERE pseudo = :pseudo AND id_topic = :id_topic');
		$req->execute(array(
			'pseudo' => $this->_JoueurForum_['pseudo'],
			'id_topic' => $id_topic
		));
		$read = $req->fetch();
		if($read['vu'] == 1)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	//Fonction vérifiant si le topic est suivie, appelé sur la page post.php pour savoir s'il faut mettre le bouton Ne plus suivre ou Suivre cette discussion ( notamment )
	public function is_followed($id_topic)
	{
		$followr = $this->bdd->prepare('SELECT id_topic FROM cmw_forum_topic_followed WHERE pseudo = :pseudo AND id_topic = :id_topic');
		$followr->execute(array(
			'pseudo' => $this->_JoueurForum_['pseudo'],
			'id_topic' => $id_topic
		));
		$follow = $followr->fetch();
		if(!empty($follow['id_topic']))
		{
			$follow = true;
		}
		else
		{
			$follow = false;
		}
		return $follow;
	}
	
	//Fonction récupérant les alertes j'aime/j'aime pas :
	public function get_like_dislike()
	{
			$req_answer = $this->bdd->prepare('SELECT cmw_forum_like.pseudo AS pseudo_likeur, Appreciation, id_answer, cmw_forum_answer.pseudo
			AS pseudo_posteur, id_topic, vu	FROM cmw_forum_like INNER JOIN cmw_forum_answer WHERE id_answer = cmw_forum_answer.id 
			AND cmw_forum_like.pseudo != :pseudo AND cmw_forum_answer.pseudo = :pseudop');
			$req_answer->execute(array(
				'pseudo' => $this->_JoueurForum_['pseudo'],
				'pseudop' => $this->_JoueurForum_['pseudo']
			));
			return $req_answer;
	}
	
	//Fonction récupérant les nouvelles réponses :
	public function get_new_answer()
	{
		$req_topic = $this->bdd->prepare('SELECT cmw_forum_topic_followed.pseudo, id_topic, vu, cmw_forum_topic_followed.last_answer AS last_answer_int, cmw_forum_post.last_answer AS last_answer_pseudo, nom FROM cmw_forum_topic_followed 
		INNER JOIN cmw_forum_post WHERE id_topic = cmw_forum_post.id AND cmw_forum_topic_followed.pseudo = :pseudo');
		$req_topic->execute(array(
			'pseudo' => $this->_JoueurForum_['pseudo']
		));
		return $req_topic;
	}
}
?>