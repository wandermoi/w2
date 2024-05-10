<?php
require 'DataProvider.php';
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['diachi']) && isset($_POST['dienthoai']) && isset($_POST['email'])) {
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$diachi = mysqli_real_escape_string($conn, $_POST['diachi']);
	$dienthoai = mysqli_real_escape_string($conn, $_POST['dienthoai']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$hoten = mysqli_real_escape_string($conn, $_POST['hoten']);

	$sql = 'SELECT * FROM user WHERE UserName="' . $username . '"';
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		echo "<script>alert('Tên đăng nhập đã tồn tại')</script>";
		echo "<script>location.href='dangky.php'</script>";
	} else {
		$sql = 'INSERT INTO 
		user( UserName, Password, DiaChi, Email, SDT, Quyen, TrangThai, tenKH) 
		VALUES ("' . $username . '","' . $password . '","' . $diachi . '","' . $email . '","' . $dienthoai . '","customer","1","' . $hoten . '")';
		$result = mysqli_query($conn, $sql);
		if ($result) {
			header("Location:dangnhap.php");
		} else {
			header("Location:dangky.php.php");
		}
	}
}
