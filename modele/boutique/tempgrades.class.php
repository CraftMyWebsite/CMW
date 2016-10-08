<?php

class TempGrades
{
	private $bddConnection; 
	private $pseudo;
	private $duree;
	private $grade;

    public function __construct($bddConnection, $pseudo, $duree, $grade)
    {	
		$this->bddConnection = $bddConnection;
		$this->pseudo = $pseudo;
		$this->duree = $duree;
		$this->grade = $grade;
	}
	
	public function ExistPlayer()
	{
		$joueursGrades = $this->bddConnection->prepare('SELECT * FROM cmw_tempgrades WHERE pseudo = :pseudo');	
		$joueursGrades->execute(Array ( 'pseudo' => $this->pseudo ));
		$joueursGrades = $joueursGrades->fetch();
		if(empty($joueursGrades['pseudo']))
			return false;
		else
			return true;
	}

	public function CreerJoueur()
	{
		$tableau = Array ( 
			'pseudo' => $this->pseudo,
			'grade_temporaire' => $this->grade,
			'grade_temps' => time() + ($this->duree * 2592000),
			'is_active' => 1
			);
		$joueursGrades = $this->bddConnection->prepare('INSERT INTO cmw_tempgrades(pseudo, grade_temporaire, grade_temps, is_active) VALUES(:pseudo, :grade_temporaire, :grade_temps, :is_active)');	
		$joueursGrades->execute($tableau);
	}

	public function CreerJoueurVie()
	{
		$tableau = Array ( 
			'pseudo' => $this->pseudo,
			'grade_vie' => $this->grade
			);
		$joueursGrades = $this->bddConnection->prepare('INSERT INTO cmw_tempgrades(pseudo, grade_vie) VALUES(:pseudo, :grade_vie)');	
		$joueursGrades->execute($tableau);
	}


	public function MajJoueur()
	{
		$tableau = Array ( 
			'pseudo' => $this->pseudo,
			'grade_temporaire' => $this->grade,
			'grade_temps' => time() + ($this->duree * 2592000),
			'is_active' => 1
			);
		$joueursGrades = $this->bddConnection->prepare('UPDATE cmw_tempgrades SET grade_temporaire = :grade_temporaire, grade_temps = :grade_temps, is_active = :is_active WHERE pseudo = :pseudo');	
		$joueursGrades->execute($tableau);
	}

	public function MajJoueurVie()
	{
		$tableau = Array ( 
			'pseudo' => $this->pseudo,
			'grade_vie' => $this->grade
			);
		$joueursGrades = $this->bddConnection->prepare('UPDATE cmw_tempgrades SET grade_vie = :grade_vie WHERE pseudo = :pseudo');	
		$joueursGrades->execute($tableau);
	}

}
?>