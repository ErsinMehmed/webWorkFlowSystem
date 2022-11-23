<?php
session_start();
require '../../dbconn.php';
date_default_timezone_set('Europe/Sofia');

if (isset($_POST['save_site_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $curDT = date('Y-m-d H:i:s');

    if ($username == null || $email == null || $password == null) {
        $res = [
            'status' => 422,
            'message' => 'Попълнете всички полета',
        ];
        echo json_encode($res);
        return;
    }
    $query = "SELECT * FROM siteuser WHERE email = '$email'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 0) {

        $query = "INSERT INTO siteuser (username,email,password,date) VALUES ('$username','$email','$password','$curDT')";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Профилът Ви е създаден',
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Профилът Ви не е създаден',
            ];
            echo json_encode($res);
            return;
        }
    } else {
        $res = [
            'status' => 510,
            'message' => 'Имейла е регистриран в системата',
        ];
        echo json_encode($res);
        return;
    }
}
