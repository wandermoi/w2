<?php
$trangthaiDH = array(
    "chuagiao" => "Chưa giao",
    "danggiao" => "Đang giao",
    "bihuy" => "Bị hủy",
    "danhan" => "Đã nhận",
    "ht" => "Hoàn thành",
    "chuanhan" => "Chưa nhận",
    "khongnhan" => "Không nhận"
);

$trangthaithanhtoan = array(
    "chuathanhtoan" => "Chưa thanh toán",
    "dathanhtoan" => "Đã thanh toán",
    "00" =>    "Giao dịch thành công",
    "07" =>    "Trừ tiền thành công. Giao dịch bị nghi ngờ (liên quan tới lừa đảo, giao dịch bất thường).",
    "09" =>    "Giao dịch không thành công do: Thẻ/Tài khoản của khách hàng chưa đăng ký dịch vụ InternetBanking tại ngân hàng.",
    "10" =>    "Giao dịch không thành công do: Khách hàng xác thực thông tin thẻ/tài khoản không đúng quá 3 lần",
    "11" =>    "Giao dịch không thành công do: Đã hết hạn chờ thanh toán. Xin quý khách vui lòng thực hiện lại giao dịch.",
    "12" =>    "Giao dịch không thành công do: Thẻ/Tài khoản của khách hàng bị khóa.",
    "13" =>    "Giao dịch không thành công do Quý khách nhập sai mật khẩu xác thực giao dịch (OTP). Xin quý khách vui lòng thực hiện lại giao dịch.",
    "24" =>    "Giao dịch không thành công do: Khách hàng hủy giao dịch",
    "51" =>    "Giao dịch không thành công do: Tài khoản của quý khách không đủ số dư để thực hiện giao dịch.",
    "65" =>    "Giao dịch không thành công do: Tài khoản của Quý khách đã vượt quá hạn mức giao dịch trong ngày.",
    "75" =>    "Ngân hàng thanh toán đang bảo trì.",
    "79" =>    "Giao dịch không thành công do: KH nhập sai mật khẩu thanh toán quá số lần quy định. Xin quý khách vui lòng thực hiện lại giao dịch",
    "99" =>    "Các lỗi khác (lỗi còn lại, không có trong danh sách mã lỗi đã liệt kê)"
);
date_default_timezone_set('Asia/Ho_Chi_Minh');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$vnp_TmnCode = "7VPICSE9"; //Mã định danh merchant kết nối (Terminal Id)
$vnp_HashSecret = "AVIMEZWBAWNRHFFEBPWTLJOWLFKOGOMP"; //Secret key
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://localhost/web2/vn_pay.php?loai=return";
//$vnp_Returnurl = "http://localhost/vnpay_php/real.php?loai=return";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
//Config input format

$startTime = date("YmdHis");
$expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));







function callAPI_auth($method, $url, $data)
{
    $curl = curl_init();
    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    // EXECUTE:
    $result = curl_exec($curl);
    if (!$result) {
        die("Connection Failure");
    }
    curl_close($curl);
    return $result;
}
