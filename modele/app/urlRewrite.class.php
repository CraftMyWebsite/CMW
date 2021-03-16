<?php 

class urlRwrite
{


	public static function call() {
	    global $_SERVER, $_GET;
	    if(strrpos($_SERVER['REQUEST_URI'], "page=") !== false) {
	        $uri = substr($_SERVER["SCRIPT_NAME"], 0, strrpos($_SERVER["SCRIPT_NAME"], '/')+1 );
	        $url = $_SERVER['SERVER_NAME'];
	        $ht = $_SERVER["HTTPS"] == "on" ? "https://" : "http://";
	        $arg = "";
	        $first = true;
	        foreach($_GET as $value) {
	            if($first) {
	                $first = false;
	                $arg .= $value;
	            } else {
	                $arg .= "/".$value;
	            }
	        }
	        header("Location: ".$ht.$url.$uri.$arg);
	    } 
	    
	}

}
?>