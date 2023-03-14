<?php

if (isset($_FILES['img_profil']) && $_FILES['img_profil']['error'] == 0) {
    require_once './controleur/images.class.php';

    $fileName = htmlspecialchars($_FILES['img_profil']['name']);
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileName = mb_substr(basename( $fileName, $fileExtension ), 0, -1);

    if(Images::upload($_FILES['img_profil'], 'utilisateurs/' . $_Joueur_['id'], false, 'profil')){
        $_ImgProfil_->removeImg($_Joueur_['pseudo']);
        $_ImgProfil_->defineExt($_Joueur_['pseudo'], $fileExtension);

        header('Location: index.php?page=profil&profil='.$_Joueur_['pseudo'].'&status=3');
    }

    header('Location: index.php?page=profil&profil='.$_Joueur_['pseudo'].'&status=4');

}

