<?php 
 require '../../dbconn.php';
 date_default_timezone_set('Europe/Sofia');

if(isset($_POST['set_product']))
    {
        $teamID = ($_POST['teamName']);
        $teamInfo = explode(" ", $teamID);
        $name = ($_POST['name']);
        $prodQuantity = ($_POST['quantity']);
        $prodKind = ($_POST['prodKind']);
        $teamID = $teamInfo[0];
        $teamName = $teamInfo[1];
        $view = 1;
        $date = date("Y-m-d");
        $time = date('H:i');

        if(empty($teamID) || $name == NULL || $prodQuantity == NULL)
        {
            $res = [
                'status' => 422,
                'message' => 'Попълнете всички полета'
            ];
            json_encode($res);
            return;
        }

        $query3 = "SELECT * FROM stock WHERE name = '$name'";
        $query_fulfill = mysqli_query($con, $query3);
    
        while($rows=mysqli_fetch_array($query_fulfill))
        {
            $quantity = $rows['quantity'];
            if($quantity != 0){
                if($prodQuantity <= $quantity){
                    $finalQuantity = $quantity - $prodQuantity;
                    
                    $query = "INSERT INTO setproduct (productName,quantity,teamID,teamName,date,kind,view) VALUES ('$name','$prodQuantity','$teamID','$teamName','$date','$prodKind','$view')";
                    $query_run = mysqli_query($con, $query);

                    $sql = "INSERT INTO setproducthistory (productName,quantity,teamID,teamName,date,kind,time) VALUES ('$name','$prodQuantity','$teamID','$teamName','$date','$prodKind','$time')";
                    $query_sql = mysqli_query($con, $sql);

                    $query4 = "UPDATE stock SET quantity = '$finalQuantity' WHERE name = '$name'";
                    $query_go = mysqli_query($con, $query4);

                    if($query_run && $query_fulfill && $query_go && $query_sql)
                    {
                        $res = [
                            'status' => 200,
                            'message' => $name.' е добавен успешно към склада на екипа'
                        ];
                        echo json_encode($res);
                        return;
                    }
                } else{
                    $res = [
                        'status' => 220,
                        'message' => 'Въвели сте по-голям брой от наличното количество'
                    ];
                    echo json_encode($res);
                    return;
                }
                
            } else{
                $res = [
                    'status' => 210,
                    'message' => 'Стоката не е налична'
                ];
                echo json_encode($res);
                return;
            }
        }
    }
