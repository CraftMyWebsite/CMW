<?php
if(isset($_Joueur_)) {
    $pseudo = $_Joueur_['pseudo'];
    $commentaire = htmlspecialchars($_POST['commentaire']);
    $id_news = urldecode($_GET['id_news']);

    require_once('modele/accueil/existNews.class.php');
    $req_ExistNews = new ExistNews($bddConnection);
    $get_ExistNews = $req_ExistNews->GetExistNews($id_news);
    $ExistNews = $get_ExistNews->rowCount();
	
	require_once('modele/accueil/countNews.class.php');
	$req_CountCommentaires = new CountNews($bddConnection);
	$rep_CountCommentaires = $req_CountCommentaires->GetCountCommentaires();
    $get_CountCommentaires = $rep_CountCommentaires->fetch();
	$id = $get_CountCommentaires['id'];

	if($ExistNews == "0") {
        header('Location: index.php?&NewsNotExist=true');
	} else {
        if(strlen($commentaire) > 255) {
		    header('Location: index.php?&MessageTropLong=true');
	    } elseif(strlen($commentaire) < 6) {
		    header('Location: index.php?&MessageTropCourt=true');
        } else {
            require_once('modele/accueil/postNews.class.php');
            $req_CommentaireNews = new PostNews($bddConnection);
            $req_CommentaireNews->AddCommentaire($id + 1, $id_news, $pseudo, $commentaire);
            header('Location: index.php?&MessageEnvoyer=true');
        }
    }
} else {
	header('Location: index.php?&NotOnline=true');
}
?>