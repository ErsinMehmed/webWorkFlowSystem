<?php 
include '../../dbconn.php';

$query = "SELECT * FROM orders WHERE view = '1' OR view = '2' OR view = '3'";
$res = mysqli_query($con,$query);
$result =  mysqli_num_rows($res);

$query1 = "SELECT * FROM productrequest WHERE view = '1' ";
$res1 = mysqli_query($con,$query1);
$result1 =  mysqli_num_rows($res1);

echo $result + $result1;
