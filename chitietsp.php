<!DOCTYPE html>
<html>

<?php include('css.php'); ?>

<body style="font-family: Helvetica Neue, Arial, sans-serif">
    <?php require "./header.php"; ?>
    <div class="phantrang">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <?php
                $ma = $_GET["id"];
                $sql = "SELECT * FROM sanpham WHERE MaSP = '" . $ma . "'";
                $result = query($sql);
                if (count($result) > 0) {
                    $row = $result[0]; ?>
                    <?php if ($row['loai'] == 0) { ?>
                        <img class="col-3" style="height:fit-content ;" src="<?php echo $row["Image"] ?>">
                        <div class="col-3 p-3 mr-2">
                            <div class="d-flex align-items-start flex-column" style="height: 450px;">
                                <h3 id="tensp"><?php echo $row["TenSP"]; ?></h3>
                                <h3 id="tensp"><?php echo number_format($row["DonGia"]); ?>Đ</h3>
                                <div class="mt-auto p-2">
                                    <h5>Số lượng: <?php echo $row['SLTon'] ?></h5>

                                    <button class="btn btn-primary" id="<?php echo $row['MaSP'] ?>">
                                        <b>Thêm vào giỏ hàng </b>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <?php include("thongsokythuat.php"); ?>
                        </div>
                    <?php } else { ?>
                        <div class="col-6 d-flex justify-content-end">
                            <img class="col-7" style="height: auto ;" src="<?php echo $row["Image"] ?>">
                        </div>
                        <div class="col-5 p-3 mr-2">
                            <div class="d-flex align-items-start flex-column" style="height: 450px;">
                                <h3 id="tensp"><?php echo $row["TenSP"]; ?></h3>
                                <h3 id="tensp"><?php echo number_format($row["DonGia"]); ?>Đ</h3>
                                <div class="mt-auto p-2">
                                    <h5>Số lượng: <?php echo $row['SLTon'] ?></h5>
                                    <button class="btn btn-primary" id="<?php echo $row['MaSP'] ?>">
                                        <b>Thêm vào giỏ hàng </b>
                                    </button>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
        <?php include('./goiy.php') ?>
    </div>
    <?php
    include("footter.php")
    ?>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        $("#<?php echo $row['MaSP']; ?>").click(function() {
            var id = $("#<?php echo $row['MaSP']; ?>").attr("id");
            $.ajax({
                type: "POST",
                url: "addcard.php",
                data: {
                    id: id
                },
                cache: false,
                success: function(result) {
                    alert("Sản phẩm đa được thêm vào giỏ hàng");
                    
                }
            });
        });
    });
</script>

</html>