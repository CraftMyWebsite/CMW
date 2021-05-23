<?php
/*
	Cette classe récupère un tableau de données à partir des sessions.
	Le but étant d'obtenir un nom de variable plus facile à utiliser.
*/

class Joueur
{
    private $_Joueur_ = null;
    
    public function __construct($bdd)
    {
        if(isset($_SESSION['Player']['pseudo'])) {
            if($_SESSION['Player']['temp'] < time() - 60) {
                $req = $bdd->prepare('SELECT * FROM cmw_users WHERE id = :id');
                $req->execute(array(
                    'id' => $_SESSION['Player']['id']
                ));
                $fetch = $req->fetch(PDO::FETCH_ASSOC);
                $this->setArraySession($fetch);
                if(!isset($_SESSION['Player']['uuid'])) {
                    $this->pickupUUID($bdd);
                }
            }
            $this->setArrayUser();
        } else {
            if(isset($_COOKIE['token'])) {
                $token = $_COOKIE['token'];
                if($this->isValidToken($token)) {
                    $user = $this->tokenExist($bdd, $token);
                    if(isset($user) && !empty($user)) {
                        $this->setArraySession($user);
                        $this->setArrayUser();
                        if(!isset($_SESSION['Player']['uuid'])) {
                            $this->pickupUUID($bdd);
                        }
                        $this->defineToken($bdd, $_SESSION['Player']['id']);
                    }
                }
            }
        }
        
    }
    
    public function createUser($bdd, $donnees, $reco) {
        $this->setArraySession($donnees);
        if($reco) {
            $this->defineToken($bdd, $donnees['id']);
        }
    }
    
    private function defineToken($bdd, $id) {
        do {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $token = '';
            for ($i = 0; $i < 16; $i++) {
                $token .= $characters[rand(0, $charactersLength - 1)];
            }
            $token .= "-".time();
        } while($this->tokenExist($bdd, $token) != null);
        
        $req = $bdd->prepare("UPDATE `cmw_users` SET `token`=:token WHERE id=:id");
        $req->execute(array("id" => $id, "token" => $token));
        setcookie('token', $token, time() + 31536000, '/', null, true,true);
    }
    
    private function setArraySession($fetch) {
        $_SESSION['Player'] = array(
            'id' => $fetch['id'],
            'pseudo' => $fetch['pseudo'],
            'email' => $fetch['email'],
            'rang' => $fetch['rang'],
            'tokens' => $fetch['tokens'],
            'uuid' => $fetch['UUID'],
            'uuidf' => $fetch['UUIDF'],
            'temp' => time()
        );
    }
    
    private function setArrayUser() {
        $this->_Joueur_ = array(
            'id' => $_SESSION['Player']['id'],
            'pseudo' => $_SESSION['Player']['pseudo'],
            'rang' => $_SESSION['Player']['rang'],
            'email' => $_SESSION['Player']['email'],
            'tokens' => $_SESSION['Player']['tokens'],
            'uuid' => $_SESSION['Player']['uuid'],
            'uuidf' => $_SESSION['Player']['uuidf']
        );
    }
    
    private function isValidToken($token) {
        $part = explode('-', $token);
        if(count($part) == 2 ) {
            return ((string) (int) $part[1] === $part[1])
            && ($part[1] <= PHP_INT_MAX)
            && ($part[1] >= ~PHP_INT_MAX) && strlen($part[0]) == 16;
        } else {
            return false;
        }
    }
    
    private function tokenExist($bdd, $token) {
        $req = $bdd->prepare("SELECT * FROM cmw_users WHERE token=:token");
        $req->execute(array("token"=>$token));
        if(!empty($req)) {
            return $req->fetch(PDO::FETCH_ASSOC);
        }
        return null;
    }
    
    public function destroy() {
        unset($_SESSION);
        unset($_COOKIE);
        session_destroy();
        setcookie('token', null, time(), '/', null, true, true);
        
    }
    
    public function getUser()
    {
        return $this->_Joueur_;
    }
    
    private function pickupUUID($bdd) {
        require_once("modele/vote.class.php");
        $UUID = vote::fetch("https://api.mojang.com/users/profiles/minecraft/".$_SESSION['Player']['pseudo']);
        
        if ($UUID != NULL) {
            $obj = json_decode($UUID);
            $UUID = $obj->{'id'};
        }
        
        //CONVERSION UUIDF
        if ($UUID != "INVALIDE") {
            $UUIDF = substr_replace($UUID, "-", 8, 0);
            $UUIDF = substr_replace($UUIDF, "-", 13, 0);
            $UUIDF = substr_replace($UUIDF, "-", 18, 0);
            $UUIDF = substr_replace($UUIDF, "-", 23, 0);
        }else{
            $UUIDF = "INVALIDE";
            $UUID = "INVALIDE";
        }
        
        $requetebdduuid2 = $bdd->prepare('UPDATE cmw_users SET UUID = :uuid, UUIDF = :uuidf WHERE pseudo = :pseudo;');
        
        $requetebdduuid2->execute(Array (
            'pseudo' => $_SESSION['Player']['pseudo'],
            'uuid' => $UUID,
            'uuidf' => $UUIDF
            
        ));
    }
}
?>