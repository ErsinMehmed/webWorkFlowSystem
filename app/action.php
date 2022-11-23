<?php
session_start();
require '../../dbconn.php';
date_default_timezone_set('Europe/Sofia');
$username = $_SESSION['username'];

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    $query = "SELECT * FROM orders WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $order = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Заявката е намерен',
            'data' => $order
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['info'])) {
    $info = ($_POST['info']);
    $sort = ($_POST['sort']);
    $date_now = date("Y-m-d");

    $query = "SELECT * FROM employee WHERE pid = '$username'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        while ($rows = mysqli_fetch_array($query_run)) {
            $teamID = $rows['teamID'];

            $query = "SELECT * FROM orders WHERE teamID = '$teamID' AND (status = 'Назначена' OR status = 'В процес') AND $sort LIKE '$info%' AND date = '$date_now'";
            $query_run = mysqli_query($con, $query);

            if (mysqli_num_rows($query_run) > 0) {
                while ($rows = mysqli_fetch_array($query_run)) {
?>
                    <button type="button" class="boxBtn" value="<?= $rows['id'] ?>">
                        <div class="orBox d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="or-box-icon">
                                    <i class="fa-solid fa-house fa-lg"></i>
                                </div>
                                <div>
                                    <b>Почистване на: <?= $rows['room'] ?></b>
                                    <div><?= $rows['customerName'] ?></div>
                                    <div class="addressWidth"><?= $rows['address'] ?></div>
                                </div>
                            </div>
                            <div>
                                <b>Номер на заявка: <?= $rows['id'] ?></b>
                                <div><i class="fa-regular fa-clock text-success"></i> Час: <?= $rows['time'] ?></div>
                                <div><i class="fa-regular fa-calendar text-danger"></i> Дата: <?= date("d.m.Y", strtotime($rows['date'])) ?></div>
                            </div>
                            <div class="statusPay">
                                <div class="text-center">Статус на плащане</div>
                                <div class="text-center"><b>
                                        <?php
                                        if ($rows['pay'] == "В брой") {
                                            echo "В брой";
                                        } else {
                                            echo "Платена";
                                        }
                                        ?>
                                    </b></div>
                            </div>
                            <div>
                                <div class="dis-status"><i class="fa-solid fa-circle-exclamation"></i> <b><?= $rows['status'] ?></b></div>
                            </div>
                            <i style="color: #1090bc;" class="fa-solid icon-right fa-angle-right fa-3x"></i>
                        </div>
                    </button>
                <?php
                }
            } else {
                ?>
                <div class="text-center noResult">Няма намерени резултати</div>
                <?php
            }
        }
    }
}

if (isset($_POST['infoo'])) {
    $info = ($_POST['infoo']);
    $sort = ($_POST['sortt']);
    $date_now = date("Y-m-d");


    $query = "SELECT * FROM employee WHERE pid = '$username'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        while ($rows = mysqli_fetch_array($query_run)) {
            $teamID = $rows['teamID'];

            $query = "SELECT * FROM orders WHERE (status = 'Приключена' OR status = 'Отказана') AND $sort LIKE '$info%' AND teamID = '$teamID' AND date = '$date_now'";
            $query_run = mysqli_query($con, $query);

            if (mysqli_num_rows($query_run) > 0) {
                while ($rows = mysqli_fetch_array($query_run)) {
                ?>
                    <button type="button" class="boxBtn" value="<?= $rows['id'] ?>">
                        <div class="orBox d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="or-box-icon">
                                    <i class="fa-solid fa-house fa-lg"></i>
                                </div>
                                <div>
                                    <b>Почистване на: <?= $rows['room'] ?></b>
                                    <div><?= $rows['customerName'] ?></div>
                                    <div class="addressWidth"><?= $rows['address'] ?></div>
                                </div>
                            </div>
                            <div>
                                <b>Номер на заявка: <?= $rows['id'] ?></b>
                                <div><i class="fa-regular fa-clock text-success"></i> Час: <?= $rows['time'] ?></div>
                                <div><i class="fa-regular fa-calendar text-danger"></i> Дата: <?= date("d.m.Y", strtotime($rows['date'])) ?></div>
                            </div>
                            <div class="statusPay">
                                <div class="text-center">Статус на плащане</div>
                                <div class="text-center"><b>
                                        <?php
                                        if ($rows['pay'] == "В брой") {
                                            echo "В брой";
                                        } else {
                                            echo "Платена";
                                        }
                                        ?>
                                    </b></div>
                            </div>
                            <div>
                                <?php if ($rows['status'] == "Отказана") {
                                ?>
                                    <div style="color: #FF3131; border-color: #FF3131;" class="dis-status"><i class="fa-solid fa-circle-exclamation"></i> <b><?= $rows['status'] ?></b></div>
                                <?php
                                } ?>
                                <?php if ($rows['status'] == "Приключена") {
                                ?>
                                    <div style="color: #50C878; border-color: #50C878;" class="dis-status"><i class="fa-solid fa-circle-exclamation"></i> <b><?= $rows['status'] ?></b></div>
                                <?php
                                } ?>
                            </div>
                            <i style="color: #1090bc;" class="fa-solid icon-right fa-angle-right fa-3x"></i>
                        </div>
                    </button>
                <?php
                }
            } else {
                ?>
                <div class="text-center noResult">Няма намерени резултати</div>
    <?php
            }
        }
    }
}

if (isset($_POST['save_textarea_info'])) {
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
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];

    $query = "SELECT * FROM employee WHERE username='$pid' AND status <> 'Напуснал'";
    $query_run = mysqli_query($con, $query);

    while ($rows = mysqli_fetch_array($query_run)) {
        $id = $rows['id'];

        $query = "UPDATE teams SET status='No' WHERE (user1ID='$id' OR user2ID='$id') AND deleteTeam <> 'Yes'";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
            ];
            echo json_encode($res);
            return;
        }
    }
}

if (isset($_POST['change_user_password'])) {
    $id = ($_POST['id']);
    $currPass = ($_POST['currPass']);
    $newPass = ($_POST['newPass']);
    $repPass = ($_POST['repPass']);

    if ($currPass == NULL) {
        $res = [
            'status' => 230,
            'message' => 'Въведете старата парола'
        ];
        echo json_encode($res);
        return;
    }

    if ($newPass == NULL || $repPass == NULL) {
        $res = [
            'status' => 240,
            'message' => 'Въведете нова парола'
        ];
        echo json_encode($res);
        return;
    }

    $query = "SELECT * FROM employee WHERE id = '$id'";
    $query_run = mysqli_query($con, $query);

    while ($rows = mysqli_fetch_array($query_run)) {
        $getPassowrd = $rows['password'];

        if ($getPassowrd == $currPass) {
            if ($newPass == $repPass) {
                $query = "UPDATE employee SET password = '$newPass' WHERE id = '$id'";
                $query_run = mysqli_query($con, $query);

                if ($query_run) {
                    $res = [
                        'status' => 200,
                        'message' => 'Паролата е сменена'
                    ];
                    echo json_encode($res);
                    return;
                }
            } else {
                $res = [
                    'status' => 220,
                    'message' => 'Паролите не съвпадат'
                ];
                echo json_encode($res);
                return;
            }
        } else {
            $res = [
                'status' => 210,
                'message' => 'Грешна парола'
            ];
            echo json_encode($res);
            return;
        }
    }
}

if (isset($_POST['name'])) {
    $name = ($_POST['name']);

    $query = "SELECT * FROM setproduct WHERE quantity <> 0 AND productName = '$name' GROUP BY productName";
    $query_run = mysqli_query($con, $query);

    while ($rows = mysqli_fetch_array($query_run)) {
        $quantity = $rows['quantity'];
        $id = $rows['id'];

        $finalQuan = $quantity - 1;

        $query = "UPDATE setproduct SET quantity = '$finalQuan' WHERE id = '$id'";
        $query_go = mysqli_query($con, $query);
    }
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    $query = "SELECT * FROM setproduct WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $order = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Ъпдейт',
            'data' => $order
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['idd'])) {
    $id = $_POST['idd'];
    $today = date("Y-m-d H:i:s");

    echo $query = "UPDATE orders SET status = 'В процес', startDate = '$today', view = '3' WHERE id='$id'";
    $query_run = mysqli_query($con, $query);
}

if (isset($_POST['iddd'])) {
    $id = $_POST['iddd'];
    $today = date("Y-m-d H:i:s");

    $query = "UPDATE orders SET status = 'Приключена', endDate = '$today', view = '2' WHERE id='$id'";
    $query_run = mysqli_query($con, $query);
}

if (isset($_POST['selectedKind'])) {
    $selectedKind =  $_POST['selectedKind'];

    $query = "SELECT * FROM stock WHERE kind='$selectedKind'";
    $query_run = mysqli_query($con, $query);

    ?>
    <option hidden disabled selected>Избери вид</option>
    <?php
    while ($rows = mysqli_fetch_array($query_run)) {
    ?>
        <option value="<?= $rows['name'] ?>"><?= $rows['name'] ?></option>
<?php
    }
}

if (isset($_POST['save_request'])) {
    $kind = $_POST['kind'];
    $teamName = $_POST['teamName'];
    $quantity = $_POST['quantity'];
    $teamID = $_POST['teamID'];
    $today = date("Y-m-d H:i:s");


    $query = "INSERT INTO productrequest (name,teamName,quantity,view,date,teamID) VALUES ('$kind','$teamName','$quantity','1','$today','$teamID')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Заявката за ' . $kind . ' е направена'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['sendData'])) {

    $today = date("Y-m-d");

    $query = "SELECT * FROM employee WHERE pid='$username'";
    $query_run = mysqli_query($con, $query);

    while ($rows = mysqli_fetch_array($query_run)) {
        $teamID = $rows['teamID'];

        $query = "UPDATE setproduct SET view = '0' WHERE teamID = '$teamID'";
        $res = mysqli_query($con, $query);

        $query = "UPDATE setorder SET view = '0' WHERE teamID = '$teamID' AND datee <= '$today'";
        $res = mysqli_query($con, $query);
    }
}
?>