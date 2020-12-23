<?php
if($_Permission_->verifPerm("createur")) {

require_once('modele/grades/NOT_TOUCH/perms.config.php');
$PermissionFormat = array_to_unidim(PERMS);

$PermissionFormat["PermsDefault"]="Permissions générales";
    $PermissionFormat["PermsDefault-news"]="Nouveautés";
    $PermissionFormat["PermsDefault-support"]="Support";
    $PermissionFormat["PermsDefault-chat"]="Chat";
    $PermissionFormat["PermsDefault-forum"]="Forum";

$PermissionFormat["PermsPanel"]="Permissions panel";
    $PermissionFormat["PermsPanel-info"]="Page information";
        $PermissionFormat["PermsPanel-info-details"]="information relatif aux serveurs";
        $PermissionFormat["PermsPanel-info-stats"]="Accès au statistique";
        $PermissionFormat["PermsPanel-info-stats-visitors"]="Compte rendu des visiteurs";
        $PermissionFormat["PermsPanel-info-stats-members"]="Paramètres relatif aux membres";
        $PermissionFormat["PermsPanel-info-stats-activity"]="Activités";
        $PermissionFormat["PermsPanel-info-stats-shop"]="Boutique";
    $PermissionFormat["PermsPanel-general"]="Page general";
        $PermissionFormat["PermsPanel-general-actions"]="Actions";
    $PermissionFormat["PermsPanel-theme"]="Page Thème";
        $PermissionFormat["PermsPanel-theme-actions"]="Actions";
    $PermissionFormat['PermsPanel-sliderMini'] = "Page Miniatures";
    $PermissionFormat["PermsPanel-home"]="Page Accueil";
        $PermissionFormat["PermsPanel-home-actions"]="Actions";
    $PermissionFormat["PermsPanel-server"]="Page Réglages serveur";
        $PermissionFormat["PermsPanel-server-actions"]="Actions";
    $PermissionFormat["PermsPanel-pages"]="Page Création de page";
        $PermissionFormat["PermsPanel-pages-actions"]="Actions";
    $PermissionFormat["PermsPanel-news"]="Page nouveautés";
        $PermissionFormat["PermsPanel-news-actions"]="Actions";
    $PermissionFormat["PermsPanel-shop"]="Page Boutique";
        $PermissionFormat["PermsPanel-shop-actions"]="Actions";
        $PermissionFormat['PermsPanel-shop-achatEvo']= "Page de réglage des achats évolutifs";
        $PermissionFormat['PermsPanel-shop-boutiqueList']= "¨Page Historique des achats";
    $PermissionFormat["PermsPanel-payment"]="Page Payement";
        $PermissionFormat["PermsPanel-payment-actions"]="Actions";
    $PermissionFormat["PermsPanel-menus"]="Page Menu";
        $PermissionFormat["PermsPanel-menus-actions"]="Actions";
    $PermissionFormat["PermsPanel-vote"]="Page Vote";
        $PermissionFormat["PermsPanel-vote-actions"]="Actions";
        $PermissionFormat['PermsPanel-vote-voteHistory']="Page historique des votes";
            $PermissionFormat['PermsPanel-vote-voteHistory-actions']="Actions";
        $PermissionFormat['PermsPanel-vote-recompenseAuto']="Page récompense Automatique";
            $PermissionFormat['PermsPanel-vote-recompenseAuto-actions']="Actions";
    $PermissionFormat["PermsPanel-members"]="Page Membres";
        $PermissionFormat["PermsPanel-members-actions"]="Actions";
    $PermissionFormat["PermsPanel-forum"]="Page Forum";
        $PermissionFormat["PermsPanel-forum-actions"]="Actions";
    $PermissionFormat["PermsPanel-widgets"]="Page Widgets";
        $PermissionFormat["PermsPanel-widgets-actions"]="Actions";
    $PermissionFormat["PermsPanel-support"]="Page Support";
        $PermissionFormat["PermsPanel-support-tickets"]="Tickets";
            $PermissionFormat["PermsPanel-support-tickets-actions"]="Actions";
    $PermissionFormat["PermsPanel-maintenance"]="Page Maintenance";
        $PermissionFormat["PermsPanel-maintenance-actions"]="Actions";
    $PermissionFormat["PermsPanel-update"]="Page Mise à jour";
    $PermissionFormat["PermsPanel-social"]="Page Membres => Réseaux sociaux";
    $PermissionFormat["PermsPanel-newsletter"]="Page Newsletter";
        $PermissionFormat["PermsPanel-newsletter-actions"]="Actions";
    $PermissionFormat["PermsPanel-ban"]="Page Membres => Bannissement";
        $PermissionFormat["PermsPanel-ban-actions"]="Actions";
    $PermissionFormat["PermsPanel-upload"]="Page Upload";

$PermissionFormat["PermsForum"]="Permissions Forums";
    $PermissionFormat["PermsForum-general"]="Général";
    $PermissionFormat["PermsForum-moderation"]="Modération";

$recup = $bddConnection->query('SELECT * FROM cmw_grades ORDER BY priorite');
$idGrade = $recup->fetchAll(PDO::FETCH_ASSOC);
foreach($idGrade as $key => $value)
{
    $idGrade[$key]['PermsDefault'] = unserialize($value['permDefault']);
    $idGrade[$key]['PermsPanel'] = unserialize($value['permPanel']);
    $idGrade[$key]['PermsForum'] = unserialize($value['permForum']);
}

$effets = array(
    'style5',
    'style16'
);
}
function hasPerm($i, $str, $grades) {
    $ar = explode("-", $str);
    $perm = $grades[$i];
    foreach($ar as $value)
    {
        $perm = $perm[$value];
    }
    return $perm == true;

}

function hasPermArray($i, $str, $grades) {
    $ar = explode("-", $str);
    $perm = $grades[$i];
    foreach($ar as $value)
    {
        $perm = $perm[$value];
    }
    foreach($perm as $key => $value)
    {
        if(is_array($value)) {
            if(hasPermArray2($value, $key) != true) {
                return false;
            }
        } else {
            if($perm[$key] != true) {
                return false;
            }
        }
    }
    return true;
}

function hasPermArray2($perm, $suivi) {
    foreach($perm as $key => $value)
    {
        $suivi = $suivi."-".$key;
        if(is_array($value)) {
            if($suivi == "PermsDefault-forum" )
            {
                continue;
            }
            if(hasPermArray2($value, $suivi) != true) {
                return false;
            }
        } else {
            if($perm[$key] != true) {
                return false;
            }
        }
    }
    return true;
}


function editPerm($id, $edit, $perm, $str, $POST) {
    foreach($perm as $key => $value)
    {
        if($key != "Grade" & $key != "prefix" & $key != "effets" & $key != "couleur") {
            if($str == "") {
                $str2 = $key;
            } else {
                $str2 = $str."-".$key;
            }
            if(is_array($value))
            {
                $edit = editPerm($id, $edit, $value, $str2, $POST);
            } else {
                $ar = explode("-", $str2);
                if($str2 == "PermsDefault-forum-perms")
                {
                    $result = $POST[$str2."-".$id];
                } else {
                    $result = isset($POST[$str2."-".$id]);
                }
                if(count($ar) == 1) {
                    $edit[$ar[0]] = $result;
                } else if(count($ar) == 2) {
                    $edit[$ar[0]][$ar[1]] = $result;
                } else if(count($ar) == 3) {
                    $edit[$ar[0]][$ar[1]][$ar[2]] = $result;
                } else if(count($ar) == 4) {
                    $edit[$ar[0]][$ar[1]][$ar[2]][$ar[3]] = $result;
                } else if(count($ar) == 5) {
                    $edit[$ar[0]][$ar[1]][$ar[2]][$ar[3]][$ar[4]] = $result;
                } else if(count($ar) == 6) {
                    $edit[$ar[0]][$ar[1]][$ar[2]][$ar[3]][$ar[4]][$ar[5]] = $result;
                } else if(count($ar) == 7) {
                    $edit[$ar[0]][$ar[1]][$ar[2]][$ar[3]][$ar[4]][$ar[5]][$ar[6]] = $result;
                } else if(count($ar) == 8) {
                    $edit[$ar[0]][$ar[1]][$ar[2]][$ar[3]][$ar[4]][$ar[5]][$ar[6]][$ar[7]] = $result;
                }

            }
        }
    }
    return $edit;
} 

function showForFormatage($perm, $suivi) {
    foreach($perm as $key => $value)
    {
        if($key != "Grade" & $key != "prefix" & $key != "effets" & $key != "couleur") 
        {
            if($suivi == "") {
                $suivi2 = $key;
            } else {
                $suivi2 = $suivi."-".$key;
            }
            echo '$PermissionFormat["'.$suivi2.'"]="";<br/>';
            if(is_array($value)) {
                showForFormatage($value, $suivi2);
            }
        }
    }
}

function array_to_unidim($array, $parent = '') {
    $result = array();
    foreach($array as $key => $value)
    {
        if(is_array($value))
            $result = array_merge($result, array_to_unidim($value, $parent.''.$key.'-'));
        else
            $result = array_merge($result, array($parent.''.$key => $value));
    }
    return $result;
}
function writePerm($perm, $nb, $id, $other, $idGrade, $PermissionFormat) {
    if(isset($perm) && is_array($perm)) {
        echo '<ul '.($nb == 20 ? 'style="margin-left:-30px;"':'style="display:none;"').'class="grade-ul" id="cont'.($nb== 20 ? '' : '-').''.$id.'-'.$other.'">';
        foreach($perm as $key => $value)
        {

            if($key != "Grade" & $key != "prefix" & $key != "effets" & $key != "couleur")
            {
                if( is_array($value)) {  ?>
                    <div class="custom-control custom-switch" id="grade-div"> 
                        <li class="grade-li" onclick="switchGrade(this,'cont-<?php echo $id; ?><?php echo ($nb== 20 ? '' : '-'); ?><?php echo $key; ?>-<?php echo $other; ?>', '<?php echo $PermissionFormat[$id."".($nb== 20 ? '' : '-')."".$key]; ?>');" value="0" style="cursor:pointer;font-size:<?php echo $nb; ?>px;display:inline;" id="tab-<?php echo $id; ?><?php echo ($nb== 20 ? '' : '-'); ?><?php echo $key; ?>" ><i class="far fa-plus-square"></i> <?php echo $PermissionFormat[$id."".($nb== 20 ? '' : '-')."".$key]; ?>

                        </li>
                        <?php if($id."-".$key != "PermsDefault-forum") { ?>
                            <input type="checkbox" onclick="CheckUnder(get('cont-<?php echo $id; ?><?php echo ($nb== 20 ? '' : '-'); ?><?php echo $key; ?>-<?php echo $other; ?>'),this.checked);updateGradeUl(this);" class="custom-control-input" id="<?php echo $id; ?><?php echo ($nb== 20 ? '' : '-'); ?><?php echo $key; ?>-<?php echo $other; ?>" <?php  if(hasPermArray($other,$id.''.($nb== 20 ? '' : '-').''.$key, $idGrade)) { echo 'checked'; } ?>> 
                            <label  style="margin-left:40px;margin-top:-30px;" class="custom-control-label " for="<?php echo $id; ?><?php echo ($nb== 20 ? '' : '-'); ?><?php echo $key; ?>-<?php echo $other; ?>"></label>
                        <?php } ?>
                        </div> 

                <?php writePerm($value, $nb == 20 ? 17 : ($nb == 17 ? 15 : 13), $id."".($nb== 20 ? '' : '-')."".$key,$other, $idGrade, $PermissionFormat);

            } else { ?>
                        <div class="custom-control custom-switch" id="grade-div"> 
                        <li style="font-size:<?php echo $nb; ?>px;display:inline;" class="grade-li" ><?php echo $PermissionFormat[$id."".($nb== 20 ? '' : '-')."".$key]; ?>

                        </li>
                            <?php if($id."-".$key == "PermsDefault-forum-perms") { ?>
                                <input value="<?php echo $idGrade[$other]["PermsDefault"]["forum"]["perms"]; ?>" type="number" min="0" max="99" class="form-control" name="<?php echo $id; ?><?php echo ($nb== 20 ? '' : '-'); ?><?php echo $key; ?>-<?php echo $other; ?>"> 

                            <?php } else { ?>
                            <input value="true" type="checkbox" onclick="updateGradeUl(this);" class="custom-control-input" id="<?php echo $id; ?><?php echo ($nb== 20 ? '' : '-'); ?><?php echo $key; ?>-<?php echo $other; ?>" name="<?php echo $id; ?><?php echo ($nb== 20 ? '' : '-'); ?><?php echo $key; ?>-<?php echo $other; ?>"
                             <?php if(hasPerm($other,$id.''.($nb== 20 ? '' : '-').''.$key, $idGrade)) { echo 'checked'; } ?>> 
                            <label  style="margin-left:40px;margin-top:-30px;" class="custom-control-label " for="<?php echo $id; ?><?php echo ($nb== 20 ? '' : '-'); ?><?php echo $key; ?>-<?php echo $other; ?>"></label>
                            <?php } ?>
                        </div> 

                    
                <?php }
            }
        }
        echo '</ul>';
    } else {

    }
}
?>
