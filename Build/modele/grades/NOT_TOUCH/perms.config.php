<?php 

/*	Fichier de configuration des permissions et de leur affichage sur le panel
	
	-> Pour ajouter une permission il suffit de respecter la syntaxe ! 

*/

const PERMS = array(
	"PermsDefault" => array(
		"news" => array(
			"deleteMemberComm" => "Suppression des commentaires dans les nouveautés",
			"editMemberComm" => "Edition des commentaires dans les nouveautés"
		),
		"support" => array(
			"closeTicket" => "Ouvrir/Fermer les tickets dans le support",
			"deleteMemberComm" => "Suppression des commentaires dans le support",
			"editMemberComm" => "Edition des commentaires dans le support",
			"displayTicket" => "Voir les tickets privés dans le support"
		),
		"chat" => array(
			'color' => "Écrire en couleur sur le chat" 
		),
		"forum" => array(
			"perms" => "Niveau de permissions (forum, categories, sous-forum et topics). Aura a accès à tous ce qui est inférieur ou égal a son niveau de permission.",
		)
	),
	"PermsPanel" => array(
		"access" => "Accès au panel",
		"info" => array(
			"showPage" => "Accès à la page informations",
			"details" => array(
				"showModal" => "Accès aux modals",
				"player" => "Voir les joueurs en ligne",
				"console" => "Voir la console",
				"command" => "Accès aux commandes",
				"plugins" => "Voir les plugins",
				"server" => "Accès aux infos du serveur"
			),
			"stats" => array(
				"visitors" => array(
					"showTable" => "Voir les stats des visiteurs"
				),
				"members" => array(
					"showTable" => "Voir les stats des inscriptions",
					"editLimitIp" => "Edition de la limite d'inscription par IP",
					"editEmail" => "Edition de la limite d'inscription par email",
					"showIP" => "Voir les adresse IP des joueurs"
				),
				"activity" => array(
					"showTable" => "Voir les stats des activités"
				),
				"shop" => array(
					"showTable" => "Voir les stats de la boutique"
				)
			)
		),
		"general" => array(
			"showPage" => "Accès à la page Réglage Site",
			"actions" => array(
				"editGeneral" => "Edition des réglages sites (base de donnée, IP minecraft ...)",
				"editFavicon" => "Edition du favicon"
			)
		),
		"theme" => array(
			"showPage" => "Accès à la page Thème",
			"actions" => array(
				"editTheme" => "Edition du thème",
				"editBackground" => "Edition du fond d'écran",
				"editTypeBackground" => "Edition du type de fond d'écran"
			)
		),
		"sliderMini" => array(
			"showPage" => "Accès à la page Slider & Miniatures"
		),
		"home" => array(
			"showPage" => "Accès à la page Accueil",
			"actions" => array(
				"uploadSlider" => "Uploader un slider",
				"editSlider" => "Edition des sliders",
				"uploadMiniature" => "Uploader une miniature",
				"editMiniature" => "Edition des miniatures",
				"addSlider" => "Ajouter un slider"
			)
		),
		"server" => array(
			"showPage" => "Accès à la page Réglage Serveur",
			"actions" => array(
				"addServer" => "Ajouter un serveur",
				"editServer" => "Edition d'un serveur"
			)
		),
		"pages" => array(
			"showPage" => "Accès à la page Pages Personnalisées",
			"actions" => array(
				"editPage" => "Edition des pages",
				"addPage" => "Ajouter une page"
			)
		),
		"news" => array(
			"showPage" => "Accès à la page Nouveautés",
			"actions" => array(
				"addNews" => "Ajouter une nouveauté",
				"editNews" => "Edition des nouveautés"
			)
		),
		"shop" => array(
			"showPage" => "Accès à la page Réglage Boutique",
			"actions" => array(
				"addCategorie" => "Ajouter une catégorie",
				"addOffre" => "Ajouter une offre",
				"editCategorieOffre" => "Edition des offres/catégories"
			),
			"achatEvo" => array(
				"showPage" => "Accès à la page Réglage des achats évolutifs"
			),
			"boutiqueList" => array(
				"showPage" => "Accès à la page Historique des achats"
			)
		),
		"payment" => array(
			"showPage" => "Accès à la page Payement",
			"actions" => array(
				"editPayment" => "Edition des paiements",
				"addOffrePaypal" => "Ajouter une offre PayPal",
				"editOffrePaypal" => "Edition des offres PayPal",
				"editOffrePaysafeCard" => "Edition des offres Paysafecard",
				"verifPaysafecard" => "Vérifier les transactions Paysafecard"
			)
		),
		"menus" => array(
			"showPage" => "Accès à la page Menus",
			"actions" => array(
				"addLinkMenu" => "Ajouter un lien menu",
				"addDropLinkMenu" => "Ajouter un menu déroulant",
				"editDropAndLinkMenu" => "Edition des lien menus/déroulants"
			)
		),
		"vote" => array(
			"showPage" => "Accès à la page Voter",
			"actions" => array(
				"editSettings" => "Edition des réglages",
				"addVote" => "Ajouter un lien de vote",
				"resetVote" => "Réinitialiser les votes",
				"deleteVote" => "Supprimer un lien de vote"
			),
			"recompenseAuto" => array(
				"page" => "Récompenses Automatique",
				"showPage" => "Accès à la page Réglage des récompenses auto",
				"actions" => array(
					"resetRecompense" => "Supprimer une récompense auto",
					"addRecompense" => "Créer une récompense auto"
				)
			)
		),
		"members" => array(
			"showPage" => "Accès à la page Membres=>Informations",
			"actions" => array(
				"editMember" => "Edition des membres"
			)
		),
		"forum" => array(
			"showPage" => "Accès à la page Forum",
			"actions" => array(
				"addSmiley" => "Ajout de smileys",
				"seeSmileys" => "Voir/Supprimer les smileys",
				"addPrefix" => "Ajouter des prefixes de discussion",
				"seePrefix" => "Voir/supprimer les prefixes de discussion"
			)
		),
		"widgets" => array(
			"showPage" => "Accès à la page Widgets",
			"actions" => array(
				"addWidgets" => "Ajouter un Widget",
				"editWidgets" => "Edition des Widgets"
			)
		),
		"support" => array(
			"tickets" => array(
				"showPage" => "Accès à la page Tickets",
				"actions" => array(
					"editEtatTicket" => "Changer l'état des tickets",
					"deleteTicket" => "Supprimer un ticket",
					"deleteAllTicket" => "Supprimer tout les tickets"
				)
			)
		),
		"maintenance" => array(
			"showPage" => "Accès à la page Maintenance",
			"actions" => array(
				"editDefaultMessage" => "Edition du message par défaut",
				"editAdminMessage" => "Edition du message adressé aux admins",
				"editInscrMessage" => "Edition du message pour les inscriptions",
				"editEtatMaintenance" => "Changer l'état de la maintenance",
				"switchRedirectMode" => "Changer le mode de redirection",
				"switchInscription" => "Autoriser/Refuser les inscriptions lors d'une maintenance",
				"connexionAdmin" => "Peut se connecter pendant une maintenance"
			)
		),
		"update" => array(
			"showPage" => "Accès à la page Mise à jours"
		),
		"social" => array(
			"showPage" => "Accès à la page Membres=>Social"
		),
		"newsletter" => array(
			"showPage" => "Accès à la page Newsletter",
			"actions" => array(
				"send" => "Peut envoyer une newsletter"
			)
		),
		"ban" => array(
			"showPage" => "Accès à la page Bannissement",
			"actions" => array(
				"removeBan" => "Permet de supprimer un utilisateur banni",
				"addBan" => "Permet d'ajouter un utilisateur à la banlist",
				"editBanPage" => "Permet l'édition de la page des bannis"
			)
		),
		"upload" => array(
			"showPage" => "Accès à la page Upload",
			"manager" => "Peut gérer l'upload d'images"
		)
	),
	"PermsForum" => array(
		"general" => array(
			"addCategorie" => "Ajouter des Catégories",
			"addForum" => "Ajouter des Forums",
			"deleteForum" => "Supprimer des Forums",
			"deleteCategorie" => "Supprimer des Catégories",
			"addSousForum" => "Ajouter des Sous-Forums",
			"deleteSousForum" => "Supprimer des Sous-Forums",
			"modeJoueur" => "Passer au visuel Joueur/Administrateur"
		),
		"moderation" => array(
			"editTopic" => "Editer des Topics",
			"deleteMessage" => "Supprimer des Messages",
			"deleteTopic" => "Supprimer des Topics",
			"editMessage" => "Editer des Messages",
			"closeTopic" => "Fermer/Ouvrir des Topics",
			"mooveTopic" => "Déplacer des Topics",
			"seeSignalement" => "Voir les topics/messages signalés",
			"addPrefix" => "Ajouter/Enlever des préfixes de discussions",
			"epingle" => "Epingler des topics",
			"selTopic" => "Peut sélectionner des topics (les deux précédentes permissions sont inutiles sans celle-ci)"
		)
	)
);

?>