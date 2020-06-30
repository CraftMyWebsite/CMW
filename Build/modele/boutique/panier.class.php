<?php 
class Panier
{

	private $bdd;

	public function __construct($bdd)
	{
		if(!isset($_SESSION['panier']))
		{
			$_SESSION['panier'] = array();
			$_SESSION['panier']['id'] = array();
			$_SESSION['panier']['quantite'] = array();
			$_SESSION['panier']['prix'] = array();
			$_SESSION['panier']['reduction'] = 0;
			$_SESSION['panier']['reduction_titre'] = '';
			$_SESSION['panier']['code'] = '';
		}
		$this->bdd = $bdd;
		$this->supprExpire();
	}

	public function ajouterProduit($id, $quantite, $prix)
	{
			$pos = array_search($id, $_SESSION['panier']['id']);

			if($pos !== false)
			{
				$_SESSION['panier']['quantite'][$pos] += $quantite;
			}
			else
			{
				array_push($_SESSION['panier']['id'], $id);
				array_push($_SESSION['panier']['quantite'], $quantite);
				array_push($_SESSION['panier']['prix'], $prix);
			}
			return true;
	}

	public function supprimerProduit($id)
	{
			$tmp = array();
			$tmp['id'] = array();
			$tmp['quantite'] = array();
			$tmp['prix'] = array();
			$tmp['verrou'] = false;

			for($i = 0; $i < count($_SESSION['panier']['id']); $i++)
			{
				if($_SESSION['panier']['id'][$i] !== $id)
				{
					array_push($tmp['id'], $_SESSION['panier']['id'][$i]);
					array_push($tmp['quantite'], $_SESSION['panier']['quantite'][$i]);
					array_push($tmp['prix'], $_SESSION['panier']['prix'][$i]);
				}
			}

			$_SESSION['panier'] = $tmp;
			unset($tmp);
			return true;
	}

	public function modifierQteArticle($id, $quantite)
	{
		if($quantite > 0)
			{
				$pos = array_search($id, $_SESSION['panier']['id']);

				if($pos !== false)
				{
					$_SESSION['panier']['quantite'][$pos] = $quantite;
				}
				else
					return FALSE;
				return TRUE;
			}
			else
			{
				$this->supprimerProduit($id);
				return true;
			}
	}

	public function montantGlobal()
	{
		$total = 0;
		if(isset($_SESSION['panier']['reduction_categorie']))
			$reduc = 1;
		else
			$reduc =0;
		for($i = 0; $i < count($_SESSION['panier']['id']); $i++)
		{
			$req = $this->bdd->prepare('SELECT prix, categorie_id FROM cmw_boutique_offres WHERE id = :id');
			$req->execute(array(
				'id' => htmlspecialchars($_SESSION['panier']['id'][$i])
			));
			$fetch = $req->fetch(PDO::FETCH_ASSOC);
			if($reduc == 1)
			{
				if($fetch['categorie_id'] == $_SESSION['panier']['reduction_categorie'])
					$total += $_SESSION['panier']['quantite'][$i] * $fetch['prix'] * (1-$_SESSION['panier']['reduction']);
				else
					$total += $_SESSION['panier']['quantite'][$i] * $fetch['prix'];
			}
			else
				$total += $_SESSION['panier']['quantite'][$i] * $fetch['prix'];
		}
		if($reduc == 1)
			return $total;
		else
			return $total*(1-$_SESSION['panier']['reduction']);
	}
	
	public function compterArticle()
	{
		$nbrArticle = 0;
		for($i = 0; $i < count($_SESSION['panier']['id']); $i++) {
			$nbrArticle += $_SESSION['panier']['quantite'][$i];
		}
		
		return $nbrArticle;
	}

	public function compterOffre()
	{
		return count($_SESSION['panier']['id']);
	}

	public function supprimerPanier()
	{
		unset($_SESSION['panier']);
	}

	public function infosArticle($id, &$nom, &$infos)
	{
			$req = $this->bdd->prepare('SELECT nom, description FROM cmw_boutique_offres WHERE id = :id');
			$req->execute(array(
				'id' => $id
			));
			$fetch = $req->fetch(PDO::FETCH_ASSOC);
			$nom = $fetch['nom'];
			$infos = $fetch['description'];
	}

	public function ajouterReduction($code)
	{
		setcookie('titre', 1, time()+3600000);
		if($this->verifReduction($code, $pourcent, $titre, $expire, $categorie))
		{
			if($pourcent <= 100 && $pourcent > 0)
			{
				$_SESSION['panier']['reduction'] = $pourcent/100;
				$_SESSION['panier']['reduction_titre'] = htmlspecialchars($titre);
				$_SESSION['panier']['code'] = htmlspecialchars($code);
				$_SESSION['panier']['reduction_expire'] = $expire;
				$_SESSION['panier']['reduction_categorie'] = $categorie;
			}
		}
	}

	public function retirerReduction()
	{
		$_SESSION['panier']['reduction'] = 0;
		$_SESSION['panier']['reduction_titre'] = '';
	}

	public function verifExpire(&$aretirer)
	{
		$aretirer = false;
		$req = $this->bdd->prepare('SELECT expire FROM cmw_boutique_reduction WHERE code_promo = :code');
		$req->execute(array(
			'code' => $_SESSION['panier']['code']
		));
		$fetch = $req->fetch(PDO::FETCH_ASSOC);
		if($fetch['expire'] > 0)
		{
			if($fetch['expire'] == 1)
			{
				$req = $this->bdd->prepare('DELETE FROM cmw_boutique_reduction WHERE code_promo = :code');
				$req->execute(array(
					'code' => $_SESSION['panier']['code']
				));
				$aretirer = true;
			}
			else
			{
				$req = $this->bdd->prepare('UPDATE cmw_boutique_reduction SET expire = :expire WHERE code_promo = :code');
				$req->execute(array(
					'expire' => --$fetch['expire'],
					'code' => $_SESSION['panier']['code']
				));
			}
			return true;
		}
		else
			return false;
	}

	private function verifReduction($code, &$pourcent, &$titre, &$expire, &$categorie)
	{
		$req = $this->bdd->prepare('SELECT pourcent, titre, categorie, debut, fin, expire FROM cmw_boutique_reduction WHERE code_promo = :code');
		$req->execute(array(
			'code' => htmlspecialchars($code)
		));
		$fetch = $req->fetch(PDO::FETCH_ASSOC);
		if(isset($fetch['titre']) AND isset($fetch['pourcent']))
		{
			if(($fetch['debut'] != null AND time() > $fetch['debut'] AND time() < $fetch['fin']) OR $fetch['debut'] == null)
			{
				$pourcent = $fetch['pourcent'];
				$titre = $fetch['titre'];
				$expire = $fetch['expire'];
				$categorie = $fetch['categorie'];
				return true;
			}
			else
				return false;
		}
		else
			return false;
	}

	public function supprExpire()
	{
		$req = $this->bdd->prepare('DELETE FROM cmw_boutique_reduction WHERE fin < :fin');
		$req->execute(array(
			'fin' => time()
		));
	}
}
