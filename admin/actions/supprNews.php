<?php
$req = $bddConnection->prepare('DELETE FROM cmw_news WHERE id = :id');
$req->bindParam(':id', $_GET['newsId']);
$req->execute();

$req2 = $bddConnection->prepare('DELETE FROM cmw_news_commentaires WHERE id_news = :id');
$req2->bindParam(':id', $_GET['newsId']);
$req2->execute();

$req3 = $bddConnection->prepare('DELETE FROM cmw_news_reports WHERE id_news = :id');
$req3->bindParam(':id', $_GET['newsId']);
$req3->execute();

$req4 = $bddConnection->prepare('DELETE FROM cmw_news_stats WHERE id_news = :id');
$req4->bindParam(':id', $_GET['newsId']);
$req4->execute();
?>