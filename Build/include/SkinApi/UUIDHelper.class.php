<?php

/**
 * 
 * UUIDHelper class:
 * 
 *  Get Mojang ping state,
 *  Minecraft Nickname -> Mojang UUID,
 *  Mojang UUID -> Mojang skin url,
 *
 * @author Guedesite <contact@neocraft.fr>
 * @version 1
 * @link https://file.neocraft.fr
 * @package UUIDHelper
 */

class UUIDHelper
{

    const SteveUUID = '8667ba71b85a4004af54457a9734eed7';
    
    private $ping;

    public function __construct(){
        $this->ping = self::checkMojangApi();
    }
        
    public function isApiEnable() {
        return $this->ping;
    }
    
    public function getUrlTextureByPseudo($pseudo) {
        $uuid = $this->getUUIDFromPseudo($pseudo);
        if(!isset($uuid))
        {
            return null;
        }
        return $this->getUrlTextureByUUID($uuid);
    }
    
    
    private function getUrlTextureByUUID($uuid) {
		$json =  $this->fetch('https://sessionserver.mojang.com/session/minecraft/profile/'.$uuid);
		
		if(!isset($json) | empty($json)) {
            return null;
        } else {
			$data = json_decode($json, true);
			if(array_key_exists('error', $data))
			{
			    return null;
			}
			$data64 = json_decode(base64_decode($data['properties'][0]['value']), true);
			return $data64['textures']['SKIN']['url'];
		}
    }
    
    private function getUUIDFromPseudo($pseudo) {
		$json = $this->fetch('https://api.mojang.com/users/profiles/minecraft/'.$pseudo);
		
		if(!isset($json) | empty($json)) {
            return null;
        } else {
            $data = json_decode($json, true);
            if(array_key_exists('error', $data))
            {
                return null;
            }
            return $data['id'];
        }
    }

    private function checkMojangApi(){
		return true;
        $json = $this->fetch('https://status.mojang.com/check');
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
	
	private function fetch($url)
    {
        if (function_exists('curl_init') and extension_loaded('curl')) {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

            $output = curl_exec($ch);
            curl_close($ch);

            return $output;
        } else {
            return @file_get_contents($url);
        }
    }
}