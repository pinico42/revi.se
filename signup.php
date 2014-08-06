<?php
// Copyright © 2014 Max Penrose
?>

<?php
include 'private/pwds.php';

function startsWith($haystack, $needle)
{
    return $needle === "" || strpos($haystack, $needle) === 0;
}

function writeJson($json, $file){
	$data = json_encode($json, true);
	$f = fopen($file, "w");
	fwrite($f, $data);
	fclose($f);
}

function readJson($file){
	$f = fopen($file, "r");
	$data = fread($f, filesize($file));
	fclose($f);
	$json = json_decode($data, true);
	return $json;
}

function writeSubjects($subs, $email){
	$json = readJson('private/subjects.json');
	$subsJson = array();

	foreach($subs as $k => $v){
		$subsJson = array_merge($subsJson,array(["Name"=>$k, "Board"=>$v]));
	}

	$json[$email] = $subsJson;
	writeJson($json, 'private/subjects.json');
}

function writeAbilities($email){
	$json = readJson('private/abilities.json');

	$json[$email] = [];

	writeJson($json, 'private/abilities.json');
}


function writeTopics($email, $subs){
	$json = readJson('private/topics.json');

	$json[$email] = [];

	foreach($subs as $k => $v){
		$json[$email][$k] = [];
	}

	writeJson($json, 'private/topics.json');
}

if(isset($_POST['pwd'])){
	$success = true;
	$subs = array();
	foreach($_POST as $postK => $postV){
		if($postK == 'email'){
			$email = $postV;
		} else
		if($postK == 'fname'){
			$fname = $postV;
		} else
		if($postK == 'sname'){
			$sname = $postV;
		} else 
		if($postK == 'pwd'){
			if($_POST['cfpwd'] == $postV){
				$pwd = sha1($postV);
			} else {
				$success = false;
			}
		}else
		if(startsWith($postK,'s')){
			$num = substr($postK, 1);
			$subs[$postV] = $_POST["b".$num];
		}
	}
	if($success){
		writeAbilities($email);
		writeTopics($email, $subs);
		writeSubjects($subs, $email);
		$conn = mysqli_connect('localhost',$mysqlUsername,$mysqlPassword,'revise');

		$q = 'INSERT INTO accounts (`fname`, `sname`, `email`, `pwd`) VALUES ("'.$fname.'","'.$sname.'","'.$email.'","'.$pwd.'");';
		$query = mysqli_query($conn,$q);
		echo $email;
		setcookie("email", $email, time()+259200);
		setcookie("pwd", $pwd, time()+259200);
		var_dump($_COOKIE);
		header('Location: index.php');
	}

} else if(isset($_POST['email'])) {
	$email = $_POST['email'];
	$fname = $_POST['fname'];
	$sname = $_POST['sname'];
} else {
	$email = '';
	$fname = '';
	$sname = '';
}
?>
<?php
include "layouts.php";
$l = getLayout("basic.layout");
$l->writeHeader();
?>

<h1 class='title'>Sign Up</h1>
<form name='signup' method='post'>
	<input type='text' name='fname' placeholder='First Name' value='<?php echo $fname;?>'><br/>
	<input type='text' name='sname' placeholder='Surname' value='<?php echo $sname;?>'><br/>
	<input type='text' name='email' placeholder='E-mail' value='<?php echo $email;?>'><br/>
	<input type='password' name='pwd' placeholder='Password'><br/>
	<input type='password' name='cfpwd' placeholder='Retype Password'><br/>
	<div id='subjectPicker'>
		<h3>Your Subjects:</h3>
		<script src='subjectpicker.js' type='text/javascript'></script>
		<div id='subPickarea'>
			<div class='subjectPickerSubject'>
				<input class='subjectPick' placeholder='Subject' name='s1' type='text'> 
				<select name="b1">
					<option value='aqa'>AQA</option>
					<option value='other'>Other</option>
				</select>
			</div>
		</div>
		<img src='images/plus.png' alt='+' onclick='newSubject()' height='30px' width='30px'/>
	</div>
	<input type='submit' value='Sign Up'>
</form>

<?php
$l->writeFooter();
?>