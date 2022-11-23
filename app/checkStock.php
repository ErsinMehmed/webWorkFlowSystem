<?php 
include("../../dbconn.php");

$queryy = "DELETE FROM setproduct WHERE quantity = 0";
mysqli_query($con, $queryy);
