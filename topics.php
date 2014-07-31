<?php
include 'private/pwds.php';
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

if(isset($_GET['s'])){
	$currentSubject = $_GET['s'];
} else {
	header('Location: index.php');
}

$currentTopic = $usersTopics[$currentSubject];
?>

<?php
include "layouts.php";
$l = getLayout("basic.layout");
$l->writeHeader();
?>
<style>body{
	width: auto;
    overflow-x: auto;
    overflow-y: hidden;
    white-space: nowrap;
}</style>
<h1 class='title'>Your Topics</h1>
<div id='topics'>
	<?php
	

	foreach($currentTopic as $topicUID){
		$conn = mysqli_connect('localhost',$mysqlUsername,$mysqlPassword, 'revise');

		$q = "SELECT * FROM topics WHERE uid = '$topicUID';";

		$query = mysqli_query($conn, $q);

		// if(is_null($query)){
		// 	header('Location: index.php');
		// }

		$result = mysqli_fetch_array($query, MYSQLI_ASSOC);


		mysqli_close($conn);
		$name = $result['name'];
		$img = $result['img'];
		$creator = $result['email'];
		$desc = $result['descr'];
		$uid = $result['uid'];
		$ids = explode($result['ids'], ',');
		$idLen = sizeof($ids);

		$abilities = get_json('private/abilities.json');
		$usersAbilities = $abilities[$email];
		$topicsAbility = $usersAbilities[$uid];
		$timesDone = $topicsAbility['done'];
		$timesCorrect = $topicsAbility['right'];
		$percentage = ($timesCorrect/$timesDone) * 100;

		$bgColor = "hsla(".floor($percentage * 1.30).", 63%, 53%, 1)";

		$s = ($idLen != 1 ? 's' : '');
		echo $s;
		echo "
			<div class='topic thin' style='background-color: $bgColor;'>
				<img src='$img' alt='' height='30vh' width='30vh'>
				<h4>$name</h4>
				<p class='topicDesc fade'>$desc</p>
				<h5 class='topicCourses fade'>$idLen Course$s</h5>
				<a href='quiz.php?u=$uid' class='fade'>Play Quiz</a>
			</div>
		";
	}
	?>
	<a class='topic new' href='newtopic.php'>
		<img src='images/plus.png' height='30vh' width='30vh'>
		<h4>New</h4>
	</a>
</div>
<script src='topicExpander.js' type='text/javascript'></script>
<?php
$l->writeFooter();
?>