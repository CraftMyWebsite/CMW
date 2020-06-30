<?php
require('include/SkinApi/UUIDHelper.class.php');
class ImgProfil
{
	
    private $api;
    private $bdd;
    
    public function __construct($bddConnection)
	{
        $this->bdd = $bddConnection;
        $this->api = new UUIDHelper();
	}
	//$_ImgProfil_->getUrlHeadByPseudo();
	public function getUrlHeadByPseudo($pseudo) {
	    if($pseudo == 'CraftMyWebsite' OR $pseudo == ""){
	        return "https://craftmywebsite.fr/favicon.ico";
	    } else {
	        $info = $this->getInfoByPseudo($pseudo);
	        if(isset($info[1]) && file_exists("utilisateurs/".$info[0]."/profil.".$info[1])) {
	            return "utilisateurs/".$info[0]."/profil.".$info[1];
	        } else if($this->api->isApiEnable()) {
	            $url = $this->getCacheUrlUserFile($info[0], $pseudo);
	            if(!isset($url)) {
	                return "utilisateurs/_default_head.png";
	            }
	            if(!$this->CheckCache("utilisateurs/".$info[0]."/skinHead.png")) {
	              
	                $temp = @imagecreatefrompng($url);
	                $img = imagecreatetruecolor(128, 128);
	                imagealphablending($img, false);
	                imagesavealpha($img, true);
	                imagecopyresampled($img, $temp, 0, 0, 8, 8, 128, 128, 8, 8);
	                imagepng($img, "utilisateurs/".$info[0]."/skinHead.png");
	            }
	            return "utilisateurs/".$info[0]."/skinHead.png";
	            
	        } else {
	            return "utilisateurs/_default_head.png";
	        }
	    }
	}
	
	public function getUrlBodyByPseudo($pseudo) {
	    if($pseudo == 'CraftMyWebsite' OR $pseudo == ""){
	        return "https://craftmywebsite.fr/favicon.ico";
	    } else {
	        $info = $this->getInfoByPseudo($pseudo);
	        if($this->api->isApiEnable()) {
	            $url = $this->getCacheUrlUserFile($info[0], $pseudo);
	            if(!isset($url)) {
	                return "utilisateurs/_default_body.png";
	            }
	            if(!$this->CheckCache("utilisateurs/".$info[0]."/skinBody.png")) {
	                $temp = @imagecreatefrompng($url);
	                $img = imagecreatetruecolor(16, 32);
	                imagealphablending($img, false);
	                imagesavealpha($img, true);
	                imagefill($img, 0, 0, imagecolorallocatealpha($img, 255, 0, 255, 127));
	                imagecopy($img, $temp, 4, 0, 8, 8, 8, 8);                      //Head
	                imagecopy($img, $temp, 4, 8, 20, 20, 8, 12);                   //Body
	                imagecopy($img, $temp, 0, 8, 44, 20, 4, 12);                   //Arm-L
	                imagecopyresampled($img, $temp, 12, 8, 47, 20, 4, 12, -4, 12); //Arm-R
	                imagecopy($img, $temp, 4, 20, 4, 20, 4, 12);                   //Leg-L
	                imagecopyresampled($img, $temp, 8, 20, 7, 20, 4, 12, -4, 12);  //Leg-R
	                imagealphablending($img, true);
	                imagecopy($img, $temp,   4, 0, 40, 8, 8, 8);                   //Hat
	                $img_big = imagecreatetruecolor(256, 512);
	                imagealphablending($img_big, false);
	                imagesavealpha($img_big, true);
	                imagecopyresampled($img_big, $img, 0, 0, 0, 0, 256, 512, 16, 32);
	                imagepng($img, "utilisateurs/".$info[0]."/skinBody.png");
	            }
	            return "utilisateurs/".$info[0]."/skinBody.png";
	            
	        } else {
	            return "utilisateurs/_default_body.png";
	        }
	    }
	}
	
	private function getCacheUrlUserFile($id, $pseudo) {
	    if($this->CheckCache("utilisateurs/".$id."/skinUrl.php"))
	    {
	        include("utilisateurs/".+$id."/skinUrl.php");
	        return $exist ? $url : null;
	    }
	    else {
	        $url = $this->api->getUrlTextureByPseudo($pseudo);
	        if (!is_dir("utilisateurs/".+$id)) {
	            mkdir("utilisateurs/".+$id);
	        }
	        if(!isset($url)) {
	            $file = fopen("utilisateurs/".$id."/skinUrl.php", "w");
	            @ftruncate($file, 0);
	            fwrite($file,"<?php \$url = null; \$exist=false; ?>");
	            fclose($file);
	            return null;
	        }
	        $file = fopen("utilisateurs/".$id."/skinUrl.php", "w");
	        @ftruncate($file, 0);
	        fwrite($file,"<?php \$url = '".$url."'; \$exist=true; ?>");
	        fclose($file);
	        return $url;
	    }
	}
	
	private function getInfoByPseudo($pseudo) {
	    $req = $this->bdd->prepare('SELECT id, img_extension FROM cmw_users WHERE pseudo = :pseudo');
	    $req->execute(array( 
	        'pseudo' => $pseudo
	    ));
	    $fetch = $req->fetch(PDO::FETCH_ASSOC);
	    $return[0] = (string)$fetch['id'];
	    if(isset($fetch['img_extension']))
	    {
	       $return[1] = $fetch['img_extension'];
	    }
	    return $return;
	} 
	
	private function CheckCache($file)
	{
	    return file_exists($file) && filemtime($file) > time() - 345600;
	}
	
    
	public function defineExt($pseudo, $ext)  {
	    $req = $this->bdd->prepare('UPDATE cmw_users SET img_extension = :ext WHERE pseudo = :pseudo');
	    $req->execute(array(
	        'ext' => $ext,
	        'pseudo' => $pseudo
	    ));
	}
	

	public function removeImg($pseudo)
	{
	    $info = $this->getInfoByPseudo($pseudo);
	    if(file_exists('utilisateurs/'.$info[0].'/profil.'.$info[1]))
	    {
    	    unlink('utilisateurs/'.$info[0].'/profil.'.$info[1]);
    		$req = $this->bdd->prepare('UPDATE cmw_users SET img_extension = null WHERE pseudo = :pseudo');
    		$req->execute(array(
    			'pseudo' => $pseudo
    		));
	    }
	}
}
?>