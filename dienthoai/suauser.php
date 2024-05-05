<?php
session_start();
if (!isset($_SESSION["member"])) {
  //header("Location:dangnhap.php");
  header("location:body.php");
} else {
?>
  <?php
  require('common.php');
  require('DataProvider.php');

  $query = "SELECT * FROM user WHERE UserName = '" . $_REQUEST['username'] . "'";


  $result = mysqli_query($conn, $query);

  $row = mysqli_fetch_array($result);

  mysqli_close($conn);
  ?>

  <html>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sửa user</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  </head>

  <body>
    <?php
    if (isset($_REQUEST['loi'])) {
      echo 'Không thể thêm được vì lý do gì đó. Vui lòng nhập lại.';
    }
    ?>

    <div class="container">
      <h2 style="text-align: center;">Sửa account</h2>
      <form action="xulyuser.php" method="post" class="was-validated">
        <div class="form-group">
          <label for="uname">Tên đăng nhập:</label>
          <input type="text" disabled class="form-control" id="uname" placeholder="Mời điền tên đăng nhập" value="<?php echo $row['UserName']; ?>" name="txtUser" required>
          <input type="hidden" value="<?php echo $row['UserName']; ?>" name="txtUser">
          <div class="valid-feedback">Hợp lệ.</div>
          <div class="invalid-feedback">Vui lòng điền vào trường này!</div>
        </div>
        <div class="form-group">
          <label for="pwd">Mật khẩu:</label>
          <input type="text" class="form-control" id="pwd" placeholder="Mời nhập mật khẩu" value="<?php echo $row['Password']; ?>" name="txtPass" required>
          <div class="valid-feedback">Hợp lệ.</div>
          <div class="invalid-feedback">Vui lòng điền vào trường này!</div>
        </div>
        <div class="form-group">
          <label for="uname">Địa chỉ:</label>
          <input type="text" class="form-control" id="uname" placeholder="Mời nhập địa chỉ" value="<?php echo $row['DiaChi']; ?>" name="txtDiachi" required>
          <div class="valid-feedback">Hợp lệ.</div>
          <div class="invalid-feedback">Vui lòng điền vào trường này!</div>
        </div>
        <div class="form-group">
          <label for="pwd">Email:</label>
          <input type="text" class="form-control" id="pwd" placeholder="Mời nhập địa chỉ email" value="<?php echo $row['Email']; ?>" name="txtEmail" required>
          <div class="valid-feedback">Hợp lệ.</div>
          <div class="invalid-feedback">Vui lòng điền vào trường này!</div>
        </div>
        <div class="form-group">
          <label for="pwd">Số điện thoại</label>
          <input type="text" class="form-control" id="pwd" placeholder="Mời nhập số điện thoại" value="<?php echo $row['SDT']; ?>" name="txtSDT" required>
          <div class="valid-feedback">Hợp lệ.</div>
          <div class="invalid-feedback">Vui lòng điền vào trường này!</div>
        </div>
        <select class="custom-select mr-sm-2 mb-3" name="txtquyen" id="inlineFormCustomSelect">
          <?php
          foreach ($quyenArray as $key => $value) {
            if ($row['Quyen'] == $key) {
              echo '<option selected value="' . $key . '">' . $value . '</option>';
            } else
              echo '<option value="' . $key . '">' . $value . '</option>';
          } ?>
        </select>
        <button type="submit" class="btn btn-primary">Sửa</button>
        <a class="btn btn-primary" href="quanlyaccount.php">Trở lại</a>
        <input name="loai" type="hidden" value="Update" />
      </form>
    </div>

  </body>

  </html>
<?php } ?>