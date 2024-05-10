<?php
include("./DataProvider.php");
$ten = $_REQUEST['ten'];

$sql = "SELECT * FROM sanpham WHERE SLTon>0 AND TenSP LIKE '%" . $ten . "%' Limit 0, 20";
?>
<?php
$res = query($sql);
$count = count($res);
for ($i = 0; $i < $count; $i++) {

    $row = $res[$i]; ?>

    <a class="text-decoration-none row p-2" href="chitietsp.php?id=<?php echo $row["MaSP"]; ?>">
        <img src="<?php echo $row['Image']; ?>" class="col-2" alt="" srcset="">
        <div class="container col-10">
            <div><?php echo $row['TenSP']; ?></div>
            <div><strong><?php echo number_format($row['DonGia']); ?></strong></div>
        </div>
    </a>
<?php } ?>