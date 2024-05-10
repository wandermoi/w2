<!DOCTYPE html>
<html lang="en">
<?php
require("DataProvider.php");
session_start();
include("css.php") ?>

<body>
  <?php
  include("./naviagte.php");
  ?>
  <div class="d-flex flex-wrap">
    <?php include("./headerAdmin.php"); ?>
    <div class="col-md-9 ml-sm-auto col-lg-10 pt-3">
      <h3>
        <a href="xlLoaiSP.php" class="btn btn-primary mr-sm-3" style="float:right;"> Thêm loại sản phẩm </a>
      </h3>
      <br>
      <h3 class="text-center">
        Danh sách loại sản phẩm
      </h3>
      <table class="table min-h">
        <thead>
          <tr class="text-center">
            <th scope="col">Mã loại </th>
            <th scope="col">Tên loại</th>
            <th scope="col">số lượng sản phẩm</th>
            <th scope="col">Handle</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = 'SELECT COUNT(sanpham.MaLoaiSP) as soluong,loaisp.MaLoaiSP ,loaisp.TenLoaiSP 
      FROM loaisp LEFT JOIN sanpham
      ON loaisp.MaLoaiSP=sanpham.MaLoaiSP
      GROUP BY loaisp.MaLoaiSP';

          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_array($result)) {
            $MaLoaiSP = $row['MaLoaiSP'];
            $TenLoaiSP = $row['TenLoaiSP'];
            $soluong = $row['soluong'];
            echo '
                   <tr class="text-center">
                     <th >' . $MaLoaiSP . '</th>
                     <td>' . $TenLoaiSP . '</td>
                     <td>
                       <a href="quanlysp.php?tl=' . $MaLoaiSP . '">
                       ' . $soluong . '
                       </a>
                     </td>
                     <td>
                       <a href="xlLoaiSP.php?id=' . $MaLoaiSP . '">
                         <div class="btn btn-primary">Cập nhât</div>
                       </a>
                       <form class="btn" action="xlLoaiSP.php" method="post">
                          <input type="hidden" name="loai" value="xoa">
                          <input type="hidden" name="MaLoaiSP" value="' . $MaLoaiSP . '">
                          <input class="btn btn-primary" type="submit" value="xóa">
                        </form>
                     </td>
                   </tr>';
          }
          mysqli_close($conn);
          ?>

        </tbody>
      </table>
    </div>
  </div>


</body>

</html>
<script>
  active_navigate('qllsp')
</script>