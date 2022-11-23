<?php
    require '../../dbconn.php';

    if(isset($_POST['id']))
    {
        $id =  ($_POST['id']);

        $selQuery = "SELECT * FROM admin WHERE id = '$id'";
        $query_run = mysqli_query($con, $selQuery);

        while($rows=mysqli_fetch_array($query_run)){
            die('signIn/adminImage/'.$rows['img']);
        }
    }
