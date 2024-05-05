<?php
require_once('./DataProvider.php');
if (!isset($_GET["page"])) $page = 1;
else $page = $_GET["page"];

if ($page == "" || $page == "1") {
	$offset = 0;
} else {
	$offset = ($page * 10) - 10;
}
$pageNum = 1;

// neu co tham so $_GET['page'] thi su dung no la trang hien thi
if (isset($_GET['page'])) {
	$pageNum = $_GET['page'];
}
if (isset($_GET['tu']) && isset($_GET['den'])) {
	if ($_GET['tu'] == "") {
		$tu = 0;
	} else
		$tu = $_GET['tu'];
	if ($_GET['den'] == "") {
		$den = 0;
	} else
		$den = $_GET['den'];
	if (!isset($_GET['gia'])) {
		$gia = "";
	} else {
		if ($_GET['gia'] == "tang") {
			$gia = " ORDER BY DonGia ASC";
		}
		if ($_GET['gia'] == "giam") {
			$gia = " ORDER BY DonGia DESC";
		}
	}
	if (!isset($_GET['theloai'])) {
		$theloai = "";
	} else $theloai = $_GET['theloai'];
	echo '<h2 style="text-align: center; padding-top: 50px">Kết quả tìm kiếm</h2>';
	$sql = "SELECT * FROM sanpham WHERE TenSP LIKE '%" . $theloai . "%' AND DonGia >=" . $tu . " AND DonGia <=" . $den . $gia . " limit $offset,10";
}
$result = mysqli_query($conn, $sql);
$i = 1;
echo '
	<div class="container-fluid" style="padding-top: 50px">
	<div class="row" style="padding-left: 120px">
	';
while ($row = mysqli_fetch_array($result)) {
	echo '<div class="sp" id="sp' . $i . '">';
	echo '<a href="detail-of-product" class="box">';
	echo '<div class="hinh-sp">';
	echo '<a href="chitietsp.php?id=' . $row["MaSP"] . '">';
	echo '<img class="hinh" src="' . $row['Image'] . '">';
	echo '</div>';
	echo '<p class="tensp">' . $row['TenSP'] . '</p>';
	echo '<p class="dongia">' . number_format($row['DonGia']) . '₫</p>';
	echo '</a>';
	echo '<div class="them-vao-gio-hang">';
	echo '<button style="button" class="them" id="' . $row['MaSP'] . '">';
	echo 'Thêm';
	echo '<i class="fa fa-cart-plus"></i>';
	echo '</button>';
	echo '</div>';
	echo '</div>';
	$i++;
?>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#<?php echo $row['MaSP']; ?>").click(function() {
				var id = $("#<?php echo $row['MaSP']; ?>").attr("id");
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
			});
		});
	</script>
<?php
}
// dem so mau tin co trong CSDL
$sql   = "SELECT COUNT(*) AS numrows FROM sanpham WHERE TenSP LIKE '%" . $theloai . "%' AND DonGia >=" . $tu . " AND DonGia <=" . $den . "";
$result = mysqli_query($conn, $sql);
$row     = mysqli_fetch_array($result, MYSQLI_ASSOC);
$numrows = $row['numrows'];

// tinh tong so trang se hien thi
$maxPage = ceil($numrows / 10);
$maxPage = $numrows / 10 == 0 ? $maxPage : $maxPage + 1;

// hien thi lien ket den tung trang

if (isset($_GET['gia']) && isset($_GET['theloai'])) $self = "body.php?tu=" . $tu . "&den=" . $den . "&gia=" . $_GET['gia'] . "&theloai=" . $theloai;
else if (isset($_GET['gia'])) $self = "body.php?tu=" . $tu . "&den=" . $den . "&gia=" . $_GET['gia'];
else if (isset($_GET['theloai'])) $self = "body.php?tu=" . $tu . "&den=" . $den . "&theloai=" . $theloai;
else $self = "body.php?tu=" . $tu . "&den=" . $den;

$nav  = '';;
$startPage = $pageNum <= 6 ? 1 : $pageNum - 6;
$finshPage = $startPage + 10;
for ($page = $startPage; $page <= $finshPage && $page < $maxPage; $page++) {
	if ($page == $pageNum) {
		$nav .= "<span class='btn btn-primary'>" . $page . "</span>";
	} else {
		$nav .= " <a href=\"$self&page=" . $page . "\" class='so-trang'>$page</a> ";
	}
}
?>
</div>
</div>
<div class="row">
	<div id="col-12" style="text-align: center;">
		<?php
		echo "<center>" . $nav . "</center>";
		?>
	</div>
</div>