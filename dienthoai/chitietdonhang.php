<?php

$MahoaDon = $_GET["MahoaDon"];
$member = $_SESSION["member"];
$sql = 'SELECT * FROM hoadon WHERE hoadon.MaHoaDon="' . $MahoaDon . '"';
$result = query($sql);
if (count($result) <= 0) {
    exit;
}
$row = $result[0];
if ($member != $row["UserName"]) {
    exit;
}

$Phuongthucnhahang = $row['Phuongthucnhahang'];
$sql = 'SELECT *  FROM donhang WHERE MaHoaDon="' . $MahoaDon . '"';

$result = query($sql);

if (count($result) <= 0) {
    exit;
}
$row = $result[0];
$tinhtrangdonhang = $row['TinhTrangDonHang'];
$MaDonHang = $row['MaDonHang'];
$trangthaithanhtoanS = $row['trangthaithanhtoan'];
?>
<div class="container">
    <table id="cart" class="table table-hover table-condensed col-md-12">
        <thead>
            <tr>
                <th style="width:50%" class="text-center">Tên sản phẩm</th>
                <th style="width:10%">Giá</th>
                <th style="width:8%">Số lượng</th>
                <th style="width:22%" class="text-center">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = 'SELECT sanpham.TenSP as TenSP,sanpham.Image as Image ,chitiethoadon.SoLuong as SoLuong,chitiethoadon.DonGia as DonGia 
                FROM chitiethoadon, sanpham
                WHERE MaHoaDon="' . $MahoaDon . '" AND chitiethoadon.MaSp=sanpham.MaSP';
            $result = query($sql);

            $tongtien = 0;
            for ($i = 0; $i < count($result); $i++) {
                $row = $result[$i];
                $TenSP = $row["TenSP"];
                $Image = $row["Image"];
                $SoLuong = $row["SoLuong"];
                $DonGia = $row["DonGia"];
                $tongtien += $DonGia * $SoLuong;
                echo '
                    <tr> 
                        <td data-th="Product"> 
                            <div class="row"> 
                            <div class="col-sm-3 hidden-xs "><img src="' . $Image . '" alt="Sản phẩm 1" class="img-responsive" width="100">
                            </div> 
                            <div class="col-sm-9"> 
                            <h4 class="nomargin ">' . $row["TenSP"] . '</h4> 
                            </div> 
                            </div> 
                        </td> 
                        <td data-th="Price">' . number_format($DonGia) . 'đ
                        </td> 
                        <td data-th="Quantity">' . $SoLuong . '</td> 
                        <td data-th="Subtotal" class="text-center">' . number_format($DonGia * $SoLuong) . 'đ</td> 
                        </td> 
                    </tr>';
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td>
                    Tình trạng đơn hàng:
                    <strong>
                        <?php
                        echo $trangthaiDH[$tinhtrangdonhang]; ?>
                    </strong>
                </td>
            </tr>
            <tr>
                <td>
                    Cách nhận hàng:
                    <strong>
                        <?php
                        echo $PhuongthucnhahangArray[$Phuongthucnhahang]; ?>
                    </strong>
                </td>
            </tr>
            <tr>
                <td>
                    Thanh toán:
                    <strong>
                        <?php
                        require_once("./config.php");
                        echo $trangthaithanhtoan[$trangthaithanhtoanS] ?>
                    </strong>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="body.php?action=danhsachhoadonmuahang" class="btn btn-primary"><i class="fa fa-angle-left"></i> danh sách hóa đơn</a>
                </td>
                <td colspan="2" class="hidden-xs"> </td>
                <td class="text-center">
                    <strong>
                        <?php
                        echo 'Tổng tiền:  ' . number_format($tongtien) . 'đ';
                        ?>
                    </strong>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="hidden-xs"> </td>
                <td>
                    <?php
                    if ($tinhtrangdonhang == "chuagiao") {
                        echo '<button class="btn btn-warning" onclick=\'active_inactive_user("khongnhan","' . $MaDonHang . '")\'>Không nhận đơn hàng</button>';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="3">

                    <?php if ($trangthaithanhtoanS == 'chuathanhtoan') { ?>
                        <form action="vn_pay.php?loai=createPay" method="post">
                            <input type="hidden" name="tongtien" value="<?php echo $tongtien; ?>">
                            <input type="hidden" name="MaHoaDon" value="<?php echo  $MahoaDon; ?>">
                            <input type="hidden" name="MaDonHang" value="<?php echo  $MaDonHang; ?>">
                            <button class="btn btn-danger">Thanh toán hóa đơn</button>
                        </form>
                    <?php } else { ?>
                        <button class="btn btn-priamry"><?php echo $trangthaithanhtoan[$trangthaithanhtoanS] ?></button>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    $sql = "SELECT * FROM vnpay WHERE MaDonHang='" . $MaDonHang . "'";
                   
                    if ($trangthaithanhtoanS == 'dathanhtoan') {
                        $result = query($sql)[0];
                    ?>

                        <div class="form-group">
                            <label>Nội dung thanh toán:</label>
                            <label><?php echo $result['noidungthanhtoan'] ?></label>
                        </div>
                        <div class="form-group">
                            <label>Mã GD Tại VNPAY:</label>
                            <label><?php echo $result['magiaodichVnpay'] ?></label>
                        </div>
                        <div class="form-group">
                            <label>Mã Ngân hàng:</label>
                            <label><?php echo $result['maBank'] ?></label>
                        </div>
                        <div class="form-group">
                            <label>Thời gian thanh toán:</label>
                            <label><?php echo $result['ngay'] ?></label>
                        </div>
                    <?php } ?>
                </td>
            </tr>
        </tfoot>
    </table>
    <div class="">

    </div>
</div>
<script src="js/thaydoitrangthai.js"></script>