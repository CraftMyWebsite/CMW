<?php

/**
 *
 * MinecraftPing class:
 *
 *  Ping serveur.
 *
 * @author Guedesite <contact@neocraft.fr>
 * @version 1
 * @link https://file.neocraft.fr
 * @package MinecraftPing
 */
class MinecraftPing {
	
	public $MaxPlayer = 0;
	public $Players = 0;
	public $Online = false;
	
	public function __construct($hostname, $port = 25565) {
		$socket = null;
		try {
		    $address = null;
		    $timeout = 1; // variable
			if($port < 1024 || $port > 65535) {
				throw new Exception('[MinecraftPing] Port invalide');
			}
		

			if(filter_var($hostname, FILTER_VALIDATE_IP)) {
			    $address = $hostname;
			}
			else {
				$resolvedIP = gethostbyname($hostname);
				
				if(filter_var($resolvedIP, FILTER_VALIDATE_IP)) {
			
				    $address = $resolvedIP;
				}
				else {
			
					$dns = @dns_get_record('_minecraft._tcp.' . $hostname, DNS_SRV);

					
					if(!$dns) {
						throw new Exception('[MinecraftPing] dns_get_record(): Erreur DNS');
					}
					
					if(is_array($dns) and count($dns) > 0) {
					    $address = gethostbyname($dns[0]['target']);
					    $port = $dns[0]['port'];
					}
				}
			}

			$socket = @fsockopen($address, $port, $errno, $errstr, $timeout);
			if(!$socket) {
				@fclose($socket);
				throw new Exception("[MinecraftPing] Impossible de créé une connexion: $errstr");
			}
			stream_set_timeout($socket, $timeout);

			$this->Ping($socket, $timeout, $address, $port);
			
			$this->Online = true;
			
			@fclose($socket);
		}
		catch(Exception $e) {
			if($socket != null) {
				@fclose($socket);
			}
 			error_log($e->getMessage());
		}

	}

	private function Ping($socket, $timeout, $address, $port) {
		$timestart = microtime(true);
		$data = "\x00\x04".pack('c', strlen($address)) . $address . pack('n', $port) . "\x01";
		$data = pack('c', strlen($data)) . $data;

		fwrite($socket, $data);
		
		fwrite($socket, "\x01\x00");
		
		$length = $this->readVarInt($socket);
		if($length < 10) {
			throw new Exception('[MinecraftPing] Réponse invalide');
		}
		
		fgetc($socket);
		$length = $this->readVarInt($socket);
		$data = "";
		do {
			if(microtime(true) - $timestart > $timeout) {
				throw new Exception('[MinecraftPing] Time out');
			}
			$remainder = $length - strlen($data);
			$block = fread($socket, $remainder);
			if(!$block) {
				throw new Exception('[MinecraftPing] Réponse invalide');
			}
			$data .= $block;
		}
		while(strlen($data) < $length);

		if($data === false) {
			throw new Exception('[MinecraftPing] null');
		}
		
		$data = json_decode($data, true);
		
		if(json_last_error() !== JSON_ERROR_NONE) {
		    throw new Exception('[MinecraftPing]'.json_last_error_msg());
		}

		$this->Players = $data['players']['online'];
		$this->MaxPlayer = $data['players']['max'];
	}

	private function readVarInt($socket) {
		$i = 0;
		$j = 0;
		while(true) {
			$k = @fgetc($socket);
			if($k === false) {
				return 0;
			}
			$k = ord($k);
			$i |= ($k & 0x7F) << $j++ * 7;
			if($j > 5) {
				throw new Exception('[MinecraftPing] VarInt erreur');
			}
			if(($k & 0x80) != 128) {
				break;
			}
		}
		
		return $i;
	}

}