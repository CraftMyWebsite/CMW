<?php
class Copie
{
	private $dir;
	private $file;
	private $tailleMax;
	private $types;
	private $width;
	private $height;
	
    public function __construct($dir, $file, $tailleMax, $types, $width, $height)
    {	
		$this->dir = $dir;
		$this->file = $file;
		$this->tailleMax = $tailleMax;
		$this->types = $types;
		$this->width = $width;
		$this->height = $height;
	}
	
	public function Verification()
	{
		$extension = strtolower(substr(strrchr($this->file['name'], '.'),1));
		
		if(in_array($extension, $this->types))
			$dimension = getimagesize($this->file['tmp_name']);
		else
			return 1;
		
		if($this->file['error'] > 0) 
			return 0;
		elseif($this->file['size'] > $this->tailleMax)
			return 2;		
		elseif($dimension[0] > $this->width OR $dimension[1] > $this->height)
			return 3;
		else
			return 4;
	}
	
	public function Copie()
	{
		$dir = $this->dir . $this->file['name'];
		$copie = move_uploaded_file($this->file['tmp_name'], $dir);
		if($copie) return true;
		else return false;
	}

    public function SetName($name)
    {
        $this->file['name'] = $name;
    }
}
?>
