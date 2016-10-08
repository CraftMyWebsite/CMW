<?php
if(isset($_Joueur_)) {
	$pseudo = $_Joueur_['pseudo'];
	$commentaire = htmlspecialchars($_POST['edit_commentaire']);
	$id_news = urldecode($_GET['id_news']);
	$auteur = urldecode($_GET['auteur']);
	$id_comm = urldecode($_GET['id_comm']);
	if($_Joueur_['rang'] == 1)
		$adminMode = true;

	require_once('modele/accueil/existNews.class.php');
	$req_ExistNews = new ExistNews($bddConnection);
	$get_ExistNews = $req_ExistNews->GetExistNews($id_news);
	$ExistNews = $get_ExistNews->rowCount();

	require_once('modele/accueil/checkNews.class.php');
	$req_CheckOwnerCommentaire = new CheckNews($bddConnection);
	$rep_CheckOwnerCommentaire = $req_CheckOwnerCommentaire->CheckOwnerCommentaire($id_comm, $id_news);
	$get_CheckOwnerCommentaire = $rep_CheckOwnerCommentaire->fetch();
	$CheckOwnerCommentaire = $get_CheckOwnerCommentaire['pseudo'];

	require_once('modele/accueil/countNews.class.php');
	$req_CountEditCommentaire = new CountNews($bddConnection);
	$rep_CountEditCommentaire = $req_CountEditCommentaire->GetCountEditCommentaire($id_comm, $id_news, $auteur);
	$get_CountEditCommentaire = $rep_CountEditCommentaire->fetch();
	$CountEditCommentaire = $get_CountEditCommentaire['nbrEdit'];

	if($ExistNews == "0") {
		header('Location: index.php?&NewsNotExist=true');
	} else {
		if(!$auteur == $pseudo AND !$CheckOwnerCommentaire == $pseudo OR !$adminMode = true) {
			header('Location: index.php?&EditImpossible=true');
		} else {
			if(strlen($commentaire) > 255) {
				header('Location: index.php?&MessageTropLong=true');
			} elseif(strlen($commentaire) < 6) {
				header('Location: index.php?&MessageTropCourt=true');
			} else {
				require_once('modele/accueil/postNews.class.php');
				$req_EditCommentaire = new PostNews($bddConnection);
				$req_EditCommentaire->AddEditCommentaire($id_comm, $id_news, $auteur, $commentaire, $CountEditCommentaire + 1);
				header('Location: index.php?&MessageEditer=true');
			}
		}
	}
} else {
	header('Location: index.php?&NotOnline=true');
}
?>