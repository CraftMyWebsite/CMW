<?php

$_ImgProfil_->removeImg($_Joueur_['pseudo']);
header('Location: ?page=profil&profil='.$_Joueur_['pseudo'].'&success=imageRemoved');