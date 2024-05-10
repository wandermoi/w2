<html>

<head>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" type="text/css" href="css/hoadon.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
  <title>Hóa đơn thanh toán</title>
</head>

<body>
  <div id="page" class="page col-md-5">
    <div class="header">
      <div class="logo"><img src="images/logo1.png" style="width:100px;height:100px;" /></div>
      <div class="company">Thế giới di động</div>
    </div>
    <br />
    <div class="title">
      HÓA ĐƠN THANH TOÁN
      <br />
      -------oOo-------
    </div>
    <?php
    require 'DataProvider.php';
    if (isset($_REQUEST['mahd']))
      $mahd = $_REQUEST['mahd'];
    //gọi hóa đơn
    $sql = "SELECT * FROM hoadon WHERE MaHoaDon='$mahd'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    //gọi đơn hàng
    $sql1 = "SELECT * FROM donhang WHERE MaHoaDon='$mahd'";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_array($result1);

    $khachhang = $row['UserName'];
    $dienthoai = $row1['SDTNguoiNhan'];

    ?>
    <div class="thongtin">
      Khách Hàng: <?php echo $khachhang ?><br /><br />
      Số điện thoại: <?php echo $dienthoai ?>
    </div>
    <br />
    <br />
    <table class="TableData">
      <tr>
        <th>Tên</th>
        <th>Đơn giá</th>
        <th>Số</th>
        <th>Thành tiền</th>
      </tr>
      <?php
      //gọi chi tiết hóa đơn
      $sql2 = "SELECT * FROM chitiethoadon WHERE MaHoaDon='$mahd'";
      $result2 = mysqli_query($conn, $sql2);
      while ($row2 = mysqli_fetch_array($result2)) {
        //gọi sản phẩm
        $sql3 = "SELECT * FROM sanpham WHERE MaSP='" . $row2['MaSP'] . "'";
        $result3 = mysqli_query($conn, $sql3);
        $row3 = mysqli_fetch_array($result3);
        $tensp = $row3['TenSP'];
        $dongia = $row2['DonGia'];
        $soluong = $row2['SoLuong'];
        $thanhtien = $row2['ThanhTien'];
        echo "<tr>";
        echo "<td class=\"cotTenSanPham\">" . $tensp . "</td>";
        echo "<td class=\"cotGia\"><div id='giasp' name='giasp' value=''>" . number_format($dongia, '0', '.', '.') . "'đ</div></td>";
        echo "<td class=\"cotSoLuong\" align='center'>" . $soluong . "</td>";
        echo "<td class=\"cotSo\">" . number_format($thanhtien, 0, ".", ".") . "đ</td>";
        echo "</tr>";
      }
      $tongtien = $row['TongTien'];
      $phiship = $row['PhiVanChuyen'];
      $thanhtoan = $tongtien + $phiship;
      $ngaydathang = $row['NgayDatHang'];
      $nhanvien = $row1['TenNguoiGiaoHang'];
      if ($row['PhuongThucThanhToan'] == "loai1")
        $phuongthuc = "Tiền mặt";
      else $phuongthuc = "Trực tuyến";
      ?>
      <tr>
        <td colspan="3" class="tong">Tổng cộng</td>
        <td class="cotSo"><?php echo number_format($tongtien) ?></td>
      </tr>
      <tr>
        <td colspan="3" class="tong">Phí vận chuyển</td>
        <td class="cotSo"><?php echo number_format($phiship) ?></td>
      </tr>
      <tr style="color: red">
        <td colspan="3" class="tong">Phải thanh toán</td>
        <td class="cotSo"><?php echo number_format($thanhtoan) ?></td>
      </tr>
    </table>
    <div class="thongtin">
      <br /><br />
      Mã hóa đơn: <?php echo $mahd ?><br />
      Hình thức: <?php echo $phuongthuc ?><br />
    </div>
    <div class="footer-left"> Thành phố Hồ Chí Minh, <?php echo $ngaydathang ?> <br />
      Khách hàng <br />
      <div class="kiten"><?php echo $khachhang ?></div>
    </div>
    <div class="footer-right"> Thành phố Hồ Chí Minh, <?php echo $ngaydathang ?> <br />
      Nhân viên <br />
      <div class="kiten"><?php echo $nhanvien ?></div>
    </div>
    <br /><br /><br /><br />
    <a href="body.php" class="btn btn-success" name="addbuy"><i class="fa fa-undo"></i>Quay lại trang chủ</a>

  </div>
</body>

</html>