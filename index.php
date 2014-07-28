<?php

if(!isset($_COOKIE['email']) || !isset($_COOKIE['pwd'])){
	header('Location: login.php');
}

?>

<?php
include "layouts.php";
$l = getLayout("basic.layout");
$l->writeHeader();
?>

<?php
$subjectsFile = fopen('private/subjects.json','r');

$json = fread($subjectsFile,filesize("private/subjects.json"));

$subjectsObj = json_decode($json,true);

$email = $_COOKIE['email'];

$usersSubjects = $subjectsObj[$email];

fclose($subjectsFile);

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

<div id='subjects'>
	<?php
	foreach($usersSubjects as $subject){
		$r = rand(1,4);
		if($r == 4){ $r = 5; }
			echo "
			<div class='flip-container'>
				<div class='flipper'>
					<div class='front c$r'>
						<img src='".$subjectImages[$subject["Name"]]."' width='40%' height='40%'>
					</div>
					<div class='back c$r'>".$subject['Name']."
					</div>
				</div>
			</div>
		";
	}

	?>
</div>

<?php
$l->writeFooter();
?>