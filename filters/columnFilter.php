<?php
include '../../dbconn.php';

if (isset($_POST['action'])) {

    $date = $_POST['date'];
    $order = $_POST["order"];

    if ($order == 'desc') {
        $order = 'asc';
    } else {
        $order = 'desc';
    }
    echo $query = "SELECT * FROM orders WHERE date = '$date' ORDER BY " . $_POST["column_name"] . " " . $_POST["order"] . "";

    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $query = "SELECT * FROM orders WHERE (customerName like '$name%' OR id = '$name') AND date = '$date' ORDER BY " . $_POST["column_name"] . " " . $_POST["order"] . "";
    }
    $query_run = mysqli_query($con, $query);

?>

    <thead>
        <tr>
            <th class="column_sort" id="custNumber" name="id" data-order="<?= $order ?>">Номер</th>
            <th class="column_sort" id="customer" name="customerName" data-order="<?= $order ?>">Клиент</th>
            <th class="column_sort" id="addres" name="address" data-order="<?= $order ?>">Адрес</th>
            <th class="column_sort" id="of" name="offer" data-order="<?= $order ?>">Оферта</th>
            <th class="column_sort" id="bul" name="room" data-order="<?= $order ?>">Помещение</th>
            <th class="column_sort" id="km" name="m2" data-order="<?= $order ?>">m<sup>2</sup></th>
            <th class="column_sort" id="pri" name="price" data-order="<?= $order ?>">Цена</th>
            <th class="column_sort" id="orStatus" name="status" data-order="<?= $order ?>">Статус</th>
            <th class="column_sort" id="payStat" name="pay" data-order="<?= $order ?>">Пл. статус</th>
            <th data-order="desc">Назначи</th>
        </tr>
    </thead>
    <tbody id="tbody" class="animate__animated animate__fadeIn animate__fast">
        <?php
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $orders) {
        ?>
                <tr>
                    <td style="width: 6%">
                        <?= $orders['id'] ?>
                    </td>
                    <td style="width: 14%"><button class="editOrderBtn customer" type="button" value="<?= $orders['id']; ?>"><?= $orders["customerName"] ?></button></td>
                    <td style="width: 23%">
                        <?= $orders['address'] ?>
                    </td>
                    <?php
                    if ($orders['offer'] == "Премиум") {
                    ?>
                        <td><span class="badge bg-primary px-2 py-1"><?= $orders['offer'] ?></span></td>
                    <?php
                    }
                    if ($orders['offer'] == "Вип") {
                    ?>
                        <td><span class="badge bg-info px-2 py-1"><?= $orders['offer'] ?></span></td>
                    <?php
                    }
                    if ($orders['offer'] == "Основна") {
                    ?>
                        <td><span class="badge bg-secondary px-2 py-1"><?= $orders['offer'] ?></span></td>
                    <?php
                    }
                    ?>
                    <td>
                        <?= $orders['room'] ?>
                    </td>
                    <td style="width: 6%">
                        <?= $orders['m2'] ?> m<sup>2</sup>
                    </td>
                    <td>
                        <?= $orders['price'] . ' лв.' ?>
                    </td>
                    <?php
                    if ($orders['status'] == "Назначи") {
                    ?>
                        <td><span class="badge bg-primary px-2 py-1"><?= $orders['status'] ?></span></td>
                    <?php
                    }
                    if ($orders['status'] == "Назначена") {
                    ?>
                        <td><span class="badge bg-info px-2 py-1"><?= $orders['status'] ?></span></td>
                    <?php
                    }
                    if ($orders['status'] == "В процес") {
                    ?>
                        <td><span class="badge bg-warning px-2 py-1"><?= $orders['status'] ?></span></td>
                    <?php
                    }
                    if ($orders['status'] == "Отказана") {
                    ?>
                        <td><span class="badge bg-danger px-2 py-1"><button class="reviewCancel customer" type="button" value="<?= $orders['id']; ?>"><?= $orders['status'] ?></button></span></td>
                    <?php
                    }
                    if ($orders['status'] == "Приключена") {
                    ?>
                        <td><span class="badge bg-success px-2 py-1"><?= $orders['status'] ?></span></td>
                    <?php
                    }
                    if ($orders['status'] == "Изтекла") {
                    ?>
                        <td><span class="badge bg-gradient bg-secondary px-2 py-1"><?= $orders['status'] ?></span></td>
                    <?php
                    }
                    ?>
                    <td style="width: 10%">
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
?>