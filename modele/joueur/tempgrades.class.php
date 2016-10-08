<?php

class TempGrades
{
	private $bddConnection; 
	private $pseudo;
	
    public function __construct($bddConnection)
    {	
		$this->bddConnection = $bddConnection;
	}
	
	public function SetPseudo($pseudo)
	{
		$this->pseudo = $pseudo;
	}
	
	public function GetPlayer()
	{
		$joueursGrades = $this->bddConnection->query('SELECT * FROM cmw_tempgrades WHERE is_active = 1');	
		return $joueursGrades;
	}
	
	public function RecupDonnees()
	{
		$joueursGrades = $this->bddConnection->prepare('SELECT * FROM cmw_tempgrades WHERE pseudo = :pseudo');	
		$joueursGrades->execute(Array ( 'pseudo' => $this->pseudo ));
		$joueursGrades = $joueursGrades->fetch();
		return $joueursGrades;
	}
	
	public function MajJoueurTimeOut()
	{
		$tableau = Array ( 
			'pseudo' => $this->pseudo,
			'grade_temporaire' => '',
			'grade_temps' => 0,
			'is_active' => 0
			);
		$joueursGrades = $this->bddConnection->prepare('UPDATE cmw_tempgrades SET grade_temporaire = :grade_temporaire, grade_temps = :grade_temps, is_active = :is_active WHERE pseudo = :pseudo');	
		$joueursGrades->execute($tableau);
	}
}
?>