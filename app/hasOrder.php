<?php
    session_start();
    require '../../dbconn.php';
    date_default_timezone_set('Europe/Sofia');
    $username = $_SESSION['username'];
    $today = date("Y-m-d H:i:s"); 

        $query = "SELECT * FROM employee WHERE pid='$username'";
        $query_run = mysqli_query($con, $query);

        while($rows=mysqli_fetch_array($query_run))
        {
            $teamID = $rows['teamID'];

            $query1 = "SELECT * FROM setorder WHERE view = '1' AND teamID = '$teamID' AND datee <= '$today'";
            $res = mysqli_query($con,$query1);
            echo mysqli_num_rows($res);
        }
