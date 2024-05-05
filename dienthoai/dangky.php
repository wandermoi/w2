<!doctype html>
<html lang="en">

<head>
  <title>Đăng kí</title>
  <META name="Author" content="Scorpion">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/sign-in.css">
</head>

<body>

  <div class="m-auto boder" style="width: 700px;">
    <form method="post" action="xulydk.php" id="myform">
      <img class="mb-4" src="Images/logo1.png" alt="" width="80" height="80">
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
      <div class="form-floating">
        <input type="text" class="form-control" placeholder="Tên đăng nhập của bạn" id="tk" name="username">
        <label for="floatingInput">Tên đăng nhập:</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" placeholder="Mật khẩu của bạn" id="mk" name="password">
        <label for="floatingPassword">Mật khẩu:</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" placeholder="Mật khẩu của bạn" id="mk" name="password1">
        <label for="floatingPassword">Nhập lại Mật khẩu:</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control" placeholder="Mật khẩu của bạn" id="mk" name="hoten">
        <label for="floatingPassword">Họ tên:</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control" placeholder="Mật khẩu của bạn" id="mk" name="diachi">
        <label for="floatingPassword">Địa chỉ:</label>
      </div>
      <div class="form-floating">
        <input type="email" class="form-control" placeholder="Mật khẩu của bạn" id="mk" name="email">
        <label for="floatingPassword">Email:</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control" placeholder="Mật khẩu của bạn" id="mk" name="dienthoai">
        <label for="floatingPassword">Số điện thoại:</label>
      </div>
      <div class="checkbox mb-3">
      </div>
      <button class="w-100 btn btn-lg btn-primary" onClick="return checkinput();" type="submit">đăng ký</button>

    </form>
    <div class="container" style="background-color:#f1f1f1">
      <label><a href="body.php" class="btn btn-primary">Về lại trang chủ</a></label>
    </div>
  </div>

</body>

<script language="JavaScript">
  function checkinput() {
    username = document.myform.username;
    password = document.myform.password;
    password1 = document.myform.password1;
    hoten = document.myform.hoten;
    diachi = document.myform.diachi;
    email = document.myform.email;
    dienthoai = document.myform.dienthoai;


    reg1 = /^[0-9A-Za-z]+[0-9A-Za-z_]*@[\w\d.]+.\w{2,4}$/;
    testmail = reg1.test(email.value);

    dieukientk = /^[A-Za-z0-9_\.]{6,32}$/;
    testtk = dieukientk.test(username.value);

    dkmatkhau = /^[A-Za-z0-9!@#$%^&*()]{8,32}$/;
    testmk = dkmatkhau.test(password.value);

    dkdienthoai = /^0[0-9]{9}$/;
    testdienthoai = dkdienthoai.test(dienthoai.value);

    if (username.value == "") {
      alert("Hãy nhập tên đăng nhập");
      username.focus();
      return false;
    }
    if (!testtk) {
      alert('Tên đăng nhập phải từ 6 đến 32 kí tự và không có kí tự đặc biệt');
      username.focus();
      return false;
    }
    if (password.value == "") {
      alert("Chưa nhập mật khẩu");
      password.focus();
      return false;
    }
    if (password1.value == "" || password1.value !== password.value) {
      alert("Mật khẩu lần 2 chưa khớp");
      password1.focus();
      return false;
    }
    if (!testmk) {
      alert('Mật khẩu phải có từ 8 đến 32 kí tự và có thể chứa kí tự đặc biệt');
      username.focus();
      return false;
    }
    if (hoten.value == "") {
      alert("Hãy nhập vào họ tên của bạn");
      hoten.focus();
      return false;
    }
    if (diachi.value == "") {
      alert("Chưa nhập địa chỉ");
      diachi.focus();
      return false;
    }
    if (!testmail) {
      alert("Địa chỉ email không hợp lệ");
      email.focus();
      return false;
    }
    if (dienthoai.value == "") {
      alert("Chưa nhập số điện thoại");
      dienthoai.focus();
      return false;
    }
    if (!testdienthoai) {
      alert("Số điện thoại chưa chính xác");
      dienthoai.focus();
      return false;
    }
    return true;
  }
</script>

</html>