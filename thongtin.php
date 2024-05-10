<div class="border1" style="border:#000000 solid 2px;">
	<div class="border3">
		<?php
		require_once('./DataProvider.php');
		if (isset($_SESSION['member']))
			$sql = "SELECT * FROM user where UserName='" . $_SESSION['member'] . "'";
		$res = query($sql);
		if (count($res) < 0) {
			exit();
		}
		$row = $res[0];
		?>
		<h1 class="text-center">
			Thông tin cá nhân
		</h1>
		<form action="suathongtin.php" method="post" class="w-75 mx-auto" onsubmit="return checkinput()" id="myform">
			<input type="hidden" name="loai" value="capnhat">
			<div class="form-group row">
				<label for="staticEmail" class="col-sm-2 col-form-label">Tài khoản</label>
				<div class="col-sm-10">
					<input type="text" disabled class="form-control-plaintext" value="<?php echo $row['UserName']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="staticEmail" class="col-sm-2 col-form-label">Mật khẩu</label>
				<div class="col-sm-10">
					<input type="text" disabled class="form-control-plaintext" value="***************">
				</div>
			</div>
			<div class="form-group row">
				<label for="Email" class="col-sm-2 col-form-label">Email</label>
				<div class="col-sm-10">
					<input type="email" name="Email" class="form-control-plaintext" id="Email" value="<?php echo $row['Email']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="SDT" class="col-sm-2 col-form-label">Số điện thoại</label>
				<div class="col-sm-10">
					<input type="text" name="SDT" class="form-control" id="SDT" value="<?php echo $row['SDT']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="DiaChi" class="col-sm-2 col-form-label">Địa chỉ nhà</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="DiaChi" id="DiaChi" value="<?php echo $row['DiaChi']; ?>">
				</div>
			</div>

			<input type="submit" value="thay đổi" class="btn btn-primary">
			<a class="btn btn-primary ml-4 " href="doimatkhau.php">Thay đổi mật khẩu</a>
		</form>
	</div>
</div>
<script language="JavaScript">
	function checkinput() {
		if (!confirm("Bạn muốn thay đổi thông tin không?")) {
			return false;
		}
		var form = document.getElementById("myform")
		diachi = form.diachi;
		email = form.email;
		dienthoai = form.sdt;
		reg1 = /^[0-9A-Za-z]+[0-9A-Za-z_]*@[\w\d.]+.\w{2,4}$/;
		testmail = reg1.test(email.value);
		if (diachi.value == "") {
			alert("Chưa nhập địa chỉ");
			diachi.focus();
			return false;
		}
		if (!testmail) {
			alert("Địa chỉ email không hợp lệ");
			email.focus();
			return false;
		}
		if (dienthoai.value == "") {
			alert("Chưa nhập số điện thoại");
			dienthoai.focus();
			return false;
		}
		if (isNaN(dienthoai.value)) {
			alert("Số điện thoại chưa chính xác");
			dienthoai.focus();
			return false;
		}
		alert("Cập nhật thành công");
		return true;
	}
</script>
