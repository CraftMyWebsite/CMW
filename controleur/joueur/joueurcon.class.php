<?php
class JoueurCon
{
	
    public function __construct($id, $pseudo, $email, $rang, $tokens)
    {	
		$_SESSION['Player']['id'] = $id;
		$_SESSION['Player']['pseudo'] = $pseudo;
		$_SESSION['Player']['email'] = $email;
		$_SESSION['Player']['rang'] = $rang;
		$_SESSION['Player']['tokens'] = $tokens;
	}
	
}
?>
