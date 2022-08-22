<?php

class Ban
{

	static function isBanned($bdd)
	{
		global $_Joueur_;
		$ip = self::get_client_ip_env();
		if(isset($_Joueur_))
		{
			$reqVerif = $bdd->prepare('SELECT * FROM cmw_ban WHERE ip = :ip OR pseudo LIKE :pseudo');
			$reqVerif->execute(array(
				'ip' => $ip,
				'pseudo' => "%".$_Joueur_['pseudo']."%"
			));
		}
		else
		{
			$reqVerif = $bdd->prepare('SELECT * FROM cmw_ban WHERE ip = :ip');
			$reqVerif->execute(array(
				'ip' => $ip
			));
		}
		$fetch = $reqVerif->fetch(PDO::FETCH_ASSOC);
		if(isset($fetch['id']))
		{
			self::updateBan($fetch, $ip, $_Joueur_['pseudo'], $bdd);
			return true;
		}
		else
		{
			return false;
		}
	}

	private function updateBan($fetch, $ip, $pseudo, $bdd)
	{
		if($pseudo != null)
		{
			if(strpos($fetch['pseudo'], $pseudo) === false)
			{
				$newfetch = $fetch['pseudo'].' '.$pseudo;
				$req = $bdd->prepare('UPDATE cmw_ban SET pseudo = :pseudo WHERE id = :id');
				$req->execute(array(
					'pseudo' => $newfetch,
					'id' => $fetch['id']
				));
			}
		}
		if($ip != $fetch['ip'])
		{
			if(empty($fetch['ip']))
			{
				$req = $bdd->prepare('UPDATE cmw_ban SET ip = :ip WHERE id = :id');
				$req->execute(array(
					'ip' => $ip,
					'id' => $fetch['id']
				));
			}
			else
			{
				$req = $bdd->prepare('INSERT INTO cmw_ban (ip, pseudo) VALUES (:ip, :pseudo)');
				$req->execute(array(
					'ip' => $ip,
					'pseudo' => $pseudo
				));
			}
		}
	}

	private static function get_client_ip_env() {
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
			$ipaddress = '0.0.0.0';
		}
		return $ipaddress;
	}
}
?>