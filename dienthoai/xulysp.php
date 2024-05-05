<?php
require('DataProvider.php');
session_start();
if (!isset($_SESSION["member"])) {
    header('location:body.php');
    exit;
}
if (!$_SERVER["REQUEST_METHOD"] == "POST") {
    header('location:body.php');
    exit;
}

if (isset($_POST['loai']) && $_POST['loai'] == 'khongban') {
    $masp = $_POST['masp'];
    $sql = 'UPDATE sanpham SET trangthai="2" WHERE MaSP="' . $masp . '"';
    $result = query($sql);
    if ($result) {
        echo 'Tháo tác thành công';
    } else {
        echo 'Tháo tác thất bại';
    }
    exit();
}
if (isset($_POST['loai']) && $_POST['loai'] == 'ban') {
    $masp = $_POST['masp'];
    $sql = 'UPDATE sanpham SET trangthai="1" WHERE MaSP="' . $masp . '"';
    $result = query($sql);
    if ($result) {
        echo 'Tháo tác thành công';
    } else {
        echo 'Tháo tác thất bại';
    }
    exit();
}
if (isset($_POST['loai']) && $_POST['loai'] == 'xoa') {
    $masp = $_POST['masp'];

    $sql = 'SELECT * FROM sanpham WHERE MaSP="' . $masp . '"';
    $row = query($sql);
    $SLTon = $row[0]['SLTon'];
    if ($SLTon > 0) {
        echo "Sản phẩm còn hàng";
        exit();
    }
    $path = $row[0]['Image'];

    $sql = 'DELETE FROM sanpham WHERE MaSP="' . $masp . '"';
    $result = query($sql);
    if ($result) {
        $remove = unlink($path);
        if ($remove) {
            echo "Xóa file thành công";
        } else {
            echo "Có lỗi xóa hình";
        }
        exit();
    }

    $sql = 'UPDATE sanpham SET trangthai="0" WHERE MaSP="' . $masp . '"';
    $result = query($sql);
    if ($result) {
        echo "Đã ẩn";
    } else {
        echo "Có lỗi";
    }
    exit();
}


$txtTen = $_POST["txtTen"];
$txtDongia = $_POST["txtDongia"];
$txtSl = $_POST["txtSl"];
$ram = $_POST['ram'];
$bonhotrong = $_POST['bonhotrong'];
$manhinh = $_POST['manhinh'];
$pin = $_POST['pin'];
$nhucau=$_POST['nhucau'];
$dacbiet=$_POST['dacbiet'];
$loaiSP=$_POST['loaiSP'];

$sql = 'SELECT * FROM sanpham WHERE trangthai > 0 AND TenSP="' . $txtTen . '"';

$result = query($sql);
if (count($result) > 0) {
    
    exit;
}





$target_dir = "Images/";
$folder = "";
$type = $_POST["type"];

$sql = 'SELECT * FROM loaisp Where MaLoaiSP = "' . $type . '"';

$result = query($sql);

if (count($result) <= 0) {
    header('location:body.php');
    exit();
}



$folder .= $result[0]['TenLoaiSP'];

$target_file = $target_dir . $folder . "/";

if (!file_exists($target_file)) {
    mkdir($target_file, 0777, true);
}

$MaSP = strtotime(date("Y-m-d H:i:s"));
$imageFileType = strtolower(pathinfo(basename($_FILES["txtHinh"]["name"]), PATHINFO_EXTENSION));
$target_file .= $folder . $MaSP . "." . $imageFileType;

$sql = "INSERT INTO sanpham ( MaLoaiSP , TenSP , SLTon , DonGia , Image,ram,bonhotrong,manhinh,pin,nhucau,dacbiet,loai ) 
VALUES ('$type','$txtTen','$txtSl','$txtDongia','$target_file','$ram','$bonhotrong','$manhinh','$pin','$nhucau','$dacbiet','$loaiSP')";
echo $sql;
if (query($sql) === TRUE) {
    move_uploaded_file($_FILES["txtHinh"]["tmp_name"], $target_file);
    header('location:themsp.php?tb=thanhcong');
} else {
    header('location:themsp.php?loi=thatbai');
}
