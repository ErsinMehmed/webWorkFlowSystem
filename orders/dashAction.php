<?php
require '../../dbconn.php';
date_default_timezone_set('Europe/Sofia');
error_reporting(E_ERROR | E_PARSE);

if (isset($_POST['save_order'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $price = ($_POST['price']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $room =  ($_POST['room']);
    $date = ($_POST['pickDate']);
    $offer =  ($_POST['offer']);
    $m2 = ($_POST['m2']);
    $curDT = date('Y-m-d H:i:s');
    $date_now = date("Y-m-d");
    $time = ($_POST['pickTime']);
    if ($name == NULL || $price == NULL || $address == NULL || $m2 == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Попълнете всички полета'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO orders (customerName,address,room,m2,status,pay,price,date,offer,addDate,phone,view,time) VALUES ('$name','$address','$room','$m2','Назначи','В брой','$price','$date','$offer','$curDT','$phone','0','$time')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Заявкта е добавена'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Заявката не е добавена'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['save_textarea'])) {
    $text = ($_POST['canText']);
    $id = ($_POST['id']);
    $curDT = date('Y-m-d H:i:s');
    if ($text == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Попълнете всички полета'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE orders SET status='Отказана', endDate='$curDT', cancelReason='$text' WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Заявка с номер ' . $id . ' беше отказана'
        ];
        echo json_encode($res);
        return;
    }
}
if (isset($_GET['idd'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    $query = "SELECT * FROM orders WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $order = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Клиента е намерен',
            'data' => $order
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    $query = "SELECT * FROM orders WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $order = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Клиента е намерен',
            'data' => $order
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Клиента не е намерен'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_GET['phone'])) {
    $phone = mysqli_real_escape_string($con, $_GET['phone']);

    $query = "SELECT * FROM customer WHERE phone='$phone'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $order = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Клиента е намерен',
            'data' => $order
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Клиента не е намерен'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['update_order'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $price = ($_POST['price']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $room =  ($_POST['room']);
    $date = ($_POST['pickDate']);
    $offer =  ($_POST['offer']);
    $m2 = ($_POST['m2']);
    $time = ($_POST['pickTime']);


    $query = "UPDATE orders SET customerName='$name', address='$address', room='$room', m2='$m2', price='$price', date='$date', offer='$offer', phone='$phone', time='$time' WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Заявкта е обновена'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Заявката не е обновена'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['action'])) {
    $id = $_POST['id'];
    $curDT = date('Y-m-d H:i:s');

    $query = "UPDATE orders SET status = 'Приключена', endDate = '$curDT' WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Заявкта е приключена'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['save_setorder'])) {
    $curDT = date('Y-m-d H:i:s');
    $today = $_POST['orderDate'];
    $teamID =  ($_POST['teamID']);
    $orderID =  ($_POST['orderID']);
    $user1 =  ($_POST['user1']);
    $user2 =  ($_POST['user2']);
    $userID1 =  ($_POST['userID1']);
    $userID2 =  ($_POST['userID2']);
    $teamName = ($_POST['getTeamName']);
    if ($user1 == NULL || $user2 == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Попълнете всички полета'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO setorder (teamID,orderID,user1,user2,user1ID,user2ID,teamName,date,view,datee) VALUES ('$teamID','$orderID','$user1','$user2','$userID1','$userID2','$teamName','$curDT','1','$today')";
    $query_run = mysqli_query($con, $query);

    $query = "UPDATE orders SET teamID = '$teamID', status = 'Назначена' WHERE id='$orderID'";
    $query_runn = mysqli_query($con, $query);

    if ($query_run && $query_runn) {
        $res = [
            'status' => 200,
            'message' => 'Заявката е добавена на екип ' . $teamName
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Заявката не е добавена на екип ' . $teamName
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['actionDate'])) {
    $date = $_POST['date'];

    $query = "SELECT * FROM orders WHERE date = '$date'";

    $query_run = mysqli_query($con, $query);
?>
    <thead>
        <tr>
            <th class="column_sort" id="custNumber" name="id" data-order="desc">Номер</th>
            <th class="column_sort" id="customer" name="customerName" data-order="desc">Клиент</th>
            <th class="column_sort" id="addres" name="address" data-order="desc">Адрес</th>
            <th class="column_sort" id="of" name="offer" data-order="desc">Оферта</th>
            <th class="column_sort" id="bul" name="room" data-order="desc">Помещение</th>
            <th class="column_sort" id="km" name="m2" data-order="desc">m<sup>2</sup></th>
            <th class="column_sort" id="pri" name="price" data-order="desc">Цена</th>
            <th class="column_sort" id="orStatus" name="status" data-order="desc">Статус</th>
            <th class="column_sort" id="payStat" name="pay" data-order="desc">Пл. статус</th>
            <th data-order="desc">Назначи</th>
        </tr>
    </thead>
    <tbody id="tbody">
        <?php
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $orders) {
        ?>
                <tr>
                    <td>
                        <?= $orders['id'] ?>
                    </td>
                    <td><button class="editOrderBtn customer" type="button" value="<?= $orders['id']; ?>"><?= $orders["customerName"] ?></button></td>
                    <td>
                        <?= $orders['address'] ?>
                    </td>
                    <?php
                    if ($orders['offer'] == "Премиум") {
                    ?>
                        <td><span class="badge bg-gradient bg-primary px-2 py-1"><?= $orders['offer'] ?></span></td>
                    <?php
                    }
                    if ($orders['offer'] == "Вип") {
                    ?>
                        <td><span class="badge bg-gradient bg-info px-2 py-1"><?= $orders['offer'] ?></span></td>
                    <?php
                    }
                    if ($orders['offer'] == "Основна") {
                    ?>
                        <td><span class="badge bg-gradient bg-secondary px-2 py-1"><?= $orders['offer'] ?></span></td>
                    <?php
                    }
                    ?>
                    <td>
                        <?= $orders['room'] ?>
                    </td>
                    <td>
                        <?= $orders['m2'] ?> m<sup>2</sup>
                    </td>
                    <td>
                        <?= $orders['price'] . ' лв.' ?>
                    </td>
                    <?php
                    if ($orders['status'] == "Назначи") {
                    ?>
                        <td><span class="badge bg-gradient bg-primary px-2 py-1"><?= $orders['status'] ?></span></td>
                    <?php
                    }
                    if ($orders['status'] == "Назначена") {
                    ?>
                        <td><span class="badge bg-gradient bg-info px-2 py-1"><?= $orders['status'] ?></span></td>
                    <?php
                    }
                    if ($orders['status'] == "В процес") {
                    ?>
                        <td><span class="badge bg-gradient bg-warning px-2 py-1"><?= $orders['status'] ?></span></td>
                    <?php
                    }
                    if ($orders['status'] == "Отказана") {
                    ?>
                        <td><span class="badge bg-gradient bg-danger px-2 py-1"><button class="reviewCancel customer" type="button" value="<?= $orders['id']; ?>"><?= $orders['status'] ?></button></span></td>
                    <?php
                    }
                    if ($orders['status'] == "Приключена") {
                    ?>
                        <td><span class="badge bg-gradient bg-success px-2 py-1"><?= $orders['status'] ?></span></td>
                    <?php
                    }
                    if ($orders['status'] == "Изтекла") {
                    ?>
                        <td><span class="badge bg-gradient bg-secondary px-2 py-1"><?= $orders['status'] ?></span></td>
                    <?php
                    }
                    ?>
                    <td>
                        <?= $orders['pay'] ?>
                    </td>
                    <?php
                    if ($orders['status'] == "Назначи" && $orders['teamID'] == 0) {
                    ?><td><button type="button" value="<?= $orders['id']; ?>" class="btn bg-gradient setOrder btn-primary btn-sm shadow-none py-1 px-4 rounded"><i class="fa-solid fa-user-group"></i></button></td><?php
                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                ?><td><button type="button" value="<?= $orders['teamID']; ?>" class="btn appointedBtn bg-gradient btn-success btn-sm shadow-none py-1 px-4 rounded"><i class="fa-solid fa-check fa-lg"></i></button></td><?php
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                        ?>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr>
                <th class="text-center pos position-absolute border-0" colspan="10">Няма намерени данни</th>
            </tr>
        <?php
        }
        ?>
    </tbody>
<?php

}

if (isset($_POST['actionOr'])) {

    $query = "SELECT * FROM teams WHERE deleteTeam <> 'yes'";
    $query_run = mysqli_query($con, $query);

?><option hidden disabled selected>Избери екип</option><?php
                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    foreach ($query_run as $orders) {
                                                                ?> <option value="<?= $orders['id'] ?>"><?= $orders['name'] ?></option><?php
                                                                                    }
                                                                                }
                                                                            }

                                                                            if (isset($_POST['orderID'])) {

                                                                                $orderID = $_POST['orderID'];

                                                                                $query = "SELECT * FROM orders WHERE id = '$orderID'";
                                                                                $query_run = mysqli_query($con, $query);

                                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                                    foreach ($query_run as $orders) {
                                                                                        echo $orders['date'];
                                                                                    }
                                                                                }
                                                                            }

                                                                            if (isset($_POST['btn_val'])) {
                                                                                $btn_val = $_POST['btn_val'];

                                                                                $query1 = "UPDATE productrequest SET view = '0' WHERE id = '$btn_val'";
                                                                                $query_run1 = mysqli_query($con, $query1);
                                                                            }

                                                                                        ?>