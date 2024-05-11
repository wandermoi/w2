<?php session_start();
if (isset($_SESSION['Quyen']) && $_SESSION['Quyen']!= 'customer' && $_SESSION['Quyen'] != "") {
    header("location:quanlysp.php");
    exit();
}

?>
<!DOCTYPE html>
<html>

<?php include("css.php") ?>

<body style="font-family: Helvetica Neue, Arial, sans-serif" class="h-min">
    <?php
    include("header.php");
    ?>
    <div class="phantrang">
        <img class="w-100" src="./Images/MHDDesktop-1920x580-6.jpg" alt="" srcset="">

        <div class="w mx-auto">
            <?php
            $sql = 'SELECT COUNT(*) as s, loaisp.MaLoaiSP as MaLoaiSP, loaisp.TenLoaiSP as TenLoaiSP
                    FROM loaisp, sanpham 
                    WHERE loaisp.MaLoaiSP= sanpham.MaLoaiSP AND sanpham.trangthai = 1 
                    GROUP BY loaisp.MaLoaiSP 
                    HAVING s>8 LIMIT 0,6';
            $data = query($sql);
            $i;


            for ($i = 0; $i < count($data); $i++) {
                $row = $data[$i];
                $MaLoaiSP = $row['MaLoaiSP'];
                $TenLoaiSP = $row['TenLoaiSP'];

                echo '
                <div>    
                <h2 class="font-weight-bold px-3 ">
                    <a href="body.php?theloai=' . $MaLoaiSP . '&page=1">' . $TenLoaiSP . '</a>
                </h2>
                </div>
                <div class="d-flex flex-wrap">
                ';
                $sql = 'SELECT * FROM sanpham WHERE trangthai = 1 AND SLTon > 0 And MaLoaiSP LIKE "' . $MaLoaiSP . '" LIMIT 0,8';
                $listSP = mysqli_query($conn, $sql);
                $data1 = query($sql);

                for ($j = 0; $j < count($data1); $j++) {
                    $rowSP = $data1[$j];
                    $TenSP = $rowSP['TenSP'];
                    $DonGia = $rowSP['DonGia'];
                    $Image = $rowSP['Image'];
                    $MaSP = $rowSP["MaSP"];
                    $slton = $rowSP['SLTon'];
                    echo ' 
                                <div class="sp" title="Xem chi tiết sản phẩm">
                                    <a href="chitietsp.php?id=' . $MaSP . '" class="box" >
                                        <div class="hinh-sp">
                                            <img class="hinh" src="' . $Image . '">
                                        </div>
                                        <p class="tensp"> ' . $TenSP . ' </p>
                                        <p class="dongia"> ' . number_format($DonGia) . ' Đ </p>
                                    </a>
                                    <p class="dongia"> Số lượng còn:' . $slton . '</p>
                                    <div>
                                        <button class="them" onclick=addcard("' . $MaSP . '")>
                                            Thêm
                                            <i class=" fa fa-cart-plus"></i>
                                        </button>
                                    </div>
                                </div>';
                }
                echo '
                </div >
               ';
            }
            ?>
        </div>
    </div>
    <footer class="page-footer font-small unique-color-dark" style="background-color: #ffffb3">

        <div class="container text-center text-md-left mt-5">

            <div class="row mt-3">

                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase font-weight-bold">Thế giới di động</h6>
                    <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p>Tích điểm Quà tặng VIP</p>
                    <p>Lịch sử mua hàng</p>
                    <p>Tìm hiểu về mua trả góp</p>
                    <p>Chính sách bảo hành</p>
                </div>

                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase font-weight-bold">CHĂM SÓC KHÁCH HÀNG</h6>
                    <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p>Hostlite:1800 0081</p>
                    <p>Email: bandienthoai@phone.com</p>
                    <p>Giờ mở cửa: 8h-20h</p>
                    <p>Liên hệ bán hàng: 1800 0000</p>
                </div>

                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase font-weight-bold">HƯỚNG DẪN MUA HÀNG</h6>
                    <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p>Chính sách bảo mật</p>
                    <p>Quy chế hoạt động</p>
                    <p>Đổi hàng trong 7 ngày</p>
                    <p>Tài khoản giao dịch</p>
                </div>

                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase font-weight-bold">Liên hệ</h6>
                    <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p><i class="fa fa-home mr-3"></i>Địa chỉ: 99 An Dương Vương Phường 16 Quận 8 HCM</p>
                    <p><i class="fa fa-envelope mr-3"></i>web2@phone.com</p>
                    <p><i class="fa fa-phone mr-3"></i> + 01 234 567 88 </p>
                    <p><i class="fa fa-print mr-3"></i> + 01 234 567 89</p>
                </div>

            </div>

        </div>

        <div class="footer-copyright text-center py-3" style="background-color: #ffff4d ">© 2021 Copyright:
            Thegioididong.com
        </div>

    </footer>
</body>
<script type="text/javascript">
    function addcard(id) {
        $.ajax({
            type: "POST",
            url: "addcard.php",
            data: {
                id: id
            },
            cache: false,
            success: function(result) {
                alert("Sản phẩm đã được thêm vào giỏ hàng");

            }
        });
    }
</script>

</html>
