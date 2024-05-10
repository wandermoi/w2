<?php
require_once('DataProvider.php');

if ($_SERVER['REQUEST_METHOD'] != "POST") {
	header("location:index.php");
	exit();
}
if (!isset($_POST["page"])) $page = 1;
else $page = $_POST["page"];


if (isset($_POST['page'])) {
	$pageNum = $_POST['page'];
}
if ($page == "" || $page == "1") {
	$offset = 0;
	$pageNum = 1;
} else {
	$offset = ($page * 15) - 15;
}

if (isset($_POST['search'])) {
	$tim = $_POST['search'];
	echo '<h2 style="text-align: center; padding-top: 50px">Kết quả tìm kiếm cho:' . $tim . '</h2>';
	$sql = "SELECT * FROM sanpham WHERE slton>0 AND TenSP LIKE '%" . $tim . "%'limit $offset,15";
}

$result = query($sql);
$i = 1;

echo '
	<div class="container-fluid" style="padding-top: 50px; min-height: 600px;">
	<div class="row" style="padding-left: 150px">
	';

for ($i = 0; $i < count($result); $i++) {
	$row = $result[$i];
	
	echo '<div class="sp" id="sp' . $i . '">';
	echo '<a href="detail-of-product" class="box">';
	echo '<div class="hinh-sp">';
	echo '<a href="chitietsp.php?id=' . $row["MaSP"] . '">';
	echo '<img class="hinh" src="' . $row['Image'] . '">';
	echo '</div>';
	echo '<p class="tensp">' . $row['TenSP'] . '</p>';
	echo '<p class="dongia">' . number_format($row['DonGia']) . '₫</p>';
	echo '</a>';
	echo '<p class="dongia"> số lượng còn:' . $row['SLTon'] . '</p>';
	echo '<div class="them-vao-gio-hang">';
	echo '<button class="them" onclick=addcard("' . $row["MaSP"] . '")>';
	echo 'Thêm';
	echo '<i class="fa fa-cart-plus"></i>';
	echo '</button>';
	echo '</div>';
	echo '</div>';
	
?>
<?php
}
echo "</div> </div>";
// dem so mau tin co trong CSDL
$sql   = "SELECT COUNT(*) AS numrows FROM sanpham WHERE TenSP LIKE '%" . $tim . "%'";
$result = query($sql);
$row     = $result[0];
$numrows = $row['numrows'];





$maxPage = ceil($numrows / 15);

$maxPage = $numrows % 15 == 0 ? $maxPage : $maxPage + 1;

$startPage = $pageNum <= 6 ? 1 : $pageNum - 6;
$finshPage = $startPage + 15;
$nav  = '';

for ($page = $startPage; $page <= $finshPage && $page < $maxPage; $page++) {
	if ($pageNum == $page) {
		$nav .= "<span class='btn'>" . $page . "</span>";
	} else {
		$nav .= '<button class="btn btn-primary px-4 py-2 m-2" onclick="timkiemAjax(\'' . $tim . '\',\'' . $page . '\')" >' . $page . '</button>';
	}
}
include("phantrang.php");
?>