<?php require("DataProvider.php");
session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<?php include("css.php") ?>

<body>
	<?php
	include("./naviagte.php");
	?>
	<div class="d-flex flex-wrap">
		<?php include("./headerAdmin.php"); ?>
		<div class="col-md-9 ml-sm-auto col-lg-10 pt-3">
			<?php
			$quyen = $_SESSION['Quyen'];
			if (!isset($_SESSION['member']) || ($quyen != "nvdd" && $quyen != "master")) {
				exit();
			} else {
			?>
				<h2 style="text-align: center; padding-top: 7px">CHI TIẾT HÓA ĐƠN</h2>
				<table class="table table-hover table-responsive-md">
					<thead class="thead-dark">
						<tr>
							<th class="text-center" onclick="ffff()" scope="col">STT</th>
							<th class="text-center" scope="col">Ảnh sản phẩm</th>
							<th class="text-center" scope="col">Tên sản phẩm</th>
							<th class="text-center" scope="col">Đơn giá</th>
							<th class="text-center" scope="col">Số lượng</th>
							<th class="text-center" scope="col">Thành tiền</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$mahd="";
						if (isset($_GET['mahd'])) {
							$mahd = $_GET['mahd'];
							//gọi hóa đơn
							$sql = "SELECT * FROM chitiethoadon where MaHoaDon='" . $mahd . "'";
							$result = mysqli_query($conn, $sql);
							$i = 1;
							$tongcong = 0;
							if (mysqli_num_rows($result) <= 0) {
								echo '<h1 class="text-center">rỗng</h1>';
								exit();
							}
							while ($row = mysqli_fetch_array($result)) {
								//gọi đơn hàng
								$sql1 = "SELECT * FROM sanpham WHERE MaSP='" . $row['MaSP'] . "'";
								$result1 = mysqli_query($conn, $sql1);
								$row1 = mysqli_fetch_array($result1);

								$masp = $row['MaSP'];
								$image = $row1['Image'];
								$tensp = $row1['TenSP'];
								$dongia = $row['DonGia'];
								$soluong = $row['SoLuong'];
								$thanhtien = $row['ThanhTien'];
								echo '<tr>
							<td class="text-center">' . $i . '</td>
							<td class="text-center">
								<img style="width:80px;height:100px" src="' . $image . '">
							</td>
							<td class="text-center">' . $tensp . '</td>
							<td class="text-center">' . number_format($dongia, '0', '.', '.') . 'đ</td>
							<td class="text-center">' . $soluong . '</td>
							<td class="text-center">' . number_format($thanhtien, '0', '.', '.') . 'đ</td>
							
						</tr>';
								$i++;
								$tongcong += $thanhtien;
							}
							$sql1 = "select * from hoadon where MaHoaDon='" . $mahd . "'";
							$result1 = query($sql1);
							$row1 = $result1[0];
							$phiship = $row1['PhiVanChuyen'];
							$thanhtoan = $tongcong + $phiship;
							$phuongthucnhahang = $row1['Phuongthucnhahang'];

							$sql = 'SELECT * FROM donhang WHERE MaHoaDon="' . $mahd . '"';
							$result = query($sql);
							$row = $result[0];
							$MaDH = $row['MaDonHang'];
							$trangthai = $row['TinhTrangDonHang'];
							$DiaChiGiaoHang = $row['DiaChiGiaoHang'];
							$trangthaithanhtoanS = $row['trangthaithanhtoan'];
							include("config.php");
						}
						?>

					</tbody>
					
				</table>
				<div class="float-right mr-4">
					<?php
					switch ($trangthai) {
						case 'chuagiao':
							echo '
								<button class="btn-primary" onclick=\'active_inactive_user("bihuy", "' . $MaDH . '")\'>Hủy hàng</button>
								<button class="btn-primary" onclick=\'active_inactive_user("danggiao", "' . $MaDH . '")\'>Đang giao</button>';
							break;
						case 'danggiao':
							echo '<button class="btn-primary" onclick=\'active_inactive_user("bihuy", "' . $MaDH . '")\'>Hủy hàng</button>';
							echo '<button class="btn-primary" onclick=\'active_inactive_user("danhan", "' . $MaDH . '")\'>Đã nhận</button>';
							break;
						case 'danhan':
							echo '<button class="btn-primary" onclick=\'active_inactive_user("ht", "' . $MaDH . '")\'>Hoàn thành</button>';
							echo '<button class="btn-primary" onclick=\'active_inactive_user("danggiao", "' . $MaDH . '")\'>Chưa nhận</button>';
							break;
						case 'khongnhan':
							echo '<button class="btn-primary" onclick=\'active_inactive_user("bihuy", "' . $MaDH . '")\'>Hủy hàng</button>';
							break;
					}
					?>
				</div>
				<div class="px-5 h-min">
					<p>Tổng cộng: <strong><?php echo number_format($tongcong, '0', '.', '.') . 'đ' ?></strong></P>
					<p>Phương thức nhận hàng: <strong><?php echo $PhuongthucnhahangArray[$phuongthucnhahang] ?></strong></p>
					<?php if ($phuongthucnhahang == "2") { ?>
						<p>Phí vận chuyển: <strong><?php echo number_format($phiship, '0', '.', '.') . 'đ' ?></strong></p>
						<p>Phải thanh toán: <strong><?php echo number_format($thanhtoan, '0', '.', '.') . 'đ' ?></strong></p>
						<p>Trạng thái hóa đơn: <strong><?php echo $trangthaiDH[$trangthai] ?></strong></p>
						<p>Địa điểm giao hàng: <strong><?php echo $DiaChiGiaoHang ?></strong></p>
					<?php } ?>
					<p>Trạng thái thanh toán: <strong><?php echo $trangthaithanhtoan[$trangthaithanhtoanS] ?></strong></p>
 
					<a href="javascript:history.go(-1)" class="btn btn-warning"><i class="fa fa-angle-left"></i> Quay lại</a>
				</div>
			<?php
			} ?>
		</div>
	</div>
</body>

</html>

<script src="js/thaydoitrangthai.js"></script>
