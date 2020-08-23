<?php
class vote {
    
    private $Player;
    private $lienData;
    private $exist;
    
    public function ___construc($bdd, $pseudo, $lienId) {
        $req = $bdd->prepare('SELECT * FROM cmw_votes_config WHERE id = :id');
        $req->execute(array('id' => $lienId));
        $this->lienData=$req->fetch(PDO::FETCH_ASSOC);
        
        
        $Player2 = $bdd->prepare('SELECT * FROM cmw_votes WHERE pseudo = :pseudo AND site = :site');
        $Player2->execute(array(
            'pseudo' => $pseudo,
            'site' => $lienId    ));
        $this->Player= $Player2->fetch(PDO::FETCH_ASSOC);

        $this->exist = isset($this->lienData) && !empty($this->lienData);
    }

    public function ___construc($bdd, $pseudo) {
        $Player2 = $bdd->prepare('SELECT * FROM cmw_votes WHERE pseudo = :pseudo AND site = :site');
        $Player2->execute(array(
            'pseudo' => $pseudo,
            'site' => $lienId    ));
        $this->Player= $Player2->fetch(PDO::FETCH_ASSOC);
        $this->exist = false;
    }
    
    public function canVote() {
        return $this->exist && $this->lienData['temps'] + $this->Player['date_dernier']  < time();
    }
    
    public function confirmVote($bdd) {
        $req = $bdd->prepare('UPDATE cmw_votes SET nbre_votes = nbre_votes + 1, date_dernier = :tmp WHERE pseudo = :pseudo AND site = :site');
        $req->execute(array(
            'tmp' => time(),
            'pseudo' => $this->Player['pseudo'],
            'site' => $this->lienData['id']));
    }

    public function stockVote($bdd, $action, $serveur) {
        if(!isset($action)) {
            $action = $this->lienData['action'];
        }
        if(!isset($serveur)) {
            $serveur = $this->lienData['serveur'];
        }
        $req = $bddConnection->prepare('INSERT INTO cmw_votes_temp (pseudo, action, serveur) VALUES (:pseudo, :action, :serveur)');
        $req->execute(array(
        'pseudo' => $this->Player['pseudo'],
        'action' =>  $action,
        'serveur' => $serveur
        ));
    }

    public function giveRecompense($action, $jsonCon) {
        if(!isset($action)) {
            $action = $this->lienData['action'];
        }

        $lastquantite = "non définie";
        $lastcmd = "non définie";
        $lastid = "non définie";
        $json = json_decode($action, true); 
        foreach($action as $value) { 
            if($value['type'] == "jeton") {
                $lastquantite = $value['value'];
                global $PlayerData, $joueurMaj, $_Joueur_;
                $PlayerData['tokens'] = $PlayerData['tokens'] + ((int)$value['value']);
                $joueurMaj->setReponseConnection($PlayerData);
                $joueurMaj->setNouvellesDonneesTokens($PlayerData);
                $_Joueur_['tokens'] = $_Joueur_['tokens'] + $number;
                $_SESSION['Player']['tokens'] = $_Joueur_['tokens']; 
            } else if($value['type'] == "message") {
                $message = str_replace('{JOUEUR}', $pseudo, str_replace('{CMD}', $lastcmd, str_replace('{QUANTITE}', $lastquantite, str_replace('{ID}', $lastid, str_replace('&amp;', '§', $value['$value'])))));
                if($value['methode'] == "1") {
                    for($j =0; $j < count($jsonCon); $j++)
                    {
                        if(in_array($Player['pseudo'], $jsonCon[$j]->GetServeurInfos()['joueurs'])) 
                        {
                            $jsonCon[$j]->SendBroadcast($message);
                            break;
                        }
                    }
                } else if($value['methode'] == "2") {
                    $jsonCon[$this->lienData['serveur']]->SendBroadcast($message);
                } else if($value['methode'] == "3") {
                    for($j =0; $j < count($jsonCon); $j++)
                    {
                        $jsonCon[$j]->SendBroadcast($message);
                    }
                } 
            } else if($value['type'] == "commande") {
                $cmd = str_replace('{JOUEUR}', $Player['pseudo'], $value['value']);
                if($value['methode'] == "1") {
                    for($j =0; $j < count($jsonCon); $j++)
                    {
                        if(in_array($Player['pseudo'], $jsonCon[$j]->GetServeurInfos()['joueurs'])) 
                        {
                            $jsonCon[$j]->runConsoleCommand($cmd);
                            break;
                        }
                    }
                } else if($value['methode'] == "2") {
                    $jsonCon[$this->lienData['serveur']]->runConsoleCommand($cmd);
                } else if($value['methode'] == "3") {
                    for($j =0; $j < count($jsonCon); $j++)
                    {
                        $jsonCon[$j]->runConsoleCommand($cmd);
                    }
                } 
            } else if($value['type'] == "item") {
                if($value['methode'] == "1") {
                    for($j =0; $j < count($jsonCon); $j++)
                    {
                        if(in_array($Player['pseudo'], $jsonCon[$j]->GetServeurInfos()['joueurs'])) 
                        {
                            $jsonCon[$j]->GivePlayerItem($Player['pseudo'].' '.$value['value'] . ' ' .$value['value2']);
                            break;
                        }
                    }
                } else if($value['methode'] == "2") {
                    $jsonCon[$this->lienData['serveur']]->GivePlayerItem($Player['pseudo'].' '.$value['value'] . ' ' .$value['value2']);
                } else if($value['methode'] == "3") {
                    for($j =0; $j < count($jsonCon); $j++)
                    {
                        $jsonCon[$j]->GivePlayerItem($Player['pseudo'].' '.$value['value'] . ' ' .$value['value2']);
                    }
                } 
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
                $API_call = @file_get_contents("https://serveur-prive.net/api/vote/".$id."/".get_client_ip());
                return $API_call == 1;
            } else if(strpos($url, 'serveurs-minecraft.org'))
            {
                $is_valid_vote = file_get_contents('https://www.serveurs-minecraft.org/api/is_valid_vote.php?id='.$id.'&ip='.get_client_ip().'&duration=5');
                return $is_valid_vote > 0;
            } else if(strpos($url, 'serveurs-minecraft.com'))
            {
                $apiaddr = 'https://serveurs-minecraft.com/api.php?Classement=' . $id .'&ip=' . get_client_ip();
                $apiResult = @file_get_contents($apiaddr);
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
                $data = file_get_contents ( "https://serveursminecraft.fr/api/api.php?IDServeur=" . $id . "&IP=" . get_client_ip());
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
                $api = json_decode(file_get_contents("https://www.liste-minecraft-serveurs.com/Api/Worker/id_server/".$id."/ip/".get_client_ip()));
                if($api->result == 202){return true;}else{return false;}
            } else if(strpos($url, 'liste-serveurs.fr'))
            {
                $api = json_decode(file_get_contents("https://www.liste-serveurs.fr/api/checkVote/".$id."/".get_client_ip()));
                if($api->success == true){return true;}else{return false;}
            }else if(strpos($url, 'liste-serveur.fr'))
            {
                $api = json_decode(file_get_contents("https://www.liste-serveur.fr/api/hasVoted/".$id."/".get_client_ip()));
                if($api->hasVoted == true){return true;}else{return false;}
            }else if(strpos($url, 'top-serveurs.net'))  {
                $api = json_decode(file_get_contents("https://api.top-serveurs.net/v1/votes/check-ip?server_token=".$id."&ip=".get_client_ip()));
                if($api->success == true){return true;}else{return false;}
            }else if(strpos($url, 'serveursminecraft.org'))  {
                $api =file_get_contents("https://www.serveursminecraft.org/sm_api/peutVoter.php?id=".$id."&ip=".get_client_ip());
                if($api == "true"){return true;}else{return false;}
            }else if(strpos($url, 'https://serveur-multigames.net'))  {
                $api =file_get_contents("https://serveur-multigames.net/api/v2/vote/true/".$id."/".get_client_ip()));
                if($api == "1"){return true;}else{return false;}
            }else if(strpos($url, 'https://minecraft-top.com'))  {
                $api = json_decode(file_get_contents("https://api.minecraft-top.com/v1/vote/".get_client_ip()."/".$id));
                if($api->vote == 1){return true;}else{return false;}
            }else {
                return true;
            }
        } else {
            return true;
        }
    }
}
?>