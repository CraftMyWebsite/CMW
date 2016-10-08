
<?php
$menuData = GetTableau($_POST);

$menuLecture = new Lire('modele/config/configMenu.yml');
$menuLecture = $menuLecture->GetTableau();

for($i = 0; $i < count($menuData['nom']); $i++)
{
	$menuLecture['MenuListeDeroulante'][$_POST['titreListe']][$i] = $menuData['nom'][$i];
	
	if($menuData['methode'][$i] == 1)
		$menuLecture['MenuListeDeroulanteLien'][$_POST['titreListe']][$i] = $menuData['lien'][$i];
	elseif($menuData['methode'][$i] == 2)
		$menuLecture['MenuListeDeroulanteLien'][$_POST['titreListe']][$i] = '?page='. $menuData['page'][$i];	
	else
	{
		$menuLecture['MenuListeDeroulanteLien'][$_POST['titreListe']][$i] = $menuData['lien'][$i];
		$menuLecture['MenuListeDeroulante'][$_POST['titreListe']][$i] = '-divider-';
	}	
}
$ecriture = new Ecrire('modele/config/configMenu.yml', $menuLecture);


function GetTableau($post)
{
	$i = 0;
	foreach($post as $cle => $element)
	{
		if (preg_match("#lienTexte#", $cle))
		{
			$menuData['nom'][$i] = $element;
			$i++;
		}
	}
	$i = 0;
	foreach($post as $cle => $element)
	{
		if (preg_match("#menuLien#", $cle))
		{
			$menuData['lien'][$i] = $element;
			$i++;
		}
	}
	$i = 0;
	foreach($post as $cle => $element)
	{
		if (preg_match("#methode#", $cle))
		{
			$menuData['methode'][$i] = $element;
			$i++;
		}
	}
	$i = 0;
	foreach($post as $cle => $element)
	{
		if(preg_match("#page#", $cle))
		{
			$menuData['page'][$i] = $element;
			$i++;
		}
	}
	return $menuData;
}
?>
