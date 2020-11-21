<?php
class accueilNews
{
	private $bdd;
	
	public function __construct($bdd)
	{	
		$this->bdd = $bdd;
	}

	public function countCommentaires($id_news)
	{
		$countCommentaires = $this->bdd->prepare('SELECT * FROM cmw_news_commentaires WHERE id_news LIKE :id_news');
		$countCommentaires->bindParam(':id_news', $id_news);
		$countCommentaires->execute();
		return $countCommentaires;
	}

	public function checkLike($pseudo, $id_news)
	{
		$checkLike = $this->bdd->prepare('SELECT pseudo FROM cmw_news_stats WHERE pseudo LIKE :pseudo AND id_news LIKE :id_news');
		$checkLike->bindParam(':pseudo', $pseudo);
		$checkLike->bindParam(':id_news', $id_news);
		$checkLike->execute();
		return $checkLike;
	}

	public function countLikesPlayers($id_news)
	{
		$countLikesPlayers = $this->bdd->prepare('SELECT * FROM cmw_news_stats WHERE id_news LIKE :id_news');
		$countLikesPlayers->bindParam(':id_news', $id_news);
		$countLikesPlayers->execute();
		return $countLikesPlayers;
	}

	public function newsCommentaires($id_news)
	{
		$newsCommentaires = $this->bdd->prepare('SELECT * FROM cmw_news_commentaires WHERE id_news LIKE :id_news');
		$newsCommentaires->bindParam(':id_news', $id_news);
		$newsCommentaires->execute();
		return $newsCommentaires;
	}

	public function ownerCommentaire($id_news, $pseudo, $id)
	{
		$ownerCommentaire = $this->bdd->prepare('SELECT * FROM cmw_news_commentaires WHERE id_news LIKE :id_news AND pseudo LIKE :pseudo AND id LIKE :id');
		$ownerCommentaire->bindParam(':id_news', $id_news);
		$ownerCommentaire->bindParam(':pseudo', $pseudo);
		$ownerCommentaire->bindParam(':id', $id);
		$ownerCommentaire->execute();
		return $ownerCommentaire;
	}

	public function checkReport($pseudo, $victime, $id_news, $id_commentaire)
	{
		$checkReport = $this->bdd->prepare('SELECT * FROM cmw_news_reports WHERE pseudo LIKE :pseudo AND victime LIKE :victime AND id_news LIKE :id_news AND id_commentaires LIKE :id_commentaires');
		$checkReport->bindParam(':pseudo', $pseudo);
		$checkReport->bindParam(':victime', $victime);
		$checkReport->bindParam(':id_news', $id_news);
		$checkReport->bindParam(':id_commentaires', $id_commentaire);
		$checkReport->execute();
		return $checkReport;
	}

	public function countReportsVictimes($victime, $id_news, $id_commentaire)
	{
		$countReportsVictimes = $this->bdd->prepare('SELECT * FROM cmw_news_reports WHERE victime LIKE :victime AND id_news LIKE :id_news AND id_commentaires LIKE :id_commentaires');
		$countReportsVictimes->bindParam(':victime', $victime);
		$countReportsVictimes->bindParam(':id_news', $id_news);
		$countReportsVictimes->bindParam(':id_commentaires', $id_commentaire);
		$countReportsVictimes->execute();
		return $countReportsVictimes;
	}

	public function editCommentaire($pseudo, $id_news, $id)
	{
		$editCommentaire = $this->bdd->prepare('SELECT commentaire FROM cmw_news_commentaires WHERE pseudo LIKE :pseudo AND id_news LIKE :id_news AND id LIKE :id');
		$editCommentaire->bindParam(':pseudo', $pseudo);
		$editCommentaire->bindParam(':id_news', $id_news);
		$editCommentaire->bindParam(':id', $id);
		$editCommentaire->execute();
		return $editCommentaire;
	}

}
?>