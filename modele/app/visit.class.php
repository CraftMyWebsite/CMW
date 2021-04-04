<?php
class visit
{
	private $bdd;
	
	public function __construct($bdd)
	{	
		$this->bdd = $bdd;
		$this->removeOldVisit();

	    if(!$this->hasVisit($this->get_client_ip())) {
	        $this->addVisit($this->get_client_ip());
	    }
	}

	private function hasVisit($getIp)
	{
		$checkVisit = $this->bdd->prepare('SELECT * FROM cmw_visits WHERE ip=:ip AND UNIX_TIMESTAMP(dates) % 86400 < UNIX_TIMESTAMP(NOW()) % 86400');
		$checkVisit->execute(array('ip' => $getIp));
		$checkVisit = $checkVisit->fetchAll(PDO::FETCH_ASSOC);
		return !empty($checkVisit);
	}

	private function addVisit($getIp)
	{
		$addVisit = $this->bdd->prepare('INSERT INTO cmw_visits (ip, dates) VALUES (:ip, NOW())');
		$addVisit->execute(array('ip' => $getIp));
	}

	private function removeOldVisit()
	{
		$delVisits = $this->bdd->exec('DELETE FROM cmw_visits WHERE UNIX_TIMESTAMP(dates) <= UNIX_TIMESTAMP(NOW()) - (86400*31)');
	}

	private function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } else if(getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } else if(getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } else if(getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } else if(getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } else if(getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = 'UNKNOWN';
        }
        return $ipaddress;
    }

	
}
?>