<?php 

class RecompenseAuto
{
	private $bdd;
	private $pseudo;
	private $data;

	public function __construct($bdd, $joueur)
	{
		$this->bdd = $bdd;
		if(isset($joueur) && !empty($joueur))
		{
			$this->pseudo = $joueur['pseudo'];
		}
	}

	public function getRecompensesAuto()
	{
		$req = $this->bdd->query('SELECT * FROM cmw_votes_recompense_auto_config');
		$data = $req->fetchAll(PDO::FETCH_ASSOC);
		$this->data = $data;
		return $data;
	}

	public function verifDate()
	{
		$newArray = array();
		$retour = array();
		foreach($this->data as $data)
		{
			if($data['type'] == 2)
				array_push($newArray, $data);
		}
		$i = 0;
		foreach($newArray as $value)
		{
			$explode = explode(':', $value['valueType']);
			if($explode[0] <= time())
			{
				$retour[$i]['id'] = $value['id'];
				$retour[$i]['reinit'] = $explode[1];
				$retour[$i]['rang'] = $explode[2];
				$retour[$i]['message'] = $value['message'];
				$retour[$i]['commande'] = $value['commande'];
				$retour[$i]['serveur'] = $value['serveur'];
				$i++;
			}
		}
		return $retour;
	}

	public function verifRecVotes($nbVotes)
	{
		$newArray = array();
		$retour = array();
		foreach($this->data as $data)
		{
			if($data['type'] == 1)
				array_push($newArray, $data);
		}
		$keys = array_keys(array_column($newArray, 'valueType'), $nbVotes);
		if(isset($keys))
		{
			$i = 0;
			foreach($keys as $value)
			{
				$retour[$i]['message'] = $newArray[$value]['message'];
				$retour[$i]['commande'] = $newArray[$value]['commande'];
				$retour[$i]['serveur'] = $newArray[$value]['serveur'];
				$i++;
			}
		}
		return $retour;
	}
}
?>