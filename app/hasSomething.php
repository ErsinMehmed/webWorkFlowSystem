<?php
    session_start();
    require '../../dbconn.php';
    $username = $_SESSION['username'];

        $query = "SELECT * FROM employee WHERE pid='$username'";
        $query_run = mysqli_query($con, $query);

        while($rows=mysqli_fetch_array($query_run))
        {
            $teamID = $rows['teamID'];

            $query1 = "SELECT * FROM setproduct WHERE view = '1' AND teamID = '$teamID'";
            $res = mysqli_query($con,$query1);
            echo mysqli_num_rows($res);
        }
