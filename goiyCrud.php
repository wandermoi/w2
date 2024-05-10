<?php $ma = $_REQUEST['masp'];
if (isset($_REQUEST['maloaisp'])) {
    $tl = $_REQUEST['maloaisp'];
} else {
    $tl = 'pk';
}
require_once("DataProvider.php");
?>
<div class="container">
    <div>
        <select name="theloai" onchange="extraProAjax(this,'<?php echo $ma ?>')" class="form-select m-2 btn text-center border">
            <?php

            $list = query('SELECT * FROM loaisp ORDER BY     MaLoaiSP ASC');
            if ($tl != "") {
                echo '<option  value="">Hãng sản xuất</option>';
            } else {
                echo '<option selected value="">Hãng sản xuất</option>';
            }

            for ($i = 0; $i < count($list); $i++) {
                if ($tl == $list[$i]['MaLoaiSP']) {
                    echo '<option selected value="' . $list[$i]['MaLoaiSP'] . '">' . $list[$i]['TenLoaiSP'] . '</option>';
                    continue;
                }
                echo '<option value="' . $list[$i]['MaLoaiSP'] . '">' . $list[$i]['TenLoaiSP'] . '</option>';
            }
            ?>
        </select>
    </div>
    <?php
    $sql = "SELECT * FROM goiy,sanpham WHERE sanphamphu=sanpham.MaSP AND goiy.sanphamchinh =$ma AND sanpham.MaLoaiSP='$tl'  ";
    $rew = query($sql);

    $sql = "SELECT * FROM sanpham WHERE MaLoaiSP='$tl' AND sanpham.MaSP NOT IN (SELECT sanphamphu FROM goiy WHERE sanphamchinh = '$ma')";
    $rew2 = query($sql);
    ?>
    <div class="row py-5 goiy">
        <?php if (count($rew) > 0) { ?>
            <h4 class="col-12">Các sản phẩm gợi ý</h4>
        <?php } ?>
        <?php for ($i = 0; $i < count($rew); $i++) {
            $re = $rew[$i]; ?>
            <div class="sp" id="sp<?php echo $i ?>">
                <div class=" box">
                    <div class="hinh-sp">
                        <img class=" hinh" src="<?php echo $re['Image'] ?>">
                    </div>
                    <p class="tensp"><?php echo $re['TenSP'] ?></p>

                </div>

                <div class="them-vao-gio-hang">
                    <button class="btn btn-primary" onclick=xlgoiy(<?php echo $ma ?>,<?php echo $re['MaSP'] ?>,"xoa")> Xóa gợi ý <i class="fa fa-cart-plus"></i>
                    </button>
                </div>
            </div>
        <?php } ?>

        <?php if (count($rew2) > 0) { ?>
            <h4 class="col-12">Thêm sản phẩm gợi ý</h4>
        <?php } ?>

        <?php

        for ($j = 0; $j < count($rew2); $j++) {
            $re = $rew2[$j]; ?>
            <div class="sp" id="sp<?php echo $i ?>">
                <div class="box" style="height: 350px;">
                    <div class="hinh-sp">
                        <img class=" hinh" src="<?php echo $re['Image'] ?>">
                    </div>
                    <p class="tensp"><?php echo $re['TenSP'] ?></p>
                </div>
                <div class="them-vao-gio-hang">
                    <button class=" btn btn-primary" onclick=xlgoiy(<?php echo $ma ?>,<?php echo $re['MaSP'] ?>,"add")> Thêm gợi ý<i class="fa fa-cart-plus"></i>
                    </button>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php

    ?>
</div>