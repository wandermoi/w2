<!DOCTYPE html>
<html lang="en">

<?php  session_start(); include("css.php");?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loai = $_POST['loai'];
    switch ($loai) {
        case 'add':
            if (themloai()) {
                echo '<script>alert("thêm mới thành công")</script>';
            } else {
                echo '<script>alert("thêm mới thất bại")</script>';
            }
            break;
        case 'update':
            if (capnhat()) {
                echo '<script>alert("cập nhật thành công")</script>';
            } else {
                echo '<script>alert("cập nhật thất bại")</script>';
            }
            break;
        case 'xoa':
            if (xoa()) {
                header("location:quanlyLoaiSP.php");
            } else {
                header("location:quanlyLoaiSP.php?tb=thatbai");
            }
            exit();
        default:
            # code...
            break;
    }
}
function themloai()
{
    require_once('DataProvider.php');
    $MaLoaiSP = $_POST['MaLoaiSP'];
    $TenLoaiSP = $_POST['TenLoaiSP'];
    if (strlen($MaLoaiSP) <= 0 || strlen($TenLoaiSP) <= 0) {
        return false;
    }
    $sql = 'INSERT INTO loaisp(MaLoaiSP, TenLoaiSP) VALUES ("' . $MaLoaiSP . '","' . $TenLoaiSP . '")';

    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function capnhat()
{
    require_once('DataProvider.php');
    $MaLoaiSPCu = $_POST['MaLoaiSPCu'];
    $TenLoaiSP = $_POST['TenLoaiSP'];
    $MaLoaiSP = $_POST['MaLoaiSP'];
    if ($MaLoaiSP != $MaLoaiSPCu && !trungID($MaLoaiSP)) {
        $sql = 'INSERT INTO loaisp(MaLoaiSP, TenLoaiSP) VALUES ("' . $MaLoaiSP . '","' . $TenLoaiSP . '")';
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            return false;
        }
        $sql = 'UPDATE 
        sanpham SET MaLoaiSP="' . $MaLoaiSP . '"
        WHERE MaLoaiSP="' . $MaLoaiSPCu . '"';
        $result = mysqli_query($conn, $sql);

        $sql = 'DELETE FROM loaisp WHERE MaLoaiSP="' . $MaLoaiSPCu . '"';
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }

    $sql = 'UPDATE loaisp 
    SET TenLoaiSP="' . $TenLoaiSP . '" 
    WHERE MaLoaiSP = "' . $MaLoaiSPCu . '"';

    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}
function trungID($id)
{
    require_once('DataProvider.php');
    $sql = 'SELECT * FROM loaisp WHERE MaLoaiSP="' . $id . '"';

    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

    return mysqli_num_rows($result) > 0;
}
function xoa()
{
    require_once('DataProvider.php');
    $MaLoaiSP = $_POST['MaLoaiSP'];
    $sql = 'SELECT COUNT(*) as x FROM sanpham WHERE sanpham.MaLoaiSP="' . $MaLoaiSP . '"';
    $result = query($sql);
    $sl = $result[0]['x'];
    if ($sl > 0) {
        echo $sl;
        return false;
    }
    $sql = ' DELETE FROM loaisp WHERE MaLoaiSP = "' . $MaLoaiSP . '"';
    echo $sql;

    $result = query($sql);

    return $result;
}
?>

<body>
    <?php
    include("./naviagte.php");
    ?>
    <div class="d-flex flex-wrap">
        <?php include("./headerAdmin.php"); ?>
        <form class="row g-3 w-50 mx-auto" method="post" action="xlLoaiSP.php" onsubmit="return isval()">

            <?php
            $MaLoaiSP = "";
            $TenLoaiSP = "";
            require_once("DataProvider.php");
            if (!isset($_GET['id'])) {
                echo ' <input type="hidden" name="loai" value="add">
                        <h1>
                            Thêm danh mục
                        </h1>';
            } else {
                $id = $_GET['id'];
                $sql = 'SELECT * from loaisp where MaLoaiSP = "' . $id . '"';
               
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) == 0) {
                    header("location:quanlyLoaiSP.php");
                    exit();
                }

                while ($row = mysqli_fetch_array($result)) {
                    $MaLoaiSP = $row['MaLoaiSP'];
                    $TenLoaiSP = $row['TenLoaiSP'];
                }
                echo '
                         <input type="hidden" name="loai" value="update">
                         <input type="hidden" name="MaLoaiSPCu" value="' . $MaLoaiSP . '"  >
                         <h1>
                             cập nhật nhãn hàng
                         </h1>';
            }
            ?>
            <div class="col-12">
                <label for="TenLoaiSP" class="form-label">Tên danh mục</label>
                <input require type="text" value='<?php echo $TenLoaiSP ? $TenLoaiSP : ""; ?>' name="TenLoaiSP" class="form-control" id="TenLoaiSP" placeholder="Iphone">
            </div>
            <div class="col-12">
                <label for="MaLoaiSP" class="form-label">Mã danh mục</label>
                <input require type="text" value="<?php echo $MaLoaiSP ? $MaLoaiSP : ''; ?>" name="MaLoaiSP" class="form-control" id="mssv" placeholder="ip">
            </div>

            <div class="col-3 mt-3">
                <button type="submit" class="btn btn-primary"><?php echo isset($_GET['id']) ? "cập nhập" : "thêm mới" ?></button>
            </div>
            <div class="col-3 mt-3">
                <a href="quanlyLoaiSP.php" class="btn btn-primary">danh sách loại</a>
            </div>
        </form>
    </div>

</body>
<script src="js/bootstrap.bundle.min.js">
</script>

</html>