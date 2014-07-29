<?php
include "layouts.php";
$l = getLayout("basic.layout");
$l->writeHeader();
?>
<?php

function get_json($path){
	$subjectsFile = fopen($path,'r');

	$json = fread($subjectsFile,filesize($path));

	$subjectsObj = json_decode($json,true);

	fclose($subjectsFile);

	return $subjectsObj;
}

$email = $_COOKIE['email'];

$topics = get_json("private/topics.json");

$usersTopics = $topics[$email];

$curretSubject = $_GET['s'];

$currentTopic = $usersTopics[$currentSubject];

?>
<h1 class='title'>Your Topics</h1>
<div id='topics'>
	<?php
	foreach($usersTopics as $topic){
		echo "
			<div class='topic'>
			topic
			</div>
		";
	}
	?>
	<div class='topic new'>new</div>
</div>

<?php
$l->writeFooter();
?>