<?php 

class RecompenseAuto
{
	private $bdd;
	private $data;

	public function __construct($bdd)
	{
		$this->bdd = $bdd;
		$this->getRecompensesAuto();
	}

	public function getRecompensesAuto()
	{
		$req = $this->bdd->query('SELECT * FROM cmw_votes_recompense_auto_config');
		$data = $req->fetchAll(PDO::FETCH_ASSOC);
		$this->data = $data;
		return $data;
	}

	public function getTopRecompenses() {
		$retour = array();

		foreach($this->data as $data)
		{
			if($data['type'] == 2)
			{
				$retour[$data['valueType']] = $data['action'];
			}
		}
		return $retour;
	}

	public function verifRecVotes($nbVotes)
	{
		$retour = array();
		foreach($this->data as $data)
		{
			if($data['type'] == 1 && $data['valueType'] == $nbVotes)
			{
				array_push($retour, $data['action']);
			}
		}
		return $retour;
	}

	public function getDate() {
		$retour = array();
		foreach($this->data as $data)
		{
			if($data['type'] == 3)
			{
				if($data['valueType'] != 0) {
					$json = json_decode($data['action'], true); 
					if($data['valueType'] == 1) {
						$data['jour'] = intval($json['jour']);
					} else if ($data['valueType'] == 2) {
						$data['mois'] = intval($json['mois']);
					}
					$data['heur'] = intval($json['heur']);
					$data['min'] = intval($json['min']);
					$data['etat'] = intval($json['etat']);
				}
				return $data;
			}
		}
		return null;
	}

	public static function configureNextDate($data, $type) {
		if($type != 0) {
			$next = 0;
			if($type == 1) {
					$day[0] = "sunday";
					$day[1] = "monday";
					$day[2] = "tuesday";
					$day[3] = "wednesday";
					$day[4] = "thursday";
					$day[5] = "friday";
					$day[6] = "saturday";
				$next = strtotime("next ".$day[$data['jour']]) + $data['heur'] * 3600 + $data['min'] * 60 - 12 * 3600;
			} else if($type == 2) {
				$month = $data['mois'];
				if($month > cal_days_in_month(CAL_GREGORIAN,intval(date("j")),intval(date("Y")))) {
					$month = cal_days_in_month(CAL_GREGORIAN,intval(date("j")),intval(date("Y")));
				}
				$next = strtotime($month." ".date("F", strtotime("next month")));
				$next += $data['heur'] * 3600 + $data['min'] * 60 - 12 * 3600;
			}
			return $next;
		}
	}

	public function saveNextDate($data, $bdd) {
		if($data['valueType'] != 0) {
			if($data['valueType'] == 1) {
				$json['jour'] = intval($data['jour']);
			} else if ($data['valueType'] == 2) {
				$json['mois'] = intval($data['mois']);
			}
			$json['heur'] = intval($data['heur']);
			$json['min'] = intval($data['min']);
			$json['etat'] = intval(self::configureNextDate($json, $data['valueType']));
			
			$action = json_encode($json);
			$req = $bdd->prepare('UPDATE cmw_votes_recompense_auto_config SET `action`=:action WHERE type=3 ');
			$req->execute(array(
				'action' => $action
			));
		}
	}
}
?>