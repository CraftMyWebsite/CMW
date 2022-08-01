<?php

$_ImgProfil_->removeImg($_Joueur_['pseudo']);
header('Location: profil/' . $_Joueur_['pseudo'] . '/imageRemoved');