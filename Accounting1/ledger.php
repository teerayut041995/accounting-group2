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
    <title>บัญชีแยกประเภท</title>
  </head>
  <body>
    <header>
    <?php include "template/header.php"; ?>
    </header>
    <br>
    <div class="container">


    <?php
    $sql_acc_id = "SELECT * FROM tb_book book
                            LEFT JOIN tb_account_number acc
                            ON book.acc_id = acc.acc_id
                            WHERE book.acc_id != 0
                            GROUP BY book.acc_id";
    $rs_acc_id = mysqli_query($conn , $sql_acc_id);
    while($data_acc_id = mysqli_fetch_array($rs_acc_id)){
      $acc_number = $data_acc_id['acc_number'];
      echo 'ชื่อบัญชี '.$data_acc_id['list'].' เลขที่บัญชี'.$data_acc_id['acc_number'].'<br>';
    ?>
    <table style="width: 100%;">
      <tr valign="top">
        <td>
        <!-- debit start  -->
        <table class="table table-bordered">
          <tr>
            <td colspan="2">วันเดือนปี</td>
            <td>รายการ</td>
            <td>หน้าบัญชี</td>
            <td>เดบิต</td>
          </tr>
          <?php
          $sql_debit = "SELECT * FROM tb_book book
                                  LEFT JOIN tb_account_number acc
                                  ON book.acc_id = acc.acc_id
                                  WHERE status = 'debit'
                                  AND acc_number = '$acc_number'";
          $rs_debit = mysqli_query($conn , $sql_debit);
          while ($data_debit = mysqli_fetch_array($rs_debit)) {
          $date_debit = $data_debit['date'];
          ?>
          <tr>
            <td><?php echo $data_debit['date']; ?></td>
            <td><?php echo $data_debit['date']; ?></td>
            <td>
            <?php
            $sql_list_debit = "SELECT * FROM tb_book book
                                    LEFT JOIN tb_account_number acc
                                    ON book.acc_id = acc.acc_id
                                    WHERE date='$date_debit'
                                    AND status = 'credit'";
            $rs_list_debit = mysqli_query($conn,$sql_list_debit);
            while ($data_list_debit = mysqli_fetch_array($rs_list_debit)) {
            echo $data_list_debit['list'].'<br>';
            }
            ?>
            </td>
            <td>ร.ว.1</td>
            <td><?php echo $data_debit['cost']; ?></td>
          </tr>
          <?php
          }
          ?>

        </table>
        <!-- debit end  -->
        </td>
        <td>
        <!-- credit start  -->
        <table class="table table-bordered">
          <tr>
            <td colspan="2">วันเดือนปี</td>
            <td>รายการ</td>
            <td>หน้าบัญชี</td>
            <td>เครดิต</td>
          </tr>
          <tr>
            <td>พ.ย.</td>
            <td>1</td>
            <td>เจ้าหนี้</td>
            <td>ร.ว.1</td>
            <td>10000</td>
          </tr>
        </table>
        <!-- credit end  -->
        </td>
      </tr>
    </table>
    <?php
    }
    ?>

    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="bootstrap/js/jquery-3.3.1.slim.min.js" ></script>
    <script src="bootstrap/js/popper.min.js" ></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
