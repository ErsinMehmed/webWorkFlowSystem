<?php
include '../../dbconn.php';

$query = "UPDATE orders SET view = '0'";
$query_run = mysqli_query($con, $query);

if($query_run && $query_run1)
    {
        $res = [
            'status' => 200
        ];
        echo json_encode($res);
        return;
    }
