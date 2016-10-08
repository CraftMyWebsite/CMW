<?php
class ExistNews
{
	private $bdd;
	
    public function __construct($bdd)
    {	
		$this->bdd = $bdd;
	}
	
	public function GetExistNews($id_news)
	{
		$news_existNews = $this->bdd->prepare('SELECT * FROM cmw_news WHERE id LIKE :id');
		$news_existNews->bindParam(':id', $id_news);
		$news_existNews->execute();
		return $news_existNews;
	}

	public function GetExistCommentaire($victime, $id_news, $id_comm)
	{
		$news_existCommentaire = $this->bdd->prepare('SELECT * FROM cmw_news_commentaires WHERE pseudo LIKE :pseudo AND id_news LIKE :id_news AND id LIKE :id');
		$news_existCommentaire->bindParam(':pseudo', $victime);
		$news_existCommentaire->bindParam(':id_news', $id_news);
		$news_existCommentaire->bindParam(':id', $id_comm);
		$news_existCommentaire->execute();
		return $news_existCommentaire;
	}

	public function GetExistLike($pseudo, $id_news)
	{
		$news_existLike = $this->bdd->prepare('SELECT pseudo FROM cmw_news_stats WHERE pseudo LIKE :pseudo AND id_news LIKE :id_news');
		$news_existLike->bindParam(':pseudo', $pseudo);
		$news_existLike->bindParam(':id_news', $id_news);
		$news_existLike->execute();
		return $news_existLike;
	}

	public function GetExistReport($pseudo, $victime, $id_news, $id_comm)
	{
		$news_existReport = $this->bdd->prepare('SELECT * FROM cmw_news_reports WHERE pseudo LIKE :pseudo AND victime LIKE :victime AND id_news LIKE :id_news AND id_commentaires LIKE :id_commentaires');
		$news_existReport->bindParam(':pseudo', $pseudo);
		$news_existReport->bindParam(':victime', $victime);
		$news_existReport->bindParam(':id_news', $id_news);
		$news_existReport->bindParam(':id_commentaires', $id_comm);
		$news_existReport->execute();
		return $news_existReport;
	}

	public function GetExistVictime($victime)
	{
		$news_existVictime = $this->bdd->prepare('SELECT pseudo FROM cmw_users WHERE pseudo LIKE :pseudo');
		$news_existVictime->bindParam(':pseudo', $victime);
		$news_existVictime->execute();
		return $news_existVictime;
	}
}
?>