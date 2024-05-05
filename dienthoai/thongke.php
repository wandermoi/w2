<?php require("DataProvider.php"); session_start()?>
<!DOCTYPE html>
<html lang="en">
<?php

$kieuthongkeArray = array("tang" => "Sắp sếp tăng", "giam" => "Sắp sếp giảm");
$loaithongkeAray = array("ds" => "Số lượng bán", "tien" => "Tiền bán", "slton" => "Số lượng tồn kho");
$sql = '';

$sqltanggiam = array("tang" => "ASC", "giam" => "DESC");

$loaithongke = "ds";
$kieuthongke = "tang";
$loaisanpham = "";

$sl = 10;
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $sta = $_POST['sta'];
    $fin = $_POST['fin'];

    $kieuthongke = $_POST['kieuthongke'];
    $loaithongke = $_POST['loaithongke'];
    $loaisanpham = $_POST['loaisanpham'];
    $sl = $_POST['sl'];

    $slgoi = $sl + 100;


    switch ($loaithongke) {
        case 'tien':
            $sql = 'SELECT sanpham.TenSP as x , SUM(chitiethoadon.SoLuong*chitiethoadon.DonGia) as y
            FROM chitiethoadon,sanpham,donhang
            WHERE chitiethoadon.MaHoaDon=donhang.MaHoaDon 
            AND chitiethoadon.MaSP=sanpham.MaSP 
            AND donhang.TinhTrangDonHang = "ht" 
            AND sanpham.MaLoaiSP LIKE "%' . $loaisanpham . '%"
            AND donhang.MaDonHang in (SELECT d1.MaDonHang
            FROM donhang as d1
            WHERE d1.ngayhoanthanh BETWEEN "' . $sta . '" AND "' . $fin . '" AND d1.TinhTrangDonHang="ht")
            GROUP BY x
            ORDER BY y ' . $sqltanggiam[$kieuthongke] . ' Limit ' . $slgoi;
            break;
        case 'slton':
            $sql= 'SELECT TenSP as x,SLTon as y
            FROM sanpham
            WHERE trangthai > 0
            ORDER BY y ' . $sqltanggiam[$kieuthongke] . ' Limit ' . $slgoi;
            
            break;
        default:
            $sql = 'SELECT sanpham.TenSP as x, SUM(chitiethoadon.SoLuong) as y
            FROM chitiethoadon,sanpham,donhang
            WHERE chitiethoadon.MaHoaDon=donhang.MaHoaDon 
            AND chitiethoadon.MaSP=sanpham.MaSP 
            AND donhang.TinhTrangDonHang = "ht" 
            AND sanpham.MaLoaiSP LIKE "%' . $loaisanpham . '%"
            AND donhang.MaDonHang in (SELECT d1.MaDonHang
            FROM donhang as d1
            WHERE d1.ngayhoanthanh BETWEEN "' . $sta . '" AND "' . $fin . '" AND d1.TinhTrangDonHang="ht")
            GROUP BY x
            ORDER BY y ' . $sqltanggiam[$kieuthongke] . ' Limit ' . $slgoi;

            break;
    }
}
?>

<head>
    <?php include("css.php"); ?>
</head>

<body>
    <?php
    include("./naviagte.php");
    ?>
    <div class="d-flex flex-wrap">
        <?php include("./headerAdmin.php"); ?>
        <div>
            <h2> Thống kê</h2>
            <div class="container mb-5">
                <form action="thongke.php" class="row align-items-center" method="post">
                    <div class="form-group col-6">
                        <label for="sta">Ngày bắt đầu</label>
                        <input id="sta" name="sta" type="date" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group col-6">
                        <label for="fin">Ngày kết thúc</label>
                        <input id="fin" name="fin" type="date" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="col-3 form-group">
                        <label for="loaisanpham">Loại sản phẩm</label>
                        <select name="loaisanpham" id="loaisanpham" class="form-control">
                            <option selected value="">Tất cả loại sản phẩm</option>
                            <?php
                            $sqllsp = "SELECT * FROM loaisp";
                            $result = query($sqllsp);
                            echo $sqllsp;

                            for ($i = 0; $i < count($result); $i++) {
                                if ($loaisanpham == $result[$i]['MaLoaiSP']) {
                                    echo ' <option selected value="' . $result[$i]['MaLoaiSP'] . '">' . $result[$i]['TenLoaiSP'] . '</option>';
                                } else {
                                    echo ' <option value="' . $result[$i]['MaLoaiSP'] . '">' . $result[$i]['TenLoaiSP'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-3 form-group">
                        <label for="kieuthongke">Kiểu thông kê</label>
                        <select name="kieuthongke" id="kieuthongke" class="form-control">
                            <?php
                            foreach ($kieuthongkeArray as $key => $value) {
                                if ($key == $kieuthongke) {
                                    echo ' <option selected value="' . $key . '">' . $value . '</option>';
                                } else {
                                    echo ' <option value="' . $key . '">' . $value . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-3 form-group">
                        <label for="loaithongke">Loại thông kê</label>
                        <select name="loaithongke" id="loaithongke" class="form-control">
                            <?php
                            foreach ($loaithongkeAray as $key => $value) {
                                if ($key == $loaithongke) {
                                    echo ' <option selected value="' . $key . '">' . $value . '</option>';
                                } else {
                                    echo ' <option value="' . $key . '">' . $value . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-3 form-group">
                        <label for="date">Số cột hiển thị</label>
                        <input class="form-control" type="number" name="sl" placeholder="Số cột hiển thị" value="10">
                    </div>

                    <input class="btn btn-primary mx-2" type="submit" value="lọc">
                </form>
            </div>
            <?php
            
            if (empty($sql)) {
                $sql = 'SELECT sanpham.TenSP as x, SUM(chitiethoadon.SoLuong) as y 
                FROM chitiethoadon,sanpham,donhang 
                WHERE chitiethoadon.MaHoaDon=donhang.MaHoaDon 
                AND chitiethoadon.MaSP=sanpham.MaSP 
                AND donhang.TinhTrangDonHang = "ht" 
                AND sanpham.MaLoaiSP LIKE "%%" 
                AND donhang.MaDonHang in (SELECT d1.MaDonHang FROM donhang as d1 WHERE d1.ngayhoanthanh BETWEEN "1977-12-12" AND "2023-05-10" AND d1.TinhTrangDonHang="ht") GROUP BY x ORDER BY y ASC
                        Limit 100';
            }
            $result = query($sql);
            $data = [];
            for ($i = 0; $i < $sl  and $i < count($result); $i++) {
                $temp = array(
                    "x" => $result[$i]['x'],
                    "y" => $result[$i]['y']
                );
                array_push($data, $temp);
            }
            $i = 0;


            ?>

            <div class=" row justify-content-end">
                <button onclick="anchart()" class="btn btn-primary anchart">Ẩn biểu đồ</button>
                <button onclick="hienchart()" class="hidden btn btn-primary hienchart">Hiện biểu đồ</button>
            </div>
            <div class="chart">
                <button class="btn btn-primary mr-3" onclick="changeChart('line')">Biểu đồ đường</button>
                <button class="btn btn-primary" onclick="changeChart('bar')">Biểu đồ cột</button>
                <canvas class="w-100" id="myChart"></canvas>
            </div>
            <div class=" row justify-content-end mt-4">
                <button onclick="anbang()" class="btn btn-primary anbang">Ẩn bảng</button>
                <button onclick="hienbang()" class="hidden btn btn-primary hienbang">Hiện bảng</button>
            </div>
            <div class="table">
                <h3 class="text-center"> Bảng thống kê </h3>
                <table class="table table-striped mytable">
                    <thead>
                        <tr>
                            <th>Số thứ tự</th>
                            <th></th>
                            <th>Số lượng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($result); $i++) {
                            $stt = $i + 1;
                            echo '
                        <tr>
                            <td>' . $stt . '</td>
                            <td>' . $result[$i]['x'] . '</td>
                            <td>' . $result[$i]['y'] . '</td>
                        </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
<script src="js/chart.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script>
    active_navigate('tkkd')
    const ctx = document.getElementById('myChart');
    var confi = {
        type: 'bar',
        data: {

            datasets: [{
                label: "<?php echo $loaithongkeAray[$loaithongke]; ?>",
                data: <?php echo json_encode($data); ?>,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 28
                        }
                    }
                }
            }
        }
    }
    var m = new Chart(ctx, confi);

    function changeChart(type) {
        confi.type = type;
        m.update();
    }
</script>
<script>
    document.getElementById("sta").valueAsDate = <?php echo isset($sta) ? 'new Date("' . $sta . '")' : "new Date('1977-12-12')" ?>;
    document.getElementById("fin").valueAsDate = <?php echo isset($fin) ? 'new Date("' . $fin . '")' : "new Date()" ?>;
    $('.hienchart').hide();
    $('.hienbang').hide();

    function anchart() {
        $('.chart').hide();
        $('.anchart').hide();
        $('.hienchart').show();
    }

    function hienchart() {
        $('.chart').show();
        $('.anchart').show();
        $('.hienchart').hide();
    }

    function anbang() {
        $('.table').hide();
        $('.anbang').hide();
        $('.hienbang').show();
    }

    function hienbang() {
        $('.table').show();
        $('.hienbang').hide();
        $('.anbang').show();

    }
</script>

</html>