<?php
$pagesReq = $bddConnection->query('SELECT titre FROM cmw_pages');
$i = 0;
while($pagesDonnees = $pagesReq->fetch())
{
	$pages[$i] = $pagesDonnees['titre'];
	$i++;
}
if(empty($pages)) $pages[0] = '- Aucune Page -';


$lectureMenu = new Lire('modele/config/configMenu.yml');
$lectureMenu = $lectureMenu->GetTableau();

for($i = 0; $i < count($lectureMenu['MenuTexte']); $i++)
{
	$lectureMenuA['MenuTexte'][$i] = str_replace('[glyph]', '<span style="display: none;" class="glyphicon glyphicon-', $lectureMenu['MenuTexte'][$i]);
	$lectureMenuA['MenuTexte'][$i] = str_replace('[/glyph]', '"></span> ', $lectureMenuA['MenuTexte'][$i]);
}
?>
