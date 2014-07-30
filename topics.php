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

<h1 class='title'>Your Topics</h1>
<div id='topics'>
	<?php
	$conn = mysqli_connect('localhost',$mysqlUsername,$mysqlPassword, 'revise');

	foreach($currentTopic as $topicUID){
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
		$ids = explode($result['ids'], ',');
		$idLen = sizeof($ids);

		$s = ($idLen != 1 ? 's' : ''); ;
		echo $s;
		echo "
			<div class='topic'>
				<img src='$img' alt='' height=10% width='10%'>
				<h4>$name</h4>
				<p class='topicDesc fade'>$desc</p>
				<h5>$idLen Course$s</h5>
			</div>
		";
	}
	?>
	<div class='topic new'>new</div>
</div>

<?php
$l->writeFooter();
?>