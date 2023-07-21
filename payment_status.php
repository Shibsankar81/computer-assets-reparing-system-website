<?php
include ('connection.php');
$id = $_GET['id'];
$status = $_GET['status'];

$q = "UPDATE problem_store set status=$status where id=$id";
mysqli_query($conn, $q);

header('location:finance.php');
?>