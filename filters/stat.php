<?php
include '../../dbconn.php';

if(isset($_POST['action'])){

    $date = $_POST['date'];

    $q="SELECT * FROM orders WHERE status = 'Приключена' AND date = '$date'";
    $res = mysqli_query($con,$q);
    $num = mysqli_num_rows($res);

    $qe="SELECT * FROM orders WHERE date = '$date'";
    $ress = mysqli_query($con,$qe);
    $num1 = mysqli_num_rows($ress);

    $q="SELECT * FROM orders WHERE status = 'В процес' and date = '$date'";
    $resss=mysqli_query($con,$q);
    $num2= mysqli_num_rows($resss);

    if($ress && $ress && $resss){
        $stat = [
            'a' => $num,
            'b' => $num1,
            'c' => $num2
        ];
        echo json_encode($stat);
        return;
    }
}
