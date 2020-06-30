<div class="panel panel-default cmw-sidebar-panel">
  <div class="panel-body cmw-sidebar-panel-body">
    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['info']['showPage'] == true) { ?>
    <a href="?page=accueil" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if($pageadmin == 'accueil' OR $pageadmin == ''){ echo 'active'; } ?>"  role="button">Accueil & Stats<i class="fa fa-area-chart cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['general']['showPage'] == true) { ?>
    <a href="?page=configsite" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'configsite'){ echo 'active'; } ?>" role="button">Réglage site <i class="fa fa-heartbeat cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['theme']['showPage'] == true) { ?>
    <a href="?page=theme" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'theme'){ echo 'active'; } ?>" role="button">Thème <i class="fa fa-object-group cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['home']['showPage'] == true) { ?>
    <a href="?page=slidemini" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'slidemini'){ echo 'active'; } ?>" role="button">Slider & Miniature <i class="fas fa-file-image cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['server']['showPage'] == true) { ?>
    <a href="?page=reglagejsonapi" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'reglagejsonapi'){ echo 'active'; } ?>" role="button">Réglages JsonAPI <i class="fa fa-sitemap cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['pages']['showPage'] == true) { ?>
    <a href="?page=custompages" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'custompages'){ echo 'active'; } ?>" role="button">Pages personnalisées <i class="fa fa-puzzle-piece cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['shop']['showPage'] == true) { ?>
        <a href="#collapseBoutique" data-toggle="collapse" style="margin-bottom: 5px;" aria-expanded="true" aria-controls="collapseBoutique" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?=(isset($pageadmin) && ($pageadmin == 'boutique' || $pageadmin == 'boutiquelist')) ? 'active' : ''?>" role="button">Boutique <i class="fa fa-shopping-cart cmw-fa-sidebar" aria-hidden="true"></i></a>
        <div id="collapseBoutique" class="collapse <?=(isset($pageadmin) && ($pageadmin == 'boutique' || $pageadmin == 'boutiquelist')) ? 'in' : '';?>" style="margin-bottom: 5px; padding-left: 10px;">
            <a href="?page=boutique" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'boutique'){ echo 'active'; } ?>" role="button">Réglage boutique <i class="fa fa-shopping-cart cmw-fa-sidebar" aria-hidden="true"></i></a>
            <a href="?page=boutiquelist" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?=(isset($pageadmin) && $pageadmin == 'boutiquelist') ? 'active' : '';?>" role="button">Liste des achats <i class="fa fa-truck cmw-fa-sidebar" aria-hidden="true"></i></a>
        </div>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['payment']['showPage'] == true) { ?>
    <a href="?page=paiement" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'paiement'){ echo 'active'; } ?>" role="button">Réglage paiement <i class="fas fa-credit-card cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['menus']['showPage'] == true) { ?>
    <a href="?page=menus" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'menus'){ echo 'active'; } ?>" role="button">Menus personnalisées <i class="fa fa-bars cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1) { ?>
    <a href="?page=grade" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'grade'){ echo 'active'; } ?>" role="button"><strong>Gestion </strong><i class="fa fa-arrow-right" aria-hidden="true"></i> Rangs <i class="fa fa-users cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['news']['showPage'] == true) { ?>
    <a href="?page=news" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'news'){ echo 'active'; } ?>" role="button"><strong>Gestion </strong><i class="fa fa-arrow-right" aria-hidden="true"></i> News <i class="fa fa-info-circle cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['vote']['showPage'] == true) { ?>
    <a href="#collapseVoter" data-toggle="collapse" style="margin-bottom: 5px;" aria-expanded="true" aria-controls="collapseVoter" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin) && ($pageadmin == 'voter' || $pageadmin == 'configVoter')){ echo 'active'; } ?>" role="button"><strong>Gestion </strong><i class="fa fa-arrow-right" aria-hidden="true"></i> Vote <i class="fa fa-star cmw-fa-sidebar" aria-hidden="true"></i></a>
    <div id="collapseVoter" class="collapse <?=(isset($pageadmin) && ($pageadmin == 'voter' || $pageadmin == 'configVoter')) ? 'in' : ''; ?>" style="margin-bottom: 5px; padding-left: 10px;">
    	<a href="?page=voter" role="button" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin) && $pageadmin == "voter") echo 'active'; ?>">Liens vote <i class="fa fa-link cmw-fa-sidebar"></i></a>
    	<a href="?page=configVoter" role="button" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin) && $pageadmin == "configVoter") echo 'active'; ?>">Récompenses Auto <i class="fa fa-trophy cmw-fa-sidebar"></i></a>
    </div>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['members']['showPage'] == true OR $_PGrades_['PermsPanel']['newsletter']['showPage'] == true OR $_PGrades_['PermsPanel']['social']['showPage'] == true) { ?>
    <a href="#collapseMembres" data-toggle="collapse" style="margin-bottom: 5px;" aria-expanded="true" aria-controls="collapseMembres" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin) && ($pageadmin == 'membres' OR $pageadmin == "newsletter" OR $pageadmin == "social" OR $pageadmin == "modifIP" OR $pageadmin == "ban")){ echo 'active'; } ?>" role="button"><strong>Gestion </strong><i class="fa fa-arrow-right" aria-hidden="false"></i> Membres <i class="fa fa-users cmw-fa-sidebar" aria-hidden="true"></i></a>
     <div id="collapseMembres" class="collapse <?=(isset($pageadmin) && ($pageadmin == "membres" OR $pageadmin == "newsletter" OR $pageadmin == "social" OR $pageadmin == "modifIP" OR $pageadmin == "ban"))  ? 'in' : ''; ?> " style="margin-bottom: 5px; padding-left: 10px;">
        <a href="?page=membres" role="button" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin) && $pageadmin == "membres") echo 'active'; ?>">Informations <i class="fa fa-address-card cmw-fa-sidebar"></i></a>
        <a href="?page=social" role="button" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin) && $pageadmin == "social") echo 'active'; ?>">Social <i class="fa fa-address-book cmw-fa-sidebar"></i></a>
        <?php if($_Joueur_['rang'] == 1 OR ($_PGrades_['PermsPanel']['info']['stats']['members']['showTable'] == true AND $_PGrades_['PermsPanel']['info']['stats']['members']['editLimitIp'] OR $_PGrades_['PermsPanel']['info']['stats']['members']['editEmail'] == true)) { ?>
        <a href="?page=modifIP" role="button" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin) && $pageadmin == "modifIP") echo 'active'; ?>">Édition système IP/Mail <i class="fa fa-wrench cmw-fa-sidebar" aria-hidden="true"></i></a>
        <?php } ?>
        <a href="?page=newsletter" role="button" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin) && $pageadmin == "newsletter") echo 'active'; ?>">Newsletter <i class="fas fa-newspaper cmw-fa-sidebar" aria-hidden="true"></i></a>
        <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['ban']['showPage'] == true) { ?><a href="?page=ban" role="button" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin) && $pageadmin == "ban") echo 'active'; ?>">Bannissement <i class="fa fa-wrench cmw-fa-sidebar" aria-hidden="true"></i></a><?php } ?>
    </div>
    <?php } 

         if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['forum']['showPage'] == true) { ?>
    <a href="?page=forum" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'forum') { echo 'active'; } ?>" role="button"><strong>Gestion </strong><i class="fa fa-arrow-right" aria-hidden="true"></i> Forum <i class="fa fa-font cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php }

         if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['widgets']['showPage'] == true) { ?>
    <a href="?page=widgets" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'widgets'){ echo 'active'; } ?>" role="button"><strong>Gestion </strong><i class="fa fa-arrow-right" aria-hidden="true"></i>  Widgets <i class="fas fa-share-square cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['tickets']['showPage'] == true) { ?>
    <a href="?page=support" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'support'){ echo 'active'; } ?>" role="button"><strong>Gestion </strong><i class="fas fa-arrow-right" aria-hidden="true"></i> Support <i class="fa fa-life-ring cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['maintenance']['showPage'] == true) { ?>
    <a href="?page=maintenance" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'maintenance'){ echo 'active'; } ?>" role="button"><strong>Gestion </strong><i class="fa fa-arrow-right" aria-hidden="true"></i> Maintenance <i class="fa fa-wrench cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <!-- <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['maintenance']['showPage'] == true) { ?>
    <a href="?page=newsletter" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'newsletter'){ echo 'active'; } ?>" role="button"><strong>Gestion </strong><i class="fa fa-arrow-right" aria-hidden="true"></i> NewsLetter <i class="fa fa-wrench cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?> -->

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['maintenance']['showPage'] == true) { ?>
    <a href="?page=upload" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'upload'){ echo 'active'; } ?>" role="button">Upload <i class="fa fa-upload cmw-fa-sidebar" aria-hidden="true"></i> </a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['update']['showPage'] == true) { ?>
    <a href="?page=maj" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'maj'){ echo 'active'; } ?>" role="button">Mise à jour <i class="fab fa-free-code-camp cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>
  </div>
</div>
