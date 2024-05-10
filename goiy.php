<?php
$ma = $_GET["id"];
$sql = "SELECT * FROM sanpham WHERE MaSP =$ma";

$sp = query($sql)[0];
if ($sp['loai'] == 1) {
} else {


    $sql = "SELECT * FROM goiy,sanpham
WHERE sanphamphu=sanpham.MaSP AND goiy.sanphamchinh =$ma AND SLTon >0  ";

    $rew = query($sql);
   

?>
    <div class="container p-0">
        <div><strong>Phụ kiện đi kèm</strong></div>
        <div class="row">
            <?php for ($i = 0; $i < count($rew); $i++) {
                $re = $rew[$i]; ?>
                <div class="sp" id="sp<?php echo $i ?>">
                    <a href="chitietsp.php?id=<?php echo  $re["MaSP"] ?>" class=" box">
                        <div class="hinh-sp">
                            <img class=" hinh" src="<?php echo $re['Image'] ?>">
                        </div>
                        <p class="tensp"><?php echo $re['TenSP'] ?></p>
                        <p class="dongia"><?php echo number_format($re['DonGia']) ?></p>
                    </a>
                    <p class="dongia"> Số lượng còn: <?php echo $re['SLTon'] ?> </p>
                    <div class="them-vao-gio-hang">
                        <button class="them" onclick=addcard(<?php echo $re['SLTon'] ?>)> Thêm <i class="fa fa-cart-plus"></i>
                        </button>
                    </div>
                </div>
            <?php } ?>
            
        </div>
    </div>
<?php } ?>