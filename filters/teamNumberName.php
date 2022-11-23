<?php
require '../../dbconn.php';

if (isset($_POST['nameNum'])) {

    $nameNum = $_POST['nameNum'];

    $query = "SELECT * FROM teams WHERE (name like '$nameNum%' OR id = '$nameNum') AND deleteTeam <> 'yes'";
}
?>
<thead>
    <tr>
        <th>Номер</th>
        <th>Име на екип</th>
        <th>Статус</th>
        <th>Потребител 1</th>
        <th>Потребител 2</th>
        <th>Назначени задачи</th>
        <th>Действия</th>
    </tr>
</thead>
<tbody>
    <?php
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        while ($rows = mysqli_fetch_array($query_run)) {
    ?>
            <tr>
                <td><?= $rows["id"] ?></td>
                <td>
                    <?= $rows['name'] ?>
                </td>
                <?php if ($rows['status'] == "Yes") {
                ?> <td>
                        <div class="activeStatusTeam"></div>
                    </td><?php
                        } else {
                            ?> <td>
                        <div class="deactiveStatusTeam"></div>
                    </td><?php
                        } ?>
                <td>
                    <?= $rows['user1'] ?>
                </td>
                <td>
                    <?= $rows['user2'] ?>
                </td>
                <td>
                    <button type="button" value="<?= $rows['id']; ?>" class="prevOrd badgee bg-primary px-2 py-1 customer ordCount">
                        <?php
                        $id = $rows['id'];
                        $date_now = date("Y-m-d");

                        $queryy = "SELECT * FROM orders WHERE teamID = '$id' AND date >= '$date_now'";
                        $query_runn = mysqli_query($con, $queryy);

                        if (mysqli_num_rows($query_runn) > 0) {
                            echo mysqli_num_rows($query_runn);
                        } else {
                        ?>
                            0
                        <?php
                        }
                        ?>
                    </button>
                </td>
                <td>
                    <button type="button" value="<?= $rows['id']; ?>" class="btn bg-gradient delete_team btn-danger shadow-none rounded">Изтрий<i class="bi bi-trash3 ml-2"></i></button>
                </td>
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