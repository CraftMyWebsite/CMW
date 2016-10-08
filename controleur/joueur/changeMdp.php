<?php
    $mdp = uniqid();
    
    $mdp = genMdp();

    function genMdp(){
        $caracAllows = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        return substr(str_shuffle($caracAllows), 0, 5);
    }   

    $register = false;
    for($i = 0; $i < count($jsonCon); $i++)
    {
        if($conEtablie[$i])
            $return = $jsonCon[$i]->GetChat(array(40));
        foreach($return[0]['success'] As $cle => $element)
        {
            if(preg_match('#{READY}#', $element['message']) AND $element['player'] == $_POST['pseudo'])
                $register = true;
        }
    }

    if(!$register){
       header('Location: /?page=erreur&erreur=7');
       exit;
    }


    for($i = 0; $i < count($jsonCon); $i++)
    {
        if($conEtablie[$i])
            $jsonCon[$i]->SendMessage(array($_POST['pseudo'], 'Votre nouveau mdp: '. $mdp));
        $ok = true;
    }
    if($ok == true)
    {    
        $req = $bddConnection->prepare('UPDATE cmw_users SET mdp = :mdp WHERE pseudo = :pseudo');
        $req->execute(array(
            'mdp' => md5(sha1($mdp)),
            'pseudo' => htmlspecialchars($_POST['pseudo'])));            
    }
?>
