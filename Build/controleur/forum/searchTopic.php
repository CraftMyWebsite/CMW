<?php 
    if(isset($_POST['recherche']))
    {
        require('modele/forum/forum.class.php');
        $_Forum_ = new Forum($bddConnection);

        $recherche = htmlspecialchars($_POST['recherche']);

        echo '[DIV]';
        $req = $bddConnection->prepare('SELECT id as id2, nom, pseudo, date_creation, perms, last_answer FROM cmw_forum_post WHERE cmw_forum_post.nom LIKE :nom OR cmw_forum_post.contenue LIKE :contenue OR cmw_forum_post.last_answer LIKE :last LIMIT 20');
        $req->execute(array(
            'nom' => "%".$recherche.'%',
            'contenue' => '%'.$recherche.'%',
            'last' => '%'.$recherche.'%'
        ));
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $img = new ImgProfil($bddConnection);
        foreach($data as $key => $value) {
            if((Permission::getInstance()->verifPerm('connect') & Permission::getInstance()->verifPerm("createur")) OR ( Permission::getInstance()->verifPerm('connect') & Permission::getInstance()->verifPerm('PermsDefault', 'forum', 'perms') >= $data[$key]['perms']) OR $data[$key]['perms'] == 0)
            {
                $data[$key]['compte'] = $_Forum_->compteReponse($data[$key]['id2']);
                $data[$key]['img'] = $img->getUrlHeadByPseudo($data[$key]['pseudo'], 42);
                $data[$key]['date_creation'] = $_Forum_->conversionDate($data[$key]['date_creation']);
               if (isset($data[$key]['prefix']) && $data[$key]['prefix'] != 0) {
                    $data[$key]['prefix'] = $_Forum_->getPrefix($data[$key]['prefix']);
               }
                                             
            } else {
                unset($data[$key]);
            }
        }

        echo json_encode(array_values($data));
    }
?>