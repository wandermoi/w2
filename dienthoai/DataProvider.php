<?php
$conn = mysqli_connect("localhost", "root", "", "phone")
	or die("Không thể kết nối đến database");

mysqli_query($conn, "set names 'utf8'");
function query($sql)
{
	$data = [];
	$conn = mysqli_connect("localhost", "root", "", "phone");
	if (!$conn) {
		return $data;
	}
	mysqli_query($conn, "set names 'utf8'");
	$res = mysqli_query($conn, $sql);
	if (gettype($res) == "boolean") {
		return $res;
	}
	if (mysqli_num_rows($res) < 0) {
		return $data = [];
	}

	while ($row = mysqli_fetch_array($res)) {
		array_push($data, $row);
	}
	mysqli_close($conn);
	return $data;
}

$trangthaiDH = array(
	"chuagiao" => "Chưa giao",
	"danggiao" => "Đang giao",
	"bihuy" => "Bị hủy",
	"danhan" => "Đã nhận",
	"ht" => "Hoàn thành",
	"khongnhan" => "Không nhận"
);
$trangthaithanhtoan = array(
	"chuathanhtoan" => "Chưa thanh toán",
	"hoanthanh" => "Thanh toán rồi"
);
$PhuongthucnhahangArray = array("1" => "Nhận tại của hàng", "2" => "Giao tận nhà");
$quyenArray = array(
	"master" => "Master",
	"qlnv" => "Quản lý nhân viên",
	"nvdd" => "Nhân viên duyệt đơn",
	"customer" => "Khách hàng",
	"nvqlkho" => "Nhân viên quản lý kho"
);

