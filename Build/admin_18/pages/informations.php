            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2 class="h2 gray">
                        Informations Générales
                    </h2>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">

                            <a data-toggle="collapse" data-target="#stats" aria-expanded="true" aria-controls="stats">
                                <h2 class="h2 gray">
                                    <i class="fas fa-chart-area"></i> Statistiques des visiteurs
                                </h2>
                            </a>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <a style="cursor:pointer;"onClick="sendPost('dropVisits')"; class="btn btn-sm btn-outline-secondary">
                                    Supprimer les visites
                                </a>
                                <script>initPost("dropVisits", "admin.php?action=dropVisits",  
                                            function (data) { if(data) { 
                                                var ctx = document.getElementById('visitsChart')
                                                var myChart = new Chart(ctx, {
                                                    type: 'line',
                                                    data: {
                                                        labels: [],
                                                        datasets: [{
                                                            data: [],
                                                            lineTension: 0,
                                                            backgroundColor: '#343A40',
                                                            borderColor: '#2F3136',
                                                            borderWidth: 4,
                                                            pointBackgroundColor: '#2F3136'
                                                        }]
                                                    },
                                                    options: {
                                                        scales: {
                                                            yAxes: [{
                                                                ticks: {
                                                                    beginAtZero: false
                                                                }
                                                            }]
                                                        },
                                                        legend: {
                                                            display: false,
                                                            labels: {
                                                                text: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
                                                            }
                                                        }
                                                    }
                                                });
                                            } })</script>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ollapse show" id="stats">
                        <canvas class="my-4 w-100" id="visitsChart" width="900" height="200">
                                  <script>
                                   <?php 
                                   $Dates = date("Y-m-d");
                                   $Dates_Yesterday = strftime("%Y-%m-%d", mktime(0, 0, 0, date('m'), date('d')-1, date('y')));

                                   $req_NumberOfDay = $bddConnection->prepare('SELECT dates AS dates FROM cmw_visits GROUP BY dates LIMIT 0, 7;');
                                   $req_NumberOfDay->execute();
                                   $get_NumberOfDay = $req_NumberOfDay->fetchAll();

                                   $req_TotalVisitsPerDay = $bddConnection->prepare('SELECT count(dates) AS visits FROM cmw_visits GROUP BY dates LIMIT 0, 7;');
                                   $req_TotalVisitsPerDay->execute();
                                   $get_TotalVisitsPerDay = $req_TotalVisitsPerDay->fetchAll();
                                   ?>

                                        var ctx = document.getElementById('visitsChart')
                                        var myChart = new Chart(ctx, {
                                            type: 'line',
                                            data: {
                                                labels: [<?php foreach ($get_NumberOfDay as $get_NumberOfDay) {
                                                  $replace_DatesBy = array("Aujourd'hui", "Hier");
                                                  $find_Dates = array($Dates, $Dates_Yesterday);
                                                  echo '"'.str_replace($find_Dates, $replace_DatesBy, $get_NumberOfDay['dates']).'"'.","; } ?>],
                                                datasets: [{
                                                    data: [<?php foreach ($get_TotalVisitsPerDay as $get_TotalVisitsPerDay) {
                                         echo '"'.$get_TotalVisitsPerDay['visits'].'"'.","; } ?>],
                                                    lineTension: 0,
                                                    backgroundColor: '#343A40',
                                                    borderColor: '#2F3136',
                                                    borderWidth: 4,
                                                    pointBackgroundColor: '#2F3136'
                                                }]
                                            },
                                            options: {
                                                scales: {
                                                    yAxes: [{
                                                        ticks: {
                                                            beginAtZero: false
                                                        }
                                                    }]
                                                },
                                                legend: {
                                                    display: false,
                                                    labels: {
                                                        text: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
                                                    }
                                                }
                                            }
                                        });
                                  </script>
                            </canvas>
                    </div>

                </div>
                <br/>

                <div class="card-columns">
                    <div class="card">

                        <div class="card-body bg-info">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="card-title">Nouveautés</h4>
                                    <p class="card-category"> ›› <?php echo isset($TotalNews)&& $TotalNews >0 ? 'Il y a actuellement '.$TotalNews.' news.' : "Il n'y a pas de news posté." ; ?></p>
                                </div>
                                <div class="col-md-4">
                                    <i class="fas fa-comments fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <a href="?page=news">
                            <div class="card-footer">
                                <button type="button" onclick="" class="btn btn-info btn-block w-100"> Voir en détails
                                    <i class="fas fa-arrow-circle-right"></i></button>
                            </div>
                        </a>

                    </div>
                    <div class="card">

                        <div class="card-body bg-success">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="card-title">Support</h4>
                                    <p class="card-category"> ›› <?php echo isset($TotalSupport) && $TotalSupport >0 ? 'Il y a '.$TotalSupport." demande(s) d'aide." : "Il n'y a aucune demande d'aide." ; ?></p>
                                </div>
                                <div class="col-md-4">
                                    <i class="fas fa-life-ring fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <a href="?page=support">
                            <div class="card-footer">
                                <button type="button" onclick="" class="btn btn-success btn-block w-100"> Voir en
                                    détails <i class="fas fa-arrow-circle-right"></i></button>
                            </div>
                        </a>

                    </div>
                    <div class="card">

                        <div class="card-body bg-danger">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="card-title">Boutique</h4>
                                    <p class="card-category"> ›› <?php echo isset($TotalOffre) && $TotalOffre >0 ? 'Il y a '.$TotalOffre.' offre(s) dans la boutique.' : "Il n'y a pas d'offre dans la boutique." ; ?></p>
                                </div>
                                <div class="col-md-4">
                                    <i class="fas fa-shopping-cart fa-5x"></i>
                                </div>
                            </div>
                        </div>
                        <a href="?page=boutique">
                            <div class="card-footer">
                                <button type="button" onclick="" class="btn btn-danger btn-block w-100"> Voir en détails
                                    <i class="fas fa-arrow-circle-right"></i></button>
                            </div>
                        </a>


                    </div>

                </div>
                <br/>
                <div class="card-columns">
                    <?php
                    for($j = 0; $j < count($lecture['Json']); $j++)
                    {
                    if($conEtablie[$j] == true)
                        { ?>
                        <div class="card">
                            <div class="card-header bg-success">
                                <div class="row">
                                    <div class="col-md-8 offset-col-md-4">
                                        <h4 class="card-title"><i class="fas fa-server"></i> Serveur #<?=$conEtablie[$j]?></h4>
                                        <p class="card-category"> 
                                            En ligne - <?=$lecture['Json'][$j]['nom'];?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#infoServeur<?=$conEtablie[$j]?>">
                                <div class="card-footer">
                                    <button type="button" onclick="" class="btn btn-success btn-block w-100"> Voir en
                                        détails
                                        <i class="fas fa-arrow-circle-right"></i></button>
                                </div>
                            </a>
                        </div>
                        <?php if($_Joueur_['rang'] == 1 OR ($_PGrades_['PermsPanel']['info']['details']['player'] == true OR $_PGrades_['PermsPanel']['info']['details']['console'] == true OR $_PGrades_['PermsPanel']['info']['details']['command'] == true OR $_PGrades_['PermsPanel']['info']['details']['plugins'] == true OR $_PGrades_['PermsPanel']['info']['details']['server'] == true)) { 
                            ?>

                            <div class="modal fade" id="infoServeur<?=$conEtablie[$j]?>" tabindex="-1" role="dialog"
                                aria-labelledby="#infoServeur<?=$conEtablie[$j]?>" aria-hidden="true">
                                <div class="modal-dialog  modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Serveur JSONAPI/Rcon</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="height: 500px;overflow-y:scroll!important">
                                           
                                        <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['info']['details']['console'] == true) { ?>
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">
                                                        Console
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                <script type="text/javascript">
                                                    function updateConsole() {
                                                        var $console = $("#console");
                                                        $console.load("admin.php #console");
                                                    }
                                                    setInterval("updateConsole()", 10000);
                                                </script>
                                                <?php 
                                                $date = date("Y-m-d");
                                                echo '<div id="console"><div style="background-color: #373737;color: #8F8F8F;border-top-left-radius:5px;border-top-right-radius:5px;border-bottom-left-radius:5px;border-bottom-right-radius:5px;border:solid 2px #8F8F8F;overflow: hidden;">';
                                                foreach($console[$j]['Test'] as $value) {
                                                    $console[$j]['Test'] = $value["line"];
                                                    $console[$j]['Test'] = str_replace($date, '', $console[$j]['Test']);
                                                    $msg_prefix = array('INFO', 'WARN', 'SEVERE', "[0;31;22m", "[0;32;22m", "[0;33;22m", "[0;34;22m", "[0;35;22m", "[0;36;22m", "[0;37;22m", "[0;30;1m", "[0;31;1m", "[0;32;1m", "[0;33;1m", "[0;34;1m", "[0;35;1m", "[0;36;1m", "[0;37;1m", "[1;31m", "[21m", "[9m", "[5m", "[3m", "[0m", "[m", "<span><span", "</span></span>");
                                                    $color_prefix = array('<span style="color: #5555FF;">INFO</span>', '<span style="color: #FFAA00;">WARN</span>', '<span style="color: #FF5555;">SEVERE</span>', "</span><span style=\"color:#aa0000\">", "</span><span style=\"color:#00aa00\">", "</span><span style=\"color:#ffaa00\">", "</span><span style=\"color:#0000aa\">", "</span><span style=\"color:#aa00aa\">", "</span><span style=\"color:#00aaaa\">", "</span><span style=\"color:#aaaaaa\">", "</span><span style=\"color:#555555\">", "</span><span style=\"color:#ff5555\">", "</span><span style=\"color:#55ff55\">", "</span><span style=\"color:#ffffff\">", "</span><span style=\"color:#5555ff\">", "</span><span style=\"color:#ff55ff\">", "</span><span style=\"color:#55ffff\">", "</span><span style=\"color:#ffff55\">", "", "", "", "", "", "", "</span>", "<span", "</span>");
                                                    $console[$j]['Test'] = str_replace($msg_prefix, $color_prefix, $console[$j]['Test']);
                                                    echo '<div style="text-align: left;">';
                                                    echo '<div>';
                                                    echo $console[$j]['Test'];
                                                    echo '<br/>
                                                            </div>';
                                                    echo '</div>';
                                                }
                                                echo '</div>
                                                </div>'; ?>
                                                </div>
                                                <div class="card-footer">
                                                <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#sendCommand").click(function (e) {
                                                        $("#sendCommand").prop('disabled',
                                                            true);
                                                        e.preventDefault();
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: '?&action=commandeConsole',
                                                            data: $('#commandeExec')
                                                                .serialize(),
                                                            success: function () {
                                                                $('input[name=commandeConsole]')
                                                                    .val('');
                                                                $("#sendCommand")
                                                                    .prop(
                                                                        'disabled',
                                                                        false);
                                                                        toastr["success"]("Commande executer !");
                                                            },
                                                            error: function () {
                                                                $('input[name=commandeConsole]')
                                                                    .val('');
                                                                $("#sendCommand")
                                                                    .prop(
                                                                        'disabled',
                                                                        false);
                                                                        toastr["success"]("Erreur: Impossible d\'executer la commande");
                                                            }
                                                        });
                                                    });
                                                });
                                                </script>
                                                <form id="commandeExec" method="POST"
                                                            action="?&action=commandeConsole">
                                                            <input class="form-control w-100" type="text"
                                                                name="commandeConsole" id="commandeConsole" value=""
                                                                placeholder="Mettre une commande sans /" required />
                                                            <button id="sendCommand" class="btn btn-info btn-block w-100">Exécuter la
                                                                commande</button>
                                                        </form>
                                                </div>
                                            </div>

                                        <div class="row">
                                            <div class="col-md-4 offset-md-4">
                                                <button class="btn btn-block btn-primary w-100" data-toggle="modal" data-target="#giveSpec<?=$conEtablie[$j]?>" disabled style="background-color: gray;border-color:gray;cursor: not-allowed;">Give d'items spéciaux</button>
                                            </div>
                                        </div>
                                        <br/>

                                        <?php }
                                        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['info']['details']['plugins'] == true) { ?>
                                        
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">
                                                        Plugins
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Nom</th>
                                                                <th>Version</th>
                                                                <th>Etat</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($plugins[$j]['Test'] as $value) { ?>
                                                            <tr>
                                                                <td><?php echo $value['name']; ?></td>
                                                                <td><?php echo $value['version'] ?></td>
                                                                <td><?php if($value['enabled']== "true") { echo '<center><img src="theme/upload/true.png"></img></center>'; } else { echo '<center><img src="theme/upload/cross.png"></img></center>'; } ?>
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="card-footer">
                                                <?php 
                                               if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['info']['details']['server'] == true) { ?>
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <button type="button" class="btn btn-warning"
                                                                onclick="window.location.replace('?&action=commandeRechargementPlugins')">Recharger
                                                                les plugins</button>
                                                        </div>
                                                        <div class="col-md-4 text-center">
                                                            <form method="post" action="?&action=commandeConsole">
                                                                <button id="commandeConsolestop" name="commandeConsole"
                                                                    type="submit" class="btn btn-danger"
                                                                    value="stop">Arrêter le serveur</button>
                                                            </form>
                                                        </div>
                                                        <div class="col-md-4 text-center" style="margin-left: -4.5%">
                                                            <button type="button" class="btn btn-success"
                                                                onclick="window.location.replace('?&action=commandeRedemarrageServer')"
                                                                disabled>Redémarrer le serveur</button>
                                                        </div>
                                                    </div>
                                               <?php } ?>
                                                </div>
                                            </div>
                                    

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>

                        <?php } ?>
                    <?php }else{?>
                        <div class="card">
                            <div class="card-header bg-danger">
                                <div class="row">
                                    <div class="col-md-8 offset-col-md-4">
                                        <h4 class="card-title"><i class="fas fa-server"></i> Serveur</h4>
                                        <p class="card-category"> 
                                            Hors Ligne - <?=$lecture['Json'][$j]['nom'];?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="card-footer">
                                    <button type="button" onclick="" class="btn btn-danger btn-block w-100"> Serveur Hors Ligne !
                                        <i class="fas fa-arrow-circle-right"></i></button>
                                </div>
                            </a>
                        </div>
                   <?php } ?>
                <?php } ?>
                </div>
                <br/>
                <div class="row">

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <i class="fas fa-user-friends"></i> Inscriptions
                                </h4>
                            </div>
                            <div class="card-body" style="overflow-x: scroll;padding: 0px;">

                                <div class="table-responsive">
                                    <table class="table table-striped w-100">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Pseudo</th>
                                                <th>Email</th>
                                                <th>Jetons</th>
                                                <th>Inscrit le</th>
                                                <?php if($ShowMail) { echo '<th>Etat</th>'; } ?>
                                                <?php if($_Permission_->verifPerm('PermsPanel', 'info', 'stats', 'members', 'showIP')) { echo '<th>IP</th>'; } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                           
                                            while($lastMembre = $lastRegisterMember->fetch(PDO::FETCH_ASSOC))
                                            {
                                                echo '<tr>';
                                                echo '<td>'.$lastMembre['id'].'</td>';
                                                echo '<td>'.$lastMembre['pseudo'].'</td>';
                                                echo '<td>'.$lastMembre['email'].'</td>';
                                                echo '<td>'.$lastMembre['tokens'].'</td>';
                                                echo '<td>'.date('d/m/Y', $lastMembre['anciennete']).' &agrave; '.date('H:i:s',$lastMembre['anciennete']).'</td>';
                                                if($ShowMail) { echo '<td>'.($lastMembre['ValidationMail'] == 1 ? "valide" : "invalide").'</td>'; }
                                                if($_Permission_->verifPerm('PermsPanel', 'info', 'stats', 'members', 'showIP')) { echo '<td>'.$lastMembre['ip'].'</td>'; }
                                                 echo '</tr>';
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <small>Ceci sont les 10 derniers membres inscrits.</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <div class="float-left">
                                        <i class="fas fa-user-friends"></i> Staff-Chat
                                    </div>
                                    <div class="float-right">
                                        <button type="submit"  class="btn btn-sm btn-outline-secondary" onClick="sendPost('clearStaffMessage')" title="Cliquer ici pour supprimer à jamais tous les messages"><i class="fas fa-trash" style="color: #bf0a0a;"></i></button>
                                         <script>initPost("clearStaffMessage", "admin.php?action=clearPostit",  
                                            function (data) { if(data) { document.getElementById('allStaffMessage').innerHTML = "";} });</script>
                                    </div>
                                </h4>
                            </div>
                            <div class="card-body postit" id="allStaffMessage" style="overflow-y: scroll;padding: 0px;height: 155px; width: 100%;">
                                <?php 
                                    while ($message_postit = $all_message_staff->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <p id="StaffMessage-<?=$message_postit['id'];?>">
                                                [<strong><?php echo $message_postit['auteur']; ?></strong>]: 
                                            <?php echo $message_postit['message']; ?>&nbsp;&nbsp; 
                                            <a id="suppStaffMessage-<?=$message_postit['id'];?>" style="cursor:pointer;"onClick="sendPost('suppStaffMessage-<?=$message_postit['id'];?>')">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                <input type="number" style="display:none;" value="<?=$message_postit['id'];?>" name="id">
                                            </a>
                                            <script>initPost("suppStaffMessage-<?=$message_postit['id'];?>", "admin.php?action=supprPostit",  
                                            function (data) { if(data) { document.getElementById("suppStaffMessage-<?=$message_postit['id'];?>").style.display = "none";} });</script>
                                        </p>
                                   <?php } ?>
                            </div>
                            <div class="card-footer" id="sendStaffMessage">
                                    <input type="text" name="message" id="message" placeholder="Message (max 50 caractères)" class="form-control" maxlength="50">
                                    <button type="submit" class="btn btn-success w-100" onClick="sendPost('sendStaffMessage')">Envoyer !</button>
                                    <script>initPost("sendStaffMessage", "admin.php?action=creerPostit",  
                                            function (data) { if(data) { console.log('message envoyé'); document.getElementById('allStaffMessage').innerHTML = "<p>[<strong><?php echo $_Joueur_['pseudo']?></strong>]: "+getValueByName('sendStaffMessage', 'message')+"</p>"+document.getElementById('allStaffMessage').innerHTML; clearAllInput('sendStaffMessage');}})</script>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card end">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <i class="fas fa-heartbeat"></i> Activité
                                </h4>
                            </div>
                            <div class="card-body">

                                <div class="list-group">
                                    <?php if(isset($LastTicket)) { ?>
                                    <li class="list-group-item">
                                        <?php if($LastTicket['etat'] == 1) {?><span class="badge" style="background-color: rgb(0, 151, 0);">Résolu</span><?php } else { ?><span class="badge" style="background-color: rgb(139, 24, 40);">Non résolu</span><?php } ?>
                                        <i class="fas fa-life-ring"></i> Dernier ticket :
                                        <strong><?php echo $LastTicket['titre']; ?></strong> par <strong><?php echo $LastTicket['auteur']; ?></strong>
                                    </li>
                                    <?php } ?>

                                    <?php if(isset($LastNews)) { ?>
                                    <li class="list-group-item">
                                        <i class="fas fa-fw fa-wrench"></i> Dernier news :
                                        <strong><?php echo $LastNews['titre']; ?></strong> par <strong><?php echo $LastNews['auteur']; ?></strong>
                                    </li>
                                    <?php } ?>
                                    <?php if(isset($LastMaintenance)) { ?>
                                    <li class="list-group-item">
                                        <?php if($LastMaintenance['maintenanceEtat'] == 0) { ?><span class="badge" style="background-color: #d9534f">Inactif</span><?php } else { ?>
                                        <span class="badge" style="background-color:rgb(0, 151, 0);">Actif</span>
                                        <?php } ?>
                                        <i class="fas fa-fw fa-wrench"></i> Dernière maintenance effectuée le  <?php if($LastMaintenance['maintenanceTime'] != "0") { echo date('d-m-Y H:i:s', $LastMaintenance['maintenanceTime']);} else { echo 'jamais';}?>
                                    </li>
                                    <?php } ?>

                                </div>

                            </div>
                            <div class="card-footer">
                                <small>Ceci sont les dernières activitées effectuée.</small>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-8">
                        <div class="card end">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <i class="fas fa-shopping-basket"></i> Boutique
                                </h4>
                            </div>
                            <div class="card-body" style="overflow-x: scroll;padding: 0px;">

                                <div class="table-responsive">
                                    <table class="table table-striped w-100">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Pseudo</th>
                                                <th>Date</th>
                                                <th>Offre acheté</th>
                                                <th>Dépenses</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($LastAchat = $lastachatreq->fetch(PDO::FETCH_ASSOC)) {
                                                echo '<tr>';
                                                echo '<td>'.$LastAchat['id'].'</td>';
                                                echo '<td>'.$LastAchat['pseudo'].'</td>';
                                                echo '<td>'.$LastAchat['date_achat'].'</td>';
                                                echo '<td>'.$LastAchat['offre_id'].'</td>';
                                                echo '<td>'.$LastAchat['prix'].'</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                         

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <small>Ceci sont les derniers achats dans la boutique.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>