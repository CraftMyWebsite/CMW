<?php
class menu {
    
    private $bdd;
    private $menu;
    
    public function __construct($bdd) {
        $this->bdd = $bdd;
        $req = $bdd->query("SELECT * FROM cmw_menu ORDER BY ordre ASC");
        $this->menu = $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMenuGroup() {
        $ret = array();
        foreach($this->menu as $value) {
            if($value['dest'] == -1) {
                if(!isset($value['url'])) {
                    $value['list'] = array();
                    foreach($this->menu as $value2) {
                        if($value2['dest'] == $value['id']) {
                            array_push($value['list'], $value2);
                        }
                    }
                }
                array_push($ret, $value);
            }
        }
        return $ret;
    }
    
    private function getMenuById($id) {
        if(!empty($this->menu)) {
            foreach($this->menu as $value) {
                if($value['id'] == $id) {
                    return $value;
                }
            }
        }
        return null;
    }
    
    public function upMenu($id) {
        $m = $this->getMenuById($id);
        if(!empty($this->menu)) {
            foreach($this->menu as $value) {
                if($value['ordre'] == $m['ordre'] +1 && $m['dest'] == $value['dest']) {
                    $req = $this->bdd->prepare("UPDATE cmw_menu SET ordre=:ordre WHERE id=:id");
                    $req->execute(array("ordre" => $m['ordre'] +1, "id" => $id));
                    
                    $req = $this->bdd->prepare("UPDATE cmw_menu SET ordre=:ordre WHERE id=:id");
                    $req->execute(array("ordre" => $m['ordre'], "id" => $value['id']));
                    return;
                }
            }
            
        }
        
    }
    
    public function downMenu($id) {
        $m = $this->getMenuById($id);
        if(!empty($this->menu)) {
            foreach($this->menu as $value) {
                if($value['ordre'] == $m['ordre'] -1 && $m['dest'] == $value['dest']) {
                    $req = $this->bdd->prepare("UPDATE cmw_menu SET ordre=:ordre WHERE id=:id");
                    $req->execute(array("ordre" => $m['ordre'] -1, "id" => $id));
                    
                    $req = $this->bdd->prepare("UPDATE cmw_menu SET ordre=:ordre WHERE id=:id");
                    $req->execute(array("ordre" => $m['ordre'], "id" => $value['id']));
                    return;
                }
            }
            
        }
    }
    
    private function getMaxOfDest($dest) {
        $max = 0;
        foreach($this->menu as $value) {
            if($value['dest'] == $dest && $value['ordre'] >= $max) {
                $max = $value['ordre'] +1;
            }
        }
        return $max;
    }
    
    public function getMenuWithDest($dest) {
        $re = array();
        foreach($this->menu as $value) {
            if($value['dest'] == $dest) {
                array_push($re, $value);
            }
        }
        return $re;
    }
    
    public function createMenu($data) {
        $req = $this->bdd->prepare("INSERT INTO cmw_menu (name, dest, url, ordre) VALUES (:name, :dest, :url, :ordre)");
        $req->execute(array("name" => $data['name'], "dest" => $data['dest'], "url" => $data['url'], "ordre" => $this->getMaxOfDest($data['dest'])));
    }

    public function supprMenu($id) {
        $m = $this->getMenuById($id);
        foreach($this->menu as $value) {
            if($value['dest'] == $m['dest'] && $value['ordre'] > $m['ordre']) {
                $req = $this->bdd->prepare("UPDATE cmw_menu SET ordre=:ordre WHERE id=:id");
                $req->execute(array("ordre" => $value['ordre'] -1, "id" => $value['id']));
            }
        }
        
        $req = $this->bdd->prepare("DELETE FROM cmw_menu WHERE id=:id OR dest=:id");
        $req->execute(array("id" => $id));
    }
    
    public function editMenu($data, $id) {
        $req = $this->bdd->prepare("UPDATE cmw_menu SET url=:url, name=:name WHERE id=:id");
        $req->execute(array("id" => $id, "name" => $data['name'], "url" => $data['url']));
    }
    
}