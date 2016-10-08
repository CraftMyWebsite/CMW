<?php
require('JSONAPI.php');
class JsonCon
{
	public $api;
	private $pseudo;
	private $bddConnection;
	
	public function __construct($adresse, $post, $utilisateur, $mdp, $salt)
	{	
		$api = new JSONAPI($adresse, $post, $utilisateur, $mdp, $salt);
		$this->api = $api;
	}
	
	public function GetConnection()
	{
		$c = $this->api->call("server.version");
		return $c;
	}
	
	public function SetConnectionBase($bddConnection)
	{
		$this->bddConnection = $bddConnection;
	}
	
	public function SetPlayerName($pseudo)
	{
		$this->pseudo = $pseudo;
	}
	
	public function SendBroadcast($message)
	{
		$message = str_replace('{PLAYER}', $this->pseudo, $message);
		$message = str_replace('&', '§', $message);
		$this->api->call("chat.broadcast", array($message));
	}
	
	public function GetChat($donnees)
	{
		$c = $this->api->call("streams.formatted_chat.latest", $donnees);
		return $c;
	}

	public function getPlugins()
	{
		$plugins['Test'] = $this->api->call("getPlugins");
		$plugins['Test'] = $plugins['Test'][0]["success"];

		return $plugins;
	}

	public function GetConsole()
	{
		$msg = 12;
		$console['Test'] = $this->api->call("getLatestConsoleLogsWithLimit", array($msg));
		$console['Test'] = $console['Test'][0]["success"];

		return $console;
	}

	public function reloadServer() {
		return $this->api->call("reloadServer");
	}

	public function restartServer() {
		return $this->api->call("server.power.restart");
	}
	
	public function SendMessage($donnees)
	{
		$c = $this->api->call("players.name.send_message", $donnees);
		return $c;
	}

	public function getGroups()
	{
		return $this->api->call("groups.all");
	}
	public function getMonnaie()
	{
		return $this->api->call("economy.currency.name_plural");
	}
	public function getFile($addr)
	{
		return $this->api->call('files.read', array($addr));
	}

	public function runConsoleCommand($message)
	{
		$message = str_replace('{PLAYER}', $this->pseudo, $message);
		$message = str_replace('&', '§', $message);
		$this->api->call("runConsoleCommand", array($message));
	}
	
	//Cette fonction à la propriété de gérer les "Grades temporaires" !
	public function AddPlayerToGroup($message, $duree)
	{
		$this->api->call("runConsoleCommand", array('manudel '.$this->pseudo));
		$this->api->call("permissions.addPlayerToGroup", array($this->pseudo, $message));
		require_once('modele/boutique/tempgrades.class.php');
		$tempGrade = new TempGrades($this->bddConnection, $this->pseudo, $duree, $message);
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

	public function ResetPlayer($pseudo, $grade)
	{
		$this->api->call("runConsoleCommand", array('manudel '.$pseudo));
		if(!empty($grade))
			$this->api->call("permissions.addPlayerToGroup", array($pseudo, $grade));	
	}
	
	public function GivePlayerItem($commande)
	{
		$this->api->call("runConsoleCommand", array('give '.$this->pseudo . ' '. $commande));	
	}

	public function GivePlayerXp($message)
	{
		$this->api->call("givePlayerXp", array($message));
	}

	public function GivePlayerMoney($message)
	{
		$this->api->call("econ.depositPlayer", array($this->pseudo, $message));
	}

	public function GetBanList()
	{
		$file = $this->api->call("files.read", array("banned-players.txt"));
		$banlist = $this->api->call("getBannedPlayers");
		return array($banlist, $file);
	}

	public function GetGroupsList()
	{
		return $this->api->call("files.list_directory", array("plugins/GroupManager/worlds"));
	}
	
	// Récupère les pseudo des joueurs et le nombre de joueurs en ligne...
	public function GetServeurInfos()
	{
		$serveurStats['enLignes'] = $this->api->call("getPlayerCount"); 
		$serveurStats['enLignes'] = $serveurStats['enLignes'][0]['success'];
		
		$serveurStats['maxJoueurs'] = $this->api->call("getPlayerLimit"); 
		$serveurStats['maxJoueurs'] = $serveurStats['maxJoueurs'][0]['success'];
		
		$serveurStats['joueurs'] = $this->api->call("getPlayerNames"); 
		$serveurStats['joueurs'] = $serveurStats['joueurs'][0]['success'];
		
		$serveurStats['version'] = $this->api->call("getBukkitVersion");
		$serveurStats['version'] = $serveurStats['version'][0]['success'];
		$serveurStats['version'] = substr($serveurStats['version'], 0, 6);

                                # Ajout par Sprik07 #
#==============================================================================================#
		$serveurStats['uMS'] = array('Mo', 'Go');
		$serveurStats['tMS'] = array('Mo', 'Go');
		$serveurStats['usedMemoryServer'] = $this->api->call("server.performance.memory.used");
		$serveurStats['usedMemoryServer'] = $serveurStats['usedMemoryServer'][0]["success"];
		$serveurStats['usedMemoryServer'] = round($serveurStats['usedMemoryServer']);
		if ($serveurStats['usedMemoryServer'] < 1000) { //Taille en Mo
		//$serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']/(1024*1024),2);
			$serveurStats['uMS'] = $serveurStats['uMS'][0];
	    } else { //Taille en Go
	    	$serveurStats['usedMemoryServer'] = round($serveurStats['usedMemoryServer']/1024,2);
	    	$serveurStats['usedMemoryServer'] = round($serveurStats['usedMemoryServer']);
	    	$serveurStats['uMS'] = $serveurStats['uMS'][1];
	    }

	    $serveurStats['totalMemoryServer'] = $this->api->call("server.performance.memory.total");
	    $serveurStats['totalMemoryServer'] = $serveurStats['totalMemoryServer'][0]["success"];
	    $serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']);
		if ($serveurStats['totalMemoryServer'] < 1000) { //Taille en Mo
		//$serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']/(1024*1024),2);
			$serveurStats['tMS'] = $serveurStats['tMS'][0];
	    } else { //Taille en Go
	    	$serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']/1024,2);
	    	$serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']);
	    	$serveurStats['tMS'] = $serveurStats['tMS'][1];
	    }
#==============================================================================================#
	    $serveurStats['uDSS'] = array('Mo', 'Go');
	    $serveurStats['tDSS'] = array('Mo', 'Go');
	    $serveurStats['fDSS'] = array('Mo', 'Go');
	    $serveurStats['usedDiskSizeServer'] = $this->api->call("server.performance.disk.used");
	    $serveurStats['usedDiskSizeServer'] = $serveurStats['usedDiskSizeServer'][0]["success"];
	    $serveurStats['usedDiskSizeServer'] = round($serveurStats['usedDiskSizeServer']);
		if ($serveurStats['usedDiskSizeServer'] < 1000) { //Taille en Mo
		//$serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']/(1024*1024),2);
			$serveurStats['uDSS'] = $serveurStats['uDSS'][0];
	    } else { //Taille en Go
	    	$serveurStats['usedDiskSizeServer'] = round($serveurStats['usedDiskSizeServer']/1024,2);
	    	$serveurStats['usedDiskSizeServer'] = round($serveurStats['usedDiskSizeServer']);
	    	$serveurStats['uDSS'] = $serveurStats['uDSS'][1];
	    }

	    $serveurStats['totalDiskSizeServer'] = $this->api->call("server.performance.disk.size");
	    $serveurStats['totalDiskSizeServer'] = $serveurStats['totalDiskSizeServer'][0]["success"];
	    $serveurStats['totalDiskSizeServer'] = round($serveurStats['totalDiskSizeServer']);
		if ($serveurStats['totalDiskSizeServer'] < 1000) { //Taille en Mo
		//$serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']/(1024*1024),2);
			$serveurStats['tDSS'] = $serveurStats['tDSS'][0];
	    } else { //Taille en Go
	    	$serveurStats['totalDiskSizeServer'] = round($serveurStats['totalDiskSizeServer']/1024,2);
	    	$serveurStats['totalDiskSizeServer'] = round($serveurStats['totalDiskSizeServer']);
	    	$serveurStats['tDSS'] = $serveurStats['tDSS'][1];
	    }

	    $serveurStats['freeDiskSizeServer'] = $this->api->call("server.performance.disk.free");
	    $serveurStats['freeDiskSizeServer'] = $serveurStats['freeDiskSizeServer'][0]["success"];
	    $serveurStats['freeDiskSizeServer'] = round($serveurStats['freeDiskSizeServer']);
		if ($serveurStats['freeDiskSizeServer'] < 1000) { //Taille en Mo
		//$serveurStats['totalMemoryServer'] = round($serveurStats['totalMemoryServer']/(1024*1024),2);
			$serveurStats['fDSS'] = $serveurStats['fDSS'][0];
	    } else { //Taille en Go
	    	$serveurStats['freeDiskSizeServer'] = round($serveurStats['freeDiskSizeServer']/1024,2);
	    	$serveurStats['freeDiskSizeServer'] = round($serveurStats['freeDiskSizeServer']);
	    	$serveurStats['fDSS'] = $serveurStats['fDSS'][1];
	    }
#==============================================================================================#
	    return $serveurStats;
	}
}

?>
