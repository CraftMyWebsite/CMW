 <?php 
$reqSmileys = $bddConnection->query('SELECT id, symbole, image FROM cmw_forum_smileys ORDER BY priorite DESC');
$reqPrefix = $bddConnection->query('SELECT id, span, nom FROM cmw_forum_prefix ORDER BY id ASC');
?>