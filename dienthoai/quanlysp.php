<?php session_start()?>
<!DOCTYPE html>
<html>

<?php
include("css.php");
require("DataProvider.php");
$ttsp = array('ẩn', 'ban', 'khongban');
$ttsp1 = array('ẩn', 'bán', 'không bán');
?>

<body style="font-family: Helvetica Neue, Arial, sans-serif">
	<?php
	include("./naviagte.php");
	if (!isset($_SESSION["member"])) {
		header('location:body.php');
		exit;
	}
	if (!isset($_GET["page"])) {
		$page = 1;
	} else {
		$page = $_GET["page"];
	}

	if (!isset($_GET['tl'])) {
		$tl = '';
	} else {
		$tl = $_GET['tl'];
	}
	if (!isset($_GET['tt'])) {
		$tt = '1';
	} else {
		$tt = $_GET['tt'];
	}
	$t = $tt == 1 ? 2 : 1;
	$offset = ($page * 10) - 10;
	$pageNum = 1;

	// neu co tham so $_GET['page'] thi su dung no la trang hien thi
	if (isset($_GET['page'])) {
		$pageNum = $_GET['page'];
	}
	?>
	<div class="d-flex flex-wrap">
		<?php include("./headerAdmin.php"); ?>
		<div class="col-md-9 ml-sm-auto col-lg-10 pt-3 ">
			<form class="mx-4 form-inline my-2 my-lg-0" style="float:left;" action='quanlysp.php' method='post'>
				<input class="form-control mr-sm-2" type="search" placeholder="Nhập sản phẩm muốn tìm" aria-label="Search" name="timsp">
				<input type="submit" class="btn btn-outline-success my-2 my-sm-0" value='Tìm kiếm'>
			</form>
			<div>
				<h3>
					<a href="quanlysp.php?tt=<?php echo $t?>" class="btn btn-primary mr-sm-3" style="float:right;"> các sản phẩm <?php echo $ttsp1[$t]?></a>
				</h3>
				<h3>
					<a href="themsp.php" class="btn btn-primary mr-sm-3" style="float:right;"> Thêm sản phẩm </a>
				</h3>
				<div class="dropdown mr-3" style="float: right;">
					<button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
						<?php
						$sql = 'SELECT * FROM loaisp';
						$result = mysqli_query($conn, $sql);
						$row = array();
						while ($temp = mysqli_fetch_array($result)) {
							$row[$temp['MaLoaiSP']] = $temp['TenLoaiSP'];
						}
						if (!isset($_GET['tl']) || $_GET['tl'] == '') {
							echo 'tất cả sản phẩm';
						} else {
							echo $row[$_GET['tl']];
						}
						?>
					</button>
					<ul class="dropdown-menu">

						<?php
						$sql = 'SELECT * FROM loaisp';
						$result = mysqli_query($conn, $sql);
						foreach ($row as $key => $value) {
							$MaLoaiSP = $key;
							$TenLoaiSP = $value;
							echo '
									<li>
										<a class="dropdown-item" href="quanlysp.php?tl=' . $MaLoaiSP . '&tt=' . $tt . '">
										' . $TenLoaiSP . '
										</a>
									</li>';
						}

						?>
						<li>
							<a class="dropdown-item" href="quanlysp.php">
								Tất cả sản phẩm
							</a>
						</li>
					</ul>
				</div>
			</div>
			<br />
			<br />
			<h2 class="text-center">
				<?php echo 'các sản phẩm ' . $ttsp1[$tt] ?>
			</h2>
			<table class="table table-hover table-responsive-md h-min">
				<thead class="thead-dark">
					<tr>
						<th class="text-center" scope="col">Hình ảnh</th>
						<th class="text-center" scope="col">Mã SP</th>
						<th class="text-center col-2" scope="col">Tên sản phẩm</th>
						<th class="text-center" scope="col">Thương hiệu</th>
						<th class="text-center" scope="col">SL Tồn</th>
						<th class="text-center" scope="col">Đơn giá</th>
						<th class="text-center" scope="col">Thao tác</th>
					</tr>
				</thead>
				<tbody>
					<?php
					//gọi sản phẩm
					$l = 0;
					if (isset($_POST['timsp'])) {
						$sql = "SELECT * FROM sanpham WHERE trangthai = ".$tt." AND TenSP LIKE '%" . $_POST['timsp'] . "%'";
						$l = 1;
					} else {
						$sql = 'SELECT * FROM sanpham WHERE trangthai = ' . $tt . ' AND MaLoaiSP LIKE "%' . $tl . '%" limit ' . $offset . ',10';
					}
					
					$result = mysqli_query($conn, $sql);
					
					while ($row1 = mysqli_fetch_array($result)) {
						//gọi loại sản phẩm

						$image = $row1['Image'];
						$masp = $row1['MaSP'];
						$tensp = $row1['TenSP'];
						$thuonghieu = $row[$row1['MaLoaiSP']];
						$slton = $row1['SLTon'];
						$dongia = $row1['DonGia'];
						echo '<tr>
							<td class="text-center"><img class=""  src="' . $image . '" style="width:155px;height:auto;"></td>
							<td class="text-center">' . $masp . '</td>
							<td class="text-center">' . $tensp . '</td>
							<td class="text-center">' . $thuonghieu . '</td>
							<td class="text-center">' . $slton . '</td>
							<td class="text-center">' . number_format($dongia, '0', '.', '.') . 'đ</td>
							<td class="text-center">
							<a style="color: white" href="suasp.php?masp=' . $masp . '&loai=NhapKho">
								<button class="btn btn-success btn-sm">
									<i class="fa fa-edit">
										Nhập kho
									</i>
								</button>
							</a>
							<a style="color: white" href="suasp.php?masp=' . $masp . '&loai=SuaSP">
								<button class="btn btn-success btn-sm">
									<i class="fa fa-edit">
										Sửa
									</i>
								</button>
							</a>
							<br>
							<button class="mt-1 btn btn-success btn-sm" onclick="ktxoa(\'' . $masp . '\',\'xoa\')">
								<i class="fa fa-edit">
									Xóa sản phẩm
								</i>
							</button>
							<button class="mt-1 btn btn-success btn-sm" onclick="ktxoa(\'' . $masp . '\',\'' . $ttsp[$t] . '\')">
								<i class="fa fa-edit">
									' . $ttsp1[$t] . '
								</i>
							</button>
							</td> 
							</tr>';
					}
					?>
					<?php
					// dem so mau tin co trong CSDL
					if ($l != 1) {
						$sql   = 'SELECT COUNT(*) AS numrows FROM sanpham where trangthai = ' . $tt . ' AND MaLoaiSP LIKE "%' . $tl . '%"';
						// $result = DataProvider::executeQuery($sql);
						$result = mysqli_query($conn, $sql);
						$row     = mysqli_fetch_array($result, MYSQLI_ASSOC);
						$numrows = $row['numrows'];
						// tinh tong so trang se hien thi
						$maxPage = ceil($numrows / 10);
						$maxPage = $numrows % 10 == 0 ? $maxPage : $maxPage + 1;
						$self = "quanlysp.php";
						$startPage = $pageNum <= 6 ? 1 : $pageNum - 6;
						$finshPage = $startPage + 10;
						$nav  = '';

						for ($page = $startPage; $page <= $finshPage && $page < $maxPage; $page++) {
							if ($page == $pageNum)
								$nav .= "<span class='btn btn-primary'>" . $page . "</span>";
							else
								$nav .= "<a href=\"$self?page=" . $page . "&tl=" . $tl . "&tt=" . $tt . "\" class='btn'>$page</a> ";
						}
					}

					?>
				</tbody>
			</table>
			<?php
			include("phantrang.php");
			?>
		</div>
	</div>




</body>
<script type="text/javascript">
	active_navigate('qlsp')

	function ktxoa(masp, type) {
		var yes = confirm('Bạn có chắc muốn thực hiện thao tác này ?');
		if (!yes) {
			return;
		}
		$.ajax({
			type: 'POST',
			url: 'xulysp.php',
			data: {
				loai: type,
				masp: masp
			},
			success: function(result) {
				alert(result);
				console.log(result)
				window.location.reload();
			}
		})
	}
</script>

</html>