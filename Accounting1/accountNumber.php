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
    <title>Accounting</title>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
    </header>
    <br>
    <div class="container">
      <form method="post" action="process/accountNumberProcess.php?action=insert">
        <div class="form-group">
          <label>รายการ</label>
            <input type="text" class="form-control" name="list" required>
        </div>
        <div class="form-group">
          <label>เลขที่บัญชี</label>
            <input type="text" class="form-control" name="acc_number" required>
        </div>
        <button type="submit" class="btn btn-primary">บันทึก</button>
        <button type="reset" class="btn btn-danger">ล้างฟอร์ม</button>
      </form>
    </div>
    <br>
    <div class="container">
      <div class="table-responsive">
        <table class="table">
          <tr>
            <th>เลขบัญชี</th>
            <th>รายการ</th>
          </tr>
          <?php
          $sql = "SELECT * FROM tb_account_number";
          $result = mysqli_query($conn,$sql);
          while ($data = mysqli_fetch_array($result)) {
          ?>
          <tr>
            <td><?php echo $data['acc_number']; ?></td>
            <td><?php echo $data['list']; ?></td>
          </tr>
          <?php
          }
          ?>

        </table>
      </div>
    </div>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="bootstrap/js/jquery-3.3.1.slim.min.js" ></script>
    <script src="bootstrap/js/popper.min.js" ></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
