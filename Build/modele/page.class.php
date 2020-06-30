<?php
class PageData
{
	private $bdd;
	
    public function __construct($bdd)
    {	
		$this->bdd = $bdd;
	}
	
	public function GetListPages($page)
	{
		$pages = $this->bdd->prepare('SELECT * FROM cmw_pages WHERE titre = :titre');
		$pages->execute(array('titre' => $page));
		return $pages;
	}
}
?>
