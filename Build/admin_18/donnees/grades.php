<?php
if($_Permission_->verifPerm("createur")) {


$PermissionFormat["PermsDefault"]="Permissions générales";
$PermissionFormat["PermsDefault-news"]="Nouveautés";
$PermissionFormat["PermsDefault-news-deleteMemberComm"]="Supprimer les commentaires";
$PermissionFormat["PermsDefault-news-editMemberComm"]="Éditer les commentaires";
$PermissionFormat["PermsDefault-support"]="Support";
$PermissionFormat["PermsDefault-support-closeTicket"]="Ouvrir/Fermer les tickets";
$PermissionFormat["PermsDefault-support-deleteMemberComm"]="Supprimer les commentaires";
$PermissionFormat["PermsDefault-support-editMemberComm"]="Éditer les commentaires";
$PermissionFormat["PermsDefault-support-displayTicket"]="Voir les tickets privés";
$PermissionFormat["PermsDefault-chat"]="Chat";
$PermissionFormat["PermsDefault-chat-color"]="Écrire en couleur sur le chat";
$PermissionFormat["PermsDefault-forum"]="Forum";
$PermissionFormat["PermsDefault-forum-perms"]="Niveau d'accès au forum";
$PermissionFormat["PermsPanel"]="Permissions panel";
$PermissionFormat["PermsPanel-access"]="Accès au panel";
$PermissionFormat["PermsPanel-info"]="Page information";
$PermissionFormat["PermsPanel-info-showPage"]="Accès à la page";
$PermissionFormat["PermsPanel-info-details"]="information relatif aux serveurs";
$PermissionFormat["PermsPanel-info-details-showModal"]="Accès au modal";
$PermissionFormat["PermsPanel-info-details-player"]="Voir les joueurs en ligne";
$PermissionFormat["PermsPanel-info-details-console"]="Accès à la console";
$PermissionFormat["PermsPanel-info-details-command"]="Envoyer des commandes depuis la console";
$PermissionFormat["PermsPanel-info-details-plugins"]="Voir les plugins";
$PermissionFormat["PermsPanel-info-details-server"]="Voir l'état du serveur";
$PermissionFormat["PermsPanel-info-stats"]="Accès au statistique";
$PermissionFormat["PermsPanel-info-stats-visitors"]="Compte rendu des visiteurs";
$PermissionFormat["PermsPanel-info-stats-visitors-showTable"]="Voir le nombre de visiteur";
$PermissionFormat["PermsPanel-info-stats-members"]="Paramètres relatif aux membres";
$PermissionFormat["PermsPanel-info-stats-members-showTable"]="Accès aux paramètres";
$PermissionFormat["PermsPanel-info-stats-members-editLimitIp"]="Changer la limitation IP/Compte";
$PermissionFormat["PermsPanel-info-stats-members-editEmail"]="Changer la limitation Email/Compte";
$PermissionFormat["PermsPanel-info-stats-activity"]="Activités";
$PermissionFormat["PermsPanel-info-stats-activity-showTable"]="Voir les stats des activités";
$PermissionFormat["PermsPanel-info-stats-shop"]="Boutique";
$PermissionFormat["PermsPanel-info-stats-shop-showTable"]="Voir les stats de la boutique";
$PermissionFormat["PermsPanel-general"]="Page general";
$PermissionFormat["PermsPanel-general-showPage"]="Accès à la page";
$PermissionFormat["PermsPanel-general-actions"]="Actions";
$PermissionFormat["PermsPanel-general-actions-editGeneral"]="Edition des paramètres généraux";
$PermissionFormat["PermsPanel-theme"]="Page Thème";
$PermissionFormat["PermsPanel-theme-showPage"]="Accès à la page";
$PermissionFormat["PermsPanel-theme-actions"]="Actions";
$PermissionFormat["PermsPanel-theme-actions-editTheme"]="Éditer le thème actuel";
$PermissionFormat["PermsPanel-theme-actions-editBackground"]="Éditer le background";
$PermissionFormat["PermsPanel-theme-actions-editTypeBackground"]="Éditer le type de background";
$PermissionFormat["PermsPanel-home"]="Page Accueil";
$PermissionFormat["PermsPanel-home-showPage"]="Accès à la page";
$PermissionFormat["PermsPanel-home-actions"]="Actions";
$PermissionFormat["PermsPanel-home-actions-uploadSlider"]="Uploader un slider";
$PermissionFormat["PermsPanel-home-actions-editSlider"]="Éditer un slider";
$PermissionFormat["PermsPanel-home-actions-uploadMiniature"]="Uploader une miniature";
$PermissionFormat["PermsPanel-home-actions-editMiniature"]="Éditer une miniature";
$PermissionFormat["PermsPanel-home-actions-addSlider"]="Ajouter un slider";
$PermissionFormat["PermsPanel-server"]="Page Réglages serveur";
$PermissionFormat["PermsPanel-server-showPage"]="Accès à la page";
$PermissionFormat["PermsPanel-server-actions"]="Actions";
$PermissionFormat["PermsPanel-server-actions-addServer"]="Ajouter un serveur";
$PermissionFormat["PermsPanel-server-actions-editServer"]="Éditer un serveur";
$PermissionFormat["PermsPanel-pages"]="Page Création de page";
$PermissionFormat["PermsPanel-pages-showPage"]="Accès à la page";
$PermissionFormat["PermsPanel-pages-actions"]="Actions";
$PermissionFormat["PermsPanel-pages-actions-editPage"]="Éditer une page";
$PermissionFormat["PermsPanel-pages-actions-addPage"]="Créer une page";
$PermissionFormat["PermsPanel-news"]="Page nouveautés";
$PermissionFormat["PermsPanel-news-showPage"]="Accès à la page";
$PermissionFormat["PermsPanel-news-actions"]="Actions";
$PermissionFormat["PermsPanel-news-actions-addNews"]="Créer une news";
$PermissionFormat["PermsPanel-news-actions-editNews"]="Éditer une news";
$PermissionFormat["PermsPanel-shop"]="Page Boutique";
$PermissionFormat["PermsPanel-shop-showPage"]="Accès à la page";
$PermissionFormat["PermsPanel-shop-actions"]="Actions";
$PermissionFormat["PermsPanel-shop-actions-addCategorie"]="Ajouter une catégorie";
$PermissionFormat["PermsPanel-shop-actions-addOffre"]="Ajouter une offre";
$PermissionFormat["PermsPanel-shop-actions-editCategorieOffre"]="Éditer une catégorie";
$PermissionFormat["PermsPanel-payment"]="Page Payement";
$PermissionFormat["PermsPanel-payment-showPage"]="Accès à la page";
$PermissionFormat["PermsPanel-payment-actions"]="Actions";
$PermissionFormat["PermsPanel-payment-actions-editPayment"]="Éditer un moyen de payement";
$PermissionFormat["PermsPanel-payment-actions-addOffrePaypal"]="Ajouter une offre paypal";
$PermissionFormat["PermsPanel-payment-actions-editOffrePaypal"]="Éditer une offre paypal";
$PermissionFormat["PermsPanel-menus"]="Page Menu";
$PermissionFormat["PermsPanel-menus-showPage"]="Accès à la page";
$PermissionFormat["PermsPanel-menus-actions"]="Actions";
$PermissionFormat["PermsPanel-menus-actions-addLinkMenu"]="Ajouter un menu";
$PermissionFormat["PermsPanel-menus-actions-addDropLinkMenu"]="Ajouter un menu déroulant";
$PermissionFormat["PermsPanel-menus-actions-editDropAndLinkMenu"]="Éditer un menu déroulant";
$PermissionFormat["PermsPanel-vote"]="Page Vote";
$PermissionFormat["PermsPanel-vote-showPage"]="Accès à la page";
$PermissionFormat["PermsPanel-vote-actions"]="Actions";
$PermissionFormat["PermsPanel-vote-actions-editSettings"]="Éditer les paramètres";
$PermissionFormat["PermsPanel-vote-actions-addVote"]="Ajouter un lien de vote";
$PermissionFormat["PermsPanel-vote-actions-resetVote"]="Rénitialiser les votes";
$PermissionFormat["PermsPanel-vote-actions-deleteVote"]="Supprimer un lien de vote";
$PermissionFormat["PermsPanel-members"]="Page Membres";
$PermissionFormat["PermsPanel-members-showPage"]="Accès à la page";
$PermissionFormat["PermsPanel-members-actions"]="Actions";
$PermissionFormat["PermsPanel-members-actions-editMember"]="Éditer un membre";
$PermissionFormat["PermsPanel-forum"]="Page Forum";
$PermissionFormat["PermsPanel-forum-showPage"]="Accès à la page";
$PermissionFormat["PermsPanel-forum-actions"]="Actions";
$PermissionFormat["PermsPanel-forum-actions-addSmiley"]="Ajouter un smiley";
$PermissionFormat["PermsPanel-forum-actions-seeSmileys"]="Éditer les smiley";
$PermissionFormat["PermsPanel-forum-actions-addPrefix"]="Ajouter un préfix";
$PermissionFormat["PermsPanel-forum-actions-seePrefix"]="Éditer les préfix";
$PermissionFormat["PermsPanel-widgets"]="Page Widgets";
$PermissionFormat["PermsPanel-widgets-showPage"]="Accès à la page";
$PermissionFormat["PermsPanel-widgets-actions"]="Actions";
$PermissionFormat["PermsPanel-widgets-actions-addWidgets"]="Ajouter un widgets";
$PermissionFormat["PermsPanel-widgets-actions-editWidgets"]="Éditer un widgets";
$PermissionFormat["PermsPanel-support"]="Page Support - Maintenance";
$PermissionFormat["PermsPanel-support-showPage"]="Accès à la page";
$PermissionFormat["PermsPanel-support-tickets"]="Tickets";
$PermissionFormat["PermsPanel-support-tickets-showPage"]="Accès à la page";
$PermissionFormat["PermsPanel-support-tickets-actions"]="Actions";
$PermissionFormat["PermsPanel-support-tickets-actions-editEtatTicket"]="Éditer l'état d'un ticket";
$PermissionFormat["PermsPanel-support-tickets-actions-deleteTicket"]="Supprimer un ticket";
$PermissionFormat["PermsPanel-support-maintenance"]="Maintenance";
$PermissionFormat["PermsPanel-support-maintenance-showPage"]="Accès à la page";
$PermissionFormat["PermsPanel-support-maintenance-actions"]="Actions";
$PermissionFormat["PermsPanel-support-maintenance-actions-editDefaultMessage"]="Éditer le message par default";
$PermissionFormat["PermsPanel-support-maintenance-actions-editAdminMessage"]="Éditer le message pour les admins";
$PermissionFormat["PermsPanel-support-maintenance-actions-editEtatMaintenance"]="Éditer l'état de la maintenance";
$PermissionFormat["PermsPanel-support-maintenance-actions-switchRedirectMode"]="Éditer la redirection";
$PermissionFormat["PermsPanel-update"]="Page Mise à jour";
$PermissionFormat["PermsPanel-update-showPage"]="Accès à la page";
$PermissionFormat["PermsForum"]="Permissions Forums";
$PermissionFormat["PermsForum-general"]="Générale";
$PermissionFormat["PermsForum-general-addCategorie"]="Ajouter une catégorie";
$PermissionFormat["PermsForum-general-addForum"]="Ajouter un forum";
$PermissionFormat["PermsForum-general-deleteForum"]="Supprimer un forum";
$PermissionFormat["PermsForum-general-deleteCategorie"]="Supprimer une catégorie";
$PermissionFormat["PermsForum-general-addSousForum"]="Ajouter un sous forum";
$PermissionFormat["PermsForum-general-deleteSousForum"]="Supprimer un sous forum";
$PermissionFormat["PermsForum-general-modeJoueur"]="Passer en mode joueur";
$PermissionFormat["PermsForum-moderation"]="Modération";
$PermissionFormat["PermsForum-moderation-editTopic"]="Éditer un topic";
$PermissionFormat["PermsForum-moderation-deleteMessage"]="Supprimer un message";
$PermissionFormat["PermsForum-moderation-deleteTopic"]="Supprimer un topic";
$PermissionFormat["PermsForum-moderation-editMessage"]="Éditer un message";
$PermissionFormat["PermsForum-moderation-closeTopic"]="Fermer un topic";
$PermissionFormat["PermsForum-moderation-mooveTopic"]="Moove un topic";
$PermissionFormat["PermsForum-moderation-seeSignalement"]="Voir les signalements";
$PermissionFormat["PermsForum-moderation-addPrefix"]="Ajouter un préfix";
$PermissionFormat["PermsForum-moderation-epingle"]="Épingler";
$PermissionFormat["PermsForum-moderation-selTopic"]="";

	$dirGrades = './modele/grades/';
	$initGrades = glob($dirGrades.'*.yml');

	$lastGrade[] = array();
	foreach($initGrades as $numGrade) {
		$lastGrade[] = substr($numGrade, 16, -4);
	}

	$lastGrade = array_filter($lastGrade);
	if(empty($lastGrade))
		array_push($lastGrade, -1);

	$idGrade[] = array();
	for($i = 2;$i <= max($lastGrade); $i++) {
		$openGrade = new Lire($dirGrades.$i.'.yml');
		$readGrade = $openGrade->GetTableau();
		$idGrade[$i] = $readGrade;
	}
	$prefixs = array(
                                 'prefixPrimary',
                                 'prefixSecondary',
                                 'prefixRed',
                                 'prefixGreen',
                                 'prefixOlive',
                                 'prefixLightGreen',
                                 'prefixBlue',
                                 'prefixRoyalBlue',
                                 'prefixSkyBlue',
                                 'prefixGray',
                                 'prefixSilver',
                                 'prefixYellow',
                                 'prefixOrange',
                                 'prefixCreateur'
                             );
                             $effets = array(
                                 'style5',
                                 'style16'
                             );


    function hasPerm($i, $str, $grades) {
        $ar = explode("-", $str);
        $perm = $grades[$i];
        foreach($ar as $value)
        {
            $perm = $perm[$value];
        }
        return $perm == true;

    }

    function hasPermArray($i, $str, $grades) {
        $ar = explode("-", $str);
        $perm = $grades[$i];
        foreach($ar as $value)
        {
            $perm = $perm[$value];
        }
        foreach($perm as $key => $value)
        {
            if(is_array($value)) {
                if(hasPermArray2($value, $key) != true) {
                    return false;
                }
            } else {
                if($perm[$key] != true) {
                    return false;
                }
            }
        }
        return true;
    }

    function hasPermArray2($perm, $suivi) {
        foreach($perm as $key => $value)
        {
            $suivi = $suivi."-".$key;
            if(is_array($value)) {
                if($suivi == "PermsDefault-forum" )
                {
                    continue;
                }
                if(hasPermArray2($value, $suivi) != true) {
                    return false;
                }
            } else {
                if($perm[$key] != true) {
                    return false;
                }
            }
        }
        return true;
    }

    
    function editPerm($id, $edit, $perm, $str, $POST) {
        foreach($perm as $key => $value)
        {
            if($key != "Grade" & $key != "prefix" & $key != "effets") {
                if($str == "") {
                    $str2 = $key;
                } else {
                    $str2 = $str."-".$key;
                }
                if(is_array($value))
                {
                    $edit = editPerm($id, $edit, $value, $str2, $POST);
                } else {
                    $ar = explode("-", $str2);
                    if($str2 == "PermsDefault-forum-perms")
                    {
                        $result = $POST[$str2."-".$id];
                    } else {
                        $result = isset($POST[$str2."-".$id]);
                    }
                    if(count($ar) == 1) {
                        $edit[$ar[0]] = $result;
                    } else if(count($ar) == 2) {
                        $edit[$ar[0]][$ar[1]] = $result;
                    } else if(count($ar) == 3) {
                        $edit[$ar[0]][$ar[1]][$ar[2]] = $result;
                    } else if(count($ar) == 4) {
                        $edit[$ar[0]][$ar[1]][$ar[2]][$ar[3]] = $result;
                    } else if(count($ar) == 5) {
                        $edit[$ar[0]][$ar[1]][$ar[2]][$ar[3]][$ar[4]] = $result;
                    } else if(count($ar) == 6) {
                        $edit[$ar[0]][$ar[1]][$ar[2]][$ar[3]][$ar[4]][$ar[5]] = $result;
                    } else if(count($ar) == 7) {
                        $edit[$ar[0]][$ar[1]][$ar[2]][$ar[3]][$ar[4]][$ar[5]][$ar[6]] = $result;
                    } else if(count($ar) == 8) {
                        $edit[$ar[0]][$ar[1]][$ar[2]][$ar[3]][$ar[4]][$ar[5]][$ar[6]][$ar[7]] = $result;
                    }

                }
            }
        }
        return $edit;
    } 

    function showForFormatage($perm, $suivi) {
        foreach($perm as $key => $value)
        {
            if($key != "Grade" & $key != "prefix" & $key != "effets") 
            {
                if($suivi == "") {
                    $suivi2 = $key;
                } else {
                    $suivi2 = $suivi."-".$key;
                }
                echo '$PermissionFormat["'.$suivi2.'"]="";<br/>';
                if(is_array($value)) {
                    showForFormatage($value, $suivi2);
                }
            }
        }

    }

}
?>