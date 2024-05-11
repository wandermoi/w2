<?php session_start()?>
<!DOCTYPE html>
<html lang="en">



<?php  require("css.php"); ?>

<body>
  <?php require("./header.php");
  require_once('./DataProvider.php');
  $DiaChi = "";
  $SDT = "";
  if (isset($_SESSION['member'])) {
    $UserName = $_SESSION['member'];
    $sql = 'SELECT * FROM user where UserName= "' . $UserName . '"';
    $result = query($sql);

    $row = $result[0];
    $DiaChi = $row['DiaChi'];
    $SDT = $row['SDT'];
    
  }

  if (isset($_POST['MaSP'])) {
    $MaSP = $_POST['MaSP'];
    unset($_SESSION['card'][$MaSP]);
  }
  ?>
  <div class="phantrang">
    <div class="w-75 mx-auto">
      <form action="addcard.php" id="giohang" onsubmit="return ktForm()" method="post">
        <input type="hidden" name="mua">
        <table class="w-100">
          <thead>
            <tr>
              <th>Ảnh sản phẩm</th>
              <th>Tên sản phẩm</th>
              <th>Đơn giá</th>
              <th>Số lượng mua</th>
              <th>Tổng giá trị</th>
              <th>Xóa</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <form action="" method="post"></form>
            </tr>
            <?php
            $tong = 0;
            $isEmty = true;
            if (isset($_SESSION['card'])) {
              
              foreach ($_SESSION['card'] as $key => $value) {
                $sql = 'SELECT * FROM sanpham where MaSP="' . $key . '"';
                //`MaLoaiSP``MaSP``TenSP``SLTon``DonGia``Image`
                
                $result = query($sql);
                if (count($result) > 0) {
                  $isEmty = false;
                  $row = $result[0];
                  $tong += $row['DonGia'] * $value;
                  echo '
                      <tr>
                        <td>
                          <img style="width:80px;height:100px" src="' . $row['Image'] . '" alt="" srcset="">
                        </td>
                        <td>' . $row['TenSP'] . '</td>
                        <td>' . number_format($row['DonGia']) . '</td>
                        <td id="TP">
                          <input onchange="tongsl(\'' . $key . '\',\'' . $row['DonGia'] . '\',this)" type="number" name="sl[]" value=' . $value . ' >
                          <input type="hidden" name="DonGia" value="' . $row['DonGia'] . '">
                          <input type="hidden" name="LMaSP[]" value="' . $key . '">
                        </td>
                        <td class="s' . $key . '">' . number_format($row['DonGia'] * $value) . '</td>
                        <td> 
                          <form action="giohang.php" method="post">
                              <input type="hidden"  name="MaSP" value="' . $key . '">
                              <input class="btn btn-primary" onsubmit="check()" type="submit" value="xóa">
                          </form>
                        </td>
                      </tr>';
                }
              }
            }
            ?>
          </tbody>
        </table>
        <?php
        if (!$isEmty) {
          echo '
        <div class="d-flex align-items-center">
          <select name="thanhtoan" title="Phương thức nhận hàng" class="form-select p-2 mx-2 w-25 float-left" aria-label="Default select example">
            <option selected value="1">Tại của hàng</option>
            <option value="2">Giao tận nhà</option>
          </select>
          <div class="float-right my-3 mx-3">
            <span>địa chỉ</span>
            <input type="text" class="p-2" value="' . $DiaChi . '" name="diachi">
          </div>
          <div class="float-right my-3 mx-3">
          <span>Số điện thoại</span>
          <input type="text" class="p-2" value="' . $SDT . '" name="SDT">
        </div>
          <div class=" my-3">
            <input type="hidden" name="loai" value="add">
            <input type="submit" class="btn btn-primary" value="Đặt hàng">
          </div>
          </div>
          <div class="float-right my-3">
            <span>Tổng tiền</span>
            <span id="t">' . number_format($tong) . '</span>
          </div>
          ';
        }
        ?>
      </form>

    </div>
  </div>


</body>
<script>
  function ktForm() {
    var giohang = new FormData(document.getElementById('giohang'))
    var ktSDT = /[0-9]{10}$/;
    if (!ktSDT.test(giohang.get("SDT"))) {
      alert("Sai số điện thoại")
      return false;
    }
  }

  function tongsl(MaSP, Dongia, pa) {
    if (pa.value < 1) {
      pa.value = 1

    }
    if (pa.value > 3) {
      pa.value = 3

    }
    document.querySelector(".s" + MaSP).innerHTML = (new Intl.NumberFormat('de-DE', {
      style: 'currency',
      currency: 'VND'
    }).format(Dongia * pa.value));
    tongTien();
  }

  function check() {

    return true;
  }

  function tongTien() {
    var tb = document.querySelectorAll("#TP");
    var tong = 0;
    tb.forEach((e) => {
      var sl = e.querySelector("input[type=number]")
      var dg = e.querySelector("input[type=hidden]")
      tong += sl.value * dg.value;
      document.getElementById("t").innerText = (new Intl.NumberFormat('de-DE', {
        style: 'currency',
        currency: 'VND'
      }).format(tong));
    })
  }
</script>

</html>
