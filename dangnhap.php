<?php
if (isset($_GET['tb'])) {
    echo '
        <script>
            alert("có lỗi đăng nhập")
        </script>';
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title>Signin Template · Bootstrap v5.3</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/sign-in.css" rel="stylesheet">

</head>

<body class="text-center">
    <div class="form-signin w-100 m-auto boder">
        <form method="post" id="dn" onsubmit="return ktdn()" action=" xulydn.php">
            <img class="mb-4" src="Images/logo1.png" alt="" width="80" height="80">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            <div class="form-floating">
                <input type="text" class="form-control" placeholder="Tên đăng nhập của bạn" id="tk" name="tk">
                <label for="floatingInput">Tài khoản</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" placeholder="Mật khẩu của bạn" id="mk" name="mk">
                <label for="floatingPassword">Password</label>
            </div>
            <div class="checkbox mb-3">
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        </form>
        <div class="container" style="background-color:#f1f1f1">
            <label><a href="dangky.php" class="btn btn-primary">Đăng ký tài khoản</a></label>
            <label><a href="body.php" class="btn btn-primary">Về lại trang chủ</a></label>
        </div>
    </div>
</body>
<script>
    function ktdn() {
        var form = new FormData(document.getElementById("dn"))
        var tk = form.get("tk");
        var mk = form.get("mk")
        if (tk.length <= 0) {
            alert("Chưa nhập tài khoản")
            return false;
        }
        if (mk.length <= 0) {
            alert("Chưa nhập mật khẩu")
            return false
        }
        return true;
    }
</script>

</html>