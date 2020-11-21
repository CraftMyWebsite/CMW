<?php
class JoueurCon
{
	
    public function __construct($id, $pseudo, $email, $rang, $tokens, $reco, $mdp, $cmw = false)
    {	
		$_SESSION['Player']['id'] = $id;
		$_SESSION['Player']['pseudo'] = $pseudo;
		$_SESSION['Player']['email'] = $email;
		$_SESSION['Player']['rang'] = $rang;
		$_SESSION['Player']['tokens'] = $tokens;
		if($reco != NULL)
		{
			setcookie('id', $id, time() + 31536000, '/', null, false, false);
			setcookie('pass', $mdp, time() + 31536000, '/', null, false, false);
		}
		if($cmw == true)
			$_SESSION['Player']['cmw'] = true;
	}
	
}
?>
