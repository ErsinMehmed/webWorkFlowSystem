<?php
require '../../dbconn.php';

if (isset($_POST['supplier'])) {
    $supplier =  ($_POST['supplier']);

    if ($supplier != "") {
        $query = "SELECT * FROM supplier WHERE name like '$supplier%'";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {
            while ($rows = mysqli_fetch_array($query_run)) {
?>
                <div class="getSup"><?= $rows['name'] ?></div>
<?php
            }
        }
    }
}
?>