<?php 

class ckeditor
{
	public static function verif($content2) {
		$content = htmlspecialchars_decode($content2);
		while(($pos = stripos($content,"<script"))!==false){
		    $end_pos = stripos($content,"</script>");
		    $start = substr($content, 0, $pos);
		    $end = substr($content, $end_pos+strlen("</script>"));
		    $content = $start.$end;
		}
		$content = strip_tags($content);
		while(($pos = stripos($content,"<?"))!==false){
		    $end_pos = stripos($content,"?>");
		    $start = substr($content, 0, $pos);
		    $end = substr($content, $end_pos+strlen("?>"));
		    $content = $start.$end;
		}
		$content = strip_tags($content);
		return $content;
	}
}
?>