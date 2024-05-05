<?php
$quuyen = $_SESSION['Quyen'];
switch ($quuyen) {
    case 'master':
?>
        <div class="col-md-2 d-none d-md-block bg-light sidebar ">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">

                </li>
                <li>
                    <a class="nav-link link-body-emphasis qltk" href="quanlyaccount.php">Quản lý tài khoản</a>
                </li>
                <li>
                    <a class="nav-link link-body-emphasis qlhd" href="quanlyhoadon.php">Quản lý hóa đơn</a>
                </li>
                <li>
                    <a class="nav-link link-body-emphasis qlsp" href="quanlysp.php">Quản lý sản phẩm</a>
                </li>
                <li>
                    <a class="nav-link link-body-emphasis qllsp" href="quanlyLoaiSP.php">Quản lý loại sản phẩm</a>
                </li>
                <li>
                    <a class="nav-link link-body-emphasis tkkd" href="thongke.php">thống kê kinh doanh</a>
                </li>
            </ul>
        </div>
    <?php
        break;
    case 'nvdd';
    ?>
        <div class="col-md-2 d-none d-md-block bg-light sidebar ">
            <ul>
                <li class="nav nav-pills flex-column mb-auto">
                    <a class="nav-link link-body-emphasis qlhd" href="quanlyhoadon.php">Quản lý hóa đơn</a>
                </li>
            </ul>
        </div>

    <?php
        break;
    case 'nvqlkho':
    ?>
        <div class="col-md-2 d-none d-md-block bg-light sidebar ">
            <ul>
                <li class="nav nav-pills flex-column mb-auto">
                    <a class="nav-link link-body-emphasis qlhd" href="quanlysp.php">Quản lý sản phẩm</a>
                </li>
            </ul>
        </div>
<?php
        break;
}
?>