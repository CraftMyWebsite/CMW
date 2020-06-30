<?php

$Img = new ImgProfil($_Joueur_['id']);
$Img->getImg();
if($Img->modif)
	$Img->removeImg();
header('Location: ?page=profil&profil='.$_Joueur_['pseudo'].'&success=imageRemoved');