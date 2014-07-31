<?php
include "layouts.php";
$l = getLayout("basic.layout");
$l->writeHeader();
?>
<script type='text/javascript'>
	function keyPress(e){
		var currentQ = String.fromCharCode(e.keyCode);
		var q = document.getElementById('topicSearch').value + currentQ;
		$.get('topicsearch.php?q='+q,function(result){
			document.getElementById('topicSearchResults').innerHTML = result;
		});
	}
</script>
<div id='search' class='adds'>
	<h1 class='title'>Search for topics</h1>
	<input id='topicSearch' onkeypress="return keyPress(event)">
	<form method='post' id='topicSearchResults'></form>
</div>
<div id='make' class='adds'>
	<h1 class='title'>Create a topic</h1>
</div>



<?php
$l->writeFooter();
?>