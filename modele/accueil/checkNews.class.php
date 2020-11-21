<?php
class CheckNews
{
	private $bdd;
	
    public function __construct($bdd)
    {	
		$this->bdd = $bdd;
	}
	
	public function CheckOwnerCommentaire($id_comm, $id_news)
	{
		$news_checkOwnerCommentaire = $this->bdd->prepare('SELECT pseudo FROM cmw_news_commentaires WHERE id LIKE :id AND id_news LIKE :id_news');
		$news_checkOwnerCommentaire->bindParam(':id', $id_comm);
		$news_checkOwnerCommentaire->bindParam(':id_news', $id_news);
		$news_checkOwnerCommentaire->execute();
		return $news_checkOwnerCommentaire;
	} 
}
?>