<?php
class StatsUpdate
{
	private $bdd;
	
    public function __construct($bdd)
    {	
		$this->bdd = $bdd;
	}
	
	public function AddSell($id_offre, $prix, $pseudo)
	{
		$req = $this->bdd->prepare('INSERT INTO cmw_boutique_stats(offre_id, date_achat, prix, pseudo) VALUES(:offre_id, NOW(), :prix, :pseudo)');
        $req->execute(array('offre_id' => $id_offre, 'prix' => $prix, 'pseudo' => $pseudo ));
	}
}
?>
