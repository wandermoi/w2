<?php
// <!-- chuagiao dagiao bihuy -->

require('DataProvider.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] != "POST") {
	echo "7";
	header("location:index.php");
	exit();
}
if (!isset($_POST['tinhtrang']) || !isset($_POST['mahd']) || !isset($_SESSION['member'])) {
	echo "12";
	exit();
}
$tinhtrang = $_POST['tinhtrang'];
$mahd = $_POST['mahd'];

if ($tinhtrang == "danggiao") {
	$sql = 'UPDATE donhang SET TinhTrangDonHang ="' . $tinhtrang . '",  TenNguoiGiaoHang="' . $_SESSION['member'] . '"
	WHERE MaDonHang ="' . $mahd . '"';
	$query = mysqli_query($conn, $sql);
	if ($query) {
		echo "cập nhật thành công";
	} else {
		echo "cập nhật thất bại";
	}
} else {
	$sql = 'UPDATE donhang 
		SET TinhTrangDonHang ="' . $tinhtrang . '", ngayhoanthanh=CURRENT_TIMESTAMP
		WHERE MaDonHang ="' . $mahd . '"';
	$query = mysqli_query($conn, $sql);
	if ($query) {
		echo "cập nhật thành công";
	} else {
		echo "cập nhật thất bại";
	}
}



$sql = 'SELECT * FROM donhang WHERE MaDonHang ="' . $mahd . '" ';
$madh = query($sql)[0]['MaHoaDon'];
if ($tinhtrang == "bihuy") {
	$sql = "SELECT * FROM chitiethoadon where MaHoaDon='" . $madh . "'";

	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_array($result)) {
		$sql1 = mysqli_query($conn, "SELECT * from sanpham where MaSP='" . $row['MaSP'] . "'");
		$row1 = mysqli_fetch_array($sql1);
		$slton = $row1['SLTon'];
		$slton += $row['SoLuong'];
		$sql2 = "UPDATE sanpham SET SLTon = '" . $slton . "' WHERE MaSP ='" . $row['MaSP'] . "'";

		$query = mysqli_query($conn, $sql2);
		if ($query) {
			echo "cập nhật thành công";
		} else {
			echo "cập nhật thất bại";
		}
	}
}
