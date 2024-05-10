<?php
if (!isset($_SESSION['Quyen'])) {
    $_SESSION['Quyen'] = "";
}
if ($_SESSION['Quyen'] == "customer" || $_SESSION['Quyen'] == "") {
    header("location:index.php");
    exit();
}
?>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <img src="./Images/logo1.png" style="height: 70px" alt="" srcset="">
    <div class="btn-group">
        <div class="btn-group dropleft" role="group">
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only"><?php echo  $_SESSION['member']; ?></span>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="logout.php">Thoát</a>
                <a class="dropdown-item" href="body.php?action=thongtincanhan">Xem thông tin cá nhân</a>
                <a class="dropdown-item" href="body.php?action=danhsachhoadonmuahang">Xem danh sách đơn hàng</a>
            </div>
        </div>
        <button type="button" class="btn btn-primary">
            <span class=""><?php echo  $_SESSION['member']; ?></span>
        </button>
    </div>
</nav>
<script>
    function active_navigate(nameClass) {
        document.querySelector(`.${nameClass}`)
            .classList.add("active")
    }
</script>