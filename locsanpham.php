<?php
include_once("./DataProvider.php");
?>
<form class=" container" id="loc">
	<?php if ($tl != 'pk') { ?>
		<div class="row row-cols-auto">

			<select name="theloai" class="form-select m-2 btn text-center border">
				<?php
				$list = query('SELECT * FROM loaisp ORDER BY MaLoaiSP ASC');
				if ($tl != "") {
					echo '<option  value="">Hãng sản xuất</option>';
				} else {
					echo '<option selected value="">Hãng sản xuất</option>';
				}

				for ($i = 0; $i < count($list); $i++) {
					if ($tl == $list[$i]['MaLoaiSP']) {
						echo '<option selected value="' . $list[$i]['MaLoaiSP'] . '">' . $list[$i]['TenLoaiSP'] . '</option>';
						continue;
					}
					echo '<option value="' . $list[$i]['MaLoaiSP'] . '">' . $list[$i]['TenLoaiSP'] . '</option>';
				}
				?>
			</select>
			<select name="ram" class="form-select m-2 btn border">

				<?php
				if ($ram != "") {
					echo '<option  value="">RAM</option>';
				} else {
					echo '<option selected value="" >RAM</option>';
				}

				$list = query('SELECT ram FROM  sanpham Where  loai =0 GROUP BY ram');
				for ($i = 0; $i < count($list); $i++) {
					if ($ram == $list[$i]['ram']) {
						echo '<option selected value="' . $ram . '">' . $ram . '</option>';
						continue;
					}
					echo '<option value="' . $list[$i]['ram'] . '">' . $list[$i]['ram'] . '</option>';
				}
				?>
			</select>
			<select name="bonhotrong" class="form-select m-2 btn border">
				<?php
				if ($bonhotrong != "") {
					echo '<option  value="">Bộ nhớ trong</option>';
				} else {
					echo '<option selected value="" >Bộ nhớ trong</option>';
				}
				$list = query('SELECT bonhotrong FROM  sanpham Where loai =0 GROUP BY bonhotrong;');
				for ($i = 0; $i < count($list); $i++) {
					if ($bonhotrong == $list[$i]['bonhotrong']) {
						echo '<option selected value="' . $bonhotrong . '">' . $bonhotrong . '</option>';
						continue;
					}
					echo '<option value="' . $list[$i]['bonhotrong'] . '">' . $list[$i]['bonhotrong'] . '</option>';
				}
				?>
			</select>
			<select name="nhucau" class="form-select m-2 btn border">
				<?php
				if ($nhucau != "") {
					echo '<option  value="">Nhu cầu sử dụng</option>';
				} else {
					echo '<option selected value="" >Nhu cầu sử dụng</option>';
				}
				$list = query('SELECT nhucau FROM  sanpham Where  loai =0 GROUP BY nhucau;');
				for ($i = 0; $i < count($list); $i++) {
					if ($nhucau == $list[$i]['nhucau']) {
						echo '<option selected value="' . $nhucau . '">' . $nhucau . '</option>';
						continue;
					}
					echo '<option value="' . $list[$i]['nhucau'] . '">' . $list[$i]['nhucau'] . '</option>';
				}
				?>
			</select>

			<select name="dacbiet" class="form-select m-2 btn border">
				<?php
				if ($dacbiet != "") {
					echo '<option  value=""Tính năng đặc biệt</option>';
				} else {
					echo '<option selected value="" >Tính năng đặc biệt</option>';
				}
				$list = query('SELECT dacbiet FROM  sanpham Where loai = 0 GROUP BY dacbiet;');
				for ($i = 0; $i < count($list); $i++) {
					if ($dacbiet == $list[$i]['dacbiet']) {
						echo '<option selected value="' . $dacbiet . '">' . $dacbiet . '</option>';
						continue;
					}
					echo '<option value="' . $list[$i]['dacbiet'] . '">' . $list[$i]['dacbiet'] . '</option>';
				}
				?>
			</select>
			<div class="form-group m-2">
				<?php
				$sql = 'SELECT MAX(`DonGia`) as max FROM  sanpham Where loai = 0 AND SLTon>0';

				$gia = query($sql)[0]['max'];
				?>
				<label id="htg">giá sản phẩm: <?php echo number_format($gia) ?></label>
				<div class="position-relative" style="width: 300px;">

					<input type="range" style="top: 0;left: 0;" value="<?php echo $gia ?>" max="<?php echo $res; ?>" name="gia" onchange="rh(this)" class="form-control-range position-absolute" id="formControlRange">
				</div>

			</div>
			<input type="button" class="btn form-select m-2 btn-primary" onclick="phantrangAjax('<?php echo $tl ?>',1)" value="lọc sản phẩm">
		</div>
	<?php } ?>

</form>

<script>
	function rh(f) {
		const formatter = new Intl.NumberFormat({
			style: 'currency',
			currency: 'VND',
		})
		var v =
			$("#htg").html('giá sản phẩm: ' + (formatter.format(f.value)))
	}
</script>