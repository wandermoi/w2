<?php 
	require('DataProvider.php');
	// echo $_POST['val'];
	// echo $_POST['makhachhang'];
	$query=mysqli_query($conn, "UPDATE `user` SET `TrangThai` = '".$_POST['val']."'WHERE 
		`MaKhachHang` ='".$_POST['makhachhang']."'");

	if($query)
	{
		//echo "seccess";
		$q=mysqli_query($conn, "SELECT * FROM `user` WHERE `MaKhachHang` = '".$_POST['makhachhang']."' ");
		$data=mysqli_fetch_assoc($q);
		echo $data['TrangThai'];
	}
?>