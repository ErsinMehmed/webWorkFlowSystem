<?php
require '../../dbconn.php';
date_default_timezone_set('Europe/Sofia');

if (isset($_POST['save_team'])) {
    $user1 = ($_POST['user1']);
    $user2 = ($_POST['user2']);

    $pid1 = ($_POST['hidPID1']);
    $pid2 = ($_POST['hidPID2']);

    $tmName = ($_POST['tmName']);

    if ($user2 == NULL || $user1 == NULL || $tmName == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Попълнете всички полета'
        ];
        echo json_encode($res);
        return;
    }

    $query = "SELECT id FROM employee WHERE name = '$user1' AND pid = '$pid1'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        while ($rows = mysqli_fetch_array($query_run)) {
            $firstID = $rows['id'];

            $query = "SELECT id FROM employee WHERE name = '$user2' AND pid = '$pid2'";
            $query_run = mysqli_query($con, $query);

            if (mysqli_num_rows($query_run) > 0) {
                while ($rows = mysqli_fetch_array($query_run)) {
                    $secondID = $rows['id'];

                    $query = "SELECT name FROM teams WHERE name = '$tmName' AND deleteTeam <> 'yes'";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) == 0) {
                        if ($pid1 !=  $pid2) {
                            $query = "INSERT INTO teams (name, user1, user2, user1ID, user2ID, status) VALUES ('$tmName','$user1','$user2','$firstID','$secondID','No')";
                            $query_run = mysqli_query($con, $query);

                            $query = "SELECT id FROM teams WHERE user1 = '$user1' AND user2 = '$user2' AND user1ID = '$firstID' AND user2ID = '$secondID'";
                            $query_go = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_go) > 0) {
                                while ($rows = mysqli_fetch_array($query_go)) {
                                    $teamID = $rows['id'];

                                    $query = "UPDATE employee SET teamID = '$teamID' WHERE id = '$firstID' AND pid = '$pid1'";
                                    mysqli_query($con, $query);

                                    $query = "UPDATE employee SET teamID = '$teamID' WHERE id = '$secondID' AND pid = '$pid2'";
                                    $query_runnn = mysqli_query($con, $query);
                                }
                            }

                            if ($query_run) {
                                $res = [
                                    'status' => 200,
                                    'message' => 'Екипът е добавен'
                                ];
                                echo json_encode($res);
                                return;
                            } else {
                                $res = [
                                    'status' => 500,
                                    'message' => 'Екипът не е добавен'
                                ];
                                echo json_encode($res);
                                return;
                            }
                        } else {
                            $res = [
                                'status' => 400,
                                'message' => 'Избрали сте един и същ потребител'
                            ];
                            echo json_encode($res);
                            return;
                        }
                    } else {
                        $res = [
                            'status' => 320,
                            'message' => 'Въведеното име съществува'
                        ];
                        echo json_encode($res);
                        return;
                    }
                }
            }
        }
    }
}

if (isset($_POST['idd'])) {
    $id = mysqli_real_escape_string($con, $_POST['idd']);
    $date_now = date("Y-m-d");

    $query = "SELECT * FROM orders WHERE teamID='$id' AND date >= '$date_now'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $orders) {
?>

            <div class="card card-margin">
                <div class="card-body pb-1">
                    <div class="widget-49">
                        <div class="widget-49-title-wrapper">
                            <div class="widget-49-date-primary">
                                <input type="hidden" id="checkClick">
                                <span class="widget-49-date-day"><?= $orders['id'] ?></span>
                                <span class="widget-49-date-month">ном</span>
                            </div>
                            <div class="widget-49-meeting-info">
                                <span class="widget-49-pro-title">Име на клиент: <?= $orders['customerName'] ?></span>
                                <span class="widget-49-meeting-time">Назначена за: <?= date("d.m.y", strtotime($orders['date'])) ?></span>
                            </div>
                        </div>
                        <ul id="custInfo" class="widget-49-meeting-points">
                            <li class="widget-49-meeting-item"><span>Вид оферта: <b><?= $orders['offer'] ?></b></span></li>
                            <li class="widget-49-meeting-item"><span>Вид помещение: <b><?= $orders['room'] ?></b></span></li>
                            <li class="widget-49-meeting-item"><span>Статус на заявката: <b><?= $orders['status'] ?></b></span></li>
                        </ul>
                    </div>
                </div>
            </div>

        <?php
        }
    } else {
        ?>
        <tr>
            <th class="text-center pos position-absolute border-0" colspan="10">Няма намерени данни</th>
        </tr>
<?php
    }
}

if (isset($_POST['delete_team'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $date_now = date("Y-m-d");
    $curDT = date('Y-m-d H:i:s');

    $query = "SELECT * FROM setproduct WHERE teamID='$id'";
    $query_runnnnn = mysqli_query($con, $query);

    if (mysqli_num_rows($query_runnnnn) == 0) {
        $query = "UPDATE orders SET teamID=0, status='Назначи' WHERE teamID='$id' AND date >= '$date_now' AND status <> 'Отказана' AND status <> 'Приключена' AND status <> 'В процес'";
        $query_run = mysqli_query($con, $query);

        $query = "DELETE FROM setorder WHERE teamID='$id' AND status <> 'В процес' AND status <> 'Отказана' AND status <> 'Приключена'";
        $query_runn = mysqli_query($con, $query);

        $query = "UPDATE teams SET deleteTeam='yes' WHERE id='$id'";
        $query_runnn = mysqli_query($con, $query);

        $query = "UPDATE employee SET teamID=0 WHERE teamID='$id'";
        $query_runnnn = mysqli_query($con, $query);

        if ($query_run && $query_runn && $query_runnn && $query_runnnn) {
            $res = [
                'status' => 200,
                'message' => 'Екипа е изтрит успешно'
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Екипа не е изтрит'
            ];
            echo json_encode($res);
            return;
        }
    } else {
        $res = [
            'status' => 300,
            'message' => 'Има назначени продукти на екипа'
        ];
        echo json_encode($res);
        return;
    }
}
?>