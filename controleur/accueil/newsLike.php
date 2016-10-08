<?php
if(isset($_Joueur_)) {
    $pseudo = $_Joueur_['pseudo'];
    $id_news = urldecode($_GET['id_news']);

    require_once('modele/accueil/existNews.class.php');
    $req_ExistNews = new ExistNews($bddConnection);
    $get_ExistNews = $req_ExistNews->GetExistNews($id_news);
    $req_ExistLike = $req_ExistNews->GetExistLike($pseudo, $id_news);
    $get_ExistLike = $req_ExistLike->fetch();
    $ExistLike = $get_ExistLike['pseudo'];
    $ExistNews = $get_ExistNews->rowCount();
    
    require_once('modele/accueil/countNews.class.php');
    $req_CountLikes = new CountNews($bddConnection);
    $rep_CountLikes = $req_CountLikes->GetCountLikes();
    $get_CountLikes = $rep_CountLikes->fetch();
    $CountLikes = $get_CountLikes['id'];

    if($ExistNews == "0") {
    	header('Location: index.php?&NewsNotExist=true');
    } else {
        if($ExistLike == $pseudo) {
            header('Location: index.php?&LikeExist=true');
        } else {
            require_once('modele/accueil/postNews.class.php');
            $req_LikeNews = new PostNews($bddConnection);
            $req_LikeNews->AddLike($CountLikes + 1, $id_news, $pseudo);
            header('Location: index.php?&LikeAdd=true&id_like='.$id_news.'');
        }
    }
} else {
    header('Location: index.php?&NotOnline=true');
}
?>