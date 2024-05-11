<?php
session_start();

require("DataProvider.php");

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("location:index.php");
    exit();
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    if ($_SESSION['card'][$id] != null) {
        $_SESSION['card'][$id] = $_SESSION['card'][$id] < 3 ? $_SESSION['card'][$id] + 1 : $_SESSION['card'][$id];
    } else {
        $_SESSION['card'][$id] = 1;
    }
    echo  $_SESSION['card'][$id];
    die();
}

if (isset($_POST['mua'])) {
    if (isset($_SESSION['member'])) {
        //tạo hóa đơn
        $sql = 'SELECT COUNT(*) as C FROM hoadon';
        $result = query($sql);
        $row = $result[0];
        $MaHD = "HD" . (string)($row['C'] + 1);

        $thanhtoan = $_POST['thanhtoan'];
        $phivanchuyen = $thanhtoan == 1 ? 0 : 5000;

        $sql = 'INSERT INTO 
        hoadon(MaHoaDon, Phuongthucnhahang, UserName, TongTien, PhiVanChuyen) 
        VALUES ("' . $MaHD . '","' . $thanhtoan . '","' . $_SESSION['member'] . '",0,"' . $phivanchuyen . '")';
        $result = query($sql);
        echo $sql;
        if ($result == null) {
            echo '34';
            exit();
        }
        //tạo đơn hàng
        $sql = 'INSERT INTO 
        donhang( MaHoaDon, TenKhachHang, SDTNguoiNhan, DiaChiGiaoHang, TinhTrangDonHang)
        VALUES ("' . $MaHD . '","' . $_SESSION['member'] . '","' . $_POST['SDT'] . '","' . $_POST['diachi'] . '","chuagiao")';
        $result = query($sql);

        if (!$result) {
            echo '44';
            exit();
        }
        $tong = 0;
        $tongSL = count($_POST['LMaSP']);
        for ($i = 0; $i < count($_POST['LMaSP']); $i++) {

            $MaSP = $_POST['LMaSP'][$i];
            $SL = $_POST['sl'][$i];

            //lấy đơn giá
            $sql = 'SELECT DonGia FROM sanpham WHERE MaSP="' . $MaSP . '"';
            $result = query($sql);
            if (count($result) < 0) {
                echo "57";
                continue;
            }
            $row = $result[0];
            $DonGia = $row['DonGia'];

            //Giảm số lượng
            $sql = 'UPDATE sanpham
            SET SLTon=SLTon-' . $SL . '
            WHERE MaSP="' . $MaSP . '"';

            echo $sql;
            $result = query($sql);
            if (!$result) {
                echo "70";
                continue;
            }

            //thêm vào chi tiết hóa đơn
            $sql = 'INSERT INTO `chitiethoadon`( `MaHoaDon`, `MaSP`, `SoLuong`, `DonGia`, `DonViTinh`, `ThanhTien`) 
            VALUES ("' . $MaHD . '","' . $MaSP . '","' . $SL . '","' . $DonGia . '","Chiếc","' . ($DonGia * $SL) . '")';
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                echo $sql;
                echo "79";
                continue;
            }
            unset($_SESSION['card'][$MaSP]);
            $tong += $DonGia * $SL;
        }
        if ($tong > 0) {
            $sql = 'UPDATE hoadon
            SET TongTien=' . $tong . '
            WHERE MaHoaDon="' . $MaHD . '"';
            $result = query($sql);
        } else {
            $sql = 'DELETE from hoadon Where MaHoaDon="' . $MaHD . '"';
            $result = query($sql);
        }
        header("location:giohang.php");
        die();

    } else {
        header("location:dangnhap.php");
    }
}
