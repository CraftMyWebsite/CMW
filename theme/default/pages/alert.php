<?php if(isset($_Joueur_))
{ ?><!--Vérif si le joueur est co -->
<div class="row">
	<div class="col-md-offset-2 col-md-6">
		<center>
			<h4>Vos alertes ... </h4>
		</center>
	</div>
</div>
<!-- Titre page-->


<table class="table stripped"><!--Tableau avec la liste des alertes
Perso il faudrait que l'on puisse avoir le href ( qui actuellement est dans l'auteur de l'alerte ) sur toutes les 
colonne mais genre du stye que lorsqu'on clic sur le fond on puisse y aller, en gros même si
on clique sur autre chose que du texte ça nous redirige au bon endroit  -->
	<caption>Tableau récapitulatif de vos alertes ... </caption>
	<tr>
		<th>Topic suivie</th>
		<th>Type d'alerte</th>
		<th>Auteur de l'alerte</th>
	</tr>
<?php 
/*J'ai décomposer les alertes en 2 parties :
	- Les alertes signalant lorsque quelqu'un aime/aime pas une de vos réponses 
	- Les alertes signalant de nouvelles réponses sur un topic suivie 
	
Ici c'est les alertes pour aime/aime pas
	*/
$req_answer = $_JoueurForum_->get_like_dislike();

//Récupération des données de la table avec jointure entre table 
while($answer_liked = $req_answer->fetch())
{
	if($answer_liked['vu'] == '0')
	{
		//Si l'alerte n'a pas été vu on l'affiche 
		
		/*Là on récupère des données pour trouver où rediriger ( c'est à dire :
			- Ligne de la réponse aimé 
			- Page sur laquelle elle a été posté 
		*/
		$a = $bddConnection->prepare('SELECT * FROM cmw_forum_answer WHERE id_topic = :id');
		$a->execute(array(
			'id' => $answer_liked['id_topic']
		));
		$da = $a->fetchAll();
		//Ci-dessus on a récupéré toutes les réponses du topic 
		foreach($da as $key => $value)
		{
			if($da[$key]['id'] == $answer_liked['id_answer'])
			{
				$ligne = $key;
			}
			//Pour chaque entrée on regarde si c'est la réponse de notre réponse aimé
			//Si c'est le cas alors on récupère la ligne.
		}
		$ligne++;
		//On augmente la ligne d'un car les array commence à 0 or aucune réponse ne vaut 0
		unset($page);
		unset($d);
		//On supprimer les variable $d et $page afin qu'il n'y est pas de soucis avec la suite
		$tour = 1;
		while($d == FALSE)
		{
			$nb = 20 * $tour;
			if($ligne <= $nb)
			{
				$page = $tour;
				$d = TRUE;
			}
			else
			{
				$tour++;
			}
			//On regarde si la ligne est comprise sur une page et on récupère le num de cette page 
		}
		
		?><tr>
			<td><?php $topic = $bddConnection->prepare('SELECT * FROM cmw_forum_post WHERE id = :id'); 
			$topic->execute(array(
				'id' => $answer_liked['id_topic']
			));
			$topicd = $topic->fetch();
			echo $topicd['nom'];
			//On affiche le nom du topic où l'alerte à été créer
			?></td>
			
			
			<td><?php if($answer_liked['Appreciation'] == 1)
			{
				?>Quelqu'un a aimé votre réponse <?php
			}
			else
			{
				?>Quelqu'un n'a pas aimé votre réponse<?php 
			}
			//On affiche si c'est une alerte de type : J'aime ou de type J'aime pas 
			?></td>
			
			
			<td><a href="index.php?action=alerts_vu&page=post&id=<?php echo $answer_liked['id_topic']; ?>&page_post=<?php echo $page; ?>&id_answer=<?php echo $answer_liked['id_answer']; ?>&likeur=<?php echo $answer_liked['pseudo_likeur']; ?>#<?php echo $answer_liked['id_answer']; ?>"> <?php echo $answer_liked['pseudo_likeur']; ?></a></td>
			<!-- On Affiche le nom de l'auteur de l'alerte + le lien vers la réponse aimé/pas aimé -->
		</tr><?php 
	}
}
// On change est on passe aux alertes de type : nouvelles réponses 


$req_topic = $_JoueurForum_->get_new_answer();
while($donnees_new = $req_topic->fetch())
{
	if($donnees_new['pseudo'] != $donnees_new['last_answer_pseudo'] AND $donnees_new['last_answer_pseudo'] != NULL AND $donnees_new['vu'] == 0)
	{
		/* Après récupération des infos on regarde si la dernière réponse n'est pas la notre
		et qu'elle ne vient pas d'un pseudo inconnu ( c'est a dire si cette réponse existe ! )
		et enfin si elle n'a pas déjà été vu ! */
		$b = $bddConnection->prepare('SELECT * FROM cmw_forum_answer WHERE id_topic = :id');
		$b->execute(array(
			'id' => $donnees_new['id_topic']
		));
		$bd = $b->fetchAll();
		//On recommence le processus pour éterminer Ligne + Page de la réponse 
		foreach($bd as $key => $value)
		{
			if($bd[$key]['id'] == $donnees_new['last_answer_int'])
			{
				$reponse = $key + 1;
				$ligne = $key + 1;
			}
		}
		$ligne++;
		unset($page);
		unset($d);
		$tour = 1;
		while($d != TRUE)
		{
			$nb = 20 * $tour;
			if($ligne <= $nb)
			{
				$page = $tour;
				$d = TRUE;
			}
			else
			{
				$tour++;
			}
		}
		?><tr>
			<td><?php
			//On affiche le nom du topic 
			echo $donnees_new['nom']; ?></td>
			<td><!-- Type d'alerte -->Une nouvelle réponse est apparue ! </td>
			<td><!-- Lien + auteur de l'alerte --><a href="index.php?action=alerts_rep&page=post&id=<?php echo $donnees_new['id_topic']; ?>&page_post=<?php echo $page; ?>&answer=<?php echo $bd[$reponse]['id']; ?>">Réponse de <?php echo $donnees_new['last_answer_pseudo']; ?></a></td>
		</tr>
		<?php
	}
}
?>
</table><?php

}
