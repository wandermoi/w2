<!DOCTYPE html>
<html lang="en">

<?php include("css.php") ?>

<body>
	<?php
	include("header.php");
	$sql = "SELECT * FROM user WHERE UserName = '" . $_SESSION['member'] .  "'";
	$row = query($sql)[0];
	$tk = $row['UserName'];
	?>
	<div class="phantrang">
		<form action="" method="post" id="myform" onsubmit="return ktmk()" class="rounded p-4 w-50 mx-auto border border-primary">
			<h3 class="text-center">đổi mật khẩu</h3>
			<input type="hidden" name="loai" value="doimk">
			<div class="form-group row">
				<label for="staticEmail" class="col-sm-2 col-form-label">Tài khoản</label>
				<div class="col-sm-10">
					<input type="text" disabled value="<?php echo $tk; ?>" class="form-control-plaintext">
					<input type="hidden" value="<?php echo $tk; ?>" name="UserName">
				</div>

			</div>
			<div class="form-group row">
				<label for="staticEmail" class="col-sm-2 col-form-label">Mật khẩu</label>
				<div class="col-sm-10">
					<input type="password" id="Password" name="Password" value="" class="form-control-plaintext" placeholder="nhập mật khẩu">
				</div>
			</div>
			<div class="form-group row">
				<label for="staticEmail" class="col-sm-2 col-form-label">Mật khẩu mới</label>
				<div class="col-sm-10">
					<input type="password" id="Password1" onkeyup="checkMK1(this.value)" name="Password1" value="" class="form-control-plaintext" placeholder="nhập mật khẩu">
				</div>
				<small id="tb1" class="form-text text-danger">mật khẩu phải từ độ dài 7 đến 20 a-z 0-9</small>
			</div>
			<div class="form-group row">
				<label for="staticEmail" class="col-sm-2 col-form-label">Xác nhật mật khẩu mới</label>
				<div class="col-sm-10">
					<input type="password" onkeyup="checkMK2(this.value)" value="" name="Password2" class="form-control-plaintext" placeholder="nhập mật khẩu">
				</div>
				<small id="tb2" class="form-text text-danger">mật khẩu không trùng</small>
			</div>
			<input type="submit" value="đổi mật khẩu" class="btn btn-primary">
		</form>
	</div>
</body>

<script>
	$("#tb1").hide();
	$("#tb2").hide();

	function ktmk() {

		var myform = new FormData(document.getElementById("myform"));
		if (confirm("bạn muốn thay đổi không") == false) {
			return false;
		}

		console.log(myform)
		var mk = myform.get("Password");
		var mk1 = myform.get("Password1");
		var mk2 = myform.get("Password2");
		if (mk == "") {
			alert("Chưa nhập mật khẩu ");
			mk.focus();
			return false;
		}
		if (mk1 == "") {
			alert("Chưa mật khẩu ");
			mk1.focus();
			return false;
		}
		if (!/[0-9a-z]{7,20}$/.test(mk1)) {
			return false;
		}
		if (mk2 == "") {
			alert("Chưa mật khẩu ");
			mk1.focus();
			return false;
		}
		if (mk1 != mk2) {
			alert("mật khẩu không  ");
			mk1.focus();
			return false;
		}
		return true;
	}

	function checkMK2(mk2) {
		var mk1 = $("#Password1").val();

		if (mk1 != mk2) {
			$("#tb2").show();
		} else {
			$("#tb2").hide();
		}
	}

	function checkMK1(mk1) {

		if (!/[a-z0-9]{7,20}$/.test(mk1)) {
			$("#tb1").show()
		} else {
			$("#tb1").hide()
		}
	}
</script>

</html>
<?php
require_once('./DataProvider.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (!isset($_POST['loai'])) {
		header("location:index.php");
		exit();
	}
	$loai = $_POST['loai'];

	switch ($loai) {
		case 'doimk':
			if (doimk()) {
				echo '<script>alert("đổi mật khẩu thành công")</script>';
			}
			else{
				echo '<script>alert("đổi mật khẩu thất bại")</script>';
			}
			break;
		default:
			header("location:index.php");
			exit();
			break;
	}
}

function doimk()
{
	$tk = $_POST['UserName'];
	$mk = $_POST['Password'];
	$mk1 = $_POST['Password1'];
	$sql = "SELECT * FROM user WHERE UserName = '" . $tk . "' AND Password = '" . $mk . "'";
	$res = query($sql);
	
	if (count($res) <= 0) {
		return false;
	}
	$sql = 'UPDATE user 
	SET Password="' . $mk1 . '"
	WHERE UserName="' . $tk . '" AND Password="' . $mk . '"';
	
	$res = query($sql);
	return $res;
}
?>