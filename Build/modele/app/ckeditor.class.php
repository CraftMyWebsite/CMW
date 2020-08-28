<?php 

class ckeditor
{
	public static function verif($content2) {
		$dom = new DOMDocument('1.0');
		$dom->loadHTML($content2);
		$dom->removeChild($dom->doctype);           
		$dom->replaceChild($dom->firstChild->firstChild->firstChild, $dom->firstChild);
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