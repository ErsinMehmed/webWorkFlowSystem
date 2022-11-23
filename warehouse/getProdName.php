<?php
require '../../dbconn.php';

if (isset($_POST['name'])) {
    $name =  ($_POST['name']);

    if ($name != "") {
        $query = "SELECT * FROM stock WHERE name like '$name%' or id = '$name'";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {
            while ($rows = mysqli_fetch_array($query_run)) {
?>
                <div class="getProdName"><?= $rows['name'] ?></div>
<?php
            }
        }
    }
}
?>