<?php
$ma = $_GET["id"];
$sql = "SELECT * FROM sanpham WHERE MaSP = '" . $ma . "'";
$r = query($sql)[0];

?>
<h3>
  <h4>Thông số kỹ thuật</h4>
</h3>
<ul class="thongso-1">
  <li class="row my-3">
    <span>Màn hình:</span>
    <div id="manhinh"> <?php echo ' '.$r['manhinh'] ?> inch</div>
  </li>
 
  <li class="row my-3">
    <span>Camera sau:</span>
    <div id="camsau"> 13 MP</div>
  </li>
  <li class="row my-3">
    <span>Camera trước:</span>
    <div id="camtruoc"> 5 MP</div>
  </li>
  
  <li class="row my-3">
    <span>RAM:</span>
    <div id="ram"> <?php echo ' '.$r['ram'] ?></div>
  </li>
  <li class="row my-3">
    <span class="">Bộ nhớ trong:</span>
    <div id="bonho"> <?php echo ' '.$r['bonhotrong'] ?></div>
  </li>
  <li class="row my-3" id="divthenho">
    <span>Nhu cầu sủ dụng :</span>
    <div id="thenho"><?php echo' '. $r['nhucau'] ?></div>
  </li>
  <li class="row my-3">
    <span>Thẻ SIM:</span>
    <div id="sim"> 2 Nano SIM, Hỗ trợ 4G</div>
  </li>
  <li class="row my-3">
    <span>Dung lượng pin: </span>
    <div id="pin"> <?php echo ' '.$r['pin'] ?> mAh</div>
  </li>

</ul>