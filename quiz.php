<?php
include "layouts.php";
$l = getLayout("basic.layout");
$l->writeHeader();
?>
<script type='text/javascript'>
	var questionsJSON = "<?php echo '{\"Why did the chicken cross the road?\":\"To get to the other side\"}';?>";
	var questions = JSON.parse(questionsJSON);
</script>

<div id='quiz'>
	<h2 id='question'>Loading...</h2>
	<input id='answer'><br/>
	<h4 id='correction'>yo.</h4><br/>
	<button id='asubmit' onclick='submitAnswer()'>Submit</button>
</div>
<script src='quiz.js' type='text/javascript'></script>
<?php
$l -> writeFooter();
?>