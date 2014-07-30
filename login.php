<?php
include 'private/pwds.php';
if(isset($_POST['email']) && isset($_POST['pwd'])){
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];
	try {
		$conn = mysqli_connect('localhost',$mysqlUsername,$mysqlPassword, 'revise');
	} catch(Exception $e){
		$conn = mysqli_connect('localhost','root',NULL,'revise');
	}
	$request = "SELECT * FROM accounts WHERE email = '".$email."' AND pwd = '".$pwd."';";
	$query = mysqli_query($conn, $request);
	$nameArray = mysqli_fetch_array($query, MYSQLI_ASSOC);

	if(!is_null($nameArray)){
		setcookie("email", $email, time()+259200);
		setcookie("pwd", $pwd, time()+259200);
		header('Location: index.php');

	}
}

?>

<?php
include "layouts.php";
$l = getLayout("basic.layout");
$l->writeHeader();
?>

<table id='loginsignup' cellspacing="0" cellpadding="9px">
	<tbody>
		<tr>
			<td>Login</td>
			<td>Sign Up</td>
		</tr>
		<tr>
			<td>
				<form method='POST' action='#'>
					<input type='text' name='email' placeholder='E-mail'><br/>
					<input type='password' name='pwd' placeholder='Password'><br/>
					<input type='submit' value='Log In'>
				</form>
			</td>
			<td>
				<form method='POST' action='signup.php'>
					<input type='text' name='fname' placeholder='First Name' class='halfwidth'>
					<input type='text' name='sname' placeholder='Surname' class='halfwidth'><br/>
					<input type='text' name='email' placeholder='E-mail'><br/>
					<input type='submit' value='Sign Up'>
				</form>
			</td>
		</tr>
	</tbody>
</table>

<?php
$l->writeFooter();
?>