<?php
class OffresList
{
	private $offres, $offresByGet;
    private $jsonCon;
	private $bddConnection;
	
    public function __construct($bddConnection, $jsonCon = null, $_Joueur_ = null)
    {	

		$this->jsonCon = $jsonCon;
		$this->bddConnection = $bddConnection;

		$recupOffres = $bddConnection->query('SELECT * FROM cmw_boutique_offres ORDER BY ordre');
		if(isset($_Joueur_)) {

			$req = $this->bddConnection->prepare('SELECT achats FROM cmw_users WHERE id = :id');
			$req->execute(Array ('id' => $_Joueur_['id']));
			$data = $req->fetch(PDO::FETCH_ASSOC);
			if(isset($data['achats'])) {
				$info = json_decode($data['achats'], true); 
			}
		}
		$i = 1;
		while($tableauOffres = $recupOffres->fetch(PDO::FETCH_ASSOC))
		{
			$offresByGet[$tableauOffres['id']] = $tableauOffres['nom'];

			$offres[$i] = array(
				'id' => $tableauOffres['id'],
				'nom' => $tableauOffres['nom'],
				'description' => $tableauOffres['description'],
				'nbre_vente' => $tableauOffres['nbre_vente'],
				'prix' => $tableauOffres['prix'],
				'categorie' => $tableauOffres['categorie_id'],
				'max_vente' => $tableauOffres['max_vente'],
				'ordre' => $tableauOffres['ordre'],
				'evo' => isset($tableauOffres['evo']) && empty($tableauOffres['evo']) ? null : $tableauOffres['evo'] );
			if(isset($_SESSION['panier']['id']) && !empty($_SESSION['panier']['id'])) {
			    $info = array();
			    foreach($_SESSION['panier']['id'] as $key => $value) {
			        if($offres[$i]['nbre_vente'] > 0 && $_SESSION['panier']['id'][$key] == $offres[$i]['id']) {
			            $offres[$i]['nbre_vente'] -= $_SESSION['panier']['quantite'][$key];
			        }
			        if(isset($info) & !empty($info)) {
			            foreach($info as $i3 => $v) {
			                if($info[$i3]['id2'] == $_SESSION['panier']['id'][$key]) {
			                    $info[$i3]['nombre'] += intval($_SESSION['panier']['quantite'][$key]);
			                }
			            }
			        } else {
			            array_push($info, array("id2" => $_SESSION['panier']['id'][$key], "nombre" => $_SESSION['panier']['quantite'][$key]));
			        }
			    }
			}
			if(isset($info) & !empty($info)) {
				$temp = array();
				if(isset($tableauOffres['evo']) && !empty($tableauOffres['evo']) && $tableauOffres['evo'] != "" ) {
					foreach(explode(",",$tableauOffres['evo']) as $value)
					{
						$temp[$value] = false;
					} 
				}
       			foreach($info as $key => $value) { 
       				$temp[intval($value['id2'])] = true;
       				if(intval($value['id2']) == $tableauOffres['id']) {
       					if($tableauOffres['max_vente'] != -1 && intval($value['nombre']) >= $tableauOffres['max_vente']) {
       						$offres[$i]['maxbuy'] = true;
       						break;
       					}
       				}
       			}
       			if(isset($tableauOffres['evo']) && !empty($tableauOffres['evo']) && $tableauOffres['evo'] != "" ) {
	       			foreach($temp as $key => $value)
					{
						if(!$value) {
							if(!isset($offres[$i]['buy'])) {
								$offres[$i]['buy'] = array($key);
							} else {
								array_push($offres[$i]['buy'], $key);
							}
						}
					}
				}

			} else if(isset($tableauOffres['evo']) && !empty($tableauOffres['evo']) && $tableauOffres['evo'] != "" ) {
				$offres[$i]['buy'] = explode(",",$tableauOffres['evo']);
			}

			$i++;
		}
		if(isset($offres))
        {
			$this->offres = $offres;
			$this->offresByGet = $offresByGet;
        }	    
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
		while($infosActions = $recupActions->fetch(PDO::FETCH_ASSOC))
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
		$infosOffres = $recupOffres->fetch(PDO::FETCH_ASSOC);
		
			$infos['offre']['nom'] = $infosOffres['nom'];
			$infos['offre']['description'] = $infosOffres['description'];
			$infos['offre']['nbre_vente'] = $infosOffres['nbre_vente'];
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
