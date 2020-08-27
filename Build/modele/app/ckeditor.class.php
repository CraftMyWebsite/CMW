<?php 

class ckeditor
{
	public static function verif($content2) {


		$content = htmlspecialchars_decode($content2);
		while(($pos = stripos($content,"<?"))!==false){
		    $end_pos = stripos($content,"?>");
		    $start = substr($content, 0, $pos);
		    $end = substr($content, $end_pos+strlen("?>"));
		    $content = $start.$end;
		}
		$content = strip_tags($content);
		$dom = new DOMDocument();
		$dom->loadHTML($content);
		$script = $dom->getElementsByTagName('script');
		$remove = [];
		foreach($script as $item)
		{
		  	$remove[] = $item;
		}
		foreach ($remove as $item)
		{
		  $item->parentNode->removeChild($item); 
		}
		$content = $dom->saveHTML();
		return $content;
	}
}
?>