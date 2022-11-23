<?php
require '../../dbconn.php';

if (isset($_POST['company'])) {
    $company =  ($_POST['company']);

    if ($company != "") {
        $query = "SELECT distinct company FROM products WHERE company like '$company%'";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {
            while ($rows = mysqli_fetch_array($query_run)) {
?>
                <div class="getCom"><?= $rows['company'] ?></div>
<?php
            }
        }
    }
}
?>