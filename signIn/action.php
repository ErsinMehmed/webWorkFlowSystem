<?php 
session_start();
require '../../dbconn.php';
date_default_timezone_set('Europe/Sofia');

if(isset($_POST['send_login_info']))
{
    $email =  ($_POST['enterEmail']);
    $password = ($_POST['enterPassword']);

    if($email == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'Въведете имейл'
        ];
        echo json_encode($res);
        return;
    } 
    if($password == NULL)
    {
        $res = [
            'status' => 424,
            'message' => 'Въведете парола'
        ];
        echo json_encode($res);
        return;
    }


    $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $_SESSION['email'] = $email;

        $res = [
            'status' => 200,
        ];
        echo json_encode($res);
        return;

    } else {

        $res = [
            'status' => 500,
            'message' => 'Грешен имейл или парола'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['send_admin_info']))
{
    $id =  ($_POST['id']);
    $name =  ($_POST['name']);
    $email = ($_POST['email']);
    $password = ($_POST['password']);
    $passwordR = ($_POST['passwordR']);
    $phone = ($_POST['phone']);

    if($name == NULL || $email == NULL || $phone == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'Попълнете всички полета'
        ];
        echo json_encode($res);
        return;
    }

    if($password == NULL)
    {
        $res = [
            'status' => 423,
            'message' => 'Въведете парола'
        ];
        echo json_encode($res);
        return;
    }
    
    if($passwordR == NULL)
    {
        $res = [
            'status' => 424,
            'message' => 'Въведете парола'
        ];
        echo json_encode($res);
        return;
    }


    if($passwordR == $password){
        $query = "UPDATE admin SET name='$name', email='$email', password='$password', phone='$phone' WHERE id='$id'";
        $query_run = mysqli_query($con, $query);

        if($query_run)
        {
            $res = [
                'status' => 200,
                'message' => 'Данните са обновени'
            ];
            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 500,
                'message' => 'Данните не са обновени'
            ];
            echo json_encode($res);
            return;
        }
    }  else
    {
        $res = [
            'status' => 512,
            'message' => 'Паролите не съвпадат'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['save_photo']))
{
    $id =  ($_POST['id']);
    $filename = $_FILES['img']['name'];
    $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
    $extensions_arr = array("jpg","jpeg","png","gif");
    move_uploaded_file($_FILES["img"]["tmp_name"],'adminImage/'.$filename);

    if($filename != NULL){
        $query = "UPDATE admin SET img='$filename' WHERE id='$id'";
        $query_run = mysqli_query($con, $query);
        
        if($query_run)
        {
            $res = [
                'status' => 200,
                'message' => 'Снимката е добавена'
            ];
            echo json_encode($res);
            return;
        } 
    } else {
        $res = [
            'status' => 500,
            'message' => 'Изберете снимка'
        ];
        echo json_encode($res);
        return;
    }     
}

if(isset($_POST['send_login_mobile']))
{
    $username =  ($_POST['enterUsername']);
    $password = ($_POST['enterPassword']);

    if($username == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'Въведете потребител'
        ];
        echo json_encode($res);
        return;
    } 
    if($password == NULL)
    {
        $res = [
            'status' => 424,
            'message' => 'Въведете парола'
        ];
        echo json_encode($res);
        return;
    }


    $query = "SELECT * FROM employee WHERE username='$username' AND password='$password' AND status <> 'Напуснал'";
    $query_run = mysqli_query($con, $query);
    $query_runn = mysqli_query($con, $query);

        if(mysqli_num_rows($query_run) == 1)
        {
            while($rows=mysqli_fetch_array($query_runn)){
                $id=$rows['id'];
                $query = "UPDATE teams SET status='Yes' WHERE (user1ID='$id' OR user2ID='$id') AND deleteTeam <> 'Yes'";
                $query_run = mysqli_query($con, $query);
            }

            $_SESSION['username'] = $username;

            $res = [
                'status' => 200,
            ];
            echo json_encode($res);
            return;

        } else {

            $res = [
                'status' => 500,
                'message' => 'Грешен потребител или парола'
            ];
            echo json_encode($res);
            return;
        }
}
