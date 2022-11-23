<?php
require '../../dbconn.php';

if (isset($_POST['prodKind'])) {
    $prodKind = $_POST['prodKind'];

    if ($prodKind == "Всички") {
        $query = "SELECT * FROM stock";
    } else {
        $query = "SELECT * FROM stock WHERE kind = '$prodKind'";
    }
    $query_run = mysqli_query($con, $query);

    while ($rows = mysqli_fetch_array($query_run)) {
?>
        <li class="my-2 li-list ml-1"><?= $rows['id'] ?>. <?= $rows['name'] ?></li>
<?php
    }
}
?>