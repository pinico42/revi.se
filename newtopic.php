<?php
if(!isset($_GET['s'])){
	header('Location: index.php');
}

if(isset($_POST['uid'])){
	$subject = $_GET['s'];
	$uid = $_POST['uid'];
	$email = $_COOKIE['email'];

	$JSONfileR = fopen('private/topics.json','r');
	$encodedJSON = fread($JSONfileR,filesize('private/topics.json'));
	$JSON = json_decode($encodedJSON, TRUE);
	fclose($JSONfileR);
	$usersTopics = $JSON[$email];
	$subjectsTopics = $usersTopics[$subject];
	$newSubjectsTopics = array_merge($subjectsTopics, [$uid]);
	$usersTopics[$subject] = $newSubjectsTopics;
	$newUsersTopics = $usersTopics;
	$JSON[$email] = $newUsersTopics;

	$newJSON = json_encode($JSON);
	$newJsonfile = fopen('private/topics.json','w');
	fwrite($newJsonfile,$newJSON);
	fclose($newJsonfile);
	header('Location: topics.php');
}
?>
<?php
include "layouts.php";
$l = getLayout("basic.layout");
$l->writeHeader();
?>
<script type='text/javascript'>
	function keyPress(e){ // called when someone types in the textbox
		var currentQ = String.fromCharCode(e.keyCode);
		var q = document.getElementById('topicSearch').value + currentQ;
		$.get('topicsearch.php?q='+q,function(result){
			document.getElementById('search').getElementsByTagName('tbody')[0].innerHTML = result;
		});
	}
	$('.adds').click(function(){
		console.log('resize')
		var elem = $(this).get(0);
		if(elem.className.indexOf('thin') > -1){ // is thin
			$('.adds').removeClass('thick');
			$('.adds').addClass('thin');
			elem.className = elem.className.replace('thin','thick');
		}
	});
</script>
<div id='search' class='adds thick'>
	<h1 class='title'>Search for topics</h1>
	<input id='topicSearch' onkeypress="return keyPress(event)">
	<h4>Your Results:</h4>
	<table cellpadding="0px" cellspacing="0px" id='searchResults'>
		<thead>
			<tr class='c5'>
				<td>Name</td>
				<td>Description</td>
				<td>Add to collection</td>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
</div>
<!-- <div id='make' class='adds thin'>
	<h1 class='title'>Create a topic</h1>
</div> -->



<?php
$l->writeFooter();
?>