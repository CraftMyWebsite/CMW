<?php

class profil
{
    private $player;
    private $isOwner = false;
    private $isOnline = false;
    
    public function __construct($bddConnection)
    {	
        global $_GET;
        global $jsonCon;
        
        $pseudo = null;
        
        if(isset($_GET['profil'])) {
            $pseudo = $_GET['profil'];
            if(isset($_Joueur_) && $_Joueur_['pseudo'] == $this->player) {
                $this->isOwner = true;
            }
        } else {
            if(isset($_Joueur_)) {
                $pseudo = $_Joueur_['pseudo'];
                $this->isOwner = true;
            }
            else {
                header('Location: erreur/19/Profil/'.htmlspecialchars("Utilisateur inexistant !").'/'.htmlspecialchars("L'utilisateur recherché est inexistant ou n'est pas connue de nos bases de données ! :("));
                exit();
            }
        }
        
        if(!$this->initPlayer($bddConnection, $pseudo)) {
            header('Location: erreur/19/Profil/'.htmlspecialchars("Utilisateur inexistant !").'/'.htmlspecialchars("L'utilisateur recherché est inexistant ou n'est pas connue de nos bases de données ! :("));
            exit();
        }
        
        
        for($j =0; $j < count($jsonCon); $j++)
        {
            if(!empty($jsonCon[$j]->GetServeurInfos()['joueurs']) && is_array($jsonCon[$j]->GetServeurInfos()['joueurs']) && in_array($this->player, $jsonCon[$j]->GetServeurInfos()['joueurs']))
            {
                $this->isOnline = true;
                break;
            }
        }     
    }
    
    public function isOnline() {
        return $this->isOnline;
    }
    
    public function isOwner() {
        return $this->isOwner;
    }
    
    public function getPlayer() {
        return $this->player;
    }
    
    private function initPlayer($bddConnection, $pseudo) {
        $req = $bddConnection->prepare("SELECT id, pseudo, email, anciennete, newsletter, rang, age, img_extension, show_email, signature FROM cmw_users WHERE pseudo = :pseudo");
        $req->execute(array('pseudo' => $pseudo));
        $req = $req->fetch(PDO::FETCH_ASSOC);
        if(empty($req) | $req === false) {
            return false;
        }
        $this->player = $req;
        return true;
    }
    
    
}