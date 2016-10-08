<?php
class CategoriesList
{
	private $categories;
	private $bddConnection;
	
    public function __construct($bddConnection)
    {	
		$recupCategories = $bddConnection->query('SELECT * FROM cmw_boutique_categories');
		
		$i = 0;
		while($tableauCategories = $recupCategories->fetch())
		{
			$categories[$i] = array(
				'id' => $tableauCategories['id'],
				'titre' => $tableauCategories['titre'],
				'message' => $tableauCategories['message'],
				'serveur' => $tableauCategories['serveur'] );
			$i++;
		}
		if(isset($categories))
			$this->categories = $categories;
			
		$this->bddConnection = $bddConnection;
	}		
	public function GetTableauCategories()
	{
		return $this->categories;
	}
	
	public function GetInfosCategorie($id, $lecture)
	{
		$recupCategories = $this->bddConnection->prepare('SELECT * FROM cmw_boutique_categories WHERE id = :id');
		$recupCategories->execute(Array ('id' => $id));
		
		$i = 0;
		while($infosCategories = $recupCategories->fetch())
		{
			$categories['serveur'] = $infosCategories['serveur'];
			$categories['connection'] = $infosCategories['connection'];
			
			$categories['serveurId'] = $categories['serveur'];
			
			if($categories['connection'] == 0)
				$categories['connection'] = false;
			if($categories['connection'] == 1)
				$categories['connection'] = true;
			
			if($categories['serveur'] == -1)
				$categories['serveur'] = 'tous les serveurs';
			elseif($categories['serveur'] == -2)
				$categories['serveur'] = 'le serveur sur lequel vous êtes en ligne';
			else
				$categories['serveur'] = 'le serveur "' .$lecture[$categories['serveur']]['nom']. '"';
		}
		return $categories;
	}
}
?>