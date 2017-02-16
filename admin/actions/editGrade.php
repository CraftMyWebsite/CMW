<?php
if(isset($_Joueur_)) {
	if($_Joueur_['rang'] == 1) {
		$checkGradeName[] = array();
		$editGradeName = true;
		for($i = 2; $i <= end($lastGrade); $i++) {
			if(file_exists($dirGrades.$i.'.yml')) {
				$grade = $dirGrades.$i.'.yml';
				$editGrade = new Lire($grade);
				$editGrade = $editGrade->GetTableau();

				if(strlen($_POST['gradeName'.$i]) > 32) {
					header('Location: admin.php?&nomGradeLong=true');
					exit();
				} if(strlen($_POST['gradeName'.$i]) < 3) {
					header('Location: admin.php?&nomGradeCourt=true');
					exit();
				}

				$checkGradeName[] = $_POST['gradeName'.$i];

				for($j = 2; $j <= $i; $j++) {
					$g = $j - 1;
					if($i != $j)
						if($checkGradeName[$g] == $_POST['gradeName'.$i])
							$editGradeName = false;
				}

				if($editGradeName == true)
					$editGrade['Grade'] = htmlspecialchars($_POST['gradeName'.$i]);
				$editGradeName = true;

				$editGrade['PermsDefault']['news']['deleteMemberComm'] = $_POST['permsDefaultNewsDeleteMemberComm'.$i];
				$editGrade['PermsDefault']['news']['editMemberComm'] = $_POST['permsDefaultNewsEditMemberComm'.$i];
				$editGrade['PermsDefault']['support']['deleteMemberComm'] = $_POST['permsDefaultSupportDeleteMemberComm'.$i];
				$editGrade['PermsDefault']['support']['editMemberComm'] = $_POST['permsDefaultSupportEditMemberComm'.$i];
				$editGrade['PermsDefault']['support']['closeTicket'] = $_POST['permsDefaultSupportCloseTicket'.$i];
				$editGrade['PermsDefault']['support']['displayTicket'] = $_POST['permsDefaultSupportDisplayTicket'.$i];

				$editGrade['PermsPanel']['access'] = $_POST['permsPanelAccess'.$i];

				$editGrade['PermsPanel']['info']['showPage'] = $_POST['permsPanelInfo'.$i];
				$editGrade['PermsPanel']['general']['showPage'] = $_POST['permsPanelGeneral'.$i];
				$editGrade['PermsPanel']['theme']['showPage'] = $_POST['permsPanelTheme'.$i];
				$editGrade['PermsPanel']['home']['showPage'] = $_POST['permsPanelAccueil'.$i];
				$editGrade['PermsPanel']['server']['showPage'] = $_POST['permsPanelServeur'.$i];
				$editGrade['PermsPanel']['pages']['showPage'] = $_POST['permsPanelPages'.$i];
				$editGrade['PermsPanel']['news']['showPage'] = $_POST['permsPanelNouveautes'.$i];
				$editGrade['PermsPanel']['shop']['showPage'] = $_POST['permsPanelBoutique'.$i];
				$editGrade['PermsPanel']['payment']['showPage'] = $_POST['permsPanelPayement'.$i];
				$editGrade['PermsPanel']['menus']['showPage'] = $_POST['permsPanelMenus'.$i];
				$editGrade['PermsPanel']['vote']['showPage'] = $_POST['permsPanelVoter'.$i];
				$editGrade['PermsPanel']['members']['showPage'] = $_POST['permsPanelMembres'.$i];
				$editGrade['PermsPanel']['widgets']['showPage'] = $_POST['permsPanelWidgets'.$i];
				$editGrade['PermsPanel']['support']['tickets']['showPage'] = $_POST['permsPanelTickets'.$i];
				$editGrade['PermsPanel']['support']['maintenance']['showPage'] = $_POST['permsPanelMaintenance'.$i];
				$editGrade['PermsPanel']['update']['showPage'] = $_POST['permsPanelMaj'.$i];

				$editGrade['PermsPanel']['info']['details']['player'] = $_POST['permsPanelInfoDetailsPlayer'.$i];
				$editGrade['PermsPanel']['info']['details']['console'] = $_POST['permsPanelInfoDetailsConsole'.$i];
				$editGrade['PermsPanel']['info']['details']['command'] = $_POST['permsPanelInfoDetailsCommand'.$i];
				$editGrade['PermsPanel']['info']['details']['plugins'] = $_POST['permsPanelInfoDetailsPlugins'.$i];
				$editGrade['PermsPanel']['info']['details']['server'] = $_POST['permsPanelInfoDetailsServer'.$i];
				$editGrade['PermsPanel']['info']['stats']['visitors']['showTable'] = $_POST['permsPanelInfoStatsVisitorsShowTable'.$i];
				$editGrade['PermsPanel']['info']['stats']['members']['showTable'] = $_POST['permsPanelInfoStatsMembersShowTable'.$i];
				$editGrade['PermsPanel']['info']['stats']['members']['editLimitIp'] = $_POST['permsPanelInfoStatsMembersEditLimitIp'.$i];
				$editGrade['PermsPanel']['info']['stats']['members']['editEmail'] = $_POST['permsPanelInfoStatsMembersEditEmail'.$i];
				$editGrade['PermsPanel']['info']['stats']['activity']['showTable'] = $_POST['permsPanelInfoStatsActivityShowTable'.$i];
				$editGrade['PermsPanel']['info']['stats']['shop']['showTable'] = $_POST['permsPanelInfoStatsShopShowTable'.$i];

				$editGrade['PermsPanel']['general']['actions']['editGeneral'] = $_POST['permsPanelGeneralActionsEditGeneral'.$i];

				$editGrade['PermsPanel']['theme']['actions']['editTheme'] = $_POST['permsPanelThemeActionsEditTheme'.$i];
				$editGrade['PermsPanel']['theme']['actions']['editBackground'] = $_POST['permsPanelThemeActionsEditBackground'.$i];
				$editGrade['PermsPanel']['theme']['actions']['editTypeBackground'] = $_POST['permsPanelThemeActionsEditTypeBackground'.$i];

				$editGrade['PermsPanel']['home']['actions']['uploadSlider'] = $_POST['permsPanelHomeActionsUploadSlider'.$i];
				$editGrade['PermsPanel']['home']['actions']['editSlider'] = $_POST['permsPanelHomeActionsEditSlider'.$i];
				$editGrade['PermsPanel']['home']['actions']['uploadMiniature'] = $_POST['permsPanelHomeActionsUploadMiniature'.$i];
				$editGrade['PermsPanel']['home']['actions']['editMiniature'] = $_POST['permsPanelHomeActionsEditMiniature'.$i];
				$editGrade['PermsPanel']['home']['actions']['addSlider'] = $_POST['permsPanelHomeActionsAddSlider'.$i];

				$editGrade['PermsPanel']['server']['actions']['addServer'] = $_POST['permsPanelServerActionsAddServer'.$i];
				$editGrade['PermsPanel']['server']['actions']['editServer'] = $_POST['permsPanelServerActionsEditServer'.$i];

				$editGrade['PermsPanel']['pages']['actions']['editPage'] = $_POST['permsPanelPagesActionsEditPage'.$i];
				$editGrade['PermsPanel']['pages']['actions']['addPage'] = $_POST['permsPanelPagesActionsAddPage'.$i];

				$editGrade['PermsPanel']['news']['actions']['addNews'] = $_POST['permsPanelNewsActionsAddNews'.$i];
				$editGrade['PermsPanel']['news']['actions']['editNews'] = $_POST['permsPanelNewsActionsEditNews'.$i];

				$editGrade['PermsPanel']['shop']['actions']['addCategorie'] = $_POST['permsPanelShopActionsAddCategorie'.$i];
				$editGrade['PermsPanel']['shop']['actions']['addOffre'] = $_POST['permsPanelShopActionsAddOffre'.$i];
				$editGrade['PermsPanel']['shop']['actions']['editCategorieOffre'] = $_POST['permsPanelShopActionsEditCategorieOffre'.$i];

				$editGrade['PermsPanel']['payment']['actions']['editPayment'] = $_POST['permsPanelPaymentActionsEditPayment'.$i];
				$editGrade['PermsPanel']['payment']['actions']['addOffrePaypal'] = $_POST['permsPanelPaymentActionsAddOffrePaypal'.$i];
				$editGrade['PermsPanel']['payment']['actions']['editOffrePaypal'] = $_POST['permsPanelPaymentActionsEditOffrePaypal'.$i];

				$editGrade['PermsPanel']['menus']['actions']['addLinkMenu'] = $_POST['permsPanelMenusActionsAddLinkMenu'.$i];
				$editGrade['PermsPanel']['menus']['actions']['addDropLinkMenu'] = $_POST['permsPanelMenusActionsAddDropLinkMenu'.$i];
				$editGrade['PermsPanel']['menus']['actions']['editDropAndLinkMenu'] = $_POST['permsPanelMenusActionsEditDropAndLinkMenu'.$i];

				$editGrade['PermsPanel']['vote']['actions']['editSettings'] = $_POST['permsPanelVoteActionsEditSettings'.$i];
				$editGrade['PermsPanel']['vote']['actions']['addVote'] = $_POST['permsPanelVoteActionsAddVote'.$i];
				$editGrade['PermsPanel']['vote']['actions']['resetVote'] = $_POST['permsPanelVoteActionsResetVote'.$i];
				$editGrade['PermsPanel']['vote']['actions']['deleteVote'] = $_POST['permsPanelVoteActionsDeleteVote'.$i];

				$editGrade['PermsPanel']['members']['actions']['editMember'] = $_POST['permsPanelMembersActionsEditMember'.$i];

				$editGrade['PermsPanel']['widgets']['actions']['addWidgets'] = $_POST['permsPanelWidgetsActionsAddWidgets'.$i];
				$editGrade['PermsPanel']['widgets']['actions']['editWidgets'] = $_POST['permsPanelWidgetsActionsEditWidgets'.$i];

				$editGrade['PermsPanel']['support']['tickets']['actions']['editEtatTicket'] = $_POST['permsPanelSupportTicketsActionsEditEtatTicket'.$i];
				$editGrade['PermsPanel']['support']['tickets']['actions']['deleteTicket'] = $_POST['permsPanelSupportTicketsActionsDeleteTicket'.$i];

				$editGrade['PermsPanel']['support']['maintenance']['actions']['editDefaultMessage'] = $_POST['permsPanelSupportMaintenanceActionsEditDefaultMessage'.$i];
				$editGrade['PermsPanel']['support']['maintenance']['actions']['editAdminMessage'] = $_POST['permsPanelSupportMaintenanceActionsEditAdminMessage'.$i];
				$editGrade['PermsPanel']['support']['maintenance']['actions']['editEtatMaintenance'] = $_POST['permsPanelSupportMaintenanceActionsEditEtatMaintenance'.$i];
				$editGrade['PermsPanel']['support']['maintenance']['actions']['switchRedirectMode'] = $_POST['permsPanelSupportMaintenanceActionsSwitchRedirectMode'.$i];
				
				$editGrade['PermsForum']['general']['addCategorie'] = $_POST['permsForumGeneralAddCategorie'.$i];
				$editGrade['PermsForum']['general']['addForum'] = $_POST['permsForumGeneralAddForum'.$i];
				$editGrade['PermsForum']['general']['deleteForum'] = $_POST['permsForumGeneralDeleteForum'.$i];
				$editGrade['PermsForum']['general']['deleteCategorie'] = $_POST['permsForumGeneralDeleteCategorie'.$i];
				$editGrade['PermsForum']['general']['addSousForum'] = $_POST['permsForumGeneralAddSousForum'.$i];
				$editGrade['PermsForum']['general']['deleteSousForum'] = $_POST['permsForumGeneralDeleteSousForum'.$i];
				$editGrade['PermsForum']['general']['modeJoueur'] = $_POST['permsForumGeneralModeJoueur'.$i];
				$editGrade['PermsForum']['moderation']['editTopic'] = $_POST['permsForumModerationEditTopic'.$i];
				$editGrade['PermsForum']['moderation']['deleteTopic'] = $_POST['permsForumModerationDeleteTopic'.$i];
				$editGrade['PermsForum']['moderation']['editMessage'] = $_POST['permsForumModerationEditMessage'.$i];
				$editGrade['PermsForum']['moderation']['deleteMessage'] = $_POST['permsForumModerationDeleteMessage'.$i];
				$editGrade['PermsForum']['moderation']['closeTopic'] = $_POST['permsForumModerationCloseTopic'.$i];
				$editGrade['PermsForum']['moderation']['mooveTopic'] = $_POST['permsForumModerationMooveTopic'.$i];
				$editGrade['PermsForum']['moderation']['seeSignalement'] = $_POST['permsForumModerationSeeSignalement'.$i];
				
				$updateGrade = new Ecrire($grade, $editGrade);
			} 
		}
	}
}
?>