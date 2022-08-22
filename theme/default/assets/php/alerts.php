<?php
//Vérification d'alerte ^^

if (Permission::getInstance()->verifPerm("connect")) :

    $req_topic = $bddConnection->prepare('SELECT cmw_forum_topic_followed.pseudo, vu, cmw_forum_post.last_answer AS last_answer_pseudo 
    FROM cmw_forum_topic_followed
    INNER JOIN cmw_forum_post WHERE id_topic = cmw_forum_post.id AND cmw_forum_topic_followed.pseudo = :pseudo');
    $req_topic->execute(array(
        'pseudo' => $_Joueur_['pseudo']
    ));

    $alerte = 0;

    while ($td = $req_topic->fetch(PDO::FETCH_ASSOC)) {
        if ($td['pseudo'] != $td['last_answer_pseudo'] and $td['last_answer_pseudo'] != NULL and $td['vu'] == 0) {
            $alerte++;
        }
    }

    $req_answer = $bddConnection->prepare('SELECT vu
    FROM cmw_forum_like INNER JOIN cmw_forum_answer WHERE id_answer = cmw_forum_answer.id
    AND cmw_forum_like.pseudo != :pseudo AND cmw_forum_answer.pseudo = :pseudo AND type = 2');
    $req_answer->execute(array(
        'pseudo' => $_Joueur_['pseudo'],
    ));

    while ($answer_liked = $req_answer->fetch(PDO::FETCH_ASSOC)) {
        if ($answer_liked['vu'] == 0) {
            $alerte++;
        }
    }

endif;

?>