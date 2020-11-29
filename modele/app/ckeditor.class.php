<?php 

class ckeditor
{


	public static function verif($content2) {
		if(isset($content2) && !empty($content2)) {
			$dom = new DOMDocument('1.0', 'utf-8');
			$dom->loadHTML(str_replace("[hr]Contenu fusionné[hr]", "",'<?xml encoding="utf-8" ?>'.$content2));
			$dom->removeChild($dom->doctype);           
			foreach ($dom->childNodes as $item)
    		{
	    		self::checkChild($item);
    		}
			return $dom->saveHTML($dom->documentElement);
		}
		return "";
	}

	private static function checkChild($item) {
		if(isset($item->tagName)) {
			$tag = strtolower($item->tagName);
			if(($tag == "script" || $tag == "form") ) {
				$item->parentNode->removeChild($item); 
			} else {
				if($item->attributes != null) {
			    	$length = $item->attributes->length;
					for ($i = 0; $i < $length; ++$i) {
						if($item->attributes->item($i) != null) {
							$n = strtolower($item->attributes->item($i)->name);
							if(strlen($n) > 1) {
								if(substr( $n, 0, 2 ) == "on")
								{
									$item->removeAttribute($item->attributes->item($i)->name);
								}
							}
						}
					}
				}
				if($tag == "img") {
					$item->setAttribute("style", "max-width: 100%;height: auto;cursor:pointer;");
					$item->setAttribute("onclick", "imageModal(this);");
					$str = str_replace(" ", "",$item->getAttribute("src"));
					if(isset($str) && !empty($str)) {
						if(strpos($str, "?action=") | strpos($str, "&action="))
						{
							$item->parentNode->removeChild($item); 
						}
					}
				}
				foreach ($item->childNodes as $item2)
	    		{
	    			if($item2 != null) {
	    				self::checkChild($item2);
	    			}
	    		}
			}
		} else {
			foreach ($item->childNodes as $item2)
	    	{
	    		if($item2 != null) {
	    			self::checkChild($item2);
	    		}
	    	}
		}
	}

}
?>