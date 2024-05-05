<?php

$loai = $_REQUEST['loai'];


function vnpay_create_payment()
{

    require_once("./config.php");
    require_once("./DataProvider.php");

    $MaDonHang = $_REQUEST['MaDonHang'];
    $sql = "DELETE FROM vnpay WHERE MaDonHang='" . $MaDonHang . "'";
    query($sql);
    $vnp_TxnRef = date('YmdHis') . rand(1, 10000); //Mã giao dịch thanh toán tham chiếu của merchant
    $vnp_Amount = $_REQUEST['tongtien']; //$_POST['amount']; // Số tiền thanh toán
    $vnp_Locale = 'VN'; //$_POST['language']; //Ngôn ngữ chuyển hướng thanh toán
    //$vnp_BankCode = 'NCB'; //$_POST['bankCode']; //Mã phương thức thanh toán
    $vnp_IpAddr = '127.0.0.1'; //$_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán
    $vnp_OrderInfo = "Thanh toan GD:" .$vnp_TxnRef;
    $createDay = date('YmdHis');
    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount * 100,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => $createDay,
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => "other",
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
        "vnp_ExpireDate" => $expire
    );

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }

    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . '?' . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }

    $sql = "
    INSERT INTO 
    vnpay(MaDonHang, idvnpay, tongtien, noidungthanhtoan, magiaodichVnpay, maBank, ngay)
    VALUES ('" . $MaDonHang . "'
    ,'" . $vnp_TxnRef . "'
    ,'" . $vnp_Amount . "'
    ,'" .  $vnp_OrderInfo . "','','','" .  $createDay . "')";

    $res = query($sql);
    if (!$res) {
        echo "lỗi ";
        die();
    }
   
    header('Location: ' . $vnp_Url);
}

function vnpay_return()
{
    require_once("./DataProvider.php");
    $vnp_TransactionNo = $_REQUEST["vnp_TransactionNo"];
    $vnp_BankCode = $_REQUEST['vnp_BankCode'];
    $vnp_ResponseCode = $_REQUEST['vnp_ResponseCode'];
    $vnp_TxnRef = $_REQUEST['vnp_TxnRef'];

    $sql = "SELECT donhang.MaHoaDon as MaHoaDon  FROM vnpay,donhang WHERE vnpay.MaDonHang=donhang.MaDonHang AND  idvnpay='" . $vnp_TxnRef . "'";
    $res = query($sql)[0]['MaHoaDon'];
    $sql = "UPDATE vnpay SET 
        magiaodichVnpay='" . $vnp_TransactionNo . "',maBank='" . $vnp_BankCode . "',
        trangthaivnpay='" . $vnp_ResponseCode . "' WHERE idvnpay='" . $vnp_TxnRef . "'";

    query($sql);

    $sql = "UPDATE donhang SET trangthaithanhtoan='dathanhtoan' WHERE MaHoaDon='" . $res . "'";

    if ($vnp_ResponseCode = "00") {
        query($sql);
    }
    header('Location: ' . "body.php?action=chitietdonhang&MahoaDon=" . $res);
}

switch ($loai) {
    case 'createPay':
        vnpay_create_payment();
        die();
        break;

    case 'return':
        vnpay_return();
        die();
        break;
}
