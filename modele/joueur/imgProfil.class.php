<?php
class ImgProfil
{
	
    private $bdd;
    
    public function __construct($bddConnection)
	{
        $this->bdd = $bddConnection;
	}

	public function getUrlHeadByPseudo($pseudo, $s=64): string
    {
	    if($pseudo === 'CraftMyWebsite' || $pseudo === ''){
	        return '/favicon.ico';
	    }

        $info = $this->getInfoByPseudo($pseudo);
        if(isset($info[1]) && file_exists('utilisateurs/' .$info[0]. '/profil.' .$info[1])) {
            return 'utilisateurs/' .$info[0]. '/profil.' .$info[1];
        }

        return 'https://minotar.net/avatar/' . $pseudo . '/' .$s;
    }
	
	public function getUrlBodyByPseudo($pseudo, $s=64): string
    {
	    if($pseudo === 'CraftMyWebsite' || $pseudo === ''){
	        return '/favicon.ico';
	    }

        return 'https://minotar.net/avatar/' .$pseudo. '/' .$s;
    }
	
	private function getInfoByPseudo($pseudo): array
    {
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
	
	public function defineExt($pseudo, $ext): void
    {
	    $req = $this->bdd->prepare('UPDATE cmw_users SET img_extension = :ext WHERE pseudo = :pseudo');
	    $req->execute(array(
	        'ext' => $ext,
	        'pseudo' => $pseudo
	    ));
	}
	

	public function removeImg($pseudo): void
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