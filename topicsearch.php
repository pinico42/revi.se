<?php
function writeResult($sqlArray, $i){ // prints the table cell
	if(is_null($sqlArray)){
		return ;
	}
	$classNum = ($i%2 == 0 ? 'c2':'c3');

	$name = $sqlArray['name'];
	$description = $sqlArray['descr'];
	$uid = $sqlArray['uid'];
	echo "
		<tr class='$classNum'>
			<td>
				$name
			</td>
			<td>
				$description
			</td>
			<td>
				<form method='post'>
					<input type='hidden' name='uid' value='$uid'>
					<input type='submit' value='Add'>
				</form>
			</td>
		</tr>
	";
}

include 'private/pwds.php';

$q = $_GET['q'];

$conn = mysqli_connect('localhost',$mysqlUsername,$mysqlPassword,'revise');

$queryText =  "select * from topics where LOWER(name) LIKE ('%$q%') LIMIT 1 OFFSET 0;";

$mquery = mysqli_query($conn, $queryText);

$array = mysqli_fetch_array($mquery, MYSQLI_ASSOC);

$topics = [$array];
writeResult($array, 1);
if(!is_null($array)){
	$l=2;
	while(!is_null($array)){
		$o = $l-1;
		$conn = mysqli_connect('localhost',$mysqlUsername,$mysqlPassword,'revise');

		$queryText =  "select * from topics where LOWER(name) LIKE ('%$q%') LIMIT $l OFFSET $o;";

		$mquery = mysqli_query($conn, $queryText);

		$array = mysqli_fetch_array($mquery, MYSQLI_ASSOC);
		$topics = array_merge($topics, [$array]);
		writeResult($array, $l);
		$l = $l + 1;
	}
} else {
	echo '<tr class="c3"><td colspan="3">No Results</td></tr>';
}
?>