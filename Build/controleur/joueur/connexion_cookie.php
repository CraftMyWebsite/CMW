<?php 
$id = htmlspecialchars($_COOKIE['id']);
$pass = $_COOKIE['pass'];
$bdd = $base->getConnection();
$requete = $bdd->prepare('SELECT * FROM cmw_users WHERE id = :id');
$requete->execute(array(
	'id' => $id
	));
$donnesJoueur = $requete->fetch(PDO::FETCH_ASSOC);
if($pass == $donnesJoueur['mdp'])
{
	require_once('controleur/joueur/joueurcon.class.php');
	$new_connexion = new JoueurCon($id, $donnesJoueur['pseudo'], $donnesJoueur['email'], $donnesJoueur['rang'], $donnesJoueur['tokens'], 1, $pass);
	$suite = true;
}
else
{
	$suite = false;
}
?>
