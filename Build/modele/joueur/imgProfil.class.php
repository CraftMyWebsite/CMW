<?php
require('include/SkinApi/UUIDHelper.class.php');
class ImgProfil
{
	private $img;
	private $extension;
	private $bdd;
	private $id;
	public $_Serveur_;
	public $modif;
	private $api;

	public function __construct($id, $mode='id')
	{
		global $bddConnection;
		global $_Serveur_;
		$this->_Serveur_ = $_Serveur_;
		$this->bdd = $bddConnection;
		$this->api = new UUIDHelper($id);
		if($mode == 'pseudo')
		{
			if($id == 'CraftMyWebsite')
				$this->id = NULL;
			else
			{
				$req = $bddConnection->prepare('SELECT id FROM  cmw_users WHERE pseudo = :pseudo');
				$req->execute(array(
					'pseudo' => $id
				));
				$fetch = $req->fetch(PDO::FETCH_ASSOC);
				if($fetch['id'] == NULL)
					$this->id = $id;
				else
					$this->id = $fetch['id'];
			}
		}
		else
			$this->id = $id;
		$req = $bddConnection->prepare('SELECT img_extension FROM cmw_users WHERE id = :id');
		$req->execute(array('id' => $this->id));
		$fetch = $req->fetch(PDO::FETCH_ASSOC);
		$this->extension = $fetch['img_extension'];
		
		
	}

	public function getImgToSize($size, &$width, &$height)
	{
		$this->getImg();
		if($this->modif)
		{
			// Constraints
			$max_width = $size;
			$max_height = $size;
			list($width, $height) = getimagesize($this->img);
			$ratioh = $max_height/$height;
			$ratiow = $max_width/$width;
			$ratio = min($ratioh, $ratiow);
			// New dimensions
			$width = intval($ratio*$width);
			$height = intval($ratio*$height);
			return $this->img;
		}
		else
		{
			if(!is_numeric($this->id))
				$pseudo = $this->id;
			else
				$pseudo = $this->getPseudo();
			$this->img = $this->getImageUUID($pseudo, 'head', $size);
			$width = $size;
			$height = $size;
			return $this->img;
		}
	}
	
	
	public function getImageUUID($pseudo, $type, $size)
	{
		$file = 'include/SkinApi/cache/'.$pseudo.'_'.$type.'_size_128.png';
		if(!file_exists("include/SkinApi/cache/"))
		{
			mkdir("include/SkinApi/cache/", 0777, true);
		}
		
		if(isset($this->api->url) && !$this->CheckCache($file) && $this->api->isApiEnable() )
		{
			$url = @imagecreatefrompng($this->api->url);
			if($type == 'body') 
			{
				/**
				* @author Mapcrafter <mapcrafter.org>
				* @link https://github.com/mapcrafter/mapcrafter-playermarkers/blob/c583dd9157a041a3c9ec5c68244f73b8d01ac37a/playermarkers/player.php#L8-L19
				* (body only)
				*/ 
				$size = $size/16;
				$img = imagecreatetruecolor(16, 32);
				imagealphablending($img, false);
				imagesavealpha($img, true);
				imagefill($img, 0, 0, imagecolorallocatealpha($img, 255, 0, 255, 127));
				imagecopy($img, $url, 4, 0, 8, 8, 8, 8);                      //Head
				imagecopy($img, $url, 4, 8, 20, 20, 8, 12);                   //Body
				imagecopy($img, $url, 0, 8, 44, 20, 4, 12);                   //Arm-L
				imagecopyresampled($img, $url, 12, 8, 47, 20, 4, 12, -4, 12); //Arm-R
				imagecopy($img, $url, 4, 20, 4, 20, 4, 12);                   //Leg-L
				imagecopyresampled($img, $url, 8, 20, 7, 20, 4, 12, -4, 12);  //Leg-R
				imagealphablending($img, true);
				imagecopy($img, $url,   4, 0, 40, 8, 8, 8);                   //Hat
				$img_big = imagecreatetruecolor(16*$size, 32*$size);
				imagealphablending($img_big, false);
				imagesavealpha($img_big, true);
				imagecopyresampled($img_big, $img, 0, 0, 0, 0, 16*$size, 32*$size, 16, 32);
				imagepng($img_big, $file);
				return $file;
			} else  if($type == 'head') {
				$img = imagecreatetruecolor($size, $size);
				imagealphablending($img_big, false);
				imagesavealpha($img_big, true);
				imagecopyresampled($img, $url, 0, 0, 8, 8, $size, $size, 8, 8);
				imagepng($img, $file);
				return $file;
			}
		} else if(file_exists($file)){
			return $file;
		} else {
			return 'include/SkinApi/_default_'.$type.'_size_128.png';
		}
	}
	
	public function CheckCache($file) 
	{

		return file_exists($file) && filemtime($file) > time() - 86400;
	}
		
	public function getImgBodyToSize($size, &$width, &$height)
	{
		$this->getImg();
		if($this->modif)
		{
			// Constraints
			$max_width = $size;
			$max_height = $size;
			list($width, $height) = getimagesize($this->img);
			$ratioh = $max_height/$height;
			$ratiow = $max_width/$width;
			$ratio = min($ratioh, $ratiow);
			// New dimensions
			$width = intval($ratio*$width);
			$height = intval($ratio*$height);
			return $this->img;
		}
		else
		{
			if(!is_numeric($this->id))
				$pseudo = $this->id;
			else
				$pseudo = $this->getPseudo();
			$this->img = $this->getImageUUID($pseudo, 'body', $size);
			$width = $size;
			$height = $size;
			return $this->img;
		}
	}

	public function getImg()
	{
		if(file_exists('utilisateurs/'.$this->id.'/profil.'.$this->extension))
		{
			$this->modif = true;
			$this->img = "utilisateurs/".$this->id.'/profil.'.$this->extension;
		}
		elseif($this->id == NULL)
		{
			$this->modif = true;
			$this->img = "https://craftmywebsite.fr/favicon.ico";
		}
		else
		{
			$this->modif = false;

		}
	}

	public function getPseudo()
	{
		$req = $this->bdd->prepare('SELECT pseudo FROM cmw_users WHERE id = :id');
		$req->execute(array(
			'id' => $this->id
		));
		$fetch = $req->fetch(PDO::FETCH_ASSOC);
		return $fetch['pseudo'];
	}

	public function getExtension()
	{
		return $this->extension;
	}

	public function redefineExt($newExt)
	{
		$req = $this->bdd->prepare('UPDATE cmw_users SET img_extension = :extension WHERE id = :id');
		$req->execute(array(
			'extension' => $newExt,
			'id' => $this->id
		));
		$this->extension = $newExt;
	}

	public function removeImg()
	{
		unlink('utilisateurs/'.$this->id.'/profil.'.$this->extension);
		rmdir('utilisateurs/'.$this->id);
		$this->extension = NULL;
		$this->img = NULL;
		$this->modif = false;
		$req = $this->bdd->prepare('UPDATE cmw_users SET img_extension = "" WHERE id = :id');
		$req->execute(array(
			'id' => $this->id
		));
	}
}
?>