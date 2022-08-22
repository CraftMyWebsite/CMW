<?php

class profil
{
    private $player;
    private $isOwner = false;
    private $isOnline = false;
    private $reseau;
    
    public function __construct($bddConnection)
    {	
        global $_GET;
        global $jsonCon;
        global $_Joueur_;
        
        $pseudo = null;
        
        if(isset($_GET['profil'])) {
            $pseudo = $_GET['profil'];
            if(isset($_Joueur_) && $_Joueur_['pseudo'] == $_GET['profil']) {
                $this->isOwner = true;
            }
        } else {
            if(isset($_Joueur_)) {
                $pseudo = $_Joueur_['pseudo'];
                $this->isOwner = true;
            }
            else {
                header('Location: index.php?page=erreur&erreur=19&type=Profil&titre='.htmlspecialchars('Utilisateur inexistant !').'&contenue='.htmlspecialchars("L'utilisateur recherché est inexistant ou n'est pas connue de nos bases de données ! :("));
                exit();
            }
        }
        
        if(!$this->initPlayer($bddConnection, $pseudo)) {
            header('Location: index.php?page=erreur&erreur=19&type=Profil&titre='.htmlspecialchars('Utilisateur inexistant !').'&contenue='.htmlspecialchars("L'utilisateur recherché est inexistant ou n'est pas connue de nos bases de données ! :("));
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
    
    public function getReseau() {
        return $this->reseau;
    }
    
    private function initPlayer($bddConnection, $pseudo) {
        $req = $bddConnection->prepare('SELECT id, pseudo, email, anciennete, newsletter, rang, age, img_extension, show_email, signature FROM cmw_users WHERE pseudo = :pseudo');
        $req->execute(array('pseudo' => $pseudo));
        $req = $req->fetch(PDO::FETCH_ASSOC);
        if(empty($req) | $req === false) {
            return false;
        }
        
        $this->player = $req;
        
        $req = $bddConnection->prepare('SELECT SUM(nbre_votes) AS nbre_votes FROM cmw_votes WHERE pseudo = :pseudo and isOld=0');
        $req->execute(array('pseudo' => $pseudo));
        $nbre = $req->fetch(PDO::FETCH_ASSOC)['nbre_votes'];
        $this->player['votes'] = (empty($nbre)) ? 0 : $nbre;
        
        $req = $bddConnection->prepare("
            SELECT count(id) as 'count' FROM cmw_forum_post WHERE pseudo=:ps 
            union all 
            SELECT count(id) as 'count' FROM cmw_forum_answer WHERE pseudo=:ps2");
        $req->execute(array('ps' => $pseudo, 'ps2' =>$pseudo));
        $count = 0;
        $req = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach($req as $value) {
            $count += $value['count'];
        }
        $this->player['forum'] = $count;
        
        
        $this->reseau = array();
        
        $req = $bddConnection->query('DESCRIBE cmw_reseaux');
        $req = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach($req as $value) {
            if($value['Field'] != 'id' && $value['Field'] != 'idJoueur') {
                $this->reseau[$value['Field']] = '?';
            }
        }
        
        $req = $bddConnection->prepare('SELECT * FROM cmw_reseaux WHERE idJoueur=:id');
        $req->execute(array('id' => $this->player['id']));
        $req = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach($req as $value) {
            foreach($this->reseau as $key => $value2) {
                if($value[$key] == '' | empty($value[$key])) {
                    $this->reseau[$key] = '?';
                } else {
                    $this->reseau[$key] = $value[$key];
                }
            }
        }
        return true;
    }
    
    
}