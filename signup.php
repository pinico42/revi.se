<?php
function startsWith($haystack, $needle)
{
    return $needle === "" || strpos($haystack, $needle) === 0;
}

if(isset($_POST['email'])){
	echo 'submit';
	$success = true;
	$subs = array();
	$boards = array();
	foreach($_POST as $postK => $postV){
		if($postK == 'email'){
			$email = $postV;
		}
		if($postK == 'fname'){
			$fname = $postV;
		}
		if($postK == 'sname'){
			$sname = $postV;
		}
		if($postK == 'pwd'){
			if($_POST['cfpwd'] == $postV){
				$pwd = $postV;
			} else {
				$success = false;
			}
		}
		if(startsWith($postK,'s')){
			$num = (int) substr($postK, 1);
			$subs[$num] = $postV;
		}
		if(startsWith($postK,'b')){
			$num = (int) substr($postK, 1);
			$boards[$num] = $postV;
		}
	}
	$conn = mysqli_connect('localhost',$mysqliUsername,$mysqliPassword,'revise');

	$q = 'INSERT INTO accounts (`fname`, `sname`, `email`, `pwd`) VALUES ($fname,$sname,$email,$pwd);';

	$query = mysqli_query($conn,$q);

	
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

<h1 class='title'></h1>
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