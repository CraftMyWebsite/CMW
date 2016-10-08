<?php
// On récupère l'api de spyc qui permet d'ouvrir et d'éditer un fichier YML.
require_once('ymlapi.class.php');

class Ecrire
{
	private $ymlFormat;

	// Le constructeur récupère l'array de données, le met sous forme YML et l'enregistre dans le fichier choisi en argument de l'instanciation.
    public function __construct($fichierLocalisation, $array)
    {	
		// Fonction de l'api permetant de mettre un tableau sous YML.
		$ymlFormat = Spyc::YAMLDump($array,4,60);
		
		// On ouvre le fichier. Ensuite on replace le curseur au début, ce qui aura pour effet d'effacer le contenu du fichier avant de re-écrire.
		$fichier = fopen($fichierLocalisation, 'a+');
		ftruncate($fichier,0);
		
		// On insère dans le fichier l'array réorganisé en YAML.
		fputs($fichier, 'Ce fichier contiens la config de base du serveur' . $ymlFormat);
		
		// On met à jours la variable référante à l'objet pour les getters.
		$this->ymlFormat = $ymlFormat;
	}
	
	// Renvoie les données sous un format "yml".
	public function GetYmlFormat()
	{
		return $ymlFormat;
	}
}
class Lire
{
	private $tableau;

	// Le constructeur récupère la localisation du fichier indiquée en argumtent, et convertis le format YML en un tableau PhP pour être utilisable.
    public function __construct($fichierLocalisation)
    {	
		// Fonction de l'api permetant de mettre un fichier YML sous forme de tableau.
		$tableau = Spyc::YAMLLoad($fichierLocalisation);
		
		// On met à jours la variable référante à l'objet pour les getters.
		$this->tableau = $tableau;
	}
	
	// Renvoie le tableau privé de l'objet.
	public function GetTableau()
	{
		return $this->tableau;
	}
}