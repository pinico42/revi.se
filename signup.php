<?php
include "layouts.php";
$l = getLayout("basic.layout");
$l->writeHeader();
?>
<?php
if(isset($_POST['email'])){
	$email = $_POST['email'];
	$fname = $_POST['fname'];
	$sname = $_POST['sname'];
} else {
	$email = '';
	$fname = '';
	$sname = '';
}
?>
<h1 class='title'></h1>
<form name='signup'>
	<input type='text' name='fname' placeholder='First Name' value='<?php echo $fname;?>'><br/>
	<input type='text' name='sname' placeholder='Surname' value='<?php echo $sname;?>'><br/>
	<input type='text' name='email' placeholder='E-mail' value='<?php echo $email;?>'><br/>
	<input type='password' name='pwd' placeholder='Password'><br/>
	<input type='password' name='cfpwd' placeholder='Retype Password'><br/>
	<div id='subjectPicker'>
		<h3>Your Subjects:</h3>
		<script src='subjectpicker.js' type='text/javascript'></script>
		<div class='subPickarea'>
			<div class='subjectPickerSubject'>
				<input class='subjectPick'>
			</div>
		</div>
	</div>
</form>

<?php
$l->writeFooter();
?>