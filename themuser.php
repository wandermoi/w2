<?php
session_start();
require "./DataProvider.php";
if (!isset($_SESSION["member"]) && ($_SESSION["Quyen"] == "admin" || $_SESSION["Quyen"] == "master")) {
  //header("Location:dangnhap.php");
  header("location:body.php");
} else {
?>
  <?php
  include('common.php');
  ?>

  <html>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Thêm user</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  </head>
  <script>
    
  </script>
  <body>
    <?php
    if (isset($_REQUEST['loi'])) {
      echo '<script>
              alert("Không thể insert được vì lý do gì đó. Vui lòng nhập lại.");
            </script>';
    }
    ?>

    <div class="container">
      <h2 style="text-align: center;">Thêm tài khoản</h2>
      <form action="xulyuser.php" method="post" class="was-validated">
        <div class="form-group">
          <label for="uname">Tên đăng nhập:</label>
          <input type="text" class="form-control" id="uname" placeholder="Mời điền tên đăng nhập" name="txtUser" required>
          <div class="valid-feedback">Hợp lệ.</div>
          <div class="invalid-feedback">Vui lòng điền vào trường này!</div>
        </div>
        <div class="form-group">
          <label for="pwd">Mật khẩu:</label>
          <input type="password" class="form-control" id="pwd" placeholder="Mời nhập mật khẩu" name="txtPass" required>
          <div class="valid-feedback">Hợp lệ.</div>
          <div class="invalid-feedback">Vui lòng điền vào trường này!</div>
        </div>
        <div class="form-group">
          <label for="uname">Địa chỉ:</label>
          <input type="text" class="form-control" id="uname" placeholder="Mời nhập địa chỉ" name="txtDiachi" required>
          <div class="valid-feedback">Hợp lệ.</div>
          <div class="invalid-feedback">Vui lòng điền vào trường này!</div>
        </div>
        <div class="form-group">
          <label for="pwd">Email:</label>
          <input type="email" class="form-control" id="pwd" placeholder="Mời nhập địa chỉ email" name="txtEmail" required>
          <div class="valid-feedback">Hợp lệ.</div>
          <div class="invalid-feedback">Vui lòng điền vào trường này!</div>
        </div>
        <div class="form-group">
          <label for="pwd">Số điện thoại</label>
          <input type="text" class="form-control" id="pwd" placeholder="Mời nhập số điện thoại" name="txtSDT" required>
          <div class="valid-feedback">Hợp lệ.</div>
          <div class="invalid-feedback">Vui lòng điền vào trường này!</div>
        </div>
        <div>
          <label for="pwd">Quyền</label>
        </div>
        <select class="custom-select mr-sm-2 mb-3" name="txtquyen" id="inlineFormCustomSelect">
          <?php
          foreach ($quyenArray as $key => $value) {
            echo '<option value="' . $key . '">' . $value . '</option>';
          }
          ?>
        </select>
        </label>

        <button type="submit" class="btn btn-primary">Thêm</button>
        <input name="loai" type="hidden" value="insert" />
        <a class="btn btn-primary" href="quanlyaccount.php">Trở lại</a>
      </form>
    </div>

  </body>

  </html>
<?php

} ?>