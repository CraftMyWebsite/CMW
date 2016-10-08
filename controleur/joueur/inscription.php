<?php
if(isset($_POST['pseudo']) AND isset($_POST['mdp']) AND isset($_POST['mdpConfirm']) AND isset($_POST['email']) AND !empty($_POST['pseudo']) AND !empty($_POST['mdp']) AND !empty($_POST['mdpConfirm']) AND !empty($_POST['email']))
{
	session_start();
	function checkCaptcha($response)
	{
		if (isset($_SESSION['captcha_login_form']) && strtolower($_SESSION['captcha_login_form']) === strtolower($response))
		{
			$res = true;
		}
		else
		{
			$res = false;
		}
		unset($_SESSION['captcha_login_form']); 
		return $res;
	}

	function get_client_ip_env() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP')) {
			$ipaddress = getenv('HTTP_CLIENT_IP');
		} else if(getenv('HTTP_X_FORWARDED_FOR')) {
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		} else if(getenv('HTTP_X_FORWARDED')) {
			$ipaddress = getenv('HTTP_X_FORWARDED');
		} else if(getenv('HTTP_FORWARDED_FOR')) {
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		} else if(getenv('HTTP_FORWARDED')) {
			$ipaddress = getenv('HTTP_FORWARDED');
		} else if(getenv('REMOTE_ADDR')) {
			$ipaddress = getenv('REMOTE_ADDR');
		} else {
			$ipaddress = '0.0.0.0';
		}
		return $ipaddress;
	}


	if (isset($_POST['CAPTCHA']) AND $_POST['CAPTCHA'] != ''){
		if (checkCaptcha($_POST['CAPTCHA'])){
			$_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
			$_POST['mdp'] = htmlspecialchars($_POST['mdp']);
			$_POST['mdpConfirm'] = htmlspecialchars($_POST['mdpConfirm']);
			$_POST['email'] = htmlspecialchars($_POST['email']);
			$get_CleUnique = md5(microtime(TRUE)*100000);
			$get_Pseudo = $_POST['pseudo'];
			$get_Mail = $_POST['email'];
			$get_Lien = 'http://'.$_SERVER['HTTP_HOST'].'/index.php?&action=validationMail&pseudo='.urlencode($get_Pseudo).'&cle='.urldecode($get_CleUnique).'';
			$getIp = get_client_ip_env();
			
			
			if(strlen($_POST['pseudo']) > 16) {
				header('Location: ?&page=erreur&erreur=2');
			} elseif($_POST['mdp'] != $_POST['mdpConfirm']) {
				header('Location: ?&page=erreur&erreur=3');
			} else {
				$get_Mdp = $_POST['mdp'];
				$_POST['mdp'] = md5(sha1($_POST['mdp']));
				
				$bddConnection = $base->getConnection();
				require_once('modele/joueur/connection.class.php');
				$userConnection = new Connection($_POST['pseudo'], $bddConnection);
				$ligneReponse = $userConnection->getReponseConnection();
				$donneesJoueur = $ligneReponse->fetch();

				if(empty($donneesJoueur['pseudo']))
				{
					require_once('modele/joueur/ScriptBySprik07/connectionPerIP.class.php');
					$req_connexionPerIp = new ConnectionPerIP($getIp, $bddConnection);
					$rep_connexionPerIp = $req_connexionPerIp->getReponseConnection();
					$ConnectionPerIp = $rep_connexionPerIp->fetch();

					require_once('modele/joueur/ScriptBySprik07/countIpBDD.class.php');
					$req_countIpBdd = new CountIpBdd($getIp, $bddConnection);
					$rep_countIpBdd = $req_countIpBdd->getReponseConnection();
					$CountIpBdd = $rep_countIpBdd->rowCount();
					
					require_once('modele/joueur/ScriptBySprik07/reqLimitePerIP.class.php');
					$req_limiteIpBdd = new LimiteIpBdd($bddConnection);
					$rep_limiteIpBdd = $req_limiteIpBdd->getReponseConnection();
					$get_limiteIpBdd = $rep_limiteIpBdd->fetch();
					$LimiteIpBdd = $get_limiteIpBdd['nbrPerIP'];

					if($CountIpBdd < $LimiteIpBdd)
					{
						if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
						{

							require_once('modele/joueur/ScriptBySprik07/reqSysMail.class.php');
							$req_apiMailBdd = new GetApiMailBdd($bddConnection);
							$rep_apiMailBdd = $req_apiMailBdd->getReponseConnection();
							$get_apiMailBdd = $rep_apiMailBdd->fetch();
							$ApiMailBdd['fromMail'] = $get_apiMailBdd['fromMail'];
							$ApiMailBdd['sujetMail'] = $get_apiMailBdd['sujetMail'];
							$ApiMailBdd['msgMail'] = $get_apiMailBdd['msgMail'];
							$ApiMailBdd['strictMail'] = $get_apiMailBdd['strictMail'];
							$ApiMailBdd['etatMail'] = $get_apiMailBdd['etatMail'];

							require_once('modele/joueur/ScriptBySprik07/countEmailBDD.class.php');
							$req_countEmailBdd = new CountEmailBdd($get_Mail, $bddConnection);
							$rep_countEmailBdd = $req_countEmailBdd->getReponseConnection();
							$CountEmailBdd = $rep_countEmailBdd->rowCount();

							if ($ApiMailBdd['etatMail'] == "1") {

								if($CountEmailBdd > $ApiMailBdd['strictMail'])
								{
									header('Location: ?&page=erreur&erreur=15');
									exit();
								}
								
								require_once('modele/joueur/inscription.class.php');
								$userInscription = new Inscription($_POST['pseudo'], $_POST['mdp'], $_POST['email'], time(), 1, 0, $getIp, $bddConnection);

								require_once('modele/joueur/ScriptBySprik07/inscriptionCleUnique.class.php');
								$userInsertIP = new InsertCleUnique($get_CleUnique, $get_Pseudo, $bddConnection);

								$destinataire = $get_Mail;
								
								if(!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $destinataire))
								{
									$next_line = "\r\n";
								}
								else
								{
									$next_line = "\n";
								}

								$mail_txt = $ApiMailBdd['msgMail'];
								$mail_txt = str_replace('{JOUEUR}', $get_Pseudo, str_replace('{LIEN}', $get_Lien, str_replace('{IP}', $getIp, str_replace('{MDP}', $get_Mdp, $mail_txt))));
								$mail_txt = strip_tags($mail_txt);

								$sujet = $ApiMailBdd['sujetMail'];

								$entete = "From: ".$ApiMailBdd['fromMail'].$next_line;
								$entete.= "Reply-To: ".$destinataire.$next_line;
								$entete.= "X-Mailer: PHP/".phpversion().$next_line;
								$entete.= "MIME-Version: 1.0".$next_line;

								$message= $next_line.$mail_txt.$next_line;

								mail($destinataire, $sujet, $message, $entete);
								header('Location: ?&WaitActivate=true');
								exit();

							} else {

								require_once('modele/joueur/inscription.class.php');
								$userInscription = new Inscription($_POST['pseudo'], $_POST['mdp'], $_POST['email'], time(), 1, 0, $getIp, $bddConnection);

								require_once('modele/joueur/ScriptBySprik07/inscriptionValidateMail.class.php');
								$userValidateMail = new UserValidateMail($get_Pseudo, $bddConnection);

								$userConnection = new Connection($_POST['pseudo'], $bddConnection);
								$ligneReponse = $userConnection->getReponseConnection();
								
								$donneesJoueur = $ligneReponse->fetch();
								require_once('controleur/joueur/joueurcon.class.php');
								$utilisateur_connection = new JoueurCon($donneesJoueur['id'], $donneesJoueur['pseudo'], $donneesJoueur['email'], $donneesJoueur['rang'], $donneesJoueur['tokens']);
								header('Location: index.php');
								
							}
						}
						else
						{
							header('Location: ?&page=erreur&erreur=11');
						}
					}
					else
					{
						header('Location: ?&page=erreur&erreur=10');
					}
				}
				else
				{
					header('Location: ?&page=erreur&erreur=1');
				}
			}
		}
		else
		{
			header('Location: ?&page=erreur&erreur=8');
		}
	}
	else
	{
		header('Location: ?&page=erreur&erreur=0');
	}
}
else
{
	header('Location: ?&page=erreur&erreur=0');
}
?>