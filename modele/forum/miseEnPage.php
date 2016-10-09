<?php 
function espacement($contenue)
{
	$contenue = nl2br($contenue);
	return $contenue;
}

function BBCode($contenue)
{
	$contenue = preg_replace("#\[b\](.+)\[/b\]#isU", '<strong>$1</strong>', $contenue);
	$contenue = preg_replace('#\[i\](.+)\[/i\]#isU', '<em>$1</em>', $contenue);
	$contenue = preg_replace('#\[color=(.+)\](.+)\[/color\]#isU', '<span style="color: $1">$2</span>', $contenue);
	$contenue = preg_replace('#\[u\](.+)\[/u\]#isU', '<u>$1</u>', $contenue);
	$contenue = preg_replace('#\[s(?:trike)?\](.+)\[/s(trike)?\]#isU', '<s>$1</s>', $contenue);
	if(preg_match("#\[url\](.+)\[/url\]#isU", $contenue))
	{
		$contenue = preg_replace("#\[url\](.+)\[/url\]#isU", "<a href='$1' target='_blank'>$1</a>", $contenue);
	}
	if(preg_match("#\[url=(.+)\](.+)\[/url\]#isU", $contenue))
	{
		$contenue = preg_replace('#\[url=[\'"](.+)[\'"]\](.+)\[/url\]#isU', "<a href='$1' target='_blank'>$2</a>", $contenue);
	}
	$smiley = array(
		':)',
		':D',
		'x)',
		'xd',
		':excited:',
		';)',
		':embarrassed:',
		'8)',
		':o',
		':(',
		':\'(',
		'<3',
		':angel:',
		':diable',
		':salut:',
		':beer:',
		':cul:',
		':calimero:',
		':vomir:',
		':google:',
		':je sors:',
		':tu sors:',
		':vive moi:',
		':fouet:',
		':caca:',
		':bomb:',
		':p'
		);
	$replace = array(
		'<img src="theme/smileys/1.gif" alt="smiley souriant :)" title=":)" />',
		'<img src="theme/smileys/2.gif" alt=":D" title=":D" />',
		'<img src="theme/smileys/3.gif" alt="x)" title="x)" />',
		'<img src="theme/smileys/4.gif" alt="xD" title="xD" />',
		'<img src="theme/smileys/5.gif" alt="excité" title="excité" />',
		'<img src="theme/smileys/6.gif" alt=";)" title=";)" />',
		'<img src="theme/smileys/11.gif" alt="embarrassé" title="embarrasé" />',
		'<img src="theme/smileys/13.gif" alt="8)" title="8)" />',
		'<img src="theme/smileys/20.gif" alt=":o" title=":o" />',
		'<img src="theme/smileys/23.gif" alt=":(" title=":(" />',
		'<img src="theme/smileys/24.gif" alt=":\'(" title=":\'(" />',
		'<img src="theme/smileys/120.gif" alt="smiley" title="smiley" />',
		'<img src="theme/smileys/36.gif" alt="smiley" title="smiley" />',
		'<img src="theme/smileys/37.gif" alt="smiley" title="smiley" />',
		'<img src="theme/smileys/48.gif" alt="smiley" title="smiley" />',
		'<img src="theme/smileys/51.gif" alt="smiley" title="smiley" />',
		'<img src="theme/smileys/96.gif" alt="smiley" title="smiley" />',
		'<img src="theme/smileys/97.gif" alt="smiley" title="smiley" />',
		'<img src="theme/smileys/98.gif" alt="smiley" title="smiley" />',
		'<img src="theme/smileys/110.gif" alt="smiley" title="smiley" />',
		'<img src="theme/smileys/112.gif" alt="smiley" title="smiley" />',
		'<img src="theme/smileys/117.gif" alt="smiley" title="smiley" />',
		'<img src="theme/smileys/113.gif" alt="smiley" title="smiley" />',
		'<img src="theme/smileys/130.gif" alt="smiley" title="smiley" />',
		'<img src="theme/smileys/151.gif" alt="smiley" title="smiley" />',
		'<img src="theme/smileys/157.gif" alt="smiley" title="smiley" />',
		'<img src="theme/smileys/131.gif" alt="smiley" title="smiley" />'
	);
	$contenue = str_ireplace($smiley, $replace , $contenue);
	$contenue = preg_replace("#[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}#isU", "<a href='mailto:$0'>$0</a>", $contenue);
	return $contenue;
}
?>