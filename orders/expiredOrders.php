<?php
    include("../../dbconn.php");

    $date_now = date("Y-m-d");

    $queryy = "UPDATE orders SET status = 'Изтекла' WHERE (date < '$date_now' AND status = 'Назначи') OR (date < '$date_now' AND status = 'Назначена')";
    mysqli_query($con, $queryy);
