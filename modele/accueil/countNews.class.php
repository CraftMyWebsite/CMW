<?php
class CountNews
{
	private $bdd;
	
    public function __construct($bdd)
    {	
		$this->bdd = $bdd;
	}
	
	public function GetCountCommentaires()
	{
		$news_countCommentaires = $this->bdd->prepare('SELECT MAX(id) AS id FROM cmw_news_commentaires');
		$news_countCommentaires->execute();
		return $news_countCommentaires;
	}

	public function GetCountReports()
	{
		$news_countReports = $this->bdd->prepare('SELECT MAX(id) AS id FROM cmw_news_reports');
		$news_countReports->execute();
		return $news_countReports;
	}

	public function GetCountLikes()
	{
		$news_countLikes = $this->bdd->prepare('SELECT MAX(id) AS id FROM cmw_news_stats');
		$news_countLikes->execute();
		return $news_countLikes;
	}

    public function GetCountEditCommentaire($id_comm, $id_news, $auteur)
    {
	    $news_countEditCommentaire = $this->bdd->prepare('SELECT nbrEdit FROM cmw_news_commentaires WHERE id LIKE :id AND id_news LIKE :id_news AND pseudo LIKE :pseudo');
        $news_countEditCommentaire->bindParam(':id', $id_comm);
        $news_countEditCommentaire->bindParam(':id_news', $id_news);
        $news_countEditCommentaire->bindParam(':pseudo', $auteur);
        $news_countEditCommentaire->execute();
        return $news_countEditCommentaire;
    }
}
?>