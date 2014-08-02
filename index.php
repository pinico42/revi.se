<?php
include 'private/pwds.php';
if(!isset($_COOKIE['email']) || !isset($_COOKIE['pwd'])){ // not logged in
	header('Location: login.php'); // to login screen
} else { // security - check cookie details are correct
	$conn = mysqli_connect('localhost',$mysqlUsername,$mysqlPassword,'revise');
	$q = 'SELECT * FROM accounts WHERE email = "'.$_COOKIE['email'].'" AND pwd = "'.sha1($_COOKIE['pwd']).'";';

	$query = mysqli_query($conn, $q);

	$qArray = mysqli_fetch_array($query, MYSQLI_ASSOC);
	if(is_null($qArray)){
		header('Location: login.php');  //to login screen
		setcookie("email", "", time()-3600);
		setcookie("pwd", "", time()-3600);
	}
}

?>

<?php // basic header
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

$subjectsObj = get_json("private/subjects.json"); // contains the users subjects

$email = $_COOKIE['email'];

$usersSubjects = $subjectsObj[$email];


$topics = get_json("private/topics.json");

$usersTopics = $topics[$email];

$subjectImages = array(
	"Art" => "images/subjects/art.png",
	"Biology" => "images/subjects/biology.png",
	"Chemistry" => "images/subjects/chemistry.png",
	"English Language" => "images/subjects/englishlang.png",
	"English Literature" => "images/subjects/englishlit.png",
	"French" => "images/subjects/french.png",
	"Geography" => "images/subjects/geography.png",
	"German" => "images/subjects/german.png",
	"Greek" => "images/subjects/greek.png",
	"History" => "images/subjects/history.png",
	"Latin" => "images/subjects/latin.png",
	"Maths" => "images/subjects/maths.png",
	"Music" => "images/subjects/music.png",
	"Physics" => "images/subjects/physics.png",
	"Religious Studies" => "images/subjects/relegiousstudies.png",
	"Spanish" => "images/subjects/spanish.png",
);
?>
<h1 class='title'>Your Subjects</h1>
<div id='subjects'>
	<?php
	foreach($usersSubjects as $subject){
		$r = rand(1,4);
		if($r == 4){ $r = 5; }
		
		$s = "";
		if(sizeof($usersTopics[$subject['Name']]) != 1){
			$s = "s";
		}

		echo "
			<a class='flip-container' href='topics.php?s=".$subject['Name']."'>
				<div class='flipper'>
					<div class='front c$r' style='background-image:url(".$subjectImages[$subject["Name"]].")'>
						<!--<img src='".$subjectImages[$subject["Name"]]."' width='40%' height='40%'>-->
					</div>
					<div class='back c$r'>
						<div class='fContent'>
							<h3>".$subject['Name']."</h3>
							<h4>".sizeof($usersTopics[$subject['Name']])." Topic$s</h4>
						</div>
					</div>
				</div>
			</a>
		";
	}

	?>
</div>

<?php
$l->writeFooter();
?>