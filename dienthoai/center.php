<?php
if (isset($_GET["tu"]) && isset($_GET["den"])) {
	include("tknc.php");
} else 
		if (isset($_GET["action"])) {

	if ($_GET["action"] == "chitiethoadonServer")
		include("chitiethoadonServer.php");
	if ($_GET["action"] == "quanlyhd")
		include("quanlyhoadon.php");
	if ($_GET["action"] == "thongtincanhan")
		include("thongtin.php");
	if ($_GET["action"] == "suathongtin")
		include("suathongtin.php");
	if ($_GET["action"] == "danhsachhoadonmuahang")
		include("danhsachhoadonmuahang.php");
	if ($_GET['action'] == "chitietdonhang")
		include("chitietdonhang.php");
} else {
	include("main.php");
}
