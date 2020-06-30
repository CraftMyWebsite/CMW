<?php

/**
 * 
 * UUIDHelper class:
 * 
 *  Get Mojang ping state,
 *  Minecraft Nickname -> Mojang UUID,
 *  Mojang UUID -> is alex or steve (?),
 *  Mojang UUID -> Mojang skin url,
 *
 * @author Guedesite <contact@neocraft.fr>
 * @version 1
 * @link https://file.neocraft.fr
 * @package UUIDHelper
 */

class UUIDHelper
{
    public $UUID;
    public $url;
    
    const SteveUUID = '8667ba71b85a4004af54457a9734eed7';
    
    private $ping;
	private $session;

    
    public function __construct($Pseudo){
		if($session = !isset($_SESSION["SkinApi"][$Pseudo]))
		{
			if(($this->ping = self::checkMojangApi()))
			{
				if(!($this->UUID = $this->getUUIDFromPseudo($Pseudo)))
				{
					$this->UUID = self::SteveUUID;
				}
				$_SESSION["SkinApi"][$Pseudo]['UUID'] = $this->UUID;
				$this->url = $_SESSION["SkinApi"][$Pseudo]['URL'] = self::getUrlTextureByUUID();
			}
		}else {
			$this->UUID = $_SESSION["SkinApi"][$Pseudo]['UUID'];
			$this->url = $_SESSION["SkinApi"][$Pseudo]['URL'];
		}
    }
        
    public function isApiEnable() {
        return $this->ping;
    }
    
    
    private function getUrlTextureByUUID() {
		$json = @file_get_contents('https://sessionserver.mojang.com/session/minecraft/profile/'.$this->UUID);
		$data = json_decode($json, true);
		$data64 = json_decode(base64_decode($data['properties'][0]['value']), true);
		return $data64['textures']['SKIN']['url'];
    }
    
    private function getUUIDFromPseudo($pseudo) {
        $json = @file_get_contents('https://api.mojang.com/users/profiles/minecraft/'.$pseudo);
        $data = json_decode($json, true);
        if(!isset($data)) {
            return false;
        } else {
            return $data['id'];
        }
    }
    
    private function checkMojangApi(){
        $json = file_get_contents('https://status.mojang.com/check');
        $data = json_decode($json, true);
        foreach($data as $address)
        {
            if(array_keys($address)[0] == 'api.mojang.com' && array_values($address)[0] == 'red'){
                return false;
            }else if(array_keys($address)[0] == 'sessionserver.mojang.com' && array_values($address)[0] == 'red'){
                return false;
            } else if(array_keys($address)[0] == 'textures.minecraft.net' && array_values($address)[0] == 'red'){
                return false;
            }
        }
        return true;
    }
}