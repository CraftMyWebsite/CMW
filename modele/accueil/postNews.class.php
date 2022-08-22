<?php
class PostNews
{
	private $bdd;
	
    public function __construct($bdd)
    {	
		$this->bdd = $bdd;
	}
	
	public function AddLike($CountNewsLikes, $id_news, $pseudo)
	{
		$news_postLike = $this->bdd->prepare('INSERT INTO cmw_news_stats (id, id_news, pseudo) VALUES (:id, :id_news, :pseudo)');
		$news_postLike->bindParam(':id', $CountNewsLikes);
		$news_postLike->bindParam(':id_news', $id_news);
		$news_postLike->bindParam(':pseudo', $pseudo);
		$news_postLike->execute();
	}

	public function AddCommentaire($id, $id_news, $pseudo, $commentaire)
	{
		$news_postCommentaire = $this->bdd->prepare('INSERT INTO cmw_news_commentaires (id, id_news, pseudo, commentaire, date_post) VALUES (:id, :id_news, :pseudo, :commentaire, UNIX_TIMESTAMP())');
		$news_postCommentaire->bindParam(':id', $id);
		$news_postCommentaire->bindParam(':id_news', $id_news);
		$news_postCommentaire->bindParam(':pseudo', $pseudo);
		$news_postCommentaire->bindParam(':commentaire', $commentaire);
		$news_postCommentaire->execute();
	}

	public function AddReport($id, $id_news, $id_comm, $pseudo, $message, $victime)
	{
		$news_postReport = $this->bdd->prepare('INSERT INTO cmw_news_reports (id, id_news, id_commentaires, pseudo, message, victime) VALUES (:id, :id_news, :id_commentaires, :pseudo, :message, :victime)');
		$news_postReport->bindParam(':id', $id);
		$news_postReport->bindParam(':id_news', $id_news);
		$news_postReport->bindParam(':id_commentaires', $id_comm);
		$news_postReport->bindParam(':pseudo', $pseudo);
		$news_postReport->bindParam(':message', $message);
		$news_postReport->bindParam(':victime', $victime);
		$news_postReport->execute();
	}

	public function AddEditCommentaire($id_comm, $id_news, $pseudo, $commentaire, $nbrEdit)
	{
		$news_postEditCommentaire = $this->bdd->prepare('UPDATE cmw_news_commentaires SET commentaire = :commentaire, date_post = UNIX_TIMESTAMP(), nbrEdit = :nbrEdit WHERE id LIKE :id AND id_news LIKE :id_news AND pseudo LIKE :pseudo');
		$news_postEditCommentaire->bindParam(':id', $id_comm);
		$news_postEditCommentaire->bindParam(':id_news', $id_news);
		$news_postEditCommentaire->bindParam(':pseudo', $pseudo);
		$news_postEditCommentaire->bindParam(':commentaire', $commentaire);
		$news_postEditCommentaire->bindParam(':nbrEdit', $nbrEdit);
		$news_postEditCommentaire->execute();
	} 
}
?>