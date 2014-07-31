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
			document.getElementById('topicSearchResults').getElementsByTagName('tbody')[0].innerHTML = result;
		});
	}
</script>
<div id='search' class='adds'>
	<h1 class='title'>Search for topics</h1>
	<input id='topicSearch' onkeypress="return keyPress(event)">
	<form method='post' id='topicSearchResults'>
		<h4>Your Results:</h4>
		<table cellpadding="0px" cellspacing="0px" id='searchResults'>
			<thead>
				<tr class='c5'>
					<td>Name</td>
					<td>Description</td>
					<td>Put in set</td>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</form>
</div>
<div id='make' class='adds'>
	<h1 class='title'>Create a topic</h1>
</div>



<?php
$l->writeFooter();
?>