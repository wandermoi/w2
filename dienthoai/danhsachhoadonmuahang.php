<?php
include("config.php");

if ($_SESSION['Quyen'] != 'customer') {

    exit();
}
$pageNum = 1;
$TinhTrangDonHang = "";
$sta = "1977-12-12";
$fin = "2024-05-10";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $sta = $_REQUEST['sta'];
    $fin = $_REQUEST['fin'];
}
$offset = 0;
if (isset($_REQUEST["page"])) {
    $pageNum = $_REQUEST["page"];
}
if (isset($_REQUEST['TinhTrangDonHang'])) {
    $TinhTrangDonHang = $_REQUEST['TinhTrangDonHang'];
}


?>
<div class="container h-min">
    <form action="body.php?action=danhsachhoadonmuahang" class="row align-items-center" method="post">
        <div class="form-group col-4">
            <label for="sta">Ngày bắt đầu</label>
            <input id="sta" name="sta" type="date" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group col-4">
            <label for="fin">Ngày kết thúc</label>
            <input id="fin" name="fin" type="date" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="col-4 form-group">
            <label for="TinhTrangDonHang">trạng thái đơn hàng</label>
            <select name="TinhTrangDonHang" id="TinhTrangDonHang" class="form-control">
                <option value="" selected>tất cả hóa đơn</option>
                <?php
                foreach ($trangthaiDH as $key => $value) {
                    if ($key == $TinhTrangDonHang) {
                        echo ' <option selected value="' . $key . '">' . $value . '</option>';
                    } else {
                        echo ' <option value="' . $key . '">' . $value . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <br>
        <input class="btn btn-primary mx-2" type="submit" value="lọc">
    </form>

    <table class="table table-hover table-responsive-md table-condensed col-md-12">
        <thead class="thead-dark">
            <tr>
                <th class="text-center" scope="col">Mã hóa đơn</th>
                <th class="text-center" scope="col">Ngày đặt</th>
                <th class="text-center" scope="col">Tổng tiền</th>
                <th class="text-center" scope="col">Tình trạng</th>
                <th class="text-center" scope="col">Thanh toán</th>
                <th class="text-center" scope="col">Xem chi tiết</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                $offset = ($pageNum * 10) - 10;
                $sql = "SELECT * 
                FROM hoadon, donhang 
                WHERE hoadon.MaHoaDon=donhang.MaHoaDon AND donhang.TinhTrangDonHang like '%" . $TinhTrangDonHang . "%' AND UserName = '" . $_SESSION["member"] . "'
                AND donhang.ngayhoanthanh BETWEEN '" . $sta . "' AND '" . $fin . "'
                ORDER BY donhang.ngayhoanthanh DESC
                limit $offset,10";


                $result = mysqli_query($conn, $sql);
                $maxPage = mysqli_num_rows($result);
                $i = 1;
                while ($row = mysqli_fetch_array($result)) {

                    $MahoaDon = $row['MaHoaDon'];
                    $NgayDatHang = $row['NgayDatHang'];
                    $Phuongthucnhahang = $PhuongthucnhahangArray[$row['Phuongthucnhahang']];
                    $TongTien = number_format($row['TongTien']);
                    $PhiVanChuyen = $row['PhiVanChuyen'];
                    $TinhTrangDonHang1 = $row['TinhTrangDonHang'];
                    $t = $row['trangthaithanhtoan'];
                    echo '
                    <tr>
                        
                        <th class="text-center" scope="col">' . $MahoaDon . '</th>
                        <th class="text-center" scope="col">' . $NgayDatHang . '</th>
                        <th class="text-center" scope="col">' . $TongTien . '</th>
                        <th class="text-center" scope="col">' . $trangthaiDH[$TinhTrangDonHang1] . '
                        <th class="text-center" scope="col">' . $trangthaithanhtoan[$t] . '
                        <th class="text-center " scope="col">
                            <a href=body.php?action=chitietdonhang&MahoaDon=' . $MahoaDon . '>
                            xem chi tiết
                            </a>
                        </th>
                    </tr>';
                    $i++;
                }
                ?>
            </tr>
        </tbody>
    </table>
    <?php
    $sql = "SELECT COUNT(*) AS numrows FROM hoadon, donhang 
    WHERE hoadon.MaHoaDon=donhang.MaHoaDon 
    AND donhang.TinhTrangDonHang like '%" . $TinhTrangDonHang . "%' 
    AND UserName = '" . $_SESSION["member"] . "'
    AND donhang.ngayhoanthanh BETWEEN '" . $sta . "' AND '" . $fin . "'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $numrows = $row["numrows"];
    $maxPage = ceil($numrows / 10);

    $maxPage = $numrows / 10 == 0 ? $maxPage : $maxPage + 1;
    $nav  = '';
    $self = "body.php";
    $startPage = $pageNum <= 6 ? 1 : $pageNum - 6;
    $finshPage = $startPage + 10;
    for ($page = $startPage; $page <= $finshPage && $page < $maxPage; $page++) {
        if ($page == $pageNum)
            $nav .= "<span class='btn btn-primary'>" . $page . "</span>";
        else
            $nav .= " <a href=\"$self?action=danhsachhoadonmuahang&TinhTrangDonHang=" . $TinhTrangDonHang . "&sta=" . $sta . "&fin=" . $fin . "&page=" . $page . "\" class='so-trang'>$page</a> ";
    }
    ?>
</div>
<script>
    document.getElementById("sta").valueAsDate = <?php echo isset($sta) ? 'new Date("' . $sta . '")' : "new Date('1977-12-12')" ?>;
    document.getElementById("fin").valueAsDate = <?php echo isset($fin) ? 'new Date("' . $fin . '")' : "new Date()" ?>;
</script>
<?php
require_once("./phantrang.php")
?>