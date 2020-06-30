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
	private $pseudo;
	private $bdd;
	private $mode;
	private $cache;
	private $id;
	
	public function __construct($adresse, $post, $utilisateur, $mdp, $salt, $bdd, $i)
	{
		if(isset($utilisateur))
		{
			$this->mode = 1;
			$api = new JSONAPI($adresse, $post, $utilisateur, $mdp, $salt);
		}
		else
		{
			try
			{
				$api['query'] = new MinecraftQuery();
				$api['query']->Connect($adresse, $post['query']);
				$api['rcon'] = new SourceQuery();
				$api['rcon']->Connect($adresse, $post['rcon'], 1, SourceQuery::SOURCE);
				$api['rcon']->SetRconPassword($mdp);
				$this->mode = 2;
			}
			catch(Exception $e)
			{
				$api = null;
			}
		}
		$this->bdd = $bdd;
		$req = $this->bdd->query("SELECT * FROM cmw_cache_json");
		$this->cache = $req->fetchAll(PDO::FETCH_ASSOC);
		$this->api = $api;
		$this->id = $i;
	}

	private function TryMode()
	{
		return ($this->mode == 1);
	}
	
	public function GetConnection()
	{
		$key = $this->verifyReq("server.version");
		if($key !== false)
		{
			return json_decode($this->cache[$key]['valeur'], true);
		}
		if($this->TryMode())
			$c = $this->api->call("server.version");
		else
		{
			if($this->api != null)
				$c = $this->api['query']->GetInfo();
		}
		$this->updateReq("server.version", $c);
		return $c;
	}
	
	public function SetConnectionBase($bddConnection)
	{
		$this->bdd = $bddConnection;
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

	public function sendChat($donnees)
	{
		if($this->TryMode())
		{
			$data = $this->api->call("chat.broadcast", array($donnees));	
		}
		else
		{
			if($this->api != null)	
				$data = $this->api['rcon']->Rcon('say '.$donnees);
		}
		return $data;
	}
	
	public function GetChat($donnees)
	{
		if($this->TryMode())
			$c = $this->api->call("streams.chat.latest", $donnees);
		return $c;
	}

	public function getPlugins()
	{
		$key = $this->verifyReq("getPlugins");
		if($key !== false)
		{
			return json_decode($this->cache[$key]['valeur'], true);
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
			return json_decode($this->cache[$key]['valeur'], true);
		$msg = 12;
		if($this->TryMode())
		{
			$console['Test'] = $this->api->call("getLatestConsoleLogsWithLimit", array($msg));
			$console['Test'] = $console['Test'][0]["success"];
		}
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
			return json_decode($this->cache[$key]['valeur'], true);
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
			$c = $this->api->call("players.name.send_message", $donnees);
		return $c;
	}

	public function getGroups()
	{
		$key = $this->verifyReq("groups.all");
		if($key !== false)
			return json_decode($this->cache[$key]['valeur'], true);
		if($this->TryMode())
		{
			$return = $this->api->call("groups.all");
			$this->updateReq("groups.all", $return);
			return $return;
		}
		return false;
	}
	public function getMonnaie()
	{
		$key = $this->verifyReq("economy.currency.name_plural");
		if($key !==false)
			return json_decode($this->cache[$key]['valeur'], true);
		if($this->TryMode())
		{
			$return = $this->api->call("economy.currency.name_plural");
			$this->updateReq("economy.currency.name_plural", $return);
			return $return;
		}
		return false;
	}
	public function getFile($addr)
	{
		$key = $this->verifyReq("files.read.".$addr, 10*3600);
		if($key !== false)
			return json_decode($this->cache[$key]['valeur']);
		if($this->TryMode())
		{
			$return = $this->api->call('files.read', array($addr));
			$this->updateReq("files.read.".$addr, $return);
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
			return json_decode($this->cache[$key]['valeur'], true);
		if($this->TryMode())
		{
			$return = $this->api->call("files.read", array("banned-players.json"));
			$this->updateReq("files.read.banlist", $return);
			return $return;
		}
		return false;
	}

	public function GetGroupsList()
	{
		if($this->TryMode())
			return $this->api->call("files.list_directory", array("plugins/GroupManager/worlds"));
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
					$serveurStats[$clee] = json_decode($this->cache[$key]['valeur'], true);
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
			$serveurStats['uMS'] = 'Mo';
			$serveurStats['tMS'] = 'Mo';
			$serveurStats['uDSS'] = 'Mo';
			$serveurStats['tDSS'] = 'Mo';
			$serveurStats['fDSS'] = 'Mo';
			// 	$serveurStats['enLignes'] = $this->api->call("getPlayerCount"); 
			// 	$serveurStats['enLignes'] = $serveurStats['enLignes'][0]['success'];
			// }
			
			// $serveurStats['maxJoueurs'] = $this->api->call("getPlayerLimit"); 
			// $serveurStats['maxJoueurs'] = $serveurStats['maxJoueurs'][0]['success'];

			// $serveurStats['joueurs'] = $this->api->call("getPlayerNames"); 
			// $serveurStats['joueurs'] = $serveurStats['joueurs'][0]['success'];
			
			// $serveurStats['version'] = $this->api->call("getBukkitVersion");
			// $serveurStats['version'] = $serveurStats['version'][0]['success'];
			// $serveurStats['version'] = substr($serveurStats['version'], 0, 6);
			// $serveurStats['uMS'] = array('Mo', 'Go');
			// $serveurStats['tMS'] = array('Mo', 'Go');
			// $serveurStats['usedMemoryServer'] = $this->api->call("server.performance.memory.used");
			// $serveurStats['usedMemoryServer'] = $serveurStats['usedMemoryServer'][0]["success"];
			// $serveurStats['usedMemoryServer'] = round($serveurStats['usedMemoryServer']);
			// if ($serveurStats['usedMemoryServer'] < 1000) { //Taille en Mo
			// //$serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']/(1024*1024),2);
			// 	$serveurStats['uMS'] = $serveurStats['uMS'][0];
		 //    } else { //Taille en Go
		 //    	$serveurStats['usedMemoryServer'] = round($serveurStats['usedMemoryServer']/1024,2);
		 //    	$serveurStats['usedMemoryServer'] = round($serveurStats['usedMemoryServer']);
		 //    	$serveurStats['uMS'] = $serveurStats['uMS'][1];
		 //    }

		 //    $serveurStats['totalMemoryServer'] = $this->api->call("server.performance.memory.total");
		 //    $serveurStats['totalMemoryServer'] = $serveurStats['totalMemoryServer'][0]["success"];
		 //    $serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']);
			// if ($serveurStats['totalMemoryServer'] < 1000) { //Taille en Mo
			// //$serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']/(1024*1024),2);
			// 	$serveurStats['tMS'] = $serveurStats['tMS'][0];
		 //    } else { //Taille en Go
		 //    	$serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']/1024,2);
		 //    	$serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']);
		 //    	$serveurStats['tMS'] = $serveurStats['tMS'][1];
		 //    }
		 //    $serveurStats['uDSS'] = array('Mo', 'Go');
		 //    $serveurStats['tDSS'] = array('Mo', 'Go');
		 //    $serveurStats['fDSS'] = array('Mo', 'Go');
		 //    $serveurStats['usedDiskSizeServer'] = $this->api->call("server.performance.disk.used");
		 //    $serveurStats['usedDiskSizeServer'] = $serveurStats['usedDiskSizeServer'][0]["success"];
		 //    $serveurStats['usedDiskSizeServer'] = round($serveurStats['usedDiskSizeServer']);
			// if ($serveurStats['usedDiskSizeServer'] < 1000) { //Taille en Mo
			// //$serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']/(1024*1024),2);
			// 	$serveurStats['uDSS'] = $serveurStats['uDSS'][0];
		 //    } else { //Taille en Go
		 //    	$serveurStats['usedDiskSizeServer'] = round($serveurStats['usedDiskSizeServer']/1024,2);
		 //    	$serveurStats['usedDiskSizeServer'] = round($serveurStats['usedDiskSizeServer']);
		 //    	$serveurStats['uDSS'] = $serveurStats['uDSS'][1];
		 //    }

		 //    $serveurStats['totalDiskSizeServer'] = $this->api->call("server.performance.disk.size");
		 //    $serveurStats['totalDiskSizeServer'] = $serveurStats['totalDiskSizeServer'][0]["success"];
		 //    $serveurStats['totalDiskSizeServer'] = round($serveurStats['totalDiskSizeServer']);
			// if ($serveurStats['totalDiskSizeServer'] < 1000) { //Taille en Mo
			// //$serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']/(1024*1024),2);
			// 	$serveurStats['tDSS'] = $serveurStats['tDSS'][0];
		 //    } else { //Taille en Go
		 //    	$serveurStats['totalDiskSizeServer'] = round($serveurStats['totalDiskSizeServer']/1024,2);
		 //    	$serveurStats['totalDiskSizeServer'] = round($serveurStats['totalDiskSizeServer']);
		 //    	$serveurStats['tDSS'] = $serveurStats['tDSS'][1];
		 //    }

		 //    $serveurStats['freeDiskSizeServer'] = $this->api->call("server.performance.disk.free");
		 //    $serveurStats['freeDiskSizeServer'] = $serveurStats['freeDiskSizeServer'][0]["success"];
		 //    $serveurStats['freeDiskSizeServer'] = round($serveurStats['freeDiskSizeServer']);
			// if ($serveurStats['freeDiskSizeServer'] < 1000) { //Taille en Mo
			// //$serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']/(1024*1024),2);
			// 	$serveurStats['fDSS'] = $serveurStats['fDSS'][0];
		 //    } else { //Taille en Go
		 //    	$serveurStats['freeDiskSizeServer'] = round($serveurStats['freeDiskSizeServer']/1024,2);
		 //    	$serveurStats['freeDiskSizeServer'] = round($serveurStats['freeDiskSizeServer']);
		 //    	$serveurStats['fDSS'] = $serveurStats['fDSS'][1];
		 //    }
		}
		else
		{
			if($this->api != null)
			{
				$key = $this->verifyReq("query.getInfo");
				if($key !== false)
				{
					$data = json_decode($this->cache[$key]['valeur'], true);
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
					$serveurStats['joueurs'] = json_decode($this->cache[$key]['valeur'], true);
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
		$key = array_search($req.'.'.$this->id, array_column($this->cache, 'requete'));
		if($key !== false)
		{
			if($this->cache[$key]['temp'] < time()-$time)
				return false;
			return $key;
		}
		return false;
	}

	private function updateReq($req, $value)
	{
		$key = array_search($req.'.'.$this->id, array_column($this->cache, 'requete'));
		if($key !== false)
		{
			$update = $this->bdd->prepare('UPDATE cmw_cache_json SET valeur = :value, temp = :temp WHERE id = :id');
			$update->execute(array(
				'value' => json_encode($value),
				'temp' => time(),
				'id' => $this->cache[$key]['id']
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