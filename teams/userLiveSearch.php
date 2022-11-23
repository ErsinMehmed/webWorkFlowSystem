<?php
require '../../dbconn.php';

if (isset($_POST['user1'])) {
    $name =  ($_POST['user1']);

    if ($name != "") {
        $query = "SELECT * FROM employee WHERE name like '$name%' AND teamID = 0 AND status <> 'Напуснал'";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {
            while ($rows = mysqli_fetch_array($query_run)) {
?>
                <div class="getName"><?= $rows['name'] ?> - <?= $rows['pid'] ?></div>
            <?php
            }
        } else {
            ?>
            <div class="getNameЕ">Няма намерени данни</div>
<?php
        }
    }
}
?>