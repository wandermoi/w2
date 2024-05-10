
<?php
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("location:index.php");
    exit();
}
require_once('./DataProvider.php');

session_start();
if (!isset($_SESSION['member'])) {
    header("location:index.php");
    exit();
}
$sql = "UPDATE user SET `DiaChi` = '" . $_POST['DiaChi'] . "', `Email` = '" . $_POST['Email'] . "', `SDT` = '" . $_POST['SDT'] . "' WHERE UserName='" . $_SESSION['member'] . "'";
$res = query($sql);
echo $sql;
if ($res) {
    header("location:body.php?action=thongtincanhan");
} else {
    header("location:index.php");
}
