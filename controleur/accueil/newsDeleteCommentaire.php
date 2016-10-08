<?php
if(isset($_Joueur_)) {
    $pseudo = $_Joueur_['pseudo'];
    $id_news = urldecode($_GET['id_news']);
    $id = urldecode($_GET['id_comm']);
    $auteur = urldecode($_GET['auteur']);
    if($_Joueur_['rang'] == 1)
        $adminMode = true;

    require_once('modele/accueil/existNews.class.php');
    $req_ExistNews = new ExistNews($bddConnection);
    $get_ExistNews = $req_ExistNews->GetExistNews($id_news);
    if($adminMode = true) {
        $get_ExistCommentaire = $req_ExistNews->GetExistCommentaire($auteur, $id_news, $id);
    } else {
        $get_ExistCommentaire = $req_ExistNews->GetExistCommentaire($pseudo, $id_news, $id);
    }
    $ExistCommentaire = $get_ExistCommentaire->rowCount();
    $ExistNews = $get_ExistNews->rowCount();

    require_once('modele/accueil/checkNews.class.php');
    $req_CheckOwnerCommentaire = new CheckNews($bddConnection);
    $rep_CheckOwnerCommentaire = $req_CheckOwnerCommentaire->CheckOwnerCommentaire($id, $id_news);
    $get_CheckOwnerCommentaire = $rep_CheckOwnerCommentaire->fetch();
    $CheckOwnerCommentaire = $get_CheckOwnerCommentaire['pseudo'];

    if($ExistNews == "0") {
    	header('Location: index.php?&NewsNotExist=true');
    } else {
    	if($ExistCommentaire == "0") {
            header('Location: index.php?&CommentaireNotExist=true');
        } else {
            if(!$CheckOwnerCommentaire == $pseudo OR !$adminMode = true) {
             header('Location: index.php?&SuppressionImpossible=true');
         } else {
            require_once('modele/accueil/deleteNews.class.php');
            $req_DeleteInfo = new DeleteNews($bddConnection);
            if($adminMode = true) {
                $req_DeleteInfo->DeleteOwnerCommentaire($id_news, $auteur, $id);
            } else {
                $req_DeleteInfo->DeleteOwnerCommentaire($id_news, $pseudo, $id);
            }
            $req_DeleteInfo->DeleteOwnerReports($id, $id_news);
            header('Location: index.php?&SuppressionCommentaire=true');
        }
    }
}
} else {
    header('Location: index.php?&NotOnline=true');
}
?>