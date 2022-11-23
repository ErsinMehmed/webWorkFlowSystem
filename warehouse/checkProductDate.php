<?php
require '../../dbconn.php';

if (isset($_POST['date'])) {
    $date = $_POST['date'];
    $prodName = $_POST['get_value'];

    $query = "SELECT * FROM setproducthistory WHERE productName = '$prodName' AND date = '$date'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
?>
        <div class="modal-header">
            <h5 class="modal-title text-black" id="setedProductHeader"></h5>
            <button type="button" class="close seeWhereIsProductModal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="mt-3 mx-3">
            <input type="date" id="checkSetedProducts" class="form-control shadow-none" value="<?php echo date("Y-m-d"); ?>">
        </div>
        <div class="modal-body">
            <div class="d-flex mb-2 px-1 pb-2 border-bottom">
                <div class="prodName"><b>Име на екип</b></div>
                <div class="prodQantity"><b>Назначени</b></div>
                <div class="prodAddDate"><b>Дата</b></div>
                <div class="prodAddTime"><b>Час</b></div>
            </div>
            <?php

            foreach ($query_run as $orders) {
            ?>

                <div class="d-flex mb-2 px-1 pb-2 border-bottom">
                    <div class="prodName"><?= $orders['teamName'] ?></div>
                    <div class="prodQantity"><?= $orders['quantity'] . ' бр.' ?></div>
                    <div class="prodAddDate"><?= date("d.m.Y", strtotime($orders['date'])) ?></div>
                    <div class="prodAddTime"><?= date("H:i", strtotime($orders['time'])) ?></div>
                </div>
            <?php
            }
            ?>
        </div>
    <?php
    } else {
    ?>
        <div class="modal-header">
            <h5 class="modal-title text-black" id="setedProductHeader"></h5>
            <button type="button" class="close seeWhereIsProductModal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="mt-3 mx-3">
            <input type="date" id="checkSetedProducts" class="form-control shadow-none" value="<?php echo date("Y-m-d"); ?>">
        </div>
        <div class="modal-body">
            <div class="mt-2 mb-3 text-center">
                <div class="text-center">Няма намерени данни</div>
            </div>
        </div>
<?php
    }
}
?>