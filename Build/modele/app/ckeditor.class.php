<?php 

class ckeditor
{
	public static function verif($content2) {
		if(isset($content2) && !empty($content2)) {
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

			$img = $dom->getElementsByTagName('img');
			foreach($img as $item)
			{
			  	$item->setAttribute("style", "max-width: 100%;height: auto;cursor:pointer;");
			  	$item->setAttribute("onclick", "imageModal(this);");
			}
			$content = $dom->saveHTML(); 
			return $content;
		}
		return "";
	}
}
?>