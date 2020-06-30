<?php
// classe permettant de récupérer / envoyer des données à la base.
class base
{
	private $bdd;
	// Le constructeur se connecte à la base, il est appellé à chaque chargement de page.
    public function __construct($_Serveur_)
    {	
		try
		{
			$bdd = new PDO('mysql:host=' .$_Serveur_['dbAdress'] .';dbname=' .$_Serveur_['dbName'].';port=' .$_Serveur_['dbPort'], $_Serveur_['dbUser'], $_Serveur_['dbPassword']);
			
			// Cette requette SQL permet d'encoder correctement tout ce qui rentre / sort de la base.
			$bdd->exec("SET CHARACTER SET utf8");
			$this->bdd = $bdd;
		}
		catch (Exception $e)
		{
				die("Erreur BDD, revoyez votre fichier de config: " . $e->getMessage() . "</br> Ou alors vous n'avez pas installé le CMS ? Cliquez ici : <a href='installation/'>INSTALLATION</a>");
		}
	}
	
	// Ce mutateur enregistre un nouvel utilisateur dans la base de données, fonction appellée à chaque utilisateur s'enregistrant.
	public function getConnection()
	{
		return $this->bdd;
	}
}
?>