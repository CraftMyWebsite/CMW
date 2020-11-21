<?php
class DeleteNews
{
	private $bdd;
	
    public function __construct($bdd)
    {	
		$this->bdd = $bdd;
	}
	
	public function DeleteOwnerCommentaire($id_news, $pseudo, $id)
	{
		$news_deleteOwnerCommentaire = $this->bdd->prepare('DELETE FROM cmw_news_commentaires WHERE id_news LIKE :id_news AND pseudo LIKE :pseudo AND id LIKE :id');
        $news_deleteOwnerCommentaire->bindParam(':id_news', $id_news);
        $news_deleteOwnerCommentaire->bindParam(':pseudo', $pseudo);
		$news_deleteOwnerCommentaire->bindParam(':id', $id);
		$news_deleteOwnerCommentaire->execute();
	}

	public function DeleteOwnerReports($id, $id_news)
	{
		$news_deleteOwnerReports = $this->bdd->prepare('DELETE FROM cmw_news_reports WHERE id_commentaires LIKE :id_commentaires AND id_news LIKE :id_news');
        $news_deleteOwnerReports->bindParam(':id_commentaires', $id);
        $news_deleteOwnerReports->bindParam(':id_news', $id_news);
		$news_deleteOwnerReports->execute();
	}
}
?>