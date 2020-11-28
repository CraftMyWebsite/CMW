<?php
class vote {
    
    private $Player;
    private $lienData;
    private $exist;
    private $Pseudo;
    
    public function __construct($bdd, $pseudo, $lienId) {
        $Player2 = $bdd->prepare('SELECT * FROM cmw_votes WHERE pseudo = :pseudo AND site = :site and isOld=0');
        $Player2->execute(array(
            'pseudo' => $pseudo,
            'site' => $lienId    ));
        $this->Player= $Player2->fetch(PDO::FETCH_ASSOC);
        $this->Pseudo=$pseudo;



        if(!isset($lienId)) {
            $this->exist = false;
        } else {
             $req = $bdd->prepare('SELECT * FROM cmw_votes_config WHERE id = :id');
            $req->execute(array('id' => $lienId));
            $this->lienData=$req->fetch(PDO::FETCH_ASSOC);
            $this->exist = isset($this->lienData) && !empty($this->lienData);
        }
    }

    
    public function canVote() {
        return empty($this->Player) || $this->exist && $this->lienData['temps'] + $this->Player['date_dernier']  < time();
    }

    public function getAction() {
         return  !$this->exist ? "" : $this->lienData['action'];
    }



    public function getLastVoteTimeMili() {
        return empty($this->Player) ? 0 : $this->Player['date_dernier'];
    }

    public function getTimeVoteTimeMili() {
        return  !$this->exist ? 0 : $this->lienData['temps'];
    }

    public function getUrl() {
        return  !$this->exist ? "" : $this->lienData['lien'];
    }
    
    public function getTitre() {
        return  !$this->exist ? "" : $this->lienData['titre'];
    }

    public function confirmVote($bdd) {
        if(!empty($this->Player)) {
            $req = $bdd->prepare('UPDATE cmw_votes SET nbre_votes = nbre_votes + 1, date_dernier = :tmp, ip = :ip WHERE pseudo = :pseudo AND site = :site');
            $req->execute(array(
                'tmp' => time(),
                'pseudo' => $this->Pseudo,
                'ip' => $this->get_client_ip(),
                'site' => $this->lienData['id']));
        } else {
             $req = $bdd->prepare('INSERT INTO cmw_votes (pseudo, ip, nbre_votes, site, date_dernier) VALUES (:pseudo, :ip, 1, :site, :tmp);');
            $req->execute(array(
                'tmp' => time(),
                'pseudo' => $this->Pseudo,
                'ip' => $this->get_client_ip(),
                'site' => $this->lienData['id']));
        }
    }

    public function stockVote($bdd, $action, $serveur) {
        if(!isset($action)) {
            $action = $this->lienData['action'];
        }
        if(!isset($serveur)) {
            $serveur = $this->lienData['serveur'];
        }

        $json = json_decode($action, true); 
        foreach($json as $key => $value) { 
            if(isset($value['pourcentage']) && ((int)$value['pourcentage']) != 100) {
                if(rand(0, 100) > ((int)$value['pourcentage'])) {
                    unset($json[$key]);
                    continue;
                }
            }
            if($value['type'] == "jetonAlea") {
                $value['type'] = "jeton";
                $value['value'] = rand($value['value'], $value['value2']);
                unset($value['value2']);
            }
        }
        $action = json_encode(array_values($json)); 


        $req = $bdd->prepare('INSERT INTO cmw_votes_temp (pseudo, action, serveur) VALUES (:pseudo, :action, :serveur)');
        $req->execute(array(
        'pseudo' => $this->Pseudo,
        'action' =>  $action,
        'serveur' => $serveur
        ));
    }

    public function giveRecompense($bdd, $data, $jsonCon, $save = false) {
        global $lectureJSON;
        if(!isset($data)) {
            $action = $this->lienData['action'];
        }else {
            $action = $data['action'];
        }
        $lastquantite = "non définie";
        $lastcmd = "non définie";
        $lastid = "non définie";
        $json = $json2 = json_decode($action, true); 
        foreach($json as $key => $value) { 
             if($value['type'] == "jeton" && Permission::getInstance()->verifPerm("connect")) {
                $lastquantite = $value['value'];
                global $_Joueur_;
                $_SESSION['Player']['tokens'] = $_Joueur_['tokens'] = $_Joueur_['tokens'] + ((int)$value['value']);
                unset($json2[$key]);
                continue;
            } else if($value['type'] == "message") {
                $message = str_replace('{JOUEUR}', $this->Pseudo, str_replace('{CMD}', $lastcmd, str_replace('{QUANTITE}', $lastquantite, str_replace('{ID}', $lastid, str_replace('&amp;', '§', $value['value'])))));
                if($value['methode'] == "1") {
                    for($j =0; $j < count($jsonCon); $j++)
                    {
                        if(!empty($jsonCon[$j]->GetServeurInfos()['joueurs']) && is_array($jsonCon[$j]->GetServeurInfos()['joueurs']) && in_array($this->Pseudo, $jsonCon[$j]->GetServeurInfos()['joueurs'])) 
                        {
                            $jsonCon[$j]->SendBroadcast($message);
                            unset($json2[$key]);
                            break;
                        }
                    }
                } else if($value['methode'] == "2") {
                    foreach($lectureJSON as $key3 => $serveur)
                    {
                        $id3 = $this->exist ? $this->lienData['serveur'] : $data['serveur'];
                        if($serveur['id'] == $id3) {
                            $jsonCon[$key3]->SendBroadcast($message);
                            unset($json2[$key]);
                            break;
                        }
                    }
                } else if($value['methode'] == "3") {
                    for($j =0; $j < count($jsonCon); $j++)
                    {
                        $jsonCon[$j]->SendBroadcast($message);
                    }
                    unset($json2[$key]);
                } 
            } else if($value['type'] == "commande") {
                $cmd = str_replace('{JOUEUR}', $this->Pseudo, $value['value']);
                if($value['methode'] == "1") {
                    for($j =0; $j < count($jsonCon); $j++)
                    {
                        if(!empty($jsonCon[$j]->GetServeurInfos()['joueurs']) && is_array($jsonCon[$j]->GetServeurInfos()['joueurs']) && in_array($this->Pseudo, $jsonCon[$j]->GetServeurInfos()['joueurs'])) 
                        {
                            $jsonCon[$j]->runConsoleCommand($cmd);
                            unset($json2[$key]);
                            break;
                        }
                    }
                } else if($value['methode'] == "2") {
                    foreach($lectureJSON as $key3 => $serveur)
                    {

                        $id3 = $this->exist ? $this->lienData['serveur'] : $data['serveur'];
                        if($serveur['id'] == $id3) {
                            $jsonCon[$key3]->runConsoleCommand($cmd);
                            unset($json2[$key]);
                            break;
                        }
                    }
                } else if($value['methode'] == "3") {
                    for($j =0; $j < count($jsonCon); $j++)
                    {
                        $jsonCon[$j]->runConsoleCommand($cmd);
                        unset($json2[$key]);
                    }
                } 
            } else if($value['type'] == "item") {
                if($value['methode'] == "1") {
                    for($j =0; $j < count($jsonCon); $j++)
                    {
                        if(!empty($jsonCon[$j]->GetServeurInfos()['joueurs']) && is_array($jsonCon[$j]->GetServeurInfos()['joueurs']) && in_array($Player['pseudo'], $jsonCon[$j]->GetServeurInfos()['joueurs'])) 
                        {
                            $jsonCon[$j]->GivePlayerItem($Player['pseudo'].' '.$value['value'] . ' ' .$value['value2']);
                            unset($json2[$key]);
                            break;
                        }
                    }
                } else if($value['methode'] == "2") {
                    foreach($lectureJSON as $key3 => $serveur)
                    {
                       $id3 = $this->exist ? $this->lienData['serveur'] : $data['serveur'];
                        if($serveur['id'] == $id3) {
                            $jsonCon[$key3]->GivePlayerItem($Player['pseudo'].' '.$value['value'] . ' ' .$value['value2']);
                            unset($json2[$key]);
                            break;
                        }
                    }
                } else if($value['methode'] == "3") {
                    for($j =0; $j < count($jsonCon); $j++)
                    {
                        $jsonCon[$j]->GivePlayerItem($Player['pseudo'].' '.$value['value'] . ' ' .$value['value2']);
                        unset($json2[$key]);
                    }
                } 
            }
            
        }
        if($lastquantite != "non définie" && Permission::getInstance()->verifPerm("connect")) {
            global $_Joueur_;
            $reqMaj = $bdd->prepare('UPDATE cmw_users SET tokens = :tokens WHERE pseudo = :pseudo');
            $reqMaj->execute(array(
                'tokens' => $_Joueur_['tokens'],
                'pseudo' => $_Joueur_['pseudo']
            ));
        }
        if($save) {
            if(empty($json2) | !isset($json2)) {
                $req_suppr = $bdd->prepare('DELETE FROM cmw_votes_temp WHERE id = :id');
                $req_suppr->execute(array(
                    'id' => $data['id']
                )); 
                return false;
            } else {
                $reqMaj = $bdd->prepare('UPDATE cmw_votes_temp SET action = :action WHERE id = :id');
                $reqMaj->execute(array(
                    'id' => $data['id'],
                    'action' => json_encode(array_values($json2))
                    ));
                return true;
            }
        }
    }
    
    public function exist() {
        return $this->exist;
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
    
    public function hasVote() {
        $id = $this->lienData['idCustom'];
        if(isset($id) AND !empty($id) and $id != "")
        {
            $url = $this->lienData['lien'];
            if(strpos($url, 'serveur-prive.net'))
            {
                $API_call = $this->fetch("https://serveur-prive.net/api/vote/".$id."/". $this->get_client_ip());
                return $API_call == 1;
            } else if(strpos($url, 'serveurs-minecraft.org'))
            {
                $is_valid_vote = $this->fetch('https://www.serveurs-minecraft.org/api/is_valid_vote.php?id='.$id.'&ip='. $this->get_client_ip().'&duration=5');
                return $is_valid_vote > 0;
            } else if(strpos($url, 'serveurs-minecraft.com'))
            {
                $apiaddr = 'https://serveurs-minecraft.com/api.php?Classement=' . $id .'&ip=' .  $this->get_client_ip();
                $apiResult = $this->fetch($apiaddr);
                if ($apiResult!==false) {
                    $apiResult = json_decode($apiResult, true);
                    $currentDate = new DateTime($apiResult['reqVote']['date']);
                    $voteDate = new DateTime($apiResult['lastVote']['date']);
                    $interval = $currentDate->diff($voteDate);
                    if ($interval->y==0 && $interval->m==0 && $interval->d<1 && !$apiResult['authorVote']) 
                    {
                        return true;
                    }
                }
                return false;
            } else if(strpos($url, 'serveursminecraft.fr'))
            {
                $data = file_get_contents ( "https://serveursminecraft.fr/api/api.php?IDServeur=" . $id . "&IP=" .  $this->get_client_ip());
                if ( $data == false )
                {
                    return false;
                }
                else
                {
                    $data_decoded = json_decode($data,true);
                    if ( $data_decoded["DateVote"] >= $data_decoded["DateActuelle"] - 360 ){return true;}else{return false;}
                }
            }else if(strpos($url, 'liste-minecraft-serveurs.com'))
            {
                $api = json_decode($this->fetch("https://www.liste-minecraft-serveurs.com/Api/Worker/id_server/".$id."/ip/". $this->get_client_ip()));
                if($api->result == 202){return true;}else{return false;}
            } else if(strpos($url, 'liste-serveurs.fr'))
            {
                $api = json_decode($this->fetch("https://www.liste-serveurs.fr/api/checkVote/".$id."/". $this->get_client_ip()));
                if($api->success == true){return true;}else{return false;}
            }else if(strpos($url, 'liste-serveur.fr'))
            {
                $api = json_decode($this->fetch("https://www.liste-serveur.fr/api/hasVoted/".$id."/". $this->get_client_ip()));
                if($api->hasVoted == true){return true;}else{return false;}
            }else if(strpos($url, 'top-serveurs.net'))  {
                $api = json_decode($this->fetch("https://api.top-serveurs.net/v1/votes/check-ip?server_token=".$id."&ip=". $this->get_client_ip()));
                if($api->success == true){return true;}else{return false;}
            }else if(strpos($url, 'serveursminecraft.org'))   	{
                $api =$this->fetch("https://www.serveursminecraft.org/sm_api/peutVoter.php?id=".$id."&ip=". $this->get_client_ip());
                if($api == "true"){return true;}else{return false;}
            }else if(strpos($url, 'serveur-multigames.net'))  {
                $api =$this->fetch("https://serveur-multigames.net/api/v2/vote/true/".$id."/". $this->get_client_ip());
                if($api == "1"){return true;}else{return false;}
            }else if(strpos($url, 'minecraft-top.com'))  {
                $api = json_decode($this->fetch("https://api.minecraft-top.com/v1/vote/". $this->get_client_ip()."/".$id));
                if($api->vote == 1){return true;}else{return false;}
            }else if(strpos($url, 'liste-serveurs-minecraft.org'))  {
                $api = $this->fetch("https://api.liste-serveurs-minecraft.org/vote/vote_verification.php?server_id=".$id."&ip=".$this->get_client_ip()."&duration=360");
                if($api == "1"){return true;}else{return false;}
            }else if(strpos($url, 'liste-serv-minecraft.fr'))  {
                $api = json_decode($this->fetch("https://liste-serv-minecraft.fr/api/check?server=".$id."&ip=".$this->get_client_ip()));
                if($api['status'] == 200) {
                    if(strtotime($api["datetime_vote_end"]) < time() - 360 ) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }else if(strpos($url, 'minecraft-mp.com'))  {
                $api = $this->fetch("https://minecraft-mp.com/api/?object=votes&element=claim&key=".$id."&username=".$this->Pseudo);
                if($api == "2"){return true;}else{return false;}
            }else if(strpos($url, 'minecraft-top.com'))  {
                $api = json_decode($this->fetch("https://api.minecraft-top.com/v1/vote/". $this->get_client_ip()."/".$id));
                if($api->vote == 1){return true;}else{return false;}
            }else {
                return true;
            }
        } else {
            return true;
        }
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
?>