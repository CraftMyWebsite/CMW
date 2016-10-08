<?php
class Draw
{
	protected $numeroTopAcheteurs, $numeroDerniersAcheteurs;
	const TOP_ACHETEURS = 0, DERNIERS_ACHETEURS = 1;

	public function __construct(){
		$this->numeroTopAcheteurs = 0;
		$this->numeroDerniersAcheteurs = 0;
	}

	public function fetch($type, $cle, $tableau, $compter = false){
		if($compter)
			switch($type)
			{
				case self::TOP_ACHETEURS;
					$this->numeroTopAcheteurs += 1;
				break;
				case self::DERNIERS_ACHETEURS;
					$this->numeroDerniersAcheteurs += 1;
				break;
			}
		return $tableau[$this->getKey($type) - 1][$cle];
	}

	public function getKey($type){
		switch($type)
		{
			case self::TOP_ACHETEURS;
				return $this->numeroTopAcheteurs;
			break;
			case self::DERNIERS_ACHETEURS;
				return $this->numeroDerniersAcheteurs;
			break;
		}		
	}

	public function isNotEnd($type, $tableau){
		if($this->getKey($type) >= count($tableau))
			return false;
		return true;
	}

	public function getEvoAchats($data){
		for($i = 1; $i <= 12; $i++)
		{
			if(!isset($return))
				$return = $data[$i];
			else
				$return =  $data[$i] . ',' . $return;
		}
		return $return;
	}
	public function getDerniersMois($data){
		for($i = 1; $i <= 12; $i++)
		{
			if(!isset($return))
				$return = '"'. $data[$i] . '"';
			else
				$return =   '"'. $data[$i] .'",'. $return;
		}
		echo $return;		
	}
}
?>