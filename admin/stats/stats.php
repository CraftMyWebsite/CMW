<script src="admin/stats/graphs/Chart.js"></script>

<section class="container">
    <div class="jumbotron">
        <h1>Statistiques boutique</h1>
        <p>Visualisez en temps réèl vos ventes sur la boutique !</p>
    </div>

    <article class="well">
        <h2>Evolution des achats (Dépenses en jetons les 12 derniers mois)</h2>
        <canvas id="canvas" width="1250" height="400"></canvas>
        <script>
            var lineChartData = {
                labels : [<?php echo $print->getDerniersMois($derniersMois); ?>],
                datasets : [
                    {
                        fillColor : "rgba(151,187,205,0.5)",
                        strokeColor : "rgba(151,187,205,1)",
                        pointColor : "rgba(151,187,205,1)",
                        pointStrokeColor : "#fff",
                        data : [<?php echo $print->getEvoAchats($histVentes); ?>]
                    }
                ]
                
            }

            var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);
        
        </script>
    </article>

    <article class="well">
        <div class="row">
            <div class="col-md-6">
                <h2>Top acheteurs</h2>
                <table class="table table-hover">
                    <tr>
                        <th>#</th>
                        <th>Acheteur</th>
                        <th>Nombre d'achats</th>
                        <th>Dépenses</th>
                    </tr>
                    <?php while($print->isNotEnd(Draw::TOP_ACHETEURS, $topAcheteurs)){ ?>
                    <tr>
                        <td><?php echo $print->getKey(Draw::TOP_ACHETEURS) + 1; ?></td>
                        <td><?php echo $print->fetch(Draw::TOP_ACHETEURS, 'pseudo', $topAcheteurs, true); ?></td>
                        <td><?php echo $print->fetch(Draw::TOP_ACHETEURS, 'depenses', $topAcheteurs, false); ?></td>
                        <td><?php echo $print->fetch(Draw::TOP_ACHETEURS, 'count', $topAcheteurs, false); ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="col-md-6">
                <h2>Derniers acheteurs</h2>
                <table class="table table-hover">
                    <tr>
                        <th>#</th>
                        <th>Acheteur</th>
                        <th>Nom produit</th>
                        <th>Prix</th>
                    </tr>
                    <?php while($print->isNotEnd(Draw::DERNIERS_ACHETEURS, $derniersAcheteurs)){ ?>
                    <tr>
                        <td><?php echo $print->getKey(Draw::DERNIERS_ACHETEURS) + 1; ?></td>
                        <td><?php echo $print->fetch(Draw::DERNIERS_ACHETEURS, 'pseudo', $derniersAcheteurs, true); ?></td>
                        <td><?php echo $print->fetch(Draw::DERNIERS_ACHETEURS, 'prix', $derniersAcheteurs, false); ?></td>
                        <td><?php echo $print->fetch(Draw::DERNIERS_ACHETEURS, 'prix', $derniersAcheteurs, false); ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </article>
    <article class="topCategories row">
        <div class="col-md-4">
            <h3>Nombre de ventes(total)</h3>
            
        </div>
    </article>
</section>
