<?php 
function espacement($contenue)
{
	$contenue = nl2br($contenue);
	return $contenue;
}

function BBCode($contenue, $bdd)
{
	$contenue = preg_replace("#\[hr\]#isU", '<hr>', $contenue);
	$contenue = preg_replace("#\[b\](.+)\[/b\]#isU", '<strong>$1</strong>', $contenue);
	$contenue = preg_replace('#\[i\](.+)\[/i\]#isU', '<em>$1</em>', $contenue);
	$contenue = preg_replace('#\[color=(.+)\](.+)\[/color\]#isU', '<span style="color: $1">$2</span>', $contenue);
	$contenue = preg_replace('#\[u\](.+)\[/u\]#isU', '<u>$1</u>', $contenue);
	$contenue = preg_replace('#\[s(?:trike)?\](.+)\[/s(trike)?\]#isU', '<s>$1</s>', $contenue);
	$contenue = preg_replace('#\[center\](.+)\[/center\]#isU', '<center>$1</center>', $contenue);
	$contenue = preg_replace('#\[font=(.+)\](.+)\[/font=(.+)\]#isU', '<span style="font-size:$1em;">$2</span>', $contenue);
	$contenue = preg_replace('#\[center\](.+)\[/center\]#isU', '<p class="text-center" style="margin-bottom: 1px">$1</p>', $contenue);
	$contenue = preg_replace('#\[right\](.+)\[/right\]#isU', '<p class="text-right" style="margin-bottom: 1px">$1</p>', $contenue);
	$contenue = preg_replace('#\[left\](.+)\[/left\]#isU', '<p class="text-left" style="margin-bottom: 1px">$1</p>', $contenue);
	$contenue = preg_replace('#\[justify\](.+)\[/justify\]#isU', '<p class="text-justify" style="margin-bottom: 1px">$1</p>', $contenue);
	$contenue = preg_replace('#\[img\](.+)\[/img\]#isU', '<img class="img-fluid" src="$1"/>', $contenue);
	$contenue = preg_replace('#\[img=(.+)\](.+)\[/img\]#isU', '<img class="img-fluid" src="$1" title="$2"/>', $contenue);
	while(preg_match('#\[spoiler(.*)\](.+)\[/spoiler\]#isU', $contenue))
	{
		$uniqueId = uniqid();
		$contenue = preg_replace('#\[spoiler=(.+)\](.+)\[/spoiler\]#isU', '<a class="btn btn-primary" data-toggle="collapse" href="#spoiler'.$uniqueId.'" role="button" aria-expanded="false" aria-controls="spoiler'.$uniqueId.'">$1</a><div class="collapse" id="spoiler'.$uniqueId.'"><div class="card card-body"<p style="margin-bottom: 0px;">$2</p></div></div>', $contenue, 1);
		$uniqueId = uniqid();
		$contenue = preg_replace('#\[spoiler\](.+)\[/spoiler\]#isU', '<a class="btn btn-primary" data-toggle="collapse" href="#spoiler'.$uniqueId.'" role="button" aria-expanded="false" aria-controls="spoiler'.$uniqueId.'">Spoiler</a><div class="collapse" id="spoiler'.$uniqueId.'"><div class="card card-body"><p style="margin-bottom: 0px;">$1</p></div></div>', $contenue, 1);
	}
	if(preg_match("#\[url\](.+)\[/url\]#isU", $contenue))
	{
		$contenue = preg_replace("#\[url\](.+)\[/url\]#isU", "<a href='$1' target='_blank'>$1</a>", $contenue);
	}
	if(preg_match("#\[url=(.+)\](.+)\[/url\]#isU", $contenue))
	{
		$contenue = preg_replace('#\[url=(.+)\](.+)\[/url\]#isU', "<a href='$1' target='_blank'>$2</a>", $contenue);
	}
	$contenue = preg_replace("#[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}#isU", "<a href='mailto:$0'>$0</a>", $contenue);
	$req = $bdd->query('SELECT symbole, image FROM cmw_forum_smileys ORDER BY priorite DESC');
	$fetch = $req->fetchAll();
	$symbole = array();
	$replace = array();
	foreach($fetch as $key => $data)
	{
		array_push($symbole, $fetch[$key]['symbole']);
		array_push($replace, '<img src="'.$fetch[$key]['image'].'" alt="smiley" title="smiley" />');

	}
	$contenue = str_ireplace($symbole, $replace , $contenue);
	return $contenue;
}

function getDonnees($bdd)
{
	$req = $bdd->query('SELECT symbole, image FROM cmw_forum_smileys ORDER BY priorite DESC');
	$fetch = $req->fetchAll();
	$smiley = array('symbole' => array(), 'image' => array());
	foreach($fetch as $key => $data)
	{
		array_push($smiley['symbole'], $fetch[$key]['symbole']);
		array_push($smiley['image'], $fetch[$key]['image']);
	}
	return $smiley;
}
?>