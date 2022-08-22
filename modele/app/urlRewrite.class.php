<?php 

class urlRewrite
{


	public static function call() {
	    global $_SERVER, $_GET;
	    if(strrpos($_SERVER['REQUEST_URI'], 'page=') !== false) {
	        $url = self::getSiteUrl();
	        $arg = '';
	        $first = true;
	        foreach($_GET as $key => $value) {
	            if($first) {
	                $first = false;
	                if(!isset($value) | empty($value)) {
	                    $arg .= '/' .$key;
	                } else {
	                   $arg .= $value;
	                }
	            } else {
	                if(!isset($value) | empty($value)) {
	                    $arg .= '/' .$key;
	                } else {
	                   $arg .= '/' .$value;
	                }
	            }
	        }
	        header('Location: ' .$url.$arg);
	    }else if($_SERVER['REQUEST_URI'] == '/index.php') {
	    	 header('Location: ' .self::getSiteUrl());
	    }
	}
	
	public static function getSiteUrl() {
	    global $_SERVER;
	    $uri = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/')+1 );
	    $url = $_SERVER['SERVER_NAME'];
	    $ht = $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';
	    
	    return $ht.$url.$uri;
	}

}
?>