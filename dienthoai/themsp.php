<?php session_start(); ?>
<!DOCTYPE html>
<html>

<?php
include("css.php");
require 'DataProvider.php';
?>
<style>
  .w200x200 {
    width: 200px;
    height: 200px;
  }

  .hidden {
    visibility: hidden;
  }
</style>

<body>
  <?php
  if (isset($_REQUEST['loi'])) {
    echo '
          <script>
            alert("Không thể insert được vì lý do gì đó có thể trùng tên sản phẩm. Vui lòng nhập lại");
          </script>';
  }
  if (isset($_REQUEST['tb'])) {
    echo '
          <script>
            alert("Thêm thành công");
          </script>';
  }
  ?>
  <?php
  include("./naviagte.php");
  ?>
  <div class="d-flex flex-wrap">
    <?php include("./headerAdmin.php"); ?>
    <div class="container">
      <h2 style="text-align: center;">Thêm sản phẩm</h2>
      <form action="xulysp.php" method="post" enctype="multipart/form-data" class="was-validated">
        <div class="form-group">
          <label for="uname">Tên sản phẩm:</label>
          <input type="text" class="form-control" id="uname" placeholder="" name="txtTen" required>
        </div>

        <label for="uname">Loại sản phẩm:</label>
        <select name="type" class="btn btn-primary" id="">
          <?php
          $sql = 'SELECT loaisp.MaLoaiSP as MaLoaiSP, loaisp.TenLoaiSP as TenLoaiSP
					FROM loaisp ';
          $data = query($sql);
          echo $sql;
          for ($i = 0; $i < count($data); $i++) {
            echo '<option  value=' . $data[$i]['MaLoaiSP'] . '>' . $data[$i]['TenLoaiSP'] . '</option>';
          }
          ?>
        </select>
        <div class="form-group mt-2">
          <label for="loai">Kiểu sản phẩm</label>
          <select name="loaiSP" onchange="extraMain(this)" class="btn " id="loai">
            <option value="0">Sản phẩm chính</option>
            <option value="1">Sản phẩm phụ</option>
          </select>
        </div>

        <div class="form-group">
          <label for="pwd">Số lượng</label>
          <input type="number" class="form-control" id="pwd" placeholder="" name="txtSl" required>
        </div>

        <div class="form-group">
          <label for="uname">Đơn giá:</label>
          <input type="number" class="form-control" id="uname" placeholder="" name="txtDongia" required>
        </div>
        <div class="container p-0">
          <div class="row extraPro ">
            <div class="form-group col-4">
              <label for="ram">Ram</label>
              <input type="text" class="form-control" id="ram" placeholder="" name="ram" >
            </div>
            <div class="form-group col-4">
              <label for="bonhotrong">Bộ nhớ ngoài</label>
              <input type="text" class="form-control" id="bonhotrong" placeholder="" name="bonhotrong" >
            </div>
            <div class="form-group col-4">
              <label for="manhinh">Màn hình</label>
              <input type="text" class="form-control" id="manhinh" placeholder="" name="manhinh" >
            </div>
            <div class="form-group col-4">
              <label for="pin">Dung lượng pin</label>
              <input type="number" class="form-control" id="pin" placeholder="" name="pin" >
            </div>

            <div class="form-group col-4">
              <label for="">Tính năng đặc biệt</label>
              <select name="dacbiet" class="form-control  btn border ">
                <?php
                $list = query('SELECT dacbiet FROM sanpham GROUP BY dacbiet;');
                for ($i = 0; $i < count($list); $i++) {
                  echo '<option value="' . $list[$i]['dacbiet'] . '">' . $list[$i]['dacbiet'] . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group col-4">
              <label for="">Nhu cầu sử dụng</label>
              <select name="nhucau" class="form-select m-2 btn border">
                <?php
                $list = query('SELECT nhucau FROM sanpham GROUP BY nhucau;');
                for ($i = 0; $i < count($list); $i++) {
                  echo '<option value="' . $list[$i]['nhucau'] . '">' . $list[$i]['nhucau'] . '</option>';
                }
                ?>
              </select>
            </div>


          </div>
        </div>

        <div>Hình ảnh</div>
        <div class="form-group">
          <label>
            <img src="Images/picture.png" for="txtHinh" id="i" class="w200x200 " alt="" srcset="">
            <input type="file" class="hidden" id="txtHinh" name="txtHinh">
          </label>
        </div>

        <button type="submit" class="btn btn-warning">Thêm</button>
        <a class="btn btn-warning" href="quanlysp.php">Trang chủ</a>
      </form>
    </div>
  </div>

</body>
<script>
  var s = document.getElementById("txtHinh")
  s.addEventListener("change", () => {
    var file = new FileReader();
    file.onloadend = () => {
      var img = document.getElementById("i");
      if (file.result) {
        img.src = file.result + "";
      }
    };
    var f = s;
    if (f && f.files) {
      file.readAsDataURL(f.files[0]);
    }
  });
</script>

</html>