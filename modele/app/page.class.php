<?php

class page
{

    private $dir = "include/CustomPage/";
    private $pages = [];
    
    public function __construct()
    {

        if(file_exists($this->dir)) {
            $pages = scandir($this->dir);
            foreach($pages as $value)
            {
                if($value != "." && $value != "..") {
                    if(strtolower(substr($value, -4)) == ".php" && strlen($value) > 4) {
                        array_push($this->pages, substr($value, 0, -4));
                    } else {
                        $this->removePage(substr($value, 0, -4));
                    }
                }
            }
        }
    }
    
    public function exist($name) {
        foreach($this->pages as $value)
        {
            if(strtolower($value) == strtolower($name)) {
                return true;
            }
        }
        return false;
    }
    
    public function changeName($old, $new) {
        return rename($this->getPath($old), $this->getPath($new));
    }
    
    public function print($name, $content) {
        return file_put_contents($this->getPath($name), $content);
    }
    
    public function getPagesName() {
        return $this->pages;
    }
    
    public function getPages() {
        $return = array();
        foreach($this->pages as $value)
        {
            array_push($return, array("titre" => $value, "content" => $this->traitPHP(file_get_contents($this->getPath($value)))));
        }
        
        return $return;
    }
    
    private function insert_at($c, $index, $insert) {
        return substr($c, 0, $index).$insert.substr($c, $index);
    }
    
    public function traitPHP($c) {
        $p = strpos($c, "<?php");
        while($p !== false) {
            $p2 = $p;
            $p = strpos($c, "?>", $p);
            if($p !== false) {
                $p2--;
                while($p2 <= $p) {
                    $p2++;
                    if($c[$p2] == '<') {
                        echo 0;
                        $c[$p2] = '&';
                        $p2++;
                        $p++;
                        $c = $this->insert_at($c, $p2, 'lt;');
                        $p2 = $p2 + 2;
                        $p = $p + 2;
                    } else  if($c[$p2] == '>') {
                        echo 0;
                        $c[$p2] = '&';
                        $p2++;
                        $p++;
                        $c = $this->insert_at($c, $p2, 'gt;');
                        $p2 = $p2 + 2;
                        $p = $p + 2;
                    }
                }
                $p = strpos($c, "<?php", $p);
            }
        }
        return $c;
    }
    
    public function getPath($name) {
        return $this->dir.$name.".php";
    }
    
    public function removePage($filename) {
        $filename = $this->getPath($filename);
        if ( is_link ($filename) ) {
            $sym = @readlink ($filename);
            if ( $sym ) {
                return is_writable ($filename) && @unlink ($filename);
            }
        }
        
        if ( realpath ($filename) && realpath ($filename) !== $filename ) {
            return is_writable ($filename) && @unlink (realpath ($filename));
        }
        
        return is_writable ($filename) && @unlink ($filename);
    }

}
?>
