<?php if(isset($_GET["ActivateSuccess"]) && urldecode($_GET['ActivateSuccess'])){ ?>
	<script>
		window.onload=function(){
			Snarl.addNotification({
				title: 'Succès',
				text: 'Votre compte vient d\'être activé avec succès.',
				icon: '<i class="fa fa-check-circle" aria-hidden="true"></i>'
			});
		}
	</script>
<?php } elseif(isset($_GET["WaitActivate"]) && urldecode($_GET['WaitActivate'])) { ?>
	<script>
		window.onload=function(){
			Snarl.addNotification({
				title: 'Info',
				text: 'Un mail vient de vous être envoyé pour l\'activation de votre compte. Vérifiez dans les Courriers indésirables.',
			    icon: '<i class="fa fa-info-circle" aria-hidden="true"></i>'
			});
		}
	</script>
<?php } elseif(isset($_GET["ActivateImpossible"]) && urldecode($_GET['ActivateImpossible'])) { ?>
	<script>
		window.onload=function(){
			Snarl.addNotification({
				title: 'Erreur',
				text: 'Votre compte ne peut être activé.',
				icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
			});
		}
	</script>
<?php } elseif(isset($_GET["MessageEnvoyer"]) && urldecode($_GET['MessageEnvoyer'])) { ?>
	<script>
		window.onload=function(){
			Snarl.addNotification({
				title: 'Succès',
				text: 'Votre commentaire vient d\'être envoyé.',
				icon: '<i class="fa fa-comment" aria-hidden="true"></i>'
			});
		}
	</script>
<?php } elseif(isset($_GET["MessageTropLong"]) && urldecode($_GET['MessageTropLong'])) { ?>
	<script>
		window.onload=function(){
			Snarl.addNotification({
				title: 'Erreur',
				text: 'Votre commentaire est trop long.',
				icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
			});
		}
	</script>
<?php } elseif(isset($_GET["MessageTropCourt"]) && urldecode($_GET['MessageTropCourt'])) { ?>
	<script>
		window.onload=function(){
			Snarl.addNotification({
				title: 'Erreur',
				text: 'Votre commentaire est trop court.',
				icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
			});
		}
	</script>
<?php } elseif(isset($_GET["NotOnline"]) && urldecode($_GET['NotOnline'])) { ?>
	<script>
		window.onload=function(){
			    Snarl.addNotification({
			    title: 'Erreur',
			    text: 'Vous n\'êtes pas connecté.',
			    icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
			});
		}
    </script> 
<?php } elseif(isset($_GET["NewsNotExist"]) && urldecode($_GET['NewsNotExist'])) { ?>
	<script>
		window.onload=function(){
			Snarl.addNotification({
			    title: 'Erreur',
			    text: 'Cette nouveauté n\'existe pas.',
			    icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
		    });
	    }
    </script>
<?php } elseif(isset($_GET["TicketNotExist"]) && urldecode($_GET['TicketNotExist'])) { ?>
	<script>
		window.onload=function(){
			Snarl.addNotification({
			    title: 'Erreur',
			    text: 'Ce ticket n\'existe pas.',
			    icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
		    });
	    }
    </script>
<?php } elseif(isset($_GET["CommentaireNotExist"]) && urldecode($_GET['CommentaireNotExist'])) { ?>
	<script>
		window.onload=function(){
			Snarl.addNotification({
			    title: 'Erreur',
			    text: 'Ce commentaire n\'existe pas.',
			    icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
		    });
	    }
    </script> 
<?php } elseif(isset($_GET["LikeExist"]) && urldecode($_GET['LikeExist'])) { ?>
    <script>
		window.onload=function(){
			Snarl.addNotification({
				title: 'Erreur',
				text: 'Votre mention j\'aime est déjà existante.',
				icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
			});
		}
	</script> 
<?php } elseif(isset($_GET["LikeAdd"]) && urldecode($_GET['LikeAdd'])) { ?>
	<script>
		window.onload=function(){
			Snarl.addNotification({
				title: 'Succès',
				text: 'Votre mention j\'aime vient d\'être envoyée.',
				icon: '<i class="fa fa-check-circle" aria-hidden="true"></i>'
			});
		}
	</script>
<?php } elseif(isset($_GET["SuppressionCommentaire"]) && urldecode($_GET['SuppressionCommentaire'])) { ?>
	<script>
		window.onload=function(){
			Snarl.addNotification({
				title: 'Succès',
				text: 'Votre commentaire vient d\'être supprimé.',
				icon: '<i class="fa fa-check-circle" aria-hidden="true"></i>'
			});
		};
	</script>
<?php } elseif(isset($_GET["SuppressionImpossible"]) && urldecode($_GET['SuppressionImpossible'])) { ?>
	<script>
		window.onload=function(){
			Snarl.addNotification({
				title: 'Erreur',
				text: 'Le commentaire ne peut être supprimé.',
				icon: '<i class="fa fa-times-circle" aria-hidden="true"></i>'
			});
		}
	</script>
<?php } ?>