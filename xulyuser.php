<?php
require_once("checksame.php");
session_start();

$loai = $_POST['loai'];
if (isset($loai)) {
	switch ($loai) {
		case "insert": // insert
			if (insert())

				header('Location:quanlyaccount.php');
			else
				header('Location:themuser.php?loi=1');
			break;

		case "update": // UPDATE
			if (update())
				header('Location:quanlyaccount.php');
			// echo $query;
			else
				header('Location:suauser.php?loi=1');
			break;

		case "DELETE": // DELETE
			if (delete())
				header('Location:quanlyaccount.php');
			else
				header('Location:body.php');
			break;
		default: 
			header('Location:quanlyaccount.php');
			break;
	}
}


function insert()
{
	require_once('DataProvider.php');

	$username = $_REQUEST['txtUser'];
	$password = $_REQUEST['txtPass'];
	$Diachi = $_REQUEST['txtDiachi'];
	$Email = $_REQUEST['txtEmail'];
	$Quyen = $_REQUEST['txtquyen'];
	$SDT = $_REQUEST['txtSDT'];

	if (Co_Tk($username)) {

		header('Location:themuser.php?tb=TrungTk');
		return false;
		
	}
	$sql = "INSERT INTO `user` ( `UserName`, `Password`, `DiaChi`, `Email`,`Quyen`,`SDT`,`TrangThai`) 
	VALUES(" . "'" . $username . "'," .
		"'" . $password . "'," .
		"'" . $Diachi . "'," .
		"'" . $Email . "'," .
		"'" . $Quyen . "'," .
		"'" . $SDT . "'," .
		"'" . '1' . "')";
	$result = query($sql);
	return $result;
}


//trả về true || false
function delete()
{
	//Lấy makhachhang từ trong function ktxoa()
	$us = $_REQUEST['username'];
	require_once('DataProvider.php');

	$sql = "DELETE FROM user WHERE UserName= '$us'";
	$result = query($sql);
	return $result;
}

function update()
{
	$username = $_REQUEST['txtUser'];
	$Diachi = $_REQUEST['txtDiachi'];
	$Email = $_REQUEST['txtEmail'];
	$password = $_REQUEST['txtPass'];
	$Diachi = $_REQUEST['txtDiachi'];
	$Email = $_REQUEST['txtEmail'];
	$Quyen = $_REQUEST['txtquyen'];
	$SDT = $_REQUEST['txtSDT'];
	// giả sử dữ liệu đúng

	require_once('DataProvider.php');

	$sql = 'UPDATE user 
	SET Password="' . $password . '",
	DiaChi="' . $Diachi . '",Email="' . $Email . '",SDT="' . $SDT . '",Quyen="' . $Quyen . '"
	WHERE UserName="' . $username . '"';
	

	// lỗi	
	return query($sql);
}
