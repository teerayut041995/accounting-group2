<?php
include "config/database.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>สมุดรายวันทั่วไป</title>
  </head>
  <body>
    <header>
    <?php include "template/header.php"; ?>
    </header>
    <br>
    <div class="container">
      <div class="row">
        <div class="col-12">

          <table class="table table-bordered">
            <tr>
              <td colspan="2">พ.ศ.</td>
              <td rowspan="2">รายการ</td>
              <td rowspan="2">เลขที่บัญชี</td>
              <td colspan="2">เดบิต</td>
              <td colspan="2">เครดิต</td>
            </tr>
            <tr>
              <td>เดือน</td>
              <td>วัน</td>

              <td>บาท</td>
              <td>ส.ต.</td>
              <td>บาท</td>
              <td>ส.ต.</td>
            </tr>
            <?php
            $sql = "SELECT * FROM tb_book book
                             LEFT JOIN tb_account_number acc
                             ON book.acc_id = acc.acc_id
                             ORDER BY date , book.id ASC";
            $result = mysqli_query($conn,$sql);
            $old_month = "";
            $old_day = "";
            while ($data = mysqli_fetch_array($result)) {
            $date = date_create($data['date']);
            $day = date_format($date,'j');
            $month = date_format($date , 'm');
            $year = date_format($date , 'Y');
            ?>
            <tr>
              <td>
                <?php
                if ($old_month != $month) {
                  echo monthThai((int)$month);
                  $old_month = $month;
                }
                ?>
              </td>
              <td>
                <?php
                if ($old_day != $day) {
                  echo $day;
                  $old_day = $day;
                }
                ?>
              </td>
              <td>
              <?php
              if ($data['status'] == 'debit') {
                echo $data['list'];
              } else if($data['status'] == 'credit'){
                echo '&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'.$data['list'];
              } else {
                echo $data['detail'];
              }
              ?>
              </td>
              <td><?php echo $data['acc_number']; ?></td>
              <?php
              if ($data['status'] == 'debit') {
              ?>
              <td><?php echo $data['cost']; ?></td>
              <td>-</td>
              <td></td>
              <td></td>
              <?php
              } else if($data['status'] == 'credit'){
              ?>
                <td></td>
                <td></td>
                <td><?php echo $data['cost']; ?></td>
                <td>-</td>
              <?php
              } else {
                ?>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                <?php

              }
              ?>

            </tr>
            <?php
            }
            ?>



          </table>

        </div>
      </div>
    </div>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="bootstrap/js/jquery-3.3.1.slim.min.js" ></script>
    <script src="bootstrap/js/popper.min.js" ></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>

<?php
  function monthThai($month){
    $num = (int)$month;
    $arr = ["","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."];
    return $arr[$num];
  }
?>
