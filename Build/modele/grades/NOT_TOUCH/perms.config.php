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
			"page" => "Informations",
			"showPage" => "Accès à la page <strong>informations</strong>",
			"details" => array(
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
			"page" => "Réglage site",
			"showPage" => "Accès à la page <strong>Réglage Site</strong>",
			"actions" => array(
				"editGeneral" => "Edition des réglages sites (base de donnée, IP minecraft ...)",
				"editFavicon" => "Edition du favicon"
			)
		),
		"theme" => array(
			"page" => "Thème",
			"showPage" => "Accès à la page <strong>Thème</strong>",
			"actions" => array(
				"editTheme" => "Edition du thème",
				"editBackground" => "Edition du fond d'écran",
				"editTypeBackground" => "Edition du type de fond d'écran"
			)
		),
		"sliderMini" => array(
			"page" => "Slider & Miniature",
			"showPage" => "Accès à la page <strong>Slider & Miniatures</strong>"
		),
		"home" => array(
			"page" => "Accueils & Stats",
			"showPage" => "Accès à la page <strong>Accueil</strong>",
			"actions" => array(
				"uploadSlider" => "Uploader un slider",
				"editSlider" => "Edition des sliders",
				"uploadMiniature" => "Uploader une miniature",
				"editMiniature" => "Edition des miniatures",
				"addSlider" => "Ajouter un slider"
			)
		),
		"server" => array(
			"page" => "Réglage JSONAPI",
			"showPage" => "Accès à la page <strong>Réglage Serveur</strong>",
			"actions" => array(
				"addServer" => "Ajouter un serveur",
				"editServer" => "Edition d'un serveur"
			)
		),
		"pages" => array(
			"page" => "Pages personnalisées",
			"showPage" => "Accès à la page <strong>Pages Personnalisées</strong>",
			"actions" => array(
				"editPage" => "Edition des pages",
				"addPage" => "Ajouter une page"
			)
		),
		"news" => array(
			"page" => "News",
			"showPage" => "Accès à la page <strong>Nouveautés</strong>",
			"actions" => array(
				"addNews" => "Ajouter une nouveauté",
				"editNews" => "Edition des nouveautés"
			)
		),
		"shop" => array(
			"page" => "Boutique",
			"showPage" => "Accès à la page <strong>Réglage Boutique</strong>",
			"actions" => array(
				"addCategorie" => "Ajouter une catégorie",
				"addOffre" => "Ajouter une offre",
				"editCategorieOffre" => "Edition des offres/catégories"
			),
			"achatEvo" => array(
				"showPage" => "Accès à la page <strong>Réglage des achats évolutifs</strong>"
			),
			"boutiqueList" => array(
				"showPage" => "Accès à la page <strong>Historique des achats</strong>"
			)
		),
		"payment" => array(
			"page" => "Paiements",
			"showPage" => "Accès à la page <strong>Payement</strong>",
			"actions" => array(
				"editPayment" => "Edition des paiements",
				"addOffrePaypal" => "Ajouter une offre PayPal",
				"editOffrePaypal" => "Edition des offres PayPal",
				"editOffrePaysafeCard" => "Edition des offres Paysafecard",
				"verifPaysafecard" => "Vérifier les transactions Paysafecard"
			)
		),
		"menus" => array(
			"page" => "Menus Personnalisées",
			"showPage" => "Accès à la page <strong>Menus</strong>",
			"actions" => array(
				"addLinkMenu" => "Ajouter un lien menu",
				"addDropLinkMenu" => "Ajouter un menu déroulant",
				"editDropAndLinkMenu" => "Edition des lien menus/déroulants"
			)
		),
		"vote" => array(
			"page" => "Vote",
			"showPage" => "Accès à la page <strong>Voter</strong>",
			"actions" => array(
				"editSettings" => "Edition des réglages",
				"addVote" => "Ajouter un lien de vote",
				"resetVote" => "Réinitialiser les votes",
				"deleteVote" => "Supprimer un lien de vote"
			),
			"recompenseAuto" => array(
				"page" => "Récompenses Automatique",
				"showPage" => "Accès à la page <strong>Réglage des récompenses auto</strong>",
				"actions" => array(
					"resetRecompense" => "Supprimer une récompense auto",
					"addRecompense" => "Créer une récompense auto"
				)
			)
		),
		"members" => array(
			"page" => "Membres",
			"showPage" => "Accès à la page <strong>Membres=>Informations</strong>",
			"actions" => array(
				"editMember" => "Edition des membres"
			)
		),
		"forum" => array(
			"page" => "Forum",
			"showPage" => "Accès à la page <strong>Forum</strong>",
			"actions" => array(
				"addSmiley" => "Ajout de smileys",
				"seeSmileys" => "Voir/Supprimer les smileys",
				"addPrefix" => "Ajouter des prefixes de discussion",
				"seePrefix" => "Voir/supprimer les prefixes de discussion"
			)
		),
		"widgets" => array(
			"page" => "Widgets",
			"showPage" => "Accès à la page <strong>Widgets</strong>",
			"actions" => array(
				"addWidgets" => "Ajouter un Widget",
				"editWidgets" => "Edition des Widgets"
			)
		),
		"support" => array(
			"tickets" => array(
				"page" => "tickets",
				"showPage" => "Accès à la page <strong>Tickets</strong>",
				"actions" => array(
					"editEtatTicket" => "Changer l'état des tickets",
					"deleteTicket" => "Supprimer un ticket",
					"deleteAllTicket" => "Supprimer tout les tickets"
				)
			)
		),
		"maintenance" => array(
			"page" => "Maintenance",
			"showPage" => "Accès à la page <strong>Maintenance</strong>",
			"actions" => array(
				"editDefaultMessage" => "Edition du message par défaut",
				"editAdminMessage" => "Edition du message adressé aux admins",
				"editEtatMaintenance" => "Changer l'état de la maintenance",
				"switchRedirectMode" => "Changer le mode de redirection",
				"connexionAdmin" => "Peut se connecter pendant une maintenance"
			)
		),
		"update" => array(
			"page" => "Mise à jours",
			"showPage" => "Accès à la page <strong>Mise à jours</strong>"
		),
		"social" => array(
			"page" => "Réseaux",
			"showPage" => "Accès à la page <strong>Membres=>Social</strong>"
		),
		"newsletter" => array(
			"page" => "Newsletter",
			"showPage" => "Accès à la page <strong>Newsletter</strong>",
			"actions" => array(
				"send" => "Peut envoyer une newsletter"
			)
		),
		"ban" => array(
			"page" => "Bannissement",
			"showPage" => "Accès à la page <strong>Bannissement</strong>",
			"actions" => array(
				"removeBan" => "Permet de supprimer un utilisateur banni",
				"addBan" => "Permet d'ajouter un utilisateur à la banlist",
				"editBanPage" => "Permet l'édition de la page des bannis"
			)
		),
		"upload" => array(
			"page" => "Upload",
			"showPage" => "Accès à la page <strong>Upload</strong>",
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