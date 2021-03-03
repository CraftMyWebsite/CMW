<!-- News Section -->
<section id="News">
    <div class="container-fluid col-md-12 col-lg-9 col-sm-10">
        <div class="row">
            <div class="row news-articles col-md-12 col-lg-8 col-sm-12 mx-auto">
                <!-- News Articles -->
                <?php
                if (isset($news) && count($news) > 0) :
                    for ($i = 0; $i < 10; $i++) :
                        if ($i < count($news)) :
                            $getCountCommentaires = $accueilNews->countCommentaires($news[$i]['id']);
                            $countCommentaires = $getCountCommentaires->rowCount();

                            $getcountLikesPlayers = $accueilNews->countLikesPlayers($news[$i]['id']);
                            $countLikesPlayers = $getcountLikesPlayers->rowCount();
                            $namesOfPlayers = $getcountLikesPlayers->fetchAll(PDO::FETCH_ASSOC);

                            $getNewsCommentaires = $accueilNews->newsCommentaires($news[$i]['id']);
                ?>

                            <article class="col-md-12 col-lg-12 col-sm-12 news-content">
                                <div class="card">
                                    <div class="card-header d-flex flex-nowrap">
                                        <h4><small>#<?= $news[$i]['id'] ?> </small><?= $news[$i]['titre']; ?></h4>
                                        <h6 class="ml-auto"><?= date('d/m/Y', $news[$i]['date']) . " &agrave; " . date('H:i:s', $news[$i]['date']) ?></h6>
                                    </div>
                                    <div class="card-body">
                                        <?= $news[$i]['message']; ?>
                                    </div>
                                    <div class="card-footer d-flex">
                                        <h3>Par <a href="?page=profil&profil=<?= $news[$i]['auteur']; ?>"><?= $news[$i]['auteur']; ?></a></h3>
                                        <div class="ml-auto">
                                            <?php
                                            if (Permission::getInstance()->verifPerm("connect")) :
                                                $reqCheckLike = $accueilNews->checkLike($_Joueur_['pseudo'], $news[$i]['id']);
                                                $getCheckLike = $reqCheckLike->fetch(PDO::FETCH_ASSOC);
                                                $checkLike = $getCheckLike['pseudo'];
                                                if ($_Joueur_['pseudo'] == $checkLike) : ?>
                                                    <a href="#" class="h5 mr-3" data-toggle="modal" data-target="#news<?= $news[$i]['id'] ?>">Commenter (<?= $countCommentaires ?>)</a> <i class="fa fa-thumbs-up"></i> <?= $countLikesPlayers ?>
                                                <?php else : ?>
                                                    <a href="#" class="h5 mr-3" data-toggle="modal" data-target="#news<?= $news[$i]['id'] ?>">Commenter (<?= $countCommentaires ?>)</a>
                                                    <a href="?&action=likeNews&id_news=<?= $news[$i]['id'] ?>" class="h5 mx-3">J'aime</a>
                                                    <i class="fa fa-thumbs-up"></i> <?= $countLikesPlayers ?>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <a href="#" class="h5 mr-3" data-toggle="modal" data-target="#news<?= $news[$i]['id'] ?>">Commenter (<?= $countCommentaires ?>)</a> <i class="fa fa-thumbs-up"></i> <?= $countLikesPlayers ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Commentaires -->

                            </article>
                        <?php endif; ?>
                    <?php endfor; ?>
                <?php else : ?>
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="alert alert-warning">
                            <p class="text-center">Aucune news n'a été créée à ce jour...</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="row info-articles col-md-12 col-lg-4 col-sm-12 mx-auto">
                <!-- Informations Articles -->
                <?php foreach($_Minia_ as $value) : ?>
                    <article class="col-12 info-content">
                        <div class="card">
                            <img class="card-img-top" src="theme/upload/navRap/<?= $value['image'] ?>" alt="">
                            <div class="card-body">
                                <p class="card-text">
                                    <?= $value['message']; ?>
                                </p>
                            </div>
                            <div class="card-footer">
                                <a href="<?= $value['lien']; ?>" class="btn btn-main w-100">S'y rendre !</a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>
