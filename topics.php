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
		$ids = explode($result['ids'], ',');
		$idLen = sizeof($ids);

		$s = ($idLen != 1 ? 's' : ''); ;
		echo $s;
		echo "
			<div class='topic'>
				<img src='$img' alt='' height='30vh' width='30vh'>
				<h4>$name</h4>
				<p class='topicDesc fade'>$desc</p>
				<h5 class='topic fade'>$idLen Course$s</h5>
			</div>
		";
	}
	?>
	<div class='topic new'>
		<img src='images/plus.png' height='30vh' width='30vh'>
		<h4>New</h4>
	</div>
</div>

<?php
$l->writeFooter();
?>