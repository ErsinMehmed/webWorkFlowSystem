<?php
require '../../dbconn.php';
date_default_timezone_set('Europe/Sofia');

if (isset($_POST['save_product'])) {
    $prodNum = ($_POST['prodNum']);
    $prodName = ($_POST['prodName']);
    $prodQuantity =  ($_POST['prodQuantity']);
    $prodPrice =  ($_POST['prodPrice']);
    $prodKind = ($_POST['prodKind']);
    $prodCompany = ($_POST['prodCompany']);
    $prodSupplier = ($_POST['prodSupplier']);
    $prodOnePrice = ($_POST['prodOnePrice']);
    $date = date("Y-m-d");
    if ($prodNum == NULL || $prodName == NULL || $prodQuantity == NULL || $prodPrice == NULL || $prodCompany == NULL || $prodSupplier == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Попълнете всички полета'
        ];
        echo json_encode($res);
        return;
    }

    $sql1 = "SELECT * FROM stock WHERE name = '$prodName'";
    $query_fulfill = mysqli_query($con, $sql1);

    while ($rows = mysqli_fetch_array($query_fulfill)) {
        $quantity = $rows['quantity'];
        $finalQuantity = $prodQuantity + $quantity;

        $sql = "UPDATE stock SET quantity = '$finalQuantity' WHERE name = '$prodName'";
        $query_go = mysqli_query($con, $sql);

        $sql2 = "INSERT INTO products (number,name,quantity,price,kind,supplier,company,onePrice,date) VALUES ('$prodNum','$prodName','$prodQuantity','$prodPrice','$prodKind','$prodSupplier','$prodCompany','$prodOnePrice','$date')";
        $query_run = mysqli_query($con, $sql2);

        if ($query_run && $query_fulfill && $query_go) {
            $res = [
                'status' => 200,
                'message' => 'Продукта е добавен'
            ];
            echo json_encode($res);
            return;
        }
    }
}

if (isset($_POST['delete_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    $query2 = "SELECT * FROM products WHERE id = '$id'";
    $query_fulfill = mysqli_query($con, $query2);

    while ($rows = mysqli_fetch_array($query_fulfill)) {
        $prodQuantity = $rows['quantity'];

        $query3 = "SELECT * FROM stock WHERE name = '$name'";
        $query_fulfill1 = mysqli_query($con, $query3);

        while ($rowss = mysqli_fetch_array($query_fulfill1)) {
            $quantity = $rowss['quantity'];
            $finalQuantity = $quantity - $prodQuantity;

            $query4 = "UPDATE stock SET quantity = '$finalQuantity' WHERE name = '$name'";
            $query_go = mysqli_query($con, $query4);

            $query1 = "DELETE FROM products WHERE id='$id'";
            $query_run = mysqli_query($con, $query1);

            if ($query_run && $query_fulfill && $query_fulfill1 && $query_go) {
                $res = [
                    'status' => 200,
                    'message' => 'Продукта е изтрит успешно'
                ];
                echo json_encode($res);
                return;
            }
        }
    }
}

if (isset($_POST['actionProd'])) {

    $query = "SELECT * FROM teams WHERE deleteTeam <> 'yes'";
    $query_run = mysqli_query($con, $query);

?><option hidden disabled selected>Избери екип</option><?php
                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    foreach ($query_run as $orders) {
                                                                ?> <option value="<?= $orders['id'] . " " . $orders['name'] ?>"><?= $orders['name'] ?></option><?php
                                                                                                        }
                                                                                                    }
                                                                                                }

                                                                                                if (isset($_POST['name'])) {
                                                                                                    $name = $_POST['name'];

                                                                                                    $query = "SELECT * FROM stock WHERE name = '$name'";
                                                                                                    $query_run = mysqli_query($con, $query);

                                                                                                    foreach ($query_run as $orders) {
                                                                                                        echo $orders['kind'];
                                                                                                    }
                                                                                                }
                                                                                                            ?>