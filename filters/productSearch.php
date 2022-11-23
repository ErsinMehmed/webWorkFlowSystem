<?php
require '../../dbconn.php';

if (isset($_POST['prodSearch'])) {

    $name = $_POST['prodSearch'];

    $query = "SELECT * FROM stock WHERE name like '$name%' OR id like '$name%'";
}
?>
<thead>
    <tr>
        <th>Номер</th>
        <th>Продукт</th>
        <th>Наличност</th>
        <th>Вид</th>
        <th>Стаус</th>
    </tr>
</thead>
<tbody>
    <?php
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        while ($rows = mysqli_fetch_array($query_run)) {
            $quantity = $rows['quantity'];
            $prodName = $rows['name'];
    ?>
            <tr>
                <td>
                    <?= $rows['id'] ?>
                </td>
                <td><button class="seeWhereIs customer" type="button" value="<?= $rows['name']; ?>"><?= $rows["name"] ?></button></td>
                <td>
                    <?= $quantity . " бр." ?>
                </td>
                <td>
                    <?= $rows['kind'] ?>
                </td>
                <td>
                    <?php
                    $query = "SELECT SUM(quantity) as quantity_sum FROM products WHERE name = '$prodName'";
                    $query_runn = mysqli_query($con, $query);

                    while ($rowss = mysqli_fetch_array($query_runn)) {
                        $quantity1 = $rowss['quantity_sum'];
                        if ($quantity != 0) {
                            if ($quantity != $quantity1) {
                    ?><i class="fa-solid text-success fa-check fa-xl"></i><?php
                                                                        } else {
                                                                            ?><i class="fa-solid text-danger fa-xmark fa-xl"></i><?php
                                                                        }
                                                                    } else {
                                                                            ?><i class="fa-solid text-danger fa-xmark fa-xl"></i><?php
                                                                        }
                                                                    }
                                                                            ?>
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