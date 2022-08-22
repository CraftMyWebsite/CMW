<?php
class googleSearchConsole {
    
    public static function call($_Serveur_, $bdd, $full = true) {
        if(!isset($_Serveur_['googleService']['searchConsole']['id'])) {
            $_Serveur_['googleService']['searchConsole']['id'] = self::genKey($_Serveur_);
        }
        
        if($full) {
            global $ZEND_THREAD_SAFE;
            $id=$_Serveur_['googleService']['searchConsole']['id'];
            
            if(file_exists($id.".xml")) {
                if(filemtime($id.".xml") < time() - 86400 * 3) {
                    if($ZEND_THREAD_SAFE) {
                        require_once("modele/google/googleSearchConsole.thread.class.php");
                        $gen = new googleSearchConsoleThread($id, $bdd);
                        $gen->start();
                    } else {
                        $gen = new googleSearchConsole($id, $bdd);
                         $gen->run();
                    }
                }
            } else {
                if($ZEND_THREAD_SAFE) {
                    require_once("modele/google/googleSearchConsole.thread.class.php");
                    $gen = new googleSearchConsoleThread($id, $bdd);
                    $gen->start();
                 $gen->start();
                } else {
                     $gen = new googleSearchConsole($id, $bdd);
                    $gen->run(); 
                }
            }
        }
    }
    
    private $bdd;
    private $id;
    
    public function __construct($id, $bdd)
    {
        $this->bdd = $bdd;
        $this->id = $id;
    }
    
    
    public function run() {
        
        $xml = new DOMDocument( "1.0", "UTF-8" );
        $base = $xml->createElement("urlset");
        
        $base->setAttribute("xmlns","http://www.sitemaps.org/schemas/sitemap/0.9");
        
        require_once('modele/app/urlRewrite.class.php');
        $url = urlRewrite::getSiteUrl();
        
        $pages =$this->listPages($this->bdd);
        
        foreach($pages as $value) {
            $u = $xml->createElement("url");
            $loc = $xml->createElement("loc", $url.$value);
            $lastmod = $xml->createElement("lastmod", date("Y m d"));
            
            $changefreq = null;
            $priority = null;
            
            if($value == "") {
                $changefreq = $xml->createElement("changefreq", "always");
                $priority = $xml->createElement("priority", "1.0");
            } else {
                $changefreq = $xml->createElement("changefreq", "daily");
                $priority = $xml->createElement("priority", "0.5");
            }
            
            $u->appendChild($loc);
            $u->appendChild($lastmod);
            $u->appendChild($changefreq);
            $u->appendChild($priority);
            
            $base->appendChild($u);
        }
        
        $users = $this->listUser($this->bdd);
        foreach($users as $value) {
            $u = $xml->createElement("url");
            $loc = $xml->createElement("loc", $url."profil/".$value);
            $lastmod = $xml->createElement("lastmod", date("Y m d"));

            $changefreq = $xml->createElement("changefreq", "daily");
            $priority = $xml->createElement("priority", "0.3");
  
            $u->appendChild($loc);
            $u->appendChild($lastmod);
            $u->appendChild($changefreq);
            $u->appendChild($priority);
            
            $base->appendChild($u);
        }
        
        $xml->appendChild($base);
        
        $xml->save($this->id.".xml");
        file_put_contents("robots.txt", "User-Agent: *\r\nDisallow: /admin\r\nDisallow: /admin.php\r\nDisallow: /installation\r\nSitemap: ".$url.$this->id.".xml");
    }
    
    private function listUser($bdd) {
        $req = $bdd->query("SELECT * FROM cmw_users");
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    
    private function listPages($bdd) {
        
        require_once("modele/app/page.class.php");
        $page = new page();
        $pages = $page->getPagesName();
        
        array_push($pages, "");
        array_push($pages, "boutique");
        array_push($pages, "voter");
        array_push($pages, "tokens");
        array_push($pages, "forum");
        array_push($pages, "support");
        array_push($pages, "chat");
        array_push($pages, "membres");
        array_push($pages, "panier");
        array_push($pages, "banlist");

        $req = $bdd->query("SELECT id FROM `cmw_forum_categorie` WHERE `perms` = 0");
        $forum_cat = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach($forum_cat as $value) {
            array_push($pages, "forum_categorie/".$value['id']);
        }
        
        $req = $bdd->query("SELECT id, id_categorie FROM `cmw_forum_sous_forum` WHERE `perms` = 0");
        $sous_forum_cat = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach($sous_forum_cat as $value) {
            array_push($pages, "sous_forum_categorie/".$value['id_categorie']."/".$value['id']);
        }
        
        $req = $bdd->query("SELECT id FROM `cmw_forum_post` WHERE `perms` = 0");
        $post = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach($post as $value) {
            array_push($pages, "post/".$value['id']);
        }
        
        return $pages;
    }
    
    public static function genKey($_Serveur_) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = strlen($characters);
        $ran = "";
        for ($i = 0; $i < 10; $i++) {
            $ran .= $characters[rand(0, $length - 1)];
        }
        
        $_Serveur_['googleService']['searchConsole']['id']  = "siteMap-".$ran;
        require_once('modele/config/yml.class.php');
        $ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);
        return $_Serveur_;
    }
    
    
}