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
    $PermissionFormat["PermsPanel-maintenance"]="Maintenance";
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

var_dump($PermissionFormat);
$dirGrades = './modele/grades/';
$initGrades = glob($dirGrades.'*.yml');

$lastGrade[] = array();
foreach($initGrades as $numGrade) {
    $lastGrade[] = substr($numGrade, 16, -4);
}

$lastGrade = array_filter($lastGrade);
if(empty($lastGrade))
    array_push($lastGrade, -1);

$idGrade[] = array();
for($i = 2;$i <= max($lastGrade); $i++) {
    $openGrade = new Lire($dirGrades.$i.'.yml');
    $readGrade = $openGrade->GetTableau();
    $idGrade[$i] = $readGrade;
}
$prefixs = array(
                             'prefixPrimary',
                             'prefixSecondary',
                             'prefixRed',
                             'prefixGreen',
                             'prefixOlive',
                             'prefixLightGreen',
                             'prefixBlue',
                             'prefixRoyalBlue',
                             'prefixSkyBlue',
                             'prefixGray',
                             'prefixSilver',
                             'prefixYellow',
                             'prefixOrange',
                             'prefixCreateur'
                         );
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
        if($key != "Grade" & $key != "prefix" & $key != "effets") {
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
        if($key != "Grade" & $key != "prefix" & $key != "effets") 
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
?>