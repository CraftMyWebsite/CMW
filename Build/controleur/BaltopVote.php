                [DIV]
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pseudo</th>
                        <th>Votes</th>
                    </tr>
                </thead>

                <?php
                if (isset($topVoteurs)) {
                    for ($i = 0; $i < count($topVoteurs) and $i < 10; $i++) {  ?>
                        <tr>
                            <td>
                                <?= $i + 1 ?>
                            </td>
                            <td>
                            
                                <strong>
                                    <a href="?page=profil&profil=<?= $topVoteurs[$i]['pseudo'] ?>">
                                        <?= $topVoteurs[$i]['pseudo']; ?>
                                    </a>
                                </strong>
                            </td>
                            <td id="nbr-vote-<?= $topVoteurs[$i]['pseudo']; ?>">
                                <?= $topVoteurs[$i]['nbre_votes']; ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr class="p-0 no-hover">
                        <td colspan="3" class="p-0 no-hover">
                            <div class="m-0 info-page bg-danger">
                                <div class="text-center">Personne n'a encore voté !</div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>