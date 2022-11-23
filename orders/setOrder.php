<?php
    require '../../dbconn.php';

     if(isset($_GET['id']))
     {
        $selectedTeam = mysqli_real_escape_string($con, $_GET['id']);
         
         $query = "SELECT * FROM teams WHERE id='$selectedTeam'";
         $query_run = mysqli_query($con, $query);
 
         if(mysqli_num_rows($query_run) == 1)
         {
             $order = mysqli_fetch_array($query_run);
 
             $res = [
                 'status' => 200,
                 'message' => 'Екипа е намерен',
                 'data' => $order
             ];
             echo json_encode($res);
             return;
         }
         else
         {
             $res = [
                 'status' => 404,
                 'message' => 'Екипа не е намерен'
             ];
             echo json_encode($res);
             return;
         }
     }
