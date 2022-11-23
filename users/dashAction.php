<?php
    require '../../dbconn.php';
    date_default_timezone_set('Europe/Sofia');
    error_reporting(E_ERROR | E_PARSE);

    if(isset($_POST['save_user']))
    {
        $name = mysqli_real_escape_string($con, $_POST['fullName']);
        $egn = ($_POST['egn']);
        $phone = mysqli_real_escape_string($con, $_POST['userPhone']);
        $pid = mysqli_real_escape_string($con, $_POST['pid']);
        $pos =  ($_POST['position']);
        $date = ($_POST['inDate']);
        $filename = $_FILES['img']['name'];
        $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
        $extensions_arr = array("jpg","jpeg","png","gif");
        move_uploaded_file($_FILES["img"]["tmp_name"],'userImages/'.$filename);
        if($name == NULL || $egn == NULL || $phone == NULL || $pid == NULL)
        {
            $res = [
                'status' => 422,
                'message' => 'Попълнете всички полета'
            ];
            echo json_encode($res);
            return;
        }
        
        $selQuery = "SELECT * FROM employee WHERE pid = '$pid'";
        $query_runn = mysqli_query($con, $selQuery);

        if(mysqli_num_rows($query_runn) == 0)
        {
            if($filename != NULL){
                $query = "INSERT INTO employee (name,image,pid,egn,phone,position,status,inDate,username,password) VALUES ('$name','$filename','$pid','$egn','$phone','$pos','Активен','$date','$pid','$pid')";
                $query_run = mysqli_query($con, $query);
        
                if($query_run)
                {
                    $res = [
                        'status' => 200,
                        'message' => 'Потребителят е добавен'
                    ];
                    echo json_encode($res);
                    return;
                }
                else
                {
                    $res = [
                        'status' => 500,
                        'message' => 'Потребителят не е добавен'
                    ];
                    echo json_encode($res);
                    return;
                }
            } else {
                $res = [
                    'status' => 300,
                    'message' => 'Изберете снимка'
                ];
                echo json_encode($res);
                return;
            }     
            
        } else {
            $res = [
                'status' => 400,
                'message' => 'Въведения ПИД съществува'
            ];
            echo json_encode($res);
            return;
        }     
    }

    if(isset($_GET['id']))
    {
        $id = mysqli_real_escape_string($con, $_GET['id']);

        $query = "SELECT * FROM employee WHERE id='$id'";
        $query_run = mysqli_query($con, $query);

        if(mysqli_num_rows($query_run) == 1)
        {
            $order = mysqli_fetch_array($query_run);

            $res = [
                'status' => 200,
                'message' => 'Служителя е намерен',
                'data' => $order
            ];
            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 404,
                'message' => 'Служителя не е намерен'
            ];
            echo json_encode($res);
            return;
        }
    }

    if(isset($_GET['userID']))
    {
        $id = mysqli_real_escape_string($con, $_GET['id']);

        $query = "SELECT * FROM employee WHERE id='$id'";
        $query_run = mysqli_query($con, $query);

        if(mysqli_num_rows($query_run) == 1)
        {
            $order = mysqli_fetch_array($query_run);

            $res = [
                'status' => 200,
                'message' => 'Служителя е намерен',
                'data' => $order
            ];
            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 404,
                'message' => 'Служителя не е намерен'
            ];
            echo json_encode($res);
            return;
        }
    }

    
    if(isset($_POST['update_password'])){
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $password = $_POST['password'];
        $rPassword =  $_POST['repPassword'];

        if($rPassword == $password){
            $query = "UPDATE employee SET password = '$password' WHERE id = '$id'";
            $query_run = mysqli_query($con, $query);
            if($query_run)
            {
                $res = [
                    'status' => 200,
                    'message' => 'Паролата е обновена'
                ];
                echo json_encode($res);
                return;
            }
            else
            {
                $res = [
                    'status' => 500,
                    'message' => 'Паролата е обновена'
                ];
                echo json_encode($res);
                return;
            }
        } else {
            $res = [
                'status' => 400,
                'message' => 'Паролите не съвпадат'
            ];
            echo json_encode($res);
            return;
        }
        
    }   

    if(isset($_POST['update_user']))
    {   
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $name = mysqli_real_escape_string($con, $_POST['fullName']);
        $egn = ($_POST['egn']);
        $phone = mysqli_real_escape_string($con, $_POST['userPhone']);
        $pos =  ($_POST['position']);
        $date = ($_POST['inDate']);
        $status = ($_POST['status']);
        $outDate = ($_POST['outDate']);
        $getTeamID = ($_POST['getTeamID']);
        $filename = $_FILES['img']['name'];
        $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
        $extensions_arr = array("jpg","jpeg","png","gif");
        move_uploaded_file($_FILES["img"]["tmp_name"],'userImages/'.$filename);
        
        if($filename != NULL){
            $query = "UPDATE employee SET image='$filename', name='$name', egn='$egn', phone='$phone', position='$pos', status='$status', inDate='$date', outDate='$outDate' WHERE id='$id'";
        }else{
            $query = "UPDATE employee SET name='$name', egn='$egn', phone='$phone', position='$pos', status='$status', inDate='$date', outDate='$outDate' WHERE id='$id'";
        }

        $query_run = mysqli_query($con, $query);

        if($status == 'Напуснал'){
            $query = "UPDATE employee SET teamID='0' WHERE id='$id'";
            $query_runn = mysqli_query($con, $query);

            $query = "UPDATE teams SET deleteTeam='yes' WHERE user1ID='$id' OR user2ID='$id'";
            $query_runn = mysqli_query($con, $query);

            $query = "SELECT * FROM teams WHERE id='$getTeamID'";
            $query_run = mysqli_query($con, $query);

            if(mysqli_num_rows($query_run) > 0)
            {
                while($rows=mysqli_fetch_array($query_run))
                {
                    $user1ID = $rows['user1ID'];
                    $user2ID = $rows['user2ID'];

                    $query = "UPDATE employee SET teamID='0' WHERE id='$user2ID' OR id='$user1ID'";
                    $query_runn = mysqli_query($con, $query);
                }
            }
            $date_now = date("Y-m-d");

            $query = "UPDATE orders SET teamID=0, status='Назначи' WHERE teamID='$getTeamID' AND date >= '$date_now' AND status <> 'Отказана' AND status <> 'Приключена' AND status <> 'В процес'";
            $query_run = mysqli_query($con, $query);
        }

        if($query_run)
        {
            $res = [
                'status' => 200,
                'message' => 'Потребителят е обновен'
            ];
            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 500,
                'message' => 'Потребителят не е обновен'
            ];
            echo json_encode($res);
            return;
        }
    }
