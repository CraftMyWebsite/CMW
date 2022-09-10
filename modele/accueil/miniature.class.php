<?php 

class miniature {

	private $bdd;
    private $minia;

	public function __construct($bdd) {
        $this->bdd = $bdd;
        $req = $bdd->query('SELECT * FROM cmw_miniature ORDER BY ordre ASC');
        $this->minia = $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMinia() {
    	return $this->minia;
    }

    private function getMiniaById($id) {
        if(!empty($this->minia)) {
            foreach($this->minia as $value) {
                if($value['id'] == $id) {
                    return $value;
                }
            }
        }
        return null;
    }

     public function upMinia($id) {
        $m = $this->getMiniaById($id);
        if(!empty($this->minia)) {
            foreach($this->minia as $value) {
                if($value['ordre'] == $m['ordre'] +1) {
                    $req = $this->bdd->prepare('UPDATE cmw_miniature SET ordre=:ordre WHERE id=:id');
                    $req->execute(array('ordre' => $m['ordre'] +1, 'id' => $id));
                    
                    $req = $this->bdd->prepare('UPDATE cmw_miniature SET ordre=:ordre WHERE id=:id');
                    $req->execute(array('ordre' => $m['ordre'], 'id' => $value['id']));
                    return;
                }
            }
            
        }
        
    }
    
    public function downMinia($id) {
        $m = $this->getMiniaById($id);
        if(!empty($this->minia)) {
            foreach($this->minia as $value) {
                if($value['ordre'] == $m['ordre'] -1) {
                    $req = $this->bdd->prepare('UPDATE cmw_miniature SET ordre=:ordre WHERE id=:id');
                    $req->execute(array('ordre' => $m['ordre'] -1, 'id' => $id));
                    
                    $req = $this->bdd->prepare('UPDATE cmw_miniature SET ordre=:ordre WHERE id=:id');
                    $req->execute(array('ordre' => $m['ordre'], 'id' => $value['id']));
                    return;
                }
            }
            
        }
    }
    
    private function getMax() {
        $max = 0;
        foreach($this->minia as $value) {
            if($value['ordre'] >= $max) {
                $max = $value['ordre'] +1;
            }
        }
        return $max;
    }
    
    public function createMinia($data) {
        $req = $this->bdd->prepare('INSERT INTO cmw_miniature (message, image, type, lien, ordre) VALUES (:message, :image, :type, :lien, :ordre);');
        $req->execute(array('message' => $data['message'], 'image' => $data['image'], 'type' => $data['type'], 'lien' => $data['lien'], 'ordre' => $this->getMax()));
        
        $req = $this->bdd->query('SELECT id FROM cmw_miniature WHERE id= LAST_INSERT_ID()');
        $req = $req->fetch(PDO::FETCH_ASSOC);
        return $req['id'];
    }
    
    public function supprMinia($id) {
        $m = $this->getMiniaById($id);
        foreach($this->minia as $value) {
            if($value['ordre'] > $m['ordre']) {
                $req = $this->bdd->prepare('UPDATE cmw_miniature SET ordre=:ordre WHERE id=:id');
                $req->execute(array('ordre' => $value['ordre'] -1, 'id' => $value['id']));
            }
        }
        
        $req = $this->bdd->prepare('DELETE FROM cmw_miniature WHERE id=:id');
        $req->execute(array('id' => $id));
    }
    
    public function editMinia($data, $id) {
        $req = $this->bdd->prepare('UPDATE cmw_miniature SET message=:message, image=:image, type=:type, lien=:lien WHERE id=:id');
        $req->execute(array('id' => $id, 'message' => $data['message'], 'image' => $data['image'], 'type' => $data['type'], 'lien' => $data['lien']));
    }

}

 ?>
