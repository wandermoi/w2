<?php

require("DataProvider.php");
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header("location:body.php");
    exit();
}
if (!isset($_POST['tk']) || !isset($_POST['mk'])) {
}
$mk = addslashes($_POST['mk']);
$tk = addslashes($_POST['tk']);



$sql = "SELECT * FROM user WHERE TrangThai = 1 and
 UserName = '" . $tk . "' AND Password = '" . $mk . "'";


$result = query($sql);
if (count($result) <= 0) {

    header("location:dangnhap.php?tb=Khongthedangnhap");
    exit();
}
$row = $result[0];
session_start();
$_SESSION['member'] = $row['UserName'];
$_SESSION['Quyen'] = $row['Quyen'];
$_SESSION['MaKhachHang '] = $row['MaKhachHang '];

if ($_SESSION['Quyen'] == 'customer') {
    header("location:index.php");
    die();
}
if ($_SESSION['Quyen'] != "master") {
    header("location:body.php");
} else {
    header("location:quanlysp.php");
}
