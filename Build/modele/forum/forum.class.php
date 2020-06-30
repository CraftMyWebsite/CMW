<?php 

class Forum {
	
	//Mise en mémoire de l'Objet permettant l'accès à la Base de donnée
	protected $bdd;
	
	//Constructeur
	public function __construct($bdd)
	{
		$this->bdd = $bdd;
	}
	
	//Fonction d'affichage des Forums
	public function affichageForum() 
	{
		$forum = $this->bdd->query('SELECT * FROM cmw_forum ORDER BY ordre ASC');
		$donnees = $forum->fetchAll();
		return $donnees;
	}
	
	//Fonction de récupération des données de chaque forum
	public function infosForum($id)
	{
		$requete = $this->bdd->prepare('SELECT * FROM cmw_forum_categorie WHERE forum = :forum ORDER BY ordre ASC');
		$requete->execute(array(
			'forum' => htmlspecialchars($id)
		));
		$donnees = $requete->fetchAll();
		return $donnees;
	}
	
	//Récupération de la dernière réponse 
	public function derniereReponseForum($id)
	{
		$dernier_topic2 = $this->bdd->prepare('SELECT date_creation FROM cmw_forum_post WHERE id_categorie = :id ORDER BY date_creation DESC');
		$dernier_topic2->execute(array(
			'id' => $id
		));
		$dernier_topic_donnees = $dernier_topic2->fetch(PDO::FETCH_ASSOC);
		$derniere_reponse_req = $this->bdd->prepare('SELECT cmw_forum_answer.pseudo AS pseudo, cmw_forum_answer.date_post AS date_post, cmw_forum_answer.id_topic AS id, cmw_forum_post.nom AS titre
			FROM cmw_forum_answer 
				INNER JOIN cmw_forum_post 
					ON cmw_forum_answer.id_topic = cmw_forum_post.id 
			WHERE cmw_forum_post.id_categorie = :id
			ORDER BY cmw_forum_answer.date_post DESC');
		$derniere_reponse_req->execute(array(
			'id' => htmlspecialchars($id)
			));
		$derniere_reponse_donnees = $derniere_reponse_req->fetch(PDO::FETCH_ASSOC);
		if(!isset($derniere_reponse_donnees['pseudo']) OR strtotime($dernier_topic_donnees['date_creation']) > strtotime($derniere_reponse_donnees['date_post']))
		{
			$dernier_topic = $this->bdd->prepare('SELECT nom AS titre, id, pseudo, date_creation AS date_post
			FROM cmw_forum_post 
			WHERE id_categorie = :id ORDER BY date_creation DESC');
			$dernier_topic->execute(array(
				'id' => $id
			));
			$derniere_topic_donnees = $dernier_topic->fetch(PDO::FETCH_ASSOC);
			if(!isset($derniere_topic_donnees['titre']))
				return FALSE;
			else
			{
				return $derniere_topic_donnees;
			}
		}
		else
			return $derniere_reponse_donnees;
	}
	
	//Récupération catégorie
	public function infosCategorie($id)
	{
		$categorie = $this->bdd->prepare('SELECT * FROM cmw_forum_categorie WHERE id = :id');
		$categorie->execute(array(
			'id' => htmlspecialchars($id)
			));
		$donnees = $categorie->fetch(PDO::FETCH_ASSOC);
		return $donnees;
	}
	
	//Récupération sousForum
	public function infosSousForum($id, $fetch)
	{
		$sousForum = $this->bdd->prepare('SELECT * FROM cmw_forum_sous_forum WHERE id_categorie = :id_categorie ORDER BY ordre ASC');
		$sousForum->execute(array(
			'id_categorie' => htmlspecialchars($id)
			));
		if($fetch == 0)
			$donnees = $sousForum->fetch(PDO::FETCH_ASSOC);
		else
			$donnees = $sousForum->fetchAll();
		return $donnees;
	}
	
	//Compte les topics
	public function compteTopics($id)
	{
		$count_topic2 = $this->bdd->prepare('SELECT * FROM cmw_forum_post WHERE id_categorie = :id_categorie AND sous_forum IS NULL');
		$count_topic2->bindParam(':id_categorie', htmlspecialchars($id));
		$count_topic2->execute();
		return $count_topic2->rowCount();
	}
	
	//Récupération des topics 
	public function infosTopics($id, $count)
	{
		$topic = $this->bdd->prepare('SELECT * FROM cmw_forum_post WHERE id_categorie = :id_categorie AND sous_forum IS NULL ORDER BY epingle DESC, last_answer_temps DESC LIMIT '.$count.', 20');
		$topic->bindParam(':id_categorie', htmlspecialchars($id));
		$topic->execute();
		return $topic->fetchAll();
	}
	
	//récupération de la table cmw_sous_forum pour le fofo si on se trouve dans un sousForum
	public function SousForum($id)
	{
		$sousforum = $this->bdd->prepare('SELECT * FROM cmw_forum_sous_forum WHERE id = :id');
		$sousforum->execute(array(
			'id' => htmlspecialchars($id)
		));
		return $sousforum->fetch(PDO::FETCH_ASSOC);
	}
	
	//Compte topics pour les topics de sous forum
	public function compteTopicsSF($id)
	{
		$count_topic = $this->bdd->prepare('SELECT * FROM cmw_forum_post WHERE sous_forum LIKE :sous_forum');
		$count_topic->bindParam(':sous_forum', $id);
        $count_topic->execute();
		return $count_topic->rowCount();
	}
	
	//InfosTopics pour les sous forum
	public function infosSousForumTopics($id, $count)
	{
		$topic = $this->bdd->prepare('SELECT * FROM cmw_forum_post WHERE sous_forum LIKE :sous_forum ORDER BY epingle DESC, last_answer_temps DESC LIMIT '.$count.', 20');
		$topic->bindParam(':sous_forum', htmlspecialchars($id));
        $topic->execute();
		return $topic->fetchAll();
	}
	
	//Page post.php récupération du topic
	public function getTopic($id)
	{
		$topic = $this->bdd->prepare('SELECT cmw_forum_post.nom AS nom, d_edition, pseudo, contenue, DAY(date_creation) AS jour, MONTH(date_creation) AS mois, YEAR(date_creation) AS annee, id_categorie, sous_forum, last_answer, etat, cmw_forum_post.id AS id, cmw_forum_categorie.nom AS nom_categorie, cmw_forum_post.perms AS perms, cmw_forum_categorie.perms AS permsCat 
		FROM cmw_forum_post 
			INNER JOIN cmw_forum_categorie 
				ON cmw_forum_post.id_categorie = cmw_forum_categorie.id
		WHERE cmw_forum_post.id = :id');
		$topic->execute(array(
			'id' => $id
		));
		$donnees = $topic->fetch(PDO::FETCH_ASSOC);
		if(isset($donnees['sous_forum']))
		{
			$nom = $this->bdd->prepare('SELECT nom FROM cmw_forum_sous_forum WHERE id = :id'); 
			$nom->execute(array('id' => $donnees['sous_forum']));
			$data = $nom->fetch(PDO::FETCH_ASSOC);
			$donnees['nom_sf'] = $data['nom'];
		}
		return $donnees;
	}
	
	//Compte réponse du topic
	public function compteReponse($id)
	{
		$count = $this->bdd->prepare('SELECT COUNT(id) AS count_id FROM cmw_forum_answer WHERE id_topic = :id_topic');
		$count->bindParam(':id_topic', $id);
		$count->execute();
		$fetch = $count->fetch(PDO::FETCH_ASSOC);
		return $fetch['count_id'];
	}
	
	//Affichage réponse en fonction de la page :
	public function affichageReponse($id, $count)
	{
		$answer = $this->bdd->prepare('SELECT id, id_topic, pseudo, contenue, d_edition, DAY(date_post) AS day, MONTH(date_post) AS mois, YEAR(date_post) AS annee FROM cmw_forum_answer WHERE id_topic LIKE :id_topic ORDER BY id ASC LIMIT '.$count.', 20');
		$answer->bindParam(':id_topic', $id);
		$answer->execute();
		return $answer->fetchAll();
	}
	
	//compte les Like des answer 
	public function compteLike($id, &$count, $type)
	{
		$like = $this->bdd->prepare('SELECT id AS count, pseudo FROM cmw_forum_like WHERE id_answer = :id_answer AND Appreciation = 1 AND type = :type');
		$like->bindParam(':id_answer', $id, PDO::PARAM_INT);
		$like->bindParam(':type', $type, PDO::PARAM_INT);
		$like->execute();
		$count = $like->rowCount();
		return $like->fetchAll();
	}
	
	//Pareil pour DisLike :
	public function compteDisLike($id, &$count, $type)
	{
		$dislike = $this->bdd->prepare('SELECT id, pseudo FROM cmw_forum_like WHERE id_answer = :id_answer AND Appreciation = 2 AND type = :type');
		$dislike->bindParam(':id_answer', $id, PDO::PARAM_INT);
		$dislike->bindParam(':type', $type, PDO::PARAM_INT);
		$dislike->execute();
		$count = $dislike->rowCount();
		return $dislike->fetchAll();
	}
	
	//Vérifie si la personne a déjà réagit 
	public function testVote($id, $joueur)
	{
		$test_vote = $this->bdd->prepare('SELECT COUNT(id) AS count FROM cmw_forum_like WHERE pseudo = :pseudo AND id_answer = :id_answer AND type = 2');
		$test_vote->execute(array(
			'pseudo' => $joueur,
			'id_answer' => $id
		));
		return $test_vote->fetch(PDO::FETCH_ASSOC);
	}
	
	//Vérification si le forum est lock 
	public function isLock($id)
	{
		$req = $this->bdd->prepare('SELECT close FROM cmw_forum_categorie WHERE id = :id');
		$req->execute(array(
			'id' => $id
			));
		return $req->fetch(PDO::FETCH_ASSOC);
	}
	
	//Vérifie l'existence du forum 
	public function exist($id)
	{
		$req = $this->bdd->prepare('SELECT COUNT(id) AS count FROM cmw_forum_categorie WHERE id = :id');
		$req->execute(array(
			'id' => $id
			));
		$data = $req->fetch(PDO::FETCH_ASSOC);
		if($data['count'] > 0)
			return true;
		else
			return false;
	}

	//Renvoie le grade du joueur
	public function gradeJoueur($pseudo)
	{
		global $_Serveur_;
		$req = $this->bdd->prepare('SELECT rang FROM cmw_users WHERE pseudo = :pseudo');
		$req->execute(array('pseudo' => $pseudo ));
		$joueurDonnees = $req->fetch(PDO::FETCH_ASSOC);
		if($joueurDonnees['rang'] == 0) {
			$gradeSite = $_Serveur_['General']['joueur'];
		} elseif($joueurDonnees['rang'] == 1) {
			$gradeSite = "<span class='prefix ".$_Serveur_['General']['createur']['prefix']." ".$_Serveur_['General']['createur']['effets']."' style='padding-left: 0px;'>".$_Serveur_['General']['createur']['nom']."</span>";
		} elseif(fopen('./modele/grades/'.$joueurDonnees['rang'].'.yml', 'r')) {
			$openGradeSite = new Lire('./modele/grades/'.$joueurDonnees['rang'].'.yml');
			$readGradeSite = $openGradeSite->GetTableau();
			$gradeSite = "<span class='prefix ".$readGradeSite['prefix']." ".$readGradeSite['effets']."' style='padding-left: 0px;'>".$readGradeSite['Grade']."</span>";
			if(empty($readGradeSite['Grade']))
				$gradeSite = $_Serveur_['General']['joueur'];
		} else {
			$gradeSite = $_Serveur_['General']['joueur'];
		}
		return $gradeSite;
	}

	//Renvoie le préfix de la discussion
	public function getPrefix($prefix)
	{
		$req = $this->bdd->prepare('SELECT span, nom FROM cmw_forum_prefix WHERE id = :id');
		$req->execute(array(	'id' => $prefix));
		$fetch = $req->fetch(PDO::FETCH_ASSOC);
		$return = '<span class="'.$fetch['span'].'">'.$fetch['nom'].'</span>';
		return $return;
	}

	//Renvoie le nombre de topic dans le forum
	public function compteTopicsForum($id)
	{
		$req = $this->bdd->prepare('SELECT COUNT(id) AS count FROM cmw_forum_post WHERE id_categorie = :id');
		$req->execute(array('id' => $id));
		$fetch = $req->fetch(PDO::FETCH_ASSOC);
		return $fetch['count'];
	}

	public function compteAnswerSF($id)
	{
		$req = $this->bdd->prepare('SELECT id FROM cmw_forum_post WHERE sous_forum = :sf');
		$req->execute(array(	'sf' => htmlspecialchars($id)));
		$count = 0;
		while($data = $req->fetch(PDO::FETCH_ASSOC))
			$count+=$this->compteReponse($data['id']);
		return $count;
	}

	public function conversionLastAnswer($last_answer)
	{
		if(preg_match('#:#', $last_answer))
		{
			$return = explode(':', $last_answer);
			return $return[0].' le '.date('d', $return[1]).' '.$this->switch_date(date('n', $return[1])).' '.date('Y', $return[1]);
		}
		else
			return $last_answer;
	}

	public function getPrefixModeration()
	{
		$req = $this->bdd->query('SELECT id, nom FROM cmw_forum_prefix ORDER BY id ASC');
		return $req;
	}

	public function compteMessages($id)
	{
		$req = $this->bdd->prepare('SELECT COUNT(cmw_forum_answer.id) AS count FROM cmw_forum_answer 
			INNER JOIN cmw_forum_post 
				ON cmw_forum_answer.id_topic = cmw_forum_post.id
			WHERE cmw_forum_post.id_categorie = :id;');
		$req->execute(array('id' => $id));
		$data = $req->fetch(PDO::FETCH_ASSOC);
		return $data['count'];
	}

	public function getDateConvert($date)
	{
		$explode = explode('-', $date);
		$jours = $explode[2];
		$mois = $this->switch_date($explode[1]);
		$annee = $explode[0];
		return $jours.' '.$mois.' '.$annee;
	}

	public function getSignature($pseudo)
	{
		$req = $this->bdd->prepare('SELECT signature FROM cmw_users WHERE pseudo = :pseudo');
		$req->execute(array(
			'pseudo' => $pseudo
		));
		$fetch = $req->fetch(PDO::FETCH_ASSOC);
		return $fetch['signature'];
	}

	protected function switch_date($date)
	{
		switch($date)
		{
			case '1':
				$mois = 'Janvier';
			break;
			
			case '2':
				$mois = 'Février';
			break;
			
			case '3':
				$mois = 'Mars';
			break;
			
			case '4':
				$mois = 'Avril';
			break;
			
			case '5':
				$mois = 'Mai';
			break;
			
			case '6':
				$mois = 'Juin';
			break;
			
			case '7':
				$mois = 'Juillet';
			break;
			
			case '8':
				$mois = 'Août';
			break;
			
			case '9':
				$mois = 'Septembre';
			break;
			
			case '10':
				$mois = 'Octobre';
			break;
			
			case '11':
				$mois = 'Novembre';
			break;
			
			case '12':
				$mois = 'Décembre';
			break;
		}
		return $mois;
	}
}
?>