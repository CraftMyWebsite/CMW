<?php
class Traitement
{
    protected $dataCategories, $dataOffres, $dataAchats;
    const QUANTITE = 0, QUALITE = 1;

    public function __construct($categories, $offres, $achats)
    {
        $this->dataCategories = $categories;
        $this->dataOffres = $offres;
        $this->dataAchats = $achats;
    }


    public function Revenus($temps = null)
    {
        $topCategories = array();
        $categories = $this->dataCategories;
        $offres = $this->dataOffres;

        if($temps == null)
            $achats = $this->dataAchats;
        else
            $achats = $this->RecentData($this->dataAchats, $temps); 

                
    }

    public function derniersMois()
    {
        $dates = array(
            1 => 'Janvier',
            2 => 'Février',
            3 => 'Mars',
            4 => 'Avril',
            5 => 'Mai',
            6 => 'Juin',
            7 => 'Juillet',
            8 => 'Aout',
            9 => 'Septembre',
            10 => 'Octobre',
            11 => 'Novembre',
            12 => 'Décembre', );
        $derniersMois = array();
        for($i = 1; $i <= 12; $i++){
            if(date("n") - $i + 1 <= 0)
                $derniersMois[$i] = $dates[(date("n") - $i + 1) + 12];
            else
                $derniersMois[$i] = $dates[date("n") - $i + 1]; }
            echo '<pre>';
            print_r($derniersMois);
            print_r(array_reverse($derniersMois));
        return $derniersMois;       
    }

    public function getVentesParMoi($derniersMois)
    {
        $achats = $this->dataAchats;
        unset($achats[count($achats) - 1]);
        $historique = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0, 12 => 0);

        foreach($achats As $cle => $element)
        {
            $mois = explode('-', $element['date_achat']);            
            if((int)$mois[0] != (int)date("Y") AND $mois[0] != (int)date("Y") - 1)
                $element['prix'] = 0;
            $mois = $mois[1];

            if(!isset($derniersMois[$mois]))
                $mois = str_replace('0', '', $mois);
            echo $mois .'<br />';
            $historique[$mois] = $historique[$mois] + $element['prix'];
        }
            print_r($historique);
            return $historique;
    }

    public function topCategories($type, $temps = null)
    {
        $topCategories = array();
        $categories = $this->dataCategories;
        $offres = $this->dataOffres;

        if($temps == null)
            $achats = $this->dataAchats;
        else
            $achats = $this->RecentData($this->dataAchats, $temps);    

        foreach($categories As $cleC => $elementC)
        {
            $topCategories[$elementC['id']][0] = 0;
        }

        foreach($achats As $cleA => $elementA){
            $offre = $this->GetOffreById($elementA['offre_id']);
            if($offre != null)
            {
                $categorie = $this->GetCategorieById($offre['categorie_id']);
                if($categorie != null)
                {
                    if($type == self::QUANTITE)
                        $topCategories[$categorie['id']][0] += 1;
                    elseif($type = self::QUALITE)
                        $topCategories[$categorie['id']][0] += $offre['prix'];
                }
            }
        }

        foreach($categories As $cleC => $elementC)
        {
            if($type == self::QUANTITE)
                $topCategories[$elementC['id']][1] = (int)(round($topCategories[$elementC['id']][0] / (count($achats) - 1) * 100));            
            elseif($type = self::QUALITE)
                $topCategories[$elementC['id']][1] = (int)(round($topCategories[$elementC['id']][0] / $this->getPrixAchats($achats) * 100));

            $topCategories[$elementC['id']][2] = $elementC['titre'];
        }    

        return $topCategories;
    }

    public function GetOffreById($id){
        foreach($this->dataOffres As $cleO => $elementO){
            if($elementO['id'] == $id)
                return $elementO;
        }
        return null;
    }
    public function GetCategorieById($id){
        foreach($this->dataCategories As $cleC => $elementC){
            if($elementC['id'] == $id)
                return $elementC;
        }
        return null;
    }

    public function RecentData($data, $temps)
    {
        $returnData = null;
        $i = 0;
        foreach($data As $cle => $element){
            $date = new DateTime($element['date_achat']);
            $date->add(new DateInterval('P'. $temps .'D'));
            $dateNow = new DateTime('now');
            if($date >= $dateNow){
                $returnData[$i] = $element;
                $i++;
            }
        }
        return $returnData;
    }

    public function getPrixAchats($achats)
    {
        $return = 0;
        foreach($achats As $cle => $element){
            $return = $return + $element['prix'];
        }
        return $return;
    }


    public function topAcheteurs($nbr)
    {
        $achats = $this->listeAcheteur($this->dataAchats);

        foreach ($achats as $key => $value) {
            $pseudo[$key]  = $value['pseudo'];
            $depense[$key] = $value['depenses'];
            $count[$key] = $value['count'];
        }
        array_multisort($depense, SORT_DESC, $count, SORT_DESC, $achats);
        unset($achats[count($achats) - 1]);
        $achats = $this->keepArray($achats, $nbr);
        return $achats;
    }

    public function derniersAcheteurs($nbr)
    {
        $achats = $this->dataAchats;
        for($i = count($achats) - 1; $i >= 0; $i--)
        {
            $retour[$i]['pseudo'] = $achats[$i]['pseudo'];
            $retour[$i]['prix'] = $achats[$i]['prix'];
            $retour[$i]['offre_id'] = $achats[$i]['offre_id'];
        }
        unset($retour[count($retour) - 1]);
        $retour = $this->keepArray($retour, $nbr);
        return $retour;
    }

    public function listeAcheteur($data)
    {
        $listeAcheteurs = array(); 
        
        $i = 0;
        foreach($data As $cle => $valeur)
        {
            if(!isset($listeAcheteurs[$valeur['pseudo']]))
            {
                $listeAcheteurs[$valeur['pseudo']] = $i;
                $retour[$i] = array(
                    'pseudo' => $valeur['pseudo'],
                    'depenses' => $valeur['prix'],
                    'count' => 1 );
            }
            else
            {
                $retour[$listeAcheteurs[$valeur['pseudo']]] = array(
                    'pseudo' => $valeur['pseudo'],
                    'depenses' => $retour[$listeAcheteurs[$valeur['pseudo']]]['depenses'] + $valeur['prix'],
                    'count' =>  $retour[$listeAcheteurs[$valeur['pseudo']]]['count'] + 1 );

            }
            $i++;
        }        
        return $retour;
    }

    public function keepArray($tableau, $nbr){
        $tableau2 = $tableau;
        for($i = $nbr; $i < count($tableau2); $i++){
            unset($tableau[$i]);
        }
        return $tableau;
    }
}
?>
