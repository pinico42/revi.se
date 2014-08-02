<?php
$uid = $_GET['u'];
$right = (int) $_GET['r'];
$done = (int) $_GET['d'];
$user = $_COOKIE['email'];

$f = fopen('private/abilities.json','r');
$jsonF = fread($f, filesize('private/abilities.json'));
$json = json_decode($jsonF, true);
fclose($f);

$usersAbilities = $json[$user];
$topicAbilities = $usersAbilities[$uid];
$fullDone = $topicAbilities['done'] + $done;
$fullRight = $topicAbilities['right'] + $right;
$newTopicAbilities = array("done" => $fullDone, "right" => $fullRight);
$newUsersAbilities = $usersAbilities;
$newUsersAbilities[$uid] = $newTopicAbilities;
$newJson = $json;
$newJson[$user] = $newUsersAbilities;

$newJsonF = json_encode($newJson);
$wf = fopen('private/abilities.json','w');
fwrite($wf, $newJsonF);
fclose($wf);
?>