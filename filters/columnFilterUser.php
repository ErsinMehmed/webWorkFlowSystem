<?php
include '../../dbconn.php';

if (isset($_POST['action'])) {

   $order = $_POST["order"];

   if ($order == 'desc') {
      $order = 'asc';
   } else {
      $order = 'desc';
   }
   $query = "SELECT * FROM employee ORDER BY " . $_POST["column_name"] . " " . $_POST["order"] . "";

   if (isset($_POST['position'])) {
      $position = $_POST['position'];

      if ($position == "Всички") {
         $query = "SELECT * FROM employee ORDER BY " . $_POST["column_name"] . " " . $_POST["order"] . "";
      } else if ($position == "") {
         $query = "SELECT * FROM employee ORDER BY " . $_POST["column_name"] . " " . $_POST["order"] . "";
      } else {
         $query = "SELECT * FROM employee WHERE position = '$position' ORDER BY " . $_POST["column_name"] . " " . $_POST["order"] . "";
      }
   }
   $query_run = mysqli_query($con, $query);

?>

   <thead>
      <tr>
         <th class="column_sortt" id="emId" name="id" data-order="<?= $order ?>">Номер</th>
         <th>Снимка</th>
         <th class="column_sortt" id="emName" name="name" data-order="<?= $order ?>">Име</th>
         <th class="column_sortt" id="emPid" name="pid" data-order="<?= $order ?>">ПИД</th>
         <th class="column_sortt" id="emEgn" name="egn" data-order="<?= $order ?>">ЕГН</th>
         <th class="column_sortt" id="emPhone" name="phone" data-order="<?= $order ?>">Телефон</th>
         <th class="column_sortt" id="emPosition" name="position" data-order="<?= $order ?>">Длъжност</th>
         <th class="column_sortt" id="emStatus" name="status" data-order="<?= $order ?>">Статус</th>
         <th>Екип</th>
         <th class="column_sortt" id="emDate" name="inDate" data-order="<?= $order ?>">Назначен</th>
         <th>Действия</th>
      </tr>
   </thead>
   <tbody id="tbody">
      <?php
      if (mysqli_num_rows($query_run) > 0) {
         foreach ($query_run as $rows) {
            $team = $rows['teamID'];
      ?>
            <tr>
               <td>
                  <?= $rows['id'] ?>
               </td>
               <td class="py-1"><img class="rounded-circle border border-secondary" src="users/userImages/<?= $rows["image"] ?>" alt=""></td>
               <td><button class="editUserBtn customer" type="button" value="<?= $rows['id']; ?>"><?= $rows["name"] ?></button></td>
               <td id="getPid">
                  <?= $rows['pid'] ?>
               </td>
               <td>
                  <?= $rows['egn'] ?>
               </td>
               <td>
                  <?= $rows['phone'] ?>
               </td>
               <td>
                  <?= $rows['position'] ?>
               </td>
               <?php
               if ($rows['status'] == "Активен") {
               ?><td class="text-success"><?= $rows['status'] ?></td><?php
                                                                                             }
                                                                                             if ($rows['status'] == "Напуснал") {
                                                                                                ?><td class="text-danger"><?= $rows['status'] ?></td><?php
                                                                                             }
                                                                                                ?>
               <td>
                  <?php
                  $queryy = "SELECT * FROM teams WHERE id='$team'";
                  $queryy_run = mysqli_query($con, $queryy);

                  if (mysqli_num_rows($queryy_run) > 0) {
                     while ($rowss = mysqli_fetch_array($queryy_run)) {
                  ?>
                        <?= $rowss['name'] ?>
                     <?php
                     }
                  } else {
                     ?>
                     Няма екип
                  <?php
                  }
                  ?>
               </td>
               <td>
                  <?= date("d.m.y", strtotime($rows['inDate'])) ?>
               </td>
               <?php
               if ($rows['status'] == "Активен") {
               ?><td><button type="button" value="<?= $rows['id']; ?>" class="btn bg-gradient btn-primary passwordBtn btn-sm shadow-none py-1 px-4 rounded">Парола<i class="fa-solid fa-unlock-keyhole ml-2"></i></button></td><?php
                                                                                                                                                                                                                                                         }
                                                                                                                                                                                                                                                         if ($rows['status'] == "Напуснал") {
                                                                                                                                                                                                                                                            ?><td class="text-danger"><button type="button" disabled class="btn bg-gradient btn-primary passwordBtn btn-sm shadow-none py-1 px-4 rounded">Парола<i class="fa-solid fa-unlock-keyhole ml-2"></i></button></td><?php
                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                               ?>
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