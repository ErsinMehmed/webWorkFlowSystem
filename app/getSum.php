<?php
require '../../dbconn.php';

if(isset($_POST['data']))
{
    $name = ($_POST['name']);

    $query = "SELECT sum(quantity) as sum_quantity FROM setproduct WHERE productName = '$name'";
    $query_run = mysqli_query($con, $query);

    while($rows=mysqli_fetch_array($query_run))
    {
        echo $quantity = $rows['sum_quantity'];
    }
}
