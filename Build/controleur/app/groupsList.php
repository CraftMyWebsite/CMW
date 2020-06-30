<?php 
if(isset($jsonCon[0]) AND $conEtablie[0])
foreach($groups As $cle => $element)
{
    if(isset($element['isDefault']) AND $element['isDefault'])
        $isDefault[$cle] = '<br />Ce grade est le grade par défaut !';    
    else
        $isDefault[$cle] = '';


    if(isset($element['canBuild']) AND $element['canBuild'])
        $canBuild[$cle] = 'Ce grade vous apporte le droit de construire !';    
    else
        $canBuild[$cle] = 'Ce grade ne vous permet pas de construire...';
}
$joueursPourGroupe = '<div class="col-md-6"><div class="well group-infos"></div></div>';
?>
