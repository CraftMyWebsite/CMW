<?php 
$version1 = $_Serveur_['General']['version_forum'];
$l_version1 = file_get_contents('http://5.196.162.31/script/version.php?req_v=1');
$l_version1 = substr($l_version1, 3,3);
if($version1 == $l_version1)
{
	$ajour = 1;
}
else
{
	$ajour = 0;
}
?>