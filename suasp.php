<?php
session_start();
require('DataProvider.php');
$Sltn = 0;
$loai = "";
$query = "";
if (isset($_POST["Malsp"])) {

  $MaSP = $_POST["Malsp"];

  if (isset($_POST["Sltn"])) {
    $Sltn = $_POST["Sltn"];
  }
  $DonGia = $_POST["DonGia"];

  $loai = $_GET["loai"];

  switch ($loai) {
    case "NhapKho":
      if ($Sltn >= 0) {
        $query = 'UPDATE sanpham SET SLTon = SLTon +' . $Sltn . ',DonGia= ' . $DonGia . ' WHERE MaSP="' . $MaSP . '"';
        $result = mysqli_query($conn, $query);

        if ($result) {
          echo '<script>alert("Nhập thành công")</script>';
        } else {
          echo '<script>alert("Nhập thất bại")</script>';
        }
      } else {
        echo '<script>alert("Nhập kho thất bại")</script>';
      }

      break;
    case "SuaSP":
      $TenSP = isset($_POST["TenSP"]) ? $_POST["TenSP"] : '';
      $MaLoaiSP = isset($_POST["MaLoaiSP"]) ? $_POST["MaLoaiSP"] : '';
      $SLTon = isset($_POST['SLTon']) ? $_POST['SLTon'] : '';
      $txtDongia = isset($_POST["DonGia"]) ? $_POST["DonGia"] : '';
      $ram = isset($_POST['ram']) ? $_POST['ram'] : '';
      $bonhotrong = isset($_POST['bonhotrong']) ? $_POST['bonhotrong'] : '';
      $manhinh = isset($_POST['manhinh']) ? $_POST['manhinh'] : '';
      $pin = isset($_POST['pin']) ? $_POST['pin'] : '';
      $nhucau = isset($_POST['nhucau']) ? $_POST['nhucau'] : '';
      $dacbiet = isset($_POST['dacbiet']) ? $_POST['dacbiet'] : '';
      $loaiSP = isset($_REQUEST['loaiSP']) ? $_REQUEST['loaiSP'] : '';


      $sql = 'SELECT * FROM sanpham WHERE trangthai > 0 AND TenSP="' . $TenSP . '"';
      $test = 0;
      $result = query($sql);
      for ($i = 0; $i < count($result); $i++) {
        $MaSP1 = $result[$i]['MaSP'];
        $TenSP1 = $result[$i]['TenSP'];
        if ($MaSP != $MaSP1 && $TenSP == $TenSP1) {
          echo '<script>alert("Sửa thất bại")</script>';
          $test = 1;
        }
      }


      if ($test == 0) {
        $query = "UPDATE sanpham 
        SET MaLoaiSP='$MaLoaiSP',TenSP='$TenSP',SLTon='$SLTon',DonGia='$DonGia',ram='$ram',bonhotrong='$bonhotrong',manhinh='$manhinh',
        pin='$pin',nhucau='$nhucau',dacbiet='$dacbiet',loai='$loai' WHERE MaSP = '$MaSP1'";

        $result = query($query);

        if ($result) {
          echo '<script>alert("Sửa thành công")</script>';
        } else {
          echo '<script>alert("Sửa thất bại")</script>';
        }
        break;
      }
  }

  if (isset($_GET["loai"])) {
    $loai = $_GET["loai"];
  } else {
    $loai = "NhapKho";
  }
}


$query = "SELECT * FROM sanpham WHERE MaSP = '" . $_REQUEST['masp'] . "'";
$result = query($query);
$row = $result[0];

?>

<html>

<style>
  .m {
    margin-top: 5px;
  }

  .mr {
    margin-right: 2px;
  }
</style>
<?php include("css.php"); ?>

<body>
  <?php

  include("./naviagte.php"); ?>
  <div class="d-flex flex-wrap">
    <?php include("./headerAdmin.php"); ?>
    <div class="container m ">
      <?php

      if (isset($_GET["loai"])) {
        $loai = $_GET["loai"];
      }
      switch ($loai) {
        case 'NhapKho':
          echo '<h2 style="text-align: center;">Nhập kho hàng</h2>';
          break;
        default:
          $loai = "SuaSP";
          echo '<h2 style="text-align: center;">Sửa sản phẩm</h2>';
          break;
      }
      ?>

      <div class="row justify-content-around mr">
        <img src="<?php echo $row["Image"]; ?>" class="col-4" style="height: 100%;" alt="" srcset="">
        <form action="suasp.php?masp=<?php echo $row["MaSP"] . "&loai=" . $loai; ?>" method="post" class="was-validated col-8">
          <div class="form-group">
            <!-- <label for="uname">MaLoaiSP:</label> -->
            <input type="hidden" class="form-control" id="uname" value="<?php echo $row["MaSP"]; ?>" name="Malsp" required>
          </div>
          <?php
          switch ($loai) {
            case 'NhapKho': ?>

              <div class="form-group">
                <label for="uname">Tên sản phẩm:</label>
                <input disabled class="form-control" id="uname" value="<?php echo $row["TenSP"] ?>">
              </div>
              <div class="form-group">
                <label for="uname">Số lượng tồn:</label>
                <input disabled class="form-control" id="uname" value="<?php echo $row["SLTon"] ?>">
              </div>
              <div class="form-group">
                <label for="uname">Số lượng nhập:</label>
                <input type="number" class="form-control" id="uname" value="0" name="Sltn" required>
              </div>
              <div class="form-group">
                <label for="pwd">Đơn giá:</label>
                <input type="number" class="form-control" id="pwd" value="<?php echo $row["DonGia"] ?>" name="DonGia" required>
              </div>
              <input type="submit" value="Nhập kho" class="btn btn-success btn-secondary">
            <?php
              break;
            default:
            ?>
              <div class="form-group">
                <label for="uname">Tên sản phẩm:</label>
                <input class="form-control" id="uname" value="<?php echo $row['TenSP'] ?>" name="TenSP" required>
              </div>
              <label for="">
                <label for="uname">Loại sản phẩm:
                  <select name="MaLoaiSP" class="btn btn-primary ml-2">
                    <?php
                    $sql = 'SELECT loaisp.MaLoaiSP as MaLoaiSP, loaisp.TenLoaiSP as TenLoaiSP FROM loaisp ';
                    $data = query($sql);
                    for ($i = 0; $i < count($data); $i++) {

                      if ($data[$i]['MaLoaiSP'] == $row['MaLoaiSP']) { ?>

                        <option selected value="<?php echo $data[$i]['MaLoaiSP'] ?>"><?php echo $data[$i]['TenLoaiSP'] ?></option>

                      <?php } else { ?>

                        <option value="<?php echo $data[$i]['MaLoaiSP'] ?>"><?php echo $data[$i]['TenLoaiSP'] ?></option>

                    <?php }
                    } ?>
                  </select>
                </label>
                <label for="uname">Loại sản phẩm:
                  <select name="loaiSP" onchange="extraMain(this)" class="btn btn-primary ml-2">
                    <?php if ($row['loai'] == 0) { ?>
                      <option value="0" selected>sản phẩm chính</option>
                      <option value="1">sản phẩm phụ</option>
                    <?php } else { ?>
                      <option value="0">sản phẩm chính</option>
                      <option value="1" selected>sản phẩm phụ</option>
                    <?php } ?>
                  </select>
                </label>

                <div class="container p-0 ">
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="uname">Số lượng tồn:</label>
                      <input class="form-control" name="SLTon" type="number" id="uname" value="<?php echo $row["SLTon"] ?>" name="SLTon" required>
                    </div>

                    <div class="form-group col-6">
                      <label for="pwd">Đơn giá:</label>
                      <input type="number" class="form-control" id="pwd" value="<?php echo $row["DonGia"] ?>" name="DonGia" required>
                    </div>
                  </div>
                </div>

                <?php if ($row['loai'] == 0) { ?>
                  <div class="container p-0 extraPro">
                    <div class="row ">
                      <div class="form-group col-6">
                        <label for="ram">Ram</label>
                        <input type="text" class="form-control" id="ram" placeholder="" name="ram" value="<?php echo $row["ram"] ?>">
                      </div>
                      <div class="form-group col-6">
                        <label for="bonhotrong">Bộ nhớ ngoài</label>
                        <input type="text" class="form-control" id="bonhotrong" placeholder="" value="<?php echo $row['bonhotrong'] ?>" name="bonhotrong">
                      </div>
                      <div class="form-group col-6">
                        <label for="manhinh">Màn hình</label>
                        <input type="text" class="form-control" id="manhinh" placeholder="" value="<?php echo $row['manhinh'] ?>" name="manhinh">
                      </div>
                      <div class="form-group col-6">
                        <label for="pin">Pin</label>
                        <input type="number" class="form-control" id="pin" placeholder="" value="<?php echo $row['pin']  ?>" name="pin">
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
                <?php } ?>

            <?php break;
          } ?>
            <input type="submit" value="Sửa" class="btn btn-success btn-secondary">
            <a class="btn btn-success btn-secondary" href="quanlysp.php">Danh sách sản phẩm</a>
        </form>
      </div>
      
      <?php if ($row['loai'] == 0) { ?>
        <div class="goiy">
          <?php include('./goiyCrud.php') ?>
        </div>
      <?php } ?>


    </div>
  </div>


</body>

</html>