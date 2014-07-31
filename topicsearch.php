<?php
include 'private/pwds.php';

$q = $_GET['q'];

$conn = mysqli_connect('localhost',$mysqlUsername,$mysqlPassword,'revise');

$queryText =  "select * from topics where LOWER(name) LIKE ('%$q%');";


$mquery = mysqli_query($conn, $queryText);

$array = mysqli_fetch_array($mquery, MYSQLI_ASSOC);

var_dump($array);
?>