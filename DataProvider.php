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
	"chuagiao" => "chưa giao",
	"danggiao" => "đang giao",
	"bihuy" => "bị hủy",
	"danhan" => "đã nhận",
	"ht" => "hoàn thành",
	"khongnhan" => "không nhận"
);
$trangthaithanhtoan = array(
	"chuathanhtoan" => "chưa thanh toán",
	"hoanthanh" => "thanh toán rồi"
);
$PhuongthucnhahangArray = array("1" => "nhận tại của hàng", "2" => "giao tận nhà");
$quyenArray = array(
	"master" => "master",
	"qlnv" => "quản lý nhân viên",
	"nvdd" => "nhân viên duyệt đơn",
	"customer" => "khách hàng",
	"nvqlkho" => "nhân viên quản lý kho"
);

