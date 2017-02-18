<?php
class alloConvInfos
{
	private $bdd;
	
	public function __construct($bdd)
	{	
		$this->bdd = $bdd;
	}

    public function insertInfos($pseudo, $code, $numero_surtaxe, $prix_total)
    {	
		$insert_Infos = $this->bdd->prepare('INSERT INTO cmw_alloconv (pseudo, code, numero_surtaxe, prix_total, date_achat) VALUES (:pseudo, :code, :numero_surtaxe, :prix_total, NOW())');
		$insert_Infos->execute(array(
			':pseudo' => $pseudo, 
			':code' => $code, 
			':numero_surtaxe' => $numero_surtaxe, 
			':prix_total' => $prix_total));
		return $insert_Infos;
	}
}
?>