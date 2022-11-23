<?php
include '../../dbconn.php';

if (isset($_POST['action'])) {

    $order = $_POST["order"];

    if ($order == 'desc') {
        $order = 'asc';
    } else {
        $order = 'desc';
    }
    $query = "SELECT * FROM products ORDER BY " . $_POST["column_name"] . " " . $_POST["order"] . "";

    if (isset($_POST['prodName'])) {
        $prodName = $_POST['prodName'];

        $query = "SELECT * FROM products WHERE name LIKE '$prodName%' ORDER BY " . $_POST["column_name"] . " " . $_POST["order"] . "";
    }
    $query_run = mysqli_query($con, $query);

?>

    <thead>
        <tr>
            <th class="product_sort" id="prId" name="id" data-order="<?= $order ?>">Номер</th>
            <th class="product_sort" id="prName" name="name" data-order="<?= $order ?>">Продукт</th>
            <th class="product_sort" id="prQuantity" name="quantity" data-order="<?= $order ?>">Количество</th>
            <th class="product_sort" id="prOnePrice" name="onePrice" data-order="<?= $order ?>">Ед. цена</th>
            <th class="product_sort" id="prPrice" name="price" data-order="<?= $order ?>">Цена</th>
            <th class="product_sort" id="prKind" name="kind" data-order="<?= $order ?>">Вид</th>
            <th class="product_sort" id="prDate" name="date" data-order="<?= $order ?>">Дата</th>
            <th class="product_sort" id="prCompany" name="company" data-order="<?= $order ?>">Производител</th>
            <th class="product_sort" id="prSupplier" name="supplier" data-order="<?= $order ?>">Доставчик</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php

        if (mysqli_num_rows($query_run) > 0) {
            while ($rows = mysqli_fetch_array($query_run)) {
        ?>
                <tr>
                    <td><?= $rows["number"] ?></td>
                    <td>
                        <?= $rows['name'] ?>
                    </td>
                    <td>
                        <?= $rows['quantity'] . " бр." ?>
                    </td>
                    <td>
                        <?= $rows['onePrice'] . " лв." ?>
                    </td>
                    <td>
                        <?= $rows['price'] . " лв." ?>
                    </td>
                    <td>
                        <?= $rows['kind'] ?>
                    </td>
                    <td>
                        <?= date("d.m.y", strtotime($rows['date'])) ?>
                    </td>
                    <td>
                        <?= $rows['company'] ?>
                    </td>
                    <td>
                        <?= $rows['supplier'] ?>
                    </td>
                    <td>
                        <button type="button" value="<?= $rows['id'] . " " . $rows['name']; ?>" class="btn bg-gradient delete_product btn-danger shadow-none rounded">Изтрий<i class="bi bi-trash3 ml-2"></i></button>
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
<?php

}
?>