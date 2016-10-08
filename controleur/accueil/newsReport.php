<?php
if(isset($_Joueur_)) {
    $pseudo = $_Joueur_['pseudo'];
    $message = '';
    $id_news = urldecode($_GET['id_news']);
    $id_comm = urldecode($_GET['id_comm']);
    $victime = urldecode($_GET['victime']);

    require_once('modele/accueil/existNews.class.php');
    $req_ExistNews = new ExistNews($bddConnection);
    $get_ExistNews = $req_ExistNews->GetExistNews($id_news);
    $get_ExistVictime = $req_ExistNews->GetExistVictime($victime);
    $get_ExistReport = $req_ExistNews->GetExistReport($pseudo, $victime, $id_news, $id_comm);
    $get_ExistCommentaire = $req_ExistNews->GetExistCommentaire($victime, $id_news, $id_comm);
    $ExistNews = $get_ExistNews->rowCount();
    $ExistVictime = $get_ExistVictime->rowCount();
    $ExistReport = $get_ExistReport->rowCount();
    $ExistCommentaire = $get_ExistCommentaire->rowCount();

    require_once('modele/accueil/countNews.class.php');
    $req_CountReportNews = new CountNews($bddConnection);
    $rep_CountReportNews = $req_CountReportNews->GetCountReports();
    $get_CountReportNews = $rep_CountReportNews->fetch();
    $id = $get_CountReportNews['id'];

    if($ExistNews == "0") {
        header('Location: index.php?&NewsNotExist=true');
    } else {
        if($pseudo == $victime) {
    	    header('Location: index.php?&NotReportYourSelf=true');
    	} else {
            if($ExistReport == "1") {
                header('Location: index.php?&ReportVictimeExist=true');
            } else {
                if($ExistVictime == "0") {
    	            header('Location: index.php?&PlayerNotExist=true');
                } else {
                    if($ExistCommentaire == "0") {
                        header('Location: index.php?&CommentaireNotExist=true');
                    } else {
    	                require_once('modele/accueil/postNews.class.php');
    	                $req_ReportVictime = new PostNews($bddConnection);
     	                $req_ReportVictime->AddReport($id + 1, $id_news, $id_comm, $pseudo, $message, $victime);
    	                header('Location: index.php?&ReportEnvoyer=true');
                    }
                }
            }
        }
    }
} else {
	header('Location: index.php?&NotOnline=true');
}
?>