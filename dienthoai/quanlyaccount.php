<?php require("DataProvider.php");session_start();?>
<!DOCTYPE html>
<html>

<?php include("css.php") ?>

<body style="font-family: Helvetica Neue, Arial, sans-serif">
	<?php
	include("./naviagte.php");
	?>

	<?php
	if (!isset($_GET["page"])) $page = 1;
	else $page = $_GET["page"];

	if (!isset($_GET['quyen'])) $quyen = "";
	else $quyen = $_GET['quyen'];

	if ($page == "" || $page == "1") {
		$offset = 0;
	} else {
		$offset = ($page * 10) - 10;
	}
	$pageNum = 1;
	if (isset($_GET['page'])) {
		$pageNum = $_GET['page'];
	}

	$sql = 'SELECT * FROM user where Quyen like "%' . $quyen . '%" limit ' . $offset . ',10';
	$result = query($sql);

	$row1 = $_SESSION['Quyen'];
	?>
	<div class="d-flex flex-wrap">
		<?php include("./headerAdmin.php"); ?>
		<div class="col-md-9 ml-sm-auto col-lg-10 pt-3">
			<a href="themuser.php" style="float:right;">
				<h6 class="btn btn-primary">
					Thêm tài khoản
				</h6>
			</a>
			<div class="dropdown mr-4 center" style="float:right;">
				<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<?php if ($quyen == "") {
						echo "tất cả tài khoản";
					} else echo $quyenArray[$quyen]; ?>
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" href="quanlyaccount.php">tất cả tài khoản</a>
					<?php
					foreach ($quyenArray as $key => $value) {
						echo '<a class="dropdown-item" href="quanlyaccount.php?quyen=' . $key . '">' . $value . '</a>';
					}
					?>
				</div>
			</div>
			<table class="table shadow-cell">
				<thead class="thead-dark">
					<tr>

						<th scope="col">Tên user</th>
						<th scope="col">Email</th>
						<th scope="col">Địa chỉ</th>
						<th scope="col">Trạng thái</th>
						<?php
						if ($row1 == 'master') {
							echo '<th scope="col">Quyền</th>';
						} ?>
						<th scope="col">Xử lý</th>
						<th scope="col">Lựa chọn</th>
					</tr>
				</thead>
				<tbody>
					<?php
					for ($i = 0; $i < count($result); $i++) {
						$row = $result[$i];

						echo '
				<tr>';
						//echo '<td scope="row">'.$i.'</td>';

						echo '<td>' . $row['UserName'] . '</td>';
						echo '<td>' . $row['Email'] . '</td>';
						echo '<td>' . $row['DiaChi'] . '</td>';
						echo '<td>'; ?>

						<?php
						if ($row['TrangThai'] == 1) {
							echo '<p id=sts' . $row['MaKhachHang'] . '>Kích hoạt</p>';
						} else
							echo '<p id=sts' . $row['MaKhachHang'] . '>Bị khóa</p>';
						?>

						<?php
						if ($row1 == 'master') {
							echo '<td>' . $quyenArray[$row['Quyen']] . '</td>';
						} ?>
						<td>
							<?php
							echo '
								<a href="suauser.php?username=' . $row['UserName'] . '">
									<div class="btn btn-primary "> 
										Sửa
									</div>
								</a> ' ?>
						</td>

						<td>

							<select onchange="activeUser(this.value,'<?php echo $row['MaKhachHang']; ?>')">
								<option value="">Lựa chọn</option>
								<option value="1">Kích hoạt</option>
								<option value="0">Khóa</option>
							</select>
							</tr>
						<?php	} ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php
	$sql   = 'SELECT COUNT(*) AS numrows FROM user where Quyen like "%' . $quyen . '%"';
	$result = query($sql);
	$row     = $result[0];
	$numrows = $row['numrows'];

	$self = "quanlyaccount.php?quyen=" . $quyen . '"';

	$nav  = '';
	$maxPage = ceil($numrows / 10);
	$maxPage = $numrows % 10 == 0 ? $maxPage : $maxPage + 1;

	$startPage = $pageNum <= 6 ? 1 : $pageNum - 6;
	$finshPage = $startPage + 10;
	$nav  = '';

	for ($page = $startPage; $page <= $finshPage && $page < $maxPage; $page++) {
		if ($page == $pageNum)
			$nav .= "<span class='btn btn-primary'>" . $page . "</span>";
		else
			$nav .= " <a href=\"$self.page=" . $page . "\" class='so-trang'>$page</a> ";
	}

	?>
	<?php
	include("phantrang.php");
	?>
</body>
<script>
	active_navigate('qltk')

	function activeUser(val, makhachhang) {
		$.ajax({
			type: 'post',
			url: 'change.php',
			data: {
				val: val,
				makhachhang: makhachhang
			},
			success: function(result) {
				//Hiển thị kết quả ra màn hình console
				//console.log(result); 
				if (result == 1) {
					$('#sts' + makhachhang).html('Kích hoạt');
				} else {
					$('#sts' + makhachhang).html('Bị khóa');
				}
			}
		})
	}
</script>

</html>