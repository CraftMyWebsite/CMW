<?php
class Chat extends JsonCon
{
	private $json;
	private $connecte;

	public function __construct($json)
	{
		$this->json = $json;
		for($i =0; $i < count($json); $i++)
		{
			$this->conEtablie($i);
		}
	}

	public function getMessages($i)
	{
		if($i < count($this->json) && $this->connecte[$i] == true)
		{
			$messages = $this->json[$i]->GetChat(array('20'));
			return $messages[0]['success'];
		}
		else
			return false;
	}

	private function conEtablie($i)
	{
		$this->api = $this->json[$i]->api;
		$connexion = $this->json[$i]->GetConnection();
		if(!isset($connexion[0]['result']) OR $connexion[0]['result'] == 'error')
			$this->connecte[$i] = false;
		else
			$this->connecte[$i] = true;
	}

	public function sendMessageChat($message, $i, $pseudo)
	{
		$data = $this->json[$i]->sendChat('[§cSite§r] §5'.$pseudo.'§r : '.$message);
		return $data[0]['success'];
	}

	public function formattage($message)
	{
		$count = substr_count($message, '§');
		if($count == 1)
		{
			return str_replace('§0', '', str_replace('§1', '<span style="color: #0000AA>', str_replace('§2', '<span style="color: #00AA00">', str_replace('§3', '<span style="color: #00AAAA>', str_replace('§4', '<span style="color: #AA0000>', str_replace('§5', '<span style="color: #AA00AA>', str_replace('§6', '<span style="color: #FFAA00">', str_replace('§7', '<span style="color: #AAAAAA">', str_replace('§8', '<span style="color: #555555>', str_replace('§9', '<span style="color: #5555FF">', str_replace('§a', '<span style="color: #55FF55;">', str_replace('§b', '<span style="color: #55FFFF">', str_replace('§c', '<span style="color: #FF5555>', str_replace('§d', '<span style="color: #FF55FF">', str_replace('§e', '<span style="color: #FFFF55">', str_replace('§f', '', $message)))))))))))))))).'</span>';
		}
		elseif($count > 1)
		{
			$aFermer = 0;
			for($i = 0; $i < $count; $i++)
			{
				if($aFermer != 0 && $i+1 != $count)
					$message = preg_replace('#§#is', '</span>§', $message, 1);
				$pos = strpos($message, '§');
				$car = substr($message, $pos+2, 1);
				$span = $this->getSpan($car);
				if($span === 0 && $i != 0)
				{
					$span = '</span>';
					$aFermer = 0;
				}
				elseif($span == 0 && $i == 0)
				{
					$span = '';
					$aFermer= 0;
				}
				else
					$aFermer=1;
				if($i+1 != $count)
					$fin = strpos($message, '§', $pos);
				$message = preg_replace('#§(.)#', $span, $message, 1);
				if($i+1 == $count)
					$message.='</span>';
			} 
			return $message;
		}
		else
			return $message;
	}

	private function getSpan($car)
	{
		switch($car)
		{
			case 1:
				return '<span style="color: #0000AA">';
			break;

			case 2:
				return '<span style="color: #00AA00">';
			break;

			case 3:
				return '<span style="color: #00AAAA">';
			break;

			case 4:
				return '<span style="color: #AA0000">';
			break;

			case 5:
				return '<span style="color: #AA00AA">';
			break;

			case 6:
				return '<span style="color: #FFAA00">';
			break;

			case 7:
				return '<span style="color: #AAAAAA">';
			break;

			case 8:
				return '<span style="color: #555555">';
			break;

			case 9:
				return '<span style="color: #5555FF">';
			break;

			case 'a':
				return '<span style="color: #55FF55">';
			break;

			case 'b':
				return '<span style="color: #55FFFF">';
			break;

			case 'c':
				return '<span style="color: #FF5555">';
			break;

			case 'd':
				return '<span style="color: #FF55FF">';
			break;

			case 'e':
				return '<span style="color: #FFFF55">';
			break;

			default:
				return 0;

		}
	}
}
?>
