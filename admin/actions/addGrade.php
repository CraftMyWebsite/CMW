<?php
if(isset($_Joueur_)) {
	if($_Joueur_['rang'] == 1) {

		function createGradeDefault() {
			$file = fopen('./modele/grades/NOT_TOUCH/default.yml', 'w+');
			$putInit = "Grade: \nPermsDefault:\n  news:\n    deleteMemberComm: \n    editMemberComm: \n  support:\n    closeTicket: \n    deleteMemberComm: \n    editMemberComm: \n    displayTicket: \nPermsPanel:\n  access: \n  info:\n    showPage: \n    details:\n      showModal: \n      player: \n      console: \n      command: \n      plugins: \n      server: \n    stats:\n      visitors:\n        showTable: \n      members:\n        showTable: \n        editLimitIp: \n        editEmail: \n      activity:\n        showTable: \n      shop:\n        showTable: \n  general:\n    showPage: \n    actions:\n      editGeneral: \n  theme:\n    showPage: \n    actions:\n      editTheme: \n      editBackground: \n      editTypeBackground: \n  home:\n    showPage: \n    actions:\n      uploadSlider: \n      editSlider: \n      uploadMiniature: \n      editMiniature: \n      addSlider: \n  server:\n    showPage: \n    actions:\n      addServer: \n      editServer: \n  pages:\n    showPage: \n    actions:\n      editPage: \n      addPage: \n  news:\n    showPage: \n    actions:\n      addNews: \n      editNews: \n  shop:\n    showPage: \n    actions:\n      addCategorie: \n      addOffre: \n      editCategorieOffre: \n  payment:\n    showPage: \n    actions:\n      editPayment: \n      addOffrePaypal: \n      editOffrePaypal: \n  menus:\n    showPage: \n    actions:\n      addLinkMenu: \n      addDropLinkMenu: \n      editDropAndLinkMenu: \n  vote:\n    showPage: \n    actions:\n      editSettings: \n      addVote: \n      resetVote: \n      deleteVote: \n  members:\n    showPage: \n    actions:\n      editMember: \n  widgets:\n    showPage: \n    actions:\n      addWidgets: \n      editWidgets: \n  support:\n    showPage: \n    tickets:\n      showPage: \n      actions:\n        editEtatTicket: \n        deleteTicket: \n    maintenance:\n      showPage: \n      actions:\n        editDefaultMessage: \n        editAdminMessage: \n        editEtatMaintenance: \n        switchRedirectMode: \n  update:\n    showPage: \nPermsForum: \n  general: \n      addCategorie: \n      addForum: \n      deleteForum: \n      deleteCategorie: \n      addSousForum: \n      deleteSousForum: \n  moderation: \n      editTopic: \n      deleteMessage: \n      deleteTopic: \n      editMessage: \n      closeTopic: \n      mooveTopic: \n      seeSignalement: ";
			fputs($file, $putInit);
			fclose($file);
		}

		$nameGrade = htmlspecialchars($_POST['gradeName']);
		$existGrade = false;

		if(strlen($nameGrade) > 32) {
			header('Location: admin.php?&nomGradeLong=true');
			exit();
		} if(strlen($nameGrade) < 3) {
			header('Location: admin.php?&nomGradeCourt=true');
			exit();
		}

		if(!is_dir($dirGrades)) {
			if(!mkdir($dirGrades, 0755)) {
				header('Location: admin.php?&cdgi=true');
				exit();
			} if(!mkdir($dirGrades.'NOT_TOUCH/', 0755)) {
				header('Location: admin.php?&cdnti=true');
				createGradeDefault();
				exit();
			}
		} elseif(!is_dir($dirGrades.'NOT_TOUCH/')) {
			if(!mkdir($dirGrades.'NOT_TOUCH/', 0755)) {
				header('Location: admin.php?&cdnti=true');
				exit();
			}
		}

		for($i = 2; $i <= end($lastGrade); $i++) {
			$checkGrade = new Lire($dirGrades.$i.'.yml');
			$checkGrade = $checkGrade->GetTableau();
			$compareGrade = $checkGrade['Grade'];
			if($nameGrade == $compareGrade)
				$existGrade = true;
		}

		if($existGrade == true) {
			header('Location: admin.php?&gradeNameAlreadyUsed=true');
			exit();
		} else {
			if(end($lastGrade) == -1) {
			    $numGrade = end($lastGrade) + 3;
		    } else {
			    $numGrade = end($lastGrade) + 1;
		    }
			if(!file_exists($dirGrades.'NOT_TOUCH/default.yml')) {
				createGradeDefault();
				header('Location: admin.php?&gradeDefaultInexistantRegen=true');
				exit();
			}  else {
				if(file_exists($dirGrades.$numGrade.'.yml')) {
					header("Location: admin.php?&conflitGrade=true");
					exit();
				}
				if(copy($dirGrades.'NOT_TOUCH/default.yml', $dirGrades.$numGrade.'.yml')) {
					$grade = $dirGrades.$numGrade.'.yml';
					$writeGrade = new Lire($grade);
					$writeGrade = $writeGrade->GetTableau();
					$writeGrade['Grade'] = $nameGrade;
					$createGrade = new Ecrire($grade, $writeGrade);
					header('Location: admin.php?&gradeCreated=true');
					exit();
				}
			}
		}
	}
}
?>