<?php require("DataProvider.php");
session_start() ?>
<!DOCTYPE html>
<html>

<?php include("css.php") ?>
<?php
if (isset($_GET['tt'])) $tt = $_GET['tt'];
else $tt = '';

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
?>

<body>
	<?php
	include("./naviagte.php");
	?>
	<div class="d-flex flex-wrap">
		<?php include("./headerAdmin.php"); ?>
		<div class="col-md-9 ml-sm-auto col-lg-10 pt-3">
			<h2 style="text-align: center; font-weight: bold; padding-top: 5px">Các hóa đơn
				<?php
				if ($tt != "") {
					echo $trangthaiDH[$tt];
				} else {
					echo "Tất cả hóa đơn";
				} ?>
			</h2>

			<div class="row w-75 mx-auto mb-4">
				<form class="mx-4 form-inline my-2 my-lg-0" action='quanlyhoadon.php?action=quanlyhd' method='post'>
					<input class="form-control mr-sm-2" name="timhd" type="search" placeholder="Nhập hóa đơn muốn tìm" aria-label="Search" name="timhd">
					<input type="submit" class="btn btn-outline-success my-2 my-sm-0" value='Tìm kiếm'>
				</form>
				<div class="dropdown ">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
						tình trạng đơn hàng
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
						<li><a class="dropdown-item" href="quanlyhoadon.php">Tất cả hóa đơn</a></li>
						<?php
						foreach ($trangthaiDH as $key => $value) {
							echo '<li><a class="dropdown-item" href="quanlyhoadon.php?tt=' . $key . '">' . $value . '</a></li>';
						}
						?>
					</ul>
				</div>
			</div>
			<div style="min-height: 600px;">
				<table class="table table-hover table-responsive-md ">
					<thead class="thead-dark">
						<tr>
							<th class="text-center" scope="col">STT</th>
							<th class="text-center" scope="col">Mã Hóa Đơn</th>
							<th class="text-center" scope="col">Ngày đăt hàng</th>
							<th class="text-center" scope="col">Nhân viên </th>
							<th class="text-center" scope="col">Tổng tiền</th>
							<th class="text-center" scope="col">Chi tiết hóa đơn</th>
							<th class="text-center" scope="col">Tình trạng </th>
							<th class="text-center" scope="col">Thanh toán</th>
						</tr>
					</thead>
					<tbody>

						<script type="text/javascript" src="js/thaydoitrangthai.js"> </script>
						<?php
						$sql = "";
						$limit = ' limit ' . $offset . ',10';
						//gọi hóa đơn
						if (isset($_POST['timhd'])) {
							$limit = "";
							$sql = "SELECT * FROM hoadon, donhang
									WHERE hoadon.MaHoaDon=donhang.MaHoaDon AND hoadon.MaHoaDon='" . $_POST['timhd'] . "'";
						} else {

							$sql = 'SELECT * 
							FROM hoadon, donhang
							WHERE hoadon.MaHoaDon=donhang.MaHoaDon 
							AND donhang.TinhTrangDonHang like "%' . $tt . '%"';
						}
						$sql1 = $sql . $limit;
						$result = mysqli_query($conn, $sql1);
						$i = 1;
						include("config.php");
						if (mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_array($result)) {
								//gọi đơn hàng
								$mahd = $row['MaHoaDon'];
								$ngaydat = $row['NgayDatHang'];
								$nhanvien = $row['TenNguoiGiaoHang'];
								$tongtien = $row['TongTien'] + $row['PhiVanChuyen'];
								$tinhtrang = $row['TinhTrangDonHang'];
								$thanhtoan=$row['trangthaithanhtoan'];
								echo '<tr>
								<td class="text-center">' . $i . '</td>
								<td class="text-center">' . $mahd . '</td>
								<td class="text-center">' . $ngaydat . '</td>
								<td class="text-center">' . $nhanvien . '</td>
								<td class="text-center">' . number_format($tongtien, '0', '.', '.') . 'đ</td>
								<td class="text-center"><a class="btn btn-outline-primary" href="chitiethoadonServer.php?mahd=' . $row['MaHoaDon'] . '">Xem</a></td>
								<td class="text-center"> ' . $trangthaiDH[$tinhtrang] . '</td>
								<td class="text-center"> ' . $trangthaithanhtoan[$thanhtoan] . '</td>
							</tr>';
								$i++;
							}
						}

						?>
						<?php
						if (isset($_POST['timhd'])) {
							$nav = " $page ";
						} else {

							$result = mysqli_query($conn, $sql);
							$numrows = mysqli_num_rows($result);



							$nav  = '';

							$maxPage = ceil($numrows / 10);
							$maxPage = $numrows % 10 == 0 ? $maxPage : $maxPage + 1;
							$self = "quanlyhoadon.php?action=quanlyhd";
							$startPage = $pageNum <= 6 ? 1 : $pageNum - 6;
							$finshPage = $startPage + 10;
							$nav  = '';

							for ($page = $startPage; $page <= $finshPage  && $page < $maxPage; $page++) {
								if ($page == $pageNum)
									$nav .= "<span class='btn btn-primary'>" . $page . "</span>";
								else
									$nav .= '<a href=' . $self . '&page=' . $page . '&tt=' . $tt . ' class="so-trang">' . $page . '</a>';
							}
							mysqli_close($conn);
						}
						?>
					</tbody>
				</table>
			</div>
			<?php include("phantrang.php") ?>
		</div>
</body>
<script>
	active_navigate('qlhd')
</script>