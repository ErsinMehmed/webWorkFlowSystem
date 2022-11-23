<?php
require '../../dbconn.php';

if (isset($_POST['namePid'])) {

    $name = $_POST['namePid'];

    $query = "SELECT * FROM employee WHERE (name like '$name%' OR pid like '$name%')";

    if (isset($_POST['position'])) {
        $position = $_POST['position'];

        if ($name == "") {
            $query = "SELECT * FROM employee WHERE (name like '$name%' OR pid like '$name%')";
        } else {
            if ($position == "Всички") {
                $query = "SELECT * FROM employee WHERE name like '$name%' OR pid like '$name%'";
            } else if ($position == "") {
                $query = "SELECT * FROM employee WHERE (name like '$name%' OR pid like '$name%')";
            } else {
                $query = "SELECT * FROM employee WHERE (name like '$name%' OR pid like '$name%') AND position = '$position'";
            }
        }
    }
}
?>
<thead>
    <tr>
        <th class="column_sortt" id="emId" name="id" data-order="desc">Номер</th>
        <th>Снимка</th>
        <th class="column_sortt" id="emName" name="name" data-order="desc">Име</th>
        <th class="column_sortt" id="emPid" name="pid" data-order="desc">ПИД</th>
        <th class="column_sortt" id="emEgn" name="egn" data-order="desc">ЕГН</th>
        <th class="column_sortt" id="emPhone" name="phone" data-order="desc">Телефон</th>
        <th class="column_sortt" id="emPosition" name="position" data-order="desc">Длъжност</th>
        <th class="column_sortt" id="emStatus" name="status" data-order="desc">Статус</th>
        <th>Екип</th>
        <th class="column_sortt" id="emDate" name="inDate" data-order="desc">Назначен</th>
        <th>Действия</th>
    </tr>
</thead>
<tbody>
    <?php
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $orders) {
            $team = $rows['teamID'];
    ?>
            <tr>
                <td>
                    <?= $orders['id'] ?>
                </td>
                <td class="py-1"><img class="rounded-circle border border-secondary" src="users/userImages/<?= $orders["image"] ?>" alt=""></td>
                <td><button class="editUserBtn customer" type="button" value="<?= $orders['id']; ?>"><?= $orders["name"] ?></button></td>
                <td id="getPid">
                    <?= $orders['pid'] ?>
                </td>
                <td>
                    <?= $orders['egn'] ?>
                </td>
                <td>
                    <?= $orders['phone'] ?>
                </td>
                <td>
                    <?= $orders['position'] ?>
                </td>
                <?php
                if ($orders['status'] == "Активен") {
                ?><td class="text-success"><?= $orders['status'] ?></td><?php
                                                                    }
                                                                    if ($orders['status'] == "Напуснал") {
                                                                        ?><td class="text-danger"><?= $orders['status'] ?></td><?php
                                                                    }
                                                                        ?>
                <td>
                    <?php
                    $queryy = "SELECT * FROM teams WHERE id='$team'";
                    $queryy_run = mysqli_query($con, $queryy);

                    if (mysqli_num_rows($queryy_run) > 0) {
                        while ($rowss = mysqli_fetch_array($queryy_run)) {
                    ?>
                            <?= $rowss['name'] ?>
                        <?php
                        }
                    } else {
                        ?>
                        Няма екип
                    <?php
                    }
                    ?>
                </td>
                <td>
                    <?= date("d.m.y", strtotime($orders['inDate'])) ?>
                </td>
                <?php
                if ($orders['status'] == "Активен") {
                ?><td><button type="button" value="<?= $orders['id']; ?>" class="btn bg-gradient btn-primary passwordBtn btn-sm shadow-none py-1 px-4 rounded">Парола<i class="fa-solid fa-unlock-keyhole ml-2"></i></button></td><?php
                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                if ($orders['status'] == "Напуснал") {
                                                                                                                                                                                                                                    ?><td class="text-danger"><button type="button" disabled class="btn bg-gradient btn-primary passwordBtn btn-sm shadow-none py-1 px-4 rounded">Парола<i class="fa-solid fa-unlock-keyhole ml-2"></i></button></td><?php
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
<tbody>