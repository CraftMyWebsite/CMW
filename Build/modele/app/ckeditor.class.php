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
			foreach($script as $item)
			{
			  	$item->parentNode->removeChild($item); 
			}

			$script = $dom->getElementsByTagName('form');
			foreach($script as $item)
			{
			  	$item->parentNode->removeChild($item); 
			}

			$img = $dom->getElementsByTagName('img');
			foreach($img as $item)
			{
			  	$item->setAttribute("style", "max-width: 100%;height: auto;cursor:pointer;");
			  	$item->setAttribute("onclick", "imageModal(this);");
			  	$str = str_replace(" ", "",$item->getAttribute("src"));
			  	if(isset($str) && !empty($str)) {
			  		if(strpos($str, "?action=") strpos($str, "&action="))
			  		{
			  			$item->parentNode->removeChild($item); 
			  		}
			  	}
			}
			$content = $dom->saveHTML(); 
			return $content;
		}
		return "";
	}

}
?>