<?php

$dirGrades = './modele/grades/';
$initGrades = glob($dirGrades.'*.yml');

$lastGrade[] = array();
foreach($initGrades as $numGrade) {
    $lastGrade[] = substr($numGrade, 16, -4);
}

$lastGrade = array_filter($lastGrade);
if(empty($lastGrade))
    array_push($lastGrade, -1);

for($i = 2;$i <= max($lastGrade); $i++) {
    $perms = Permission::getInstance()->readPerm($i);
    $data = array();
    $data['nom'] = $perms['Grade'];
    $data['priorite'] = $i;
    $data['prefix'] = $perms['prefix'];
    $data['couleur'] = $perms['couleur'];
    $data['effets'] = $perms['effets'];
    $data['permDefault'] = serialize($perms['PermsDefault']);
    $data['permPanel'] = serialize($perms['PermsPanel']);
    $data['permForum'] = serialize($perms['PermsForum']);
    $update = $bddConnection->prepare('INSERT INTO cmw_grades (nom, priorite, prefix, couleur, effets, permDefault, permPanel, permForum) VALUES (:nom, :priorite, :prefix, :couleur, :effets, :permDefault, :permPanel, :permForum)');
    $update->execute($data); 
}


?>