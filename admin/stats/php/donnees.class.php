<?php
class Donnees
{
    protected $db, $categories, $offres, $achats;

    public function __construct($bdd)
    {
        $this->db = $bdd;

        $this->categories = $this->getListeCategories();
        $this->offres = $this->getListOffres();
        $this->achats = $this->getListAchats();
    }

    public function GetCategories(){
        return $this->categories; }
    public function GetOffres(){
        return $this->offres; }
    public function GetAchats(){
        return $this->achats; }

    public function getListeCategories()
    {
        $req = $this->db->query('SELECT id, titre FROM cmw_boutique_categories');
        return Donnees::Fetch($req);
    }

    public function getListOffres()
    {
        $req = $this->db->query('SELECT id, nom, categorie_id, prix FROM cmw_boutique_offres ORDER BY id');
        return Donnees::Fetch($req);
    }

    public function getListAchats()
    {
        $req = $this->db->query('SELECT * FROM cmw_boutique_stats');
        return Donnees::Fetch($req);
    }


    public static function Fetch($req)
    {
        $i = 0;
        while($donnees[$i] = $req->fetch())
        {
            $i++;
        }
        return $donnees;
    }
}
