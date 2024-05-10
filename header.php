<?php
require_once('./DataProvider.php');


?>
<div class="stick">
	<li class="nav-item active btn float-right ">

		<?php
		if (!isset($_SESSION['member'])) {
			echo '
						<a href="dangnhap.php">
							<button  class=" btn btn-primary">
								Đăng nhập
				   			</button>
						</a>';
		} else {
			echo '
		<div class="btn-group">
        <div class="btn-group dropleft" role="group">
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">  ' . $_SESSION['member'] . '</span>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="logout.php">Thoát</a>
                <a class="dropdown-item" href="body.php?action=thongtincanhan">Xem thông tin cá nhân</a>
                <a class="dropdown-item" href="body.php?action=danhsachhoadonmuahang">Xem danh sách đơn hàng</a>
            </div>
        </div>
        <button type="button" class="btn btn-primary">
            <span class="">' . $_SESSION['member'] . '</span>
        </button>
    </div>';
		}
		?>
	</li>
	<div style="background-color: red;">
		<div class="container">
			<div class="row">
				<h1 class="font-weight-bold text-white">
					My Store
				</h1>
				<?php
				if (!isset($_SESSION['Quyen'])) {
					$_SESSION['Quyen'] = "";
				}
				?>
				<?php
				if ($_SESSION['Quyen'] == "" || $_SESSION['Quyen'] == "customer") { ?>
					<div class="form-inline my-2 col-9 my-lg-0 ">
						<div class="col-7 position-relative">
							<input class="col-12  p-2  rounded mr-sm-2 "  onclick="display()" onkeyup="goiytimkiem(this)" type="search" placeholder="Nhập điện thoại bạn cần" aria-label="Search" name="nameSP" id="timkiem">
							<div class="position-absolute hidden t col-11" style="height: 400px;overflow: scroll; background-color: white; ">


							</div>
							<img class="position-absolute t hidden" onclick="xoa()" style="width: 40px;top: 0;right: 12px;" src="Images\svg\X-icon.svg" class="" alt="" srcset="">

						</div>
						<div class="btn mr-1 hover_btn" onclick="sea()">
							<div class="row px-2 ">
								<img style="width: 20px;;" src="Images\svg\search-solid.svg" class="" alt="" srcset="">
								<div class="ml-1 text-white">Tìm kiếm</div>
							</div>
						</div>

						<a href="giohang.php " class=" btn mr-1 hover_btn">
							<div class="row px-2 hover_btn">
								<img style="width: 20px;;" src="Images\svg\cart-shopping-solid.svg" class="" alt="" srcset="">
								<div class="ml-1 text-white ">Giỏ hàng</div>
							</div>
						</a>

					</div>
				<?php } ?>
			</div>
		</div>
	</div>


	<?php

	switch ($_SESSION['Quyen']) {
		case 'master':
			echo '
		<div class="center header-nav mb-3 stick">
			<a class="header-nav-link" href="trangchu.php">Trang chủ</a>
			<a class="header-nav-link" href="quanlyaccount.php">Quản lý tài khoản</a>
			<a class="header-nav-link" href="quanlyhoadon.php">Quản lý hóa đơn</a>
			<a class="header-nav-link" href="quanlysp.php">Quản lý sản phẩm</a>
			<a class="header-nav-link" href="quanlyLoaiSP.php">Quản lý loại sản phẩm</a>
			<a class="header-nav-link" href="thongke.php">Thống kê kinh doanh</a>
		</div>';
			break;
		case 'qlnv':
			echo '
		<div class="center header-nav  mb-3 stick">
			<a class="header-nav-link" href="quanlyaccount.php">Quản lý tài khoản</a>
		</div>';
			break;
		case 'nvdd':
			echo '
		<div class="center header-nav  mb-3 stick">
			<a class="header-nav-link" href="quanlyhoadon.php">Quản lý hóa đơn</a>
		</div>';
			break;
		case 'nvqlkho':
			echo '
		<div class="center header-nav  mb-3 stick">
			<a class="header-nav-link" href="quanlysp.php">Quản lý sản phẩm</a>
			<a class="header-nav-link" href="quanlyLoaiSP.php">Quản lý loại sản phẩm</a>
		</div>';
			break;
		default:
			echo '
			<div class="center header-nav mb-3 ">
				<a class="header-nav-link btn" href="index.php">Trang chủ</a>
				<a class="header-nav-link btn" onclick="phantrangAjax(\'\', 1)">Tất cả sản phẩm</a>
			';
			$sql = 'SELECT COUNT(*) as s, loaisp.MaLoaiSP as MaLoaiSP, loaisp.TenLoaiSP as TenLoaiSP
					FROM loaisp, sanpham 
					WHERE loaisp.MaloaiSP <> "pk" AND loaisp.MaLoaiSP = sanpham.MaLoaiSP And sanpham.SLTon > 0
					GROUP BY loaisp.MaLoaiSP 
					HAVING s>0';

			$data = query($sql);
			for ($i = 0; $i < count($data); $i++) {
				$MaLoaiSP = $data[$i]['MaLoaiSP'];
				$TenLoaiSP = $data[$i]['TenLoaiSP'];
				echo '<a class="header-nav-link btn" onclick="phantrangAjax(\'' . $MaLoaiSP . '\', 0)">' . $TenLoaiSP . '</a>';
			}
			$sql = 'SELECT COUNT(*) as s, loaisp.MaLoaiSP as MaLoaiSP, loaisp.TenLoaiSP as TenLoaiSP
					FROM loaisp, sanpham 
					WHERE loaisp.MaloaiSP = "pk" AND loaisp.MaLoaiSP = sanpham.MaLoaiSP And sanpham.SLTon > 0
					GROUP BY loaisp.MaLoaiSP 
					HAVING s>0';
			$data = query($sql);
			for ($i = 0; $i < count($data); $i++) {
				$MaLoaiSP = $data[$i]['MaLoaiSP'];
				$TenLoaiSP = $data[$i]['TenLoaiSP'];
				echo '<a class="header-nav-link btn" onclick="phantrangAjax(\'' . $MaLoaiSP . '\', 0)">' . $TenLoaiSP . '</a>';
			}
			echo '</div>';
			break;
	}
	?>
</div>

<script>
	function sea() {
		let nameSP = $("#timkiem").val();
		timkiemAjax(nameSP, "")
		xoa()
	}

	function display() {
		$(".t").show()
	}

	function xoa() {
		$(".t").html()
		$(".t").hide()

	}

	function goiytimkiem(f) {
		var s = f.value
		if (s.length == 0) {
			$(".t").html("")
			return
		}
		$.ajax({
			method: "POST",
			url: "goiytimkiem.php",
			data: {
				ten: f.value
			},
			success: (result) => {
				$(".t").html(result)

			}
		})
	}
</script>
