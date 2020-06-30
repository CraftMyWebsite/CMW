             <nav class="col-md-2 col-sm-12 col-xs-12 bg-img sidebar collapse show navbar-collapse"
                id="navbarSupportedContent">
                <div class="sidebar-sticky filter-opacity" style="background-color: rgba('0, 0, 0, 0.7')">
                    <ul class="nav flex-column" id="scrollnav">

                        <!-- Petite carte profil (afficher sur pc only)-->
                        <div class="row" id="profiladmin">
                            <div class="col-4">
                                <img src="<?php echo $_ImgProfil_->getUrlHeadByPseudo($_Joueur_['pseudo']); ?>" alt="<?php echo $_Joueur_['pseudo']; ?>" class="rounded-circle imageusercard"
                                    style="max-width: 64px;max-height: 64px;margin-left: 15px;">
                            </div>
                            <div class="col-5">
                                <p class="text-center text-white">
                                    <b><?php echo $_Joueur_['pseudo']; ?></b>
                                    <span class="prefix prefixRed" id="grade" style="margin-top: 15px">Créateur</span>
                                </p>
                            </div>
                        </div>
                        <!-- Fin de la carte d'identité profil -->
                        <!-- Début des items de navigation-->

                     <?php  if($_Permission_->verifPerm('PermsPanel', 'info', 'showPage')) { ?>
                        <li class="nav-item <?php if((isset($_GET['page'])&&$_GET['page']=='accueil')|!isset($_GET['page'])){echo 'active';}?>">
                            <a class="nav-link"  href="?page=accueil">
                                <i class="fas fa-home"></i>
                                Accueil / Statistique
                            </a>
                        </li>
                       <?php } if($_Permission_->verifPerm('PermsPanel', 'general', 'showPage')) { ?>
                        <li class="nav-item <?php if(isset($_GET['page'])&&$_GET['page']=='configsite'){echo 'active';}?>">
                            <a class="nav-link"  href="?page=configsite">
                                <i class="fas fa-wrench"></i>
                                Réglages du site
                            </a>
                        </li>
                       <?php } if($_Permission_->verifPerm('PermsPanel', 'theme', 'showPage')) { ?>
                        <li class="nav-item <?php if(isset($_GET['page'])&&$_GET['page']=='theme'){echo 'active';}?>">
                            <a class="nav-link"  href="?page=theme">
                                <i class="fas fa-paint-roller"></i>
                                Thèmes
                            </a>
                        </li>
                       <?php } if($_Permission_->verifPerm('PermsPanel', 'home', 'showPage')) { ?>
                        <li class="nav-item  <?php if(isset($_GET['page'])&&$_GET['page']=='slidemini'){echo 'active';}?>">
                            <a class="nav-link" href="?page=slidemini">
                                <i class="far fa-images"></i>
                                Miniatures
                            </a>
                        </li>
                       <?php } if($_Permission_->verifPerm('PermsPanel', 'server', 'showPage')) { ?>
                        <li class="nav-item <?php if(isset($_GET['page'])&&$_GET['page']=='reglagejsonapi'){echo 'active';}?>">
                            <a class="nav-link"  href="?page=reglagejsonapi">
                                <i class="fas fa-terminal"></i>
                                Réglage JsonAPI/Rcon
                            </a>
                        </li>
                       <?php } if($_Permission_->verifPerm('PermsPanel', 'pages', 'showPage')) { ?>
                        <li class="nav-item <?php if(isset($_GET['page'])&&$_GET['page']=='custompages'){echo 'active';}?>">
                            <a class="nav-link"  href="?page=custompages">
                                <i class="fas fa-pencil-ruler"></i>
                                Création / Edition de pages
                            </a>
                        </li>
                        <?php } if($_Permission_->verifPerm('PermsPanel', 'shop', 'showPage')) { ?>
                        <li class="nav-item <?php if(isset($_GET['page'])&&($_GET['page']=='boutique' | $_GET['page']=='boutiquelist')){echo 'active';}?>">
                            <a class="nav-link  " <?php if(isset($_GET['page'])&&($_GET['page']=='boutique' | $_GET['page']=='boutiquelist')){echo 'active';}?> href="#collapseBoutique" data-toggle="collapse">
                                <i class="fas fa-store-alt"></i>
                                Boutique
                            </a>
                            <div id="collapseBoutique" class="collapse nav-link">

                                <a class="nav-link <?php if(isset($_GET['page'])&&$_GET['page']=='boutique'){echo 'active';}?>"  href="?page=boutique">
                                    <i class="fas fa-cash-register"></i>
                                    Réglages
                                </a>
                                <?php if($_Permission_->verifPerm('PermsPanel', 'shop', 'boutiqueList', 'showPage')) { ?>
                                <a class="nav-link <?php if(isset($_GET['page'])&&$_GET['page']=='boutiquelist'){echo 'active';}?>"  href="?page=boutiquelist">
                                    <i class="fas fa-shipping-fast"></i>
                                    Historique des achats
                                </a>
                                 <?php } ?>
                            </div>
                        </li>
                       <?php } if($_Permission_->verifPerm('PermsPanel', 'menus', 'showPage')) { ?>
                        <li class="nav-item <?php if(isset($_GET['page'])&&$_GET['page']=='menus'){echo 'active';}?>">
                            <a class="nav-link"  href="?page=menus">
                                <i class="fas fa-bars"></i>
                                Menus personnalisées
                            </a>
                        </li>

                        <h6
                            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>Gestion</span>
                            <a class="align-items-center text-muted hrvbig mobilenone" style="font-size: 8px;" data-target="#snakemodal" title="Cliquer pour lancer le mini-jeu !" data-toggle="modal">
                                <i class="fas fa-gamepad"></i>
                            </a>
                        </h6>

                       <?php } if($_Permission_->verifPerm('createur')) { ?>
                        <li class="nav-item <?php if(isset($_GET['page'])&&$_GET['page']=='grade'){echo 'active';}?>">
                            <a class="nav-link"  href="?page=grade">
                                <i class="fas fa-crown"></i>
                                Grades
                            </a>
                        </li>
                       <?php } if($_Permission_->verifPerm('PermsPanel', 'news', 'showPage')) { ?>
                        <li class="nav-item <?php if(isset($_GET['page'])&&$_GET['page']=='news'){echo 'active';}?>">
                            <a class="nav-link"  href="?page=news">
                                <i class="far fa-newspaper"></i>
                                Nouveautés
                            </a>
                        </li>
                        <?php } if($_Permission_->verifPerm('PermsPanel', 'payment', 'showPage')) { ?>
                        <li class="nav-item ">
                            <a class="nav-link <?php if(isset($_GET['page'])&&($_GET['page']=='paiement' |isset($_GET['paypal'])|isset($_GET['dedipass']))){echo 'collapseaactive';}?>" href="#collapsePaiement" data-toggle="collapse">
                                <i class="far fa-credit-card"></i>
                                Moyens de paiement
                            </a>
                            <div id="collapsePaiement" class="collapse nav-link <?php if(isset($_GET['paypal']) OR $_GET['page'] == 'paiement' OR isset($_GET['paypal']) OR isset($_GET['dedipass'])){echo 'show';}?>">
                                <a class="nav-link <?php if(isset($_GET['paypal'])){echo 'active';}?>" href="?page=paiement&paypal">
                                    <i class="fab fa-paypal"></i>
                                    PayPal
                                </a>
                                <a class="nav-link <?php if(isset($_GET['dedipass'])&&$_GET['page']=='paiement'){echo 'active';}?>" href="?page=paiement&dedipass">
                                    <i class="fas fa-sms"></i>
                                    DediPass
                                </a>
                                <a class="nav-link <?php if(isset($_GET['page'])&&$_GET['page']=='paiement'&&(!isset($_GET['paypal']) && (!isset($_GET['dedipass'])))){echo 'active';}?>" href="?page=paiement">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                    PaySafeCard
                                </a>
                            </div>
                        </li>
                        <?php } if($_Permission_->verifPerm('PermsPanel', 'vote', 'showPage')) { ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(isset($_GET['page']) AND $_GET['page'] == 'voter'|$_GET['page']=='configVoter'){echo'collapseaactive'; }?>" href="#collapseVotes" data-toggle="collapse"  <?php if(isset($_GET['page'])&&$_GET['page']=='voter'|$_GET['page']=='configVoter'){echo 'aria-expanded="true" aria-controls="collapseVotes"';}?>>
                                <i class="fas fa-vote-yea"></i>
                                Votes
                            </a>
                            <div id="collapseVotes" class="collapse nav-link <?php if(isset($_GET['page'])&&$_GET['page']=='voter'|$_GET['page']=='configVoter'){echo 'show';}?>">

                                <a class="nav-link <?php if(isset($_GET['page'])&&$_GET['page']=='voter'){echo 'active';}?>" href="?page=voter">
                                    <i class="fas fa-cogs"></i>
                                    Réglages des sites
                                </a>
                                <?php if($_Permission_->verifPerm('PermsPanel', 'vote', 'recompenseAuto', 'showPage')) { ?>
                                <a class="nav-link <?php if(isset($_GET['page'])&&$_GET['page']=='configVoter'){echo 'active';}?>" href="?page=configVoter">
                                    <i class="fas fa-ruler"></i>
                                    Récompences automatique
                                </a>
                                <?php } ?>
                            </div>
                        </li>
                        <?php } if($_Permission_->verifPerm('PermsPanel', 'members', 'showPage') OR $_Permission_->verifPerm('PermsPanel', 'social', 'showPage') OR $_Permission_->verifPerm("PermsPanel", 'ban', 'showPage')) { ?>
                        <li class="nav-item ">
                            <a class="nav-link <?php if(isset($_GET['page'])&&($_GET['page']=='membres' |$_GET['page']=='social' |$_GET['page']=='modifIP'|$_GET['page']=='ban')){echo 'collapseaactive';}?>" href="#collapseMembres" data-toggle="collapse" <?php if(isset($_GET['page'])&&($_GET['page']=='membres' |$_GET['page']=='social' |$_GET['page']=='modifIP'|$_GET['page']=='ban')){echo 'aria-expanded="true" aria-controls="collapseMembres"';}?>>
                                <i class="fas fa-user-friends"></i>
                                Membres
                            </a>
                            <div id="collapseMembres" class="collapse nav-link <?php if(isset($_GET['page'])&&($_GET['page']=='membres' |$_GET['page']=='social' |$_GET['page']=='modifIP'|$_GET['page']=='ban')){echo 'show';}?>">
                                <a class="nav-link <?php if(isset($_GET['page'])&&$_GET['page']=='membres'){echo 'active';}?>" href="?page=membres">
                                    <i class="fas fa-users-cog"></i>
                                    Liste des utilisateurs
                                </a>
                                <?php if($_Permission_->verifPerm('PermsPanel', 'social', 'showPage')) { ?>
                                <a class="nav-link <?php if(isset($_GET['page'])&&$_GET['page']=='social'){echo 'active';}?>" href="?page=social">
                                    <i class="fas fa-screwdriver"></i>
                                    Réglages des champs personnalisées
                                </a>
                                <?php } if(Permission::getInstance()->verifPerm('PermsPanel', 'info', 'stats', 'members', 'showTable') && (Permission::getInstance()->verifPerm('PermsPanel', 'info', 'stats', 'members', 'editLimitIp') || Permission::getInstance()->verifPerm('PermsPanel', 'info', 'stats', 'members', 'editEmail'))) { ?>
                                <a class="nav-link <?php if(isset($_GET['page'])&&$_GET['page']=='modifIP'){echo 'active';}?>" href="?page=modifIP">
                                    <i class="fas fa-toolbox"></i>
                                    Limitations IP/Email
                                </a>
                                <?php } if($_Permission_->verifPerm('PermsPanel', 'ban', 'showPage')) { ?>
                                <a class="nav-link <?php if(isset($_GET['page'])&&$_GET['page']=='ban'){echo 'active';}?>" href="?page=ban">
                                    <i class="fas fa-wrench"></i>
                                    Bannissement
                                </a>
                                <?php } ?>
                            </div>
                        </li>
                       <?php } if($_Permission_->verifPerm('PermsPanel', 'forum', 'showPage')) { ?>
                        <li class="nav-item <?php if(isset($_GET['page'])&&$_GET['page']=='forum'){echo 'active';}?>">
                            <a class="nav-link"  href="?page=forum">
                                <i class="fas fa-comments"></i>
                                Forum
                            </a>
                        </li>
                       <?php } if($_Permission_->verifPerm('PermsPanel', 'widgets', 'showPage')) { ?>
                        <li class="nav-item <?php if(isset($_GET['page'])&&$_GET['page']=='widgets'){echo 'active';}?>">
                            <a class="nav-link"  href="?page=widgets">
                                <i class="fas fa-share-square"></i>
                                Widgets
                            </a>
                        </li>
                         <?php } if($_Permission_->verifPerm('PermsPanel', 'support', 'tickets', 'showPage')) { ?>
                        <li class="nav-item <?php if(isset($_GET['page'])&&$_GET['page']=='support'){echo 'active';}?>">
                            <a class="nav-link" href="?page=supports">
                                <i class="fas fa-life-ring"></i>
                                Support
                            </a>
                        </li>
                         <?php } if($_Permission_->verifPerm('PermsPanel', 'support', 'maintenance', 'showPage')) { ?>
                        <li class="nav-item <?php if(isset($_GET['page'])&&$_GET['page']=='maintenance'){echo 'active';}?>">
                            <a class="nav-link"  href="?page=maintenance">
                                <i class="fas fa-wrench"></i>
                                Maintenance
                            </a>
                        </li>
                         <?php } if($_Permission_->verifPerm('PermsPanel', 'newsletter', 'showPage')) { ?>
                        <li class="nav-item <?php if(isset($_GET['page'])&&$_GET['page']=='newsletter'){echo 'active';}?>">
                            <a class="nav-link"  href="?page=newsletter">
                                <i class="fas fa-newspaper"></i>
                                NewsLetter
                            </a>
                        </li>
                       <?php } if($_Permission_->verifPerm('PermsPanel', 'support', 'maintenance','showPage')) { ?>
                        <li class="nav-item <?php if(isset($_GET['page'])&&$_GET['page']=='upload'){echo 'active';}?>">
                            <a class="nav-link"  href="?page=upload">
                                <i class="fas fa-cloud-upload-alt"></i>
                                Upload
                            </a>
                        </li>
                       <?php } if($_Permission_->verifPerm('PermsPanel', 'update', 'showPage')) { ?>
                        <li class="nav-item <?php if(isset($_GET['page'])&&$_GET['page']=='maj'){echo 'active';}?>">
                            <a class="nav-link"  href="?page=maj">
                                <i class="fas fa-box-open"></i>
                                Mise à jour
                            </a>
                        </li>
                         <?php }  ?>
                         <li class="nav-item">
                            <a class="nav-link hrvbig" onclick='javascript:(function(){function c(){var e=document.createElement("link");e.setAttribute("type","text/css");e.setAttribute("rel","stylesheet");e.setAttribute("href",f);e.setAttribute("class",l);document.body.appendChild(e)}function h(){var e=document.getElementsByClassName(l);for(var t=0;t<e.length;t++){document.body.removeChild(e[t])}}function p(){var e=document.createElement("div");e.setAttribute("class",a);document.body.appendChild(e);setTimeout(function(){document.body.removeChild(e)},100)}function d(e){return{height:e.offsetHeight,width:e.offsetWidth}}function v(i){var s=d(i);return s.height>e&&s.height<n&&s.width>t&&s.width<r}function m(e){var t=e;var n=0;while(!!t){n+=t.offsetTop;t=t.offsetParent}return n}function g(){var e=document.documentElement;if(!!window.innerWidth){return window.innerHeight}else if(e&&!isNaN(e.clientHeight)){return e.clientHeight}return 0}function y(){if(window.pageYOffset){return window.pageYOffset}return Math.max(document.documentElement.scrollTop,document.body.scrollTop)}function E(e){var t=m(e);return t>=w&&t<=b+w}function S(){var e=document.createElement("audio");e.setAttribute("class",l);e.src=i;e.loop=false;e.addEventListener("canplay",function(){setTimeout(function(){x(k)},500);setTimeout(function(){N();p();for(var e=0;e<O.length;e++){T(O[e])}},15500)},true);e.addEventListener("ended",function(){N();h()},true);e.innerHTML=" <p>If you are reading this, it is because your browser does not support the audio element. We recommend that you get a new browser.</p> <p>";document.body.appendChild(e);e.play()}function x(e){e.className+=" "+s+" "+o}function T(e){e.className+=" "+s+" "+u[Math.floor(Math.random()*u.length)]}function N(){var e=document.getElementsByClassName(s);var t=new RegExp("\\b"+s+"\\b");for(var n=0;n<e.length;){e[n].className=e[n].className.replace(t,"")}}var e=30;var t=30;var n=350;var r=350;var i="//s3.amazonaws.com/moovweb-marketing/playground/harlem-shake.mp3";var s="mw-harlem_shake_me";var o="im_first";var u=["im_drunk","im_baked","im_trippin","im_blown"];var a="mw-strobe_light";var f="//s3.amazonaws.com/moovweb-marketing/playground/harlem-shake-style.css";var l="mw_added_css";var b=g();var w=y();var C=document.getElementsByTagName("*");var k=null;for(var L=0;L<C.length;L++){var A=C[L];if(v(A)){if(E(A)){k=A;break}}}if(A===null){console.warn("Could not find a node of the right size. Please try a different page.");return}c();S();var O=[];for(var L=0;L<C.length;L++){var A=C[L];if(v(A)){O.push(A)}}})()'>
                                NE PAS CLIQUER
                            </a>
                        </li>
                        <!-- Fin des items de navigations -->
                    </ul>
                </div>
            </nav>