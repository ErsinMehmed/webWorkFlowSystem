<?php
require '../../dbconn.php';

if (isset($_POST['prodSearch'])) {

    $name = $_POST['prodSearch'];

    $query = "SELECT * FROM products WHERE name like '$name%'";
}
?>
<thead>
    <tr>
        <th class="product_sort" id="prId" name="id" data-order="desc">Номер</th>
        <th class="product_sort" id="prName" name="name" data-order="desc">Продукт</th>
        <th class="product_sort" id="prQuantity" name="quantity" data-order="desc">Количество</th>
        <th class="product_sort" id="prOnePrice" name="onePrice" data-order="desc">Ед. цена</th>
        <th class="product_sort" id="prPrice" name="price" data-order="desc">Цена</th>
        <th class="product_sort" id="prKind" name="kind" data-order="desc">Вид</th>
        <th class="product_sort" id="prDate" name="date" data-order="desc">Дата</th>
        <th class="product_sort" id="prCompany" name="company" data-order="desc">Производител</th>
        <th class="product_sort" id="prSupplier" name="supplier" data-order="desc">Доставчик</th>
        <th>Действия</th>
    </tr>
</thead>
<tbody class="animate__animated animate__fadeIn animate__faster">
    <?php
    $query_run = mysqli_query($con, $query);

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
<tbody>