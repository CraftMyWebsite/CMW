<?php
require('JSONAPI.php');
require('bootstrap.php');
require 'src/MinecraftQuery.php';
require 'src/MinecraftQueryException.php';
use xPaw\MinecraftQuery;
use xPaw\MinecraftQueryException;
use xPaw\SourceQuery\SourceQuery;
class JsonCon
{
	public $api;
	public $connected;
	private $pseudo;
	private $bdd;
	private $mode;
	private $id;
	
	public function __construct($adresse, $post, $utilisateur, $mdp, $bdd, $i)
	{
		if(isset($utilisateur))
		{
			$this->mode = 1;
			$this->connected = false;
			$this->api = array(
				'adresse' => $adresse, 
				'port' => $post, 
				'user' => $utilisateur, 
				'mdp' => $mdp
			);
		}
		else
		{
			try
			{
				$this->connected = false;
				$this->api['query'] = new MinecraftQuery();
				$this->api['data'] = array(
					'adresse' => $adresse,
					'portQ' => $post['query'],
					'portR' => $post['rcon'],
					'mdp' => $mdp
				);
				//$api['query']->Connect($adresse, $post['query']);
				$this->api['rcon'] = new SourceQuery();
				//$api['rcon']->Connect($adresse, $post['rcon'], 1, SourceQuery::SOURCE);
				//$api['rcon']->SetRconPassword($mdp);
				$this->mode = 2;
			}
			catch(Exception $e)
			{
				$api = null;
			}
		}
		$this->bdd = $bdd;
		$this->id = $i;
	}

	private function TryMode()
	{
		$mode = ($this->mode == 1);
		if(!$this->connected)
			$this->connect($mode);
		return $mode;
	}

	public function connect($mode)
	{
		if(!$this->connected)
		{
			if($mode)
			{
				$api = new JSONAPI($this->api['adresse'], $this->api['port'], $this->api['user'], $this->api['mdp']);
				$this->api = $api;
			}
			else
			{
				$this->api['query']->Connect($this->api['data']['adresse'], $this->api['data']['portQ']);
				$this->api['rcon']->Connect($this->api['data']['adresse'], $this->api['data']['portR'], 1, SourceQuery::SOURCE);
				$this->api['rcon']->SetRconPassword($this->api['data']['mdp']);
				unset($this->api['data']);
			}
			$this->connected = true;
		}
	}
	
	public function GetConnection()
	{
		$key = $this->verifyReq("server.version");
		unset($c);
		if($key !== false)
			$c =  $key;
		elseif($this->TryMode())
			$c = $this->api->call("server.version");
		elseif($this->api != null)
			$c = $this->api['query']->GetInfo();
		$this->updateReq("server.version", $c);
		if(!isset($c))
			return false;
		if(isset($c[0]['result']) && $c[0]['result'] == "success")
			return true;
		if(isset($c['HostName']) && !empty($c['HostName']))
			return true;
		return false;
	}
	
	public function SetPlayerName($pseudo)
	{
		$this->pseudo = $pseudo;
	}
	
	public function SendBroadcast($message)
	{
		$message = str_replace('{PLAYER}', $this->pseudo, $message);
		$message = str_replace('&', '§', $message);
		if($this->TryMode())
		{
			$this->api->call("chat.broadcast", array($message));
		}
		else
		{
			if($this->api != null)
				$this->api['rcon']->Rcon("say ".$message);
		}
	}
	
	public function GetChat($donnees)
	{
		if($this->TryMode())
			return $this->api->call("streams.chat.latest", $donnees);
		else
			return null;
	}

	public function getPlugins()
	{
		$key = $this->verifyReq("getPlugins");
		if($key !== false)
		{
			return $key;
		}
		if($this->TryMode())
		{
			$plugins['Test'] = $this->api->call("getPlugins");
			$plugins['Test'] = $plugins['Test'][0]["success"];
		}
		else
		{
			if($this->api != null)
			{
				$data = $this->api['query']->GetInfo();
				$plugins['Test'] = $data['Plugins'];
			}
		}
		$this->updateReq("getPlugins", $plugins);
		return $plugins;
	}

	public function GetConsole()
	{
		$key = $this->verifyReq("getLatestConsoleLogsWithLimit");
		if($key !== false)
			return $key;
		$msg = 12;
		if($this->TryMode())
		{
			$console['Test'] = $this->api->call("getLatestConsoleLogsWithLimit", array($msg));
			$console['Test'] = $console['Test'][0]["success"];
		}
		else
			$console['Test'] = "Impossible de récupérer les données de la console en RCON/QUERY";
		$this->updateReq("getLatestConsoleLogsWithLimit", $console);
		return $console;
	}

	public function reloadServer() {
		if($this->TryMode())
			return $this->api->call("reloadServer");
		else
			return false;
	}

	public function restartServer() {
		if($this->TryMode())
			return $this->api->call("server.power.restart");
		else
			return false;
	}

	public function getPermissionsGroups($pseudo) {
		$key = $this->verifyReq("permissions.getGroups.".$pseudo);
		if($key !== false)
			return $key;
		if($this->TryMode())
		{
			$return = $this->api->call("permissions.getGroups", Array($pseudo));
			$this->updateReq("permissions.getGroups.".$pseudo, $return);
			return $return;
		}
		else
			return '';
	}
	
	public function SendMessage($donnees)
	{
		if($this->TryMode())
		{
			$this->api->call("players.name.send_message", $donnees);
		}
		else {
			if($this->api != null)	
				$data = $this->api['rcon']->Rcon('msg '.$donnees[0].' '.$donnees[1]);
		}
	}

	public function getMonnaie()
	{
		$key = $this->verifyReq("economy.currency.name_plural");
		if($key !==false)
			return $key;
		if($this->TryMode())
		{
			$return = $this->api->call("economy.currency.name_plural");
			$this->updateReq("economy.currency.name_plural", $return);
			return $return;
		}
		return false;
	}

	public function runConsoleCommand($message)
	{
		$message = str_replace('{PLAYER}', $this->pseudo, $message);
		$message = str_replace('&', '§', $message);
		if($this->TryMode())
		{
			$this->api->call("runConsoleCommand", array($message));
		}
		else
		{
			if($this->api != null)
				$this->api['rcon']->Rcon($message);
		}		
	}
	
	//Cette fonction à la propriété de gérer les "Grades temporaires" !
	public function AddPlayerToGroup($message, $duree)
	{
		if($this->TryMode())
		{
			$this->api->call("runConsoleCommand", array('manudel '.$this->pseudo));
			$this->api->call("permissions.addPlayerToGroup", array($this->pseudo, $message));
			require_once('modele/boutique/tempgrades.class.php');
			$tempGrade = new TempGrades($this->bdd, $this->pseudo, $duree, $message);
			if($tempGrade->ExistPlayer())
			{
				if($duree == 0)
					$tempGrade->MajJoueurVie();
				else
					$tempGrade->MajJoueur();
			}
			else
			{
				if($duree == 0)
					$tempGrade->CreerJoueurVie();
				else
					$tempGrade->CreerJoueur();
			}
		}
	}

	public function ResetPlayer($pseudo, $grade)
	{
		if($this->TryMode())
		{
			$this->api->call("runConsoleCommand", array('manudel '.$pseudo));
			if(!empty($grade))
				$this->api->call("permissions.addPlayerToGroup", array($pseudo, $grade));	
		}
	}
	
	public function GivePlayerItem($commande)
	{
		if($this->TryMode())
		{
			$this->api->call("runConsoleCommand", array('give '.$this->pseudo . ' '. $commande));	
		}
		else
		{
			if($this->api != null)
				$this->api['rcon']->Rcon('give '.$this->pseudo.' '.$commande);
		}
	}

	public function GivePlayerXp($message)
	{
		if($this->TryMode())
			$this->api->call("givePlayerXp", array($message));
	}

	public function GivePlayerMoney($message)
	{
		if($this->TryMode())
			$this->api->call("econ.depositPlayer", array($this->pseudo, $message));
	}

	public function GetBanList()
	{
		$key = $this->verifyReq("files.read.banlist");
		if($key !== false)
			return $key;
		if($this->TryMode())
		{
			$return = $this->api->call("files.read", array("banned-players.json"));
			$this->updateReq("files.read.banlist", $return);
			return $return;
		}
		return false;
	}
	
	// Récupère les pseudo des joueurs et le nombre de joueurs en ligne...
	public function GetServeurInfos()
	{
		if($this->TryMode())
		{
			$serveurStats = array(
				'enLignes' => 0,
				'maxJoueurs' => 1,
				'joueurs' => 2,
				'version' => 3,
				'usedMemoryServer' => 4,
				'totalMemoryServer' => 5,
				'usedDiskSizeServer' => 6,
				'totalDiskSizeServer' => 7,
				'freeDiskSizeServer' => 8
			);
			$reqs = array(
				'getPlayerCount',
				'getPlayerLimit',
				'getPlayerNames',
				'getBukkitVersion',
				'server.performance.memory.used',
				'server.performance.memory.total',
				'server.performance.disk.used',
				'server.performance.disk.size',
				'server.performance.disk.free'
			);
			foreach($serveurStats as $clee => $value)
			{
				$key = $this->verifyReq($reqs[$value]);
				if($key !== false)
					$serveurStats[$clee] = $key;
				else
				{
					$req = $reqs[$value];
					$serveurStats[$clee] = $this->api->call($req); 
					$serveurStats[$clee] = $serveurStats[$clee][0]['success'];
					$this->updateReq($req, $serveurStats[$clee]);
				}
				if(is_numeric($serveurStats[$clee]))
					$serveurStats[$clee] = round($serveurStats[$clee]);
			}
		}
		else
		{
			if($this->api != null)
			{
				$key = $this->verifyReq("query.getInfo");
				if($key !== false)
				{
					$data = $key;
					$serveurStats['enLignes'] = $data['Players'];
					$serveurStats['maxJoueurs'] = $data['MaxPlayers'];
					$serveurStats['version'] = $data['Version'];
				}
				else
				{
					$data = $this->api['query']->GetInfo();
					$serveurStats['enLignes'] = $data['Players'];
					$serveurStats['maxJoueurs'] = $data['MaxPlayers'];
					$serveurStats['version'] = $data['Version'];
					$this->updateReq("query.getInfo", $data);
				}
				$key = $this->verifyReq("query.getPlayers");
				if($key !== false)
					$serveurStats['joueurs'] = $key;
				else
				{
					$serveurStats['joueurs'] = $this->api['query']->GetPlayers();
					$this->updateReq("query.getPlayers", $serveurStats['joueurs']);
				}
			}
		}
	    return $serveurStats;
	}

	public function close()
	{
		if(!$this->TryMode())
		{
			$this->api['rcon']->Disconnect();
		}
	}

	private function verifyReq($req, $time = 60)
	{
		if($req == "getLatestConsoleLogsWithLimit")
			return false;
		$select = $this->bdd->prepare('SELECT valeur, temp FROM cmw_cache_json WHERE requete = :req LIMIT 0,1');
		$select->execute(array(
			'req' => $req.'.'.$this->id
		));
		$data = $select->fetch(PDO::FETCH_ASSOC);
		if(isset($data['valeur']) && !empty($data['valeur']))
		{
			if($data['temp'] < time()-$time)
				return false;
			return json_decode($data['valeur'], true);
		}
		return false;
	}

	private function updateReq($req, $value)
	{
		$select = $this->bdd->prepare('SELECT id FROM cmw_cache_json WHERE requete = :req LIMIT 0,1');
		$select->execute(array(
			'req' => $req.'.'.$this->id
		));
		$key = $select->fetch(PDO::FETCH_ASSOC);
		if(isset($key['id']) && !empty($key['id']))
		{
			$update = $this->bdd->prepare('UPDATE cmw_cache_json SET valeur = :value, temp = :temp WHERE id = :id');
			$update->execute(array(
				'value' => json_encode($value),
				'temp' => time(),
				'id' => $key['id']
			));
		}
		else
		{
			$create = $this->bdd->prepare('INSERT INTO cmw_cache_json(requete, valeur, temp) VALUES (:requete, :valeur, :temp)');
			$create->execute(array(
				'requete' => $req.'.'.$this->id,
				'valeur' => json_encode($value),
				'temp' => time()
			));
		}
	}
}

?>