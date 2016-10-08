<?php
class AccueilData
{
	private $bdd;
	
	public function __construct($bdd)
	{	
		$this->bdd = $bdd;
	}
	
	public function GetNews()
	{
		$news = $this->bdd->query('SELECT * FROM cmw_news ORDER BY date DESC');
		return $news;
	}

    #----Début intégration----#

	public function CheckVisit($getIp, $getDates)
	{
		$checkVisit = $this->bdd->prepare('SELECT * FROM cmw_visits WHERE ip LIKE :ip AND dates LIKE :dates');
		$checkVisit->bindParam(':ip', $getIp);
		$checkVisit->bindParam(':dates', $getDates);
		$checkVisit->execute();
		return $checkVisit;
	}

	public function GetTotalVisits()
	{
		$getTotalVisits = $this->bdd->prepare('SELECT MAX(id) AS id FROM cmw_visits');
		$getTotalVisits->execute();
		return $getTotalVisits;
	}

	public function AddVisit($totalVisits, $getIp, $getDates)
	{
		$addVisit = $this->bdd->prepare('INSERT INTO cmw_visits (id, ip, dates) VALUES (:id, :ip, :dates)');
		$addVisit->bindParam(':id', $totalVisits);
		$addVisit->bindParam(':ip', $getIp);
		$addVisit->bindParam(':dates', $getDates);
		$addVisit->execute();
	}

	public function DelOldVisits($getOldDates)
	{
		$delVisits = $this->bdd->prepare('DELETE FROM cmw_visits WHERE dates <= :dates');
		$delVisits->bindParam(':dates', $getOldDates);
		$delVisits->execute();
	}

	#----Fin intégration----#
	
}
?>