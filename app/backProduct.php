<?php
session_start();
require '../../dbconn.php';
$username = $_SESSION['username'];

if (isset($_POST['back_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    $query = "SELECT sum(quantity) as quantity_sum FROM setproduct WHERE productName='$name' AND teamID = '$id'";
    $query_run = mysqli_query($con, $query);

    while ($rows = mysqli_fetch_array($query_run)) {
        $quantity = $rows['quantity_sum'];

        $query3 = "SELECT * FROM stock WHERE name = '$name'";
        $query_fulfill = mysqli_query($con, $query3);

        while ($rowss = mysqli_fetch_array($query_fulfill)) {
            $quantity1 = $rowss['quantity'];
            $finalSum = $quantity + $quantity1;

            $query4 = "UPDATE stock SET quantity = '$finalSum' WHERE name = '$name'";
            $query_go = mysqli_query($con, $query4);

            $query5 = "DELETE FROM setproduct WHERE productName = '$name' AND teamID = '$id'";
            $query_goo = mysqli_query($con, $query5);
        }
    }

    $query = "SELECT * FROM employee WHERE pid = '$username'";
    $query_go = mysqli_query($con, $query);

    while ($rows = mysqli_fetch_array($query_go)) {
        $teamID = $rows['teamID'];

        $query = "SELECT * FROM setproduct WHERE teamID = '$teamID' GROUP BY productName";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {
            while ($rows = mysqli_fetch_array($query_run)) {
                $prodName = $rows['productName'];
                $kind = $rows['kind'];
                $id = $rows['id'];

                $query = "SELECT SUM(quantity) as quantity_sum FROM setproduct WHERE teamID = '$teamID' AND productName = '$prodName'";
                $query_runn = mysqli_query($con, $query);

                while ($rowss = mysqli_fetch_array($query_runn)) {
                    $quantity = $rowss['quantity_sum'];
?>
                    <input type="hidden" value="<?= $id ?>" id="getIDsetProd">
                    <div id="<?= str_replace(' ', '-', $prodName); ?>" class="orBox1 d-flex justify-content-between">
                        <div class="d-flex wid-set">
                            <div class="or-box-icon1" style="padding: 9.4px 10px 10px 11.1px;">
                                <i class="fa-solid fa-list fa-lg"></i>
                            </div>
                            <div class="startText kindProd1">
                                ТИП ПРОДУКТ
                                <div class="text-uppercase"><b><?= $prodName ?></b></div>
                            </div>
                            <div class="startText kindProd">
                                ВИД ПРОДУКТ
                                <div class="text-uppercase"><b><?= $kind ?></b></div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="numbCount">
                                БРОЙ
                                <div><b class="<?= str_replace(' ', '-', $prodName); ?>"><?= $quantity ?></b></div>
                            </div>
                            <div class="btn-group-mob">
                                <button value="<?= $prodName ?>" class="back-product" style="background-color: #dc5134;"><i class="fa-solid fa-minus fa-lg"></i></button>
                                <button value="<?= $id ?>" class="back-btn" style="background-color: #1aa758;"><i class="fa-solid fa-rotate-left fa-lg"></i> </button>
                            </div>
                        </div>
                    </div>
                    <div id="noResult" class="noResult d-none">Няма намерени резултати</div>
            <?php
                }
            }
        } else {
            ?><div class="noResult">Няма намерени резултати</div><?php
                                                                }
                                                            }
                                                        }
                                                                    ?>