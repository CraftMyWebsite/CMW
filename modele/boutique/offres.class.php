<?php
class OffresList
{
	private $offres, $offresByGet;
    private $jsonCon;
	private $bddConnection;
	
    public function __construct($bddConnection, $jsonCon = null)
    {	
		$recupOffres = $bddConnection->query('SELECT * FROM cmw_boutique_offres ORDER BY ordre');
		
		$i = 1;
		while($tableauOffres = $recupOffres->fetch())
		{
			$offresByGet[$tableauOffres['id']] = array(
				'id' => $tableauOffres['id'],
				'nom' => $tableauOffres['nom'],
				'description' => $tableauOffres['description'],
				'prix' => $tableauOffres['prix'],
				'categorie' => $tableauOffres['categorie_id'] );
			$offres[$i] = array(
				'id' => $tableauOffres['id'],
				'nom' => $tableauOffres['nom'],
				'description' => $tableauOffres['description'],
				'prix' => $tableauOffres['prix'],
				'categorie' => $tableauOffres['categorie_id'] );
			$i++;
		}
		if(isset($offres))
        {
            $this->offresByGet = $offresByGet;
			$this->offres = $offres;
        }	    

        $this->jsonCon = $jsonCon;
		$this->bddConnection = $bddConnection;
	}		
	public function GetTableauOffres()
	{
		return $this->offres;
	}	
	public function GetOffresGet()
	{
		return $this->offresByGet;
	}
	
	public function GetInfosOffre($id)
	{
		$recupActions = $this->bddConnection->prepare('SELECT * FROM cmw_boutique_action WHERE id_offre = :id');
		$recupActions->execute(Array ('id' => $id));
		
		$i = 0;
		while($infosActions = $recupActions->fetch())
		{
			$infos['action'][$i]['methode'] = $infosActions['methode'];
			$infos['action'][$i]['commande_valeur'] = $infosActions['commande_valeur'];
			$infos['action'][$i]['prix'] = $infosActions['prix'];
			$infos['action'][$i]['duree'] = $infosActions['duree'];

			if($infos['action'][$i]['methode'] == 0)
			{
				$infos['action'][$i]['methode'] =  'Commande: ';
				$infos['action'][$i]['commande_valeur'] =  '/'. $infos['action'][$i]['commande_valeur'];
			}
			elseif($infos['action'][$i]['methode'] == 1)
			{
				$infos['action'][$i]['methode'] =  'Message Chat: ';
				$infos['action'][$i]['commande_valeur'] =  $infos['action'][$i]['commande_valeur'];
			}
			elseif($infos['action'][$i]['methode'] == 2)
			{
				if($infos['action'][$i]['duree'] == 0)
					$infos['action'][$i]['duree'] = 'à vie.';
				else
					$infos['action'][$i]['duree'] = $infos['action'][$i]['duree'] . ' Mois';
				$infos['action'][$i]['methode'] =  'Grade: ';
				$infos['action'][$i]['commande_valeur'] =  $infos['action'][$i]['commande_valeur'] . ' ' . $infos['action'][$i]['duree'];
			}
			elseif($infos['action'][$i]['methode'] == 3)
			{
				$explodeAction = explode(' ', $infos['action'][$i]['commande_valeur']);
				$infos['action'][$i]['commande_valeur'] = null;
				for($k = 0; $k < count($explodeAction); $k++)
				{
					if($infos['action'][$i]['commande_valeur'] == null)
						$infos['action'][$i]['commande_valeur'] = $explodeAction[$k];
					elseif($k < 2)
						$infos['action'][$i]['commande_valeur'] = $infos['action'][$i]['commande_valeur'] .'x'. $explodeAction[$k];
					else
					{
						if($k == 2)
							$infos['action'][$i]['commande_valeur'] = $infos['action'][$i]['commande_valeur'] .'<blockquote><span class="offreLittle">';
						$explodeAction[$k] = explode(':', $explodeAction[$k]);
						$explodeAction[$k] = 'Enchantement: '. $explodeAction[$k][0] .' <> Niveau: '. $explodeAction[$k][1];
						$infos['action'][$i]['commande_valeur'] = $infos['action'][$i]['commande_valeur'] .' '. $explodeAction[$k] .'<br />';
						if($k == count($explodeAction)-1)
							$infos['action'][$i]['commande_valeur'] = $infos['action'][$i]['commande_valeur'] .'</span></blockquote>';
					}
				}

				$infos['action'][$i]['methode'] =  'Give item: ';
				$infos['action'][$i]['commande_valeur'] =  $infos['action'][$i]['commande_valeur'];
			}	
		    elseif($infos['action'][$i]['methode'] == 4)
		    {
			    $infos['action'][$i]['methode'] =  'Give d\'argent: ';
			    $infos['action'][$i]['commande_valeur'] =  $infos['action'][$i]['commande_valeur'] . $this->getMonnaie();
		    }
			
			$i++;
		}
		
		$recupOffres = $this->bddConnection->prepare('SELECT * FROM cmw_boutique_offres WHERE id = :id');
		$recupOffres->execute(Array ('id' => $id));
		
		$i = 0;
		$infosOffres = $recupOffres->fetch();
		
			$infos['offre']['nom'] = $infosOffres['nom'];
			$infos['offre']['description'] = $infosOffres['description'];
			$infos['offre']['prix'] = $infosOffres['prix'];
			$infos['offre']['categorie'] = $infosOffres['categorie_id'];

	
		return $infos;
	}

    public function getMonnaie() 
    {
        if($this->jsonCon != null)
        {
            for($i = 0; $i < count($this->jsonCon); $i++)
            {
                $return = $this->jsonCon[$i]->getMonnaie();            
                if($return[0]['result'] == 'success' AND !empty($return[0]['success']))
                    return ' '.$return[0]['success']; 
            }
        }
        return 'PO';
    }
}
?>
