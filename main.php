<?php

require_once('./DataProvider.php');
$sql = 'SELECT MAX(`DonGia`) as max FROM sanpham Where SLTon>0';
$res = query($sql)[0]['max'];

if (!isset($_REQUEST["theloai"]))  $tl = "";
else $tl = $_REQUEST["theloai"];

if (!isset($_REQUEST["page"])) $page = 1;
else $page = $_REQUEST["page"];

if (!isset($_REQUEST["ram"])) $ram = "";
else $ram = $_REQUEST["ram"];

if (!isset($_REQUEST["bonhotrong"])) $bonhotrong = "";
else $bonhotrong = $_REQUEST["bonhotrong"];

if (!isset($_REQUEST["gia"])) $gia = $res;
else $gia = $_REQUEST["gia"];

if (!isset($_REQUEST["nhucau"])) $nhucau = "";
else $nhucau = $_REQUEST["nhucau"];

if (!isset($_REQUEST["dacbiet"])) $dacbiet = "";
else $dacbiet = $_REQUEST["dacbiet"];

echo '<div class="d-flex justify-content-center">';

echo '<div class="" >';


if ($page == "" || $page == "1") {
	$offset = 0;
} else {
	$offset = ($page * 12) - 12;
}
$pageNum = 1;
// neu co tham so $_REQUEST['page'] thi su dung no la trang hien thi
if (isset($_REQUEST['page'])) {
	$pageNum = $_REQUEST['page'];
}
$sql = "SELECT * FROM sanpham WHERE
nhucau LIKE '%" . $nhucau . "%' AND
DonGia < " . $gia . " AND
ram LIKE '%" . $ram . "%' AND 
bonhotrong LIKE '%" . $bonhotrong . "%' AND
trangthai = 1 AND SLTon>0 AND 
MaLoaiSP LIKE '%" . $tl . "%' ORDER BY DonGia DESC limit $offset,12";

$result = query($sql);
$i = 1;
echo '<div class="container" >';
include('./locsanpham.php');
echo '<div class="row" >';

if (count($result) == 0) {
	echo '
	<h1 style="height: 400px;">Không có sản phẩm phù hợp với tiêu chí bạn tìm</h1>';
}

for ($j = 0; $j < count($result); $j++) {
	$row = $result[$j];
	$slton = $row['SLTon'];
	if ($slton > 0) {
		echo '<div class="sp" id="sp' . $j . '">';
		echo '<a href="detail-of-product" class="box">';
		echo '<div class="hinh-sp">';
		echo '<a href="chitietsp.php?id=' . $row["MaSP"] . '">';
		echo '<img class="hinh" src="' . $row['Image'] . '">';
		echo '</div>';
		echo '<p class="tensp">' . $row['TenSP'] . '</p>';
		echo '<p class="dongia">' . number_format($row['DonGia']) . '₫</p>';
		echo '</a>';
		echo '<p class="dongia"> Số lượng còn:' . $row['SLTon'] . '</p>';
		echo '<div class="them-vao-gio-hang">';
		echo '<button class="them" onclick=addcard("' . $row["MaSP"] . '")>';
		echo 'Thêm';
		echo '<i class="fa fa-cart-plus"></i>';
		echo '</button>';
		echo '</div>';
		echo '</div>';
	}
}
echo '</div> </div> </div></div>';
?>
<?php
$sql = "SELECT * FROM sanpham WHERE 
nhucau like '%" . $nhucau . "%' AND
DonGia < " . $gia . " AND
ram LIKE '%" . $ram . "%' AND 
bonhotrong LIKE '%" . $bonhotrong . "%' AND
trangthai = 1 AND SLTon>0 AND 
MaLoaiSP LIKE '%" . $tl . "%'";

$result = query($sql);

$numrows   = count($result);



// tinh tong so trang se hien thi
$maxPage = ceil($numrows / 12);
$maxPage = $numrows / 12 == 0 ? $maxPage : $maxPage + 1;
// hien thi lien ket den tung trang
$self = "body.php";
$nav  = '';
$startPage = $pageNum <= 6 ? 1 : $pageNum - 6;
$finshPage = $startPage + 12;
for ($page = $startPage; $page <= $finshPage && $page < $maxPage; $page++) {
	if ($page == $pageNum) {
		$nav .= "<span class='btn btn-primary px-4 py-2'>" . $page . "</span>";
	} else {
		$nav .= '<button class="btn  px-4 py-2 m-2" onclick="phantrangAjax(\'' . $tl . '\',\'' . $page . '\')" >' . $page . '</button>';
	}
}
include("phantrang.php");

?>
<script type="text/javascript">
	function addcard(id) {
		$.ajax({
			type: "POST",
			url: "addcard.php",
			data: {
				id: id
			},
			cache: false,
			success: function(result) {
				alert("Sản phẩm đa được thêm vào giỏ hàng");

			}
		});
	}
</script>