<head>
    <title>Thế giới di động</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/nut-chuyen-trang.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/header.css">
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>

    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        function ktraTK() {
            var add = document.getElementById(timkiem);
            var kiemtra = /^[!@#$%^&*()]/;
            var kiemtra1 = /^[ ]+[A-Za-z0-9]+[ ]/;
            if (kiemtra.test(add.value) || (kiemtra1.test(add.value))) {
                document.getElementById("timkiem").value = "";
                document.getElementById("timkiem").placeholder = "Không hợp lệ";
                add.focus();
                return false;
            } else
                return true;
        }

        function ktttnc() {
            var giatu = document.getElementById(giatu);
            var giaden = document.getElementById(giaden);
            var kiemtra = /^[!@#$%^&*()]/;
            var kiemtra1 = /^[ A-Za-z0-9 ]/;
            if (kiemtra.test(giatu.value) || kiemtra1.test(giatu.value)) {
                document.getElementById("giatu").value = "";
                document.getElementById("giatu").placeholder = "Không hợp lệ";
                giatu.focus();
                return false;
            } else if (kiemtra.test(giaden.value) || kiemtra1.test(giaden.value)) {
                document.getElementById("giaden").value = "";
                document.getElementById("giaden").placeholder = "Không hợp lệ";
                giaden.focus();
                return false;
            } else
                return true;
        }

        function phantrangAjax(theloai, page) {
            var form, d = {}
            try {
                form = new FormData(document.getElementById('loc'))
                form.forEach((v, k) => {
                    console.log(`${k}:${v}`);
                    d[k] = v
                })
            } catch (error) {
                console.log(error);
                d['theloai'] = theloai
            }


            d['page'] = page
            if (page == "0") {
                d['theloai'] = theloai;
                d['page'] = 1
            }
            $.ajax({
                type: "POST",
                url: "main.php",
                data: d,
                caches: false,
                success: (result) => {
                    $("div.phantrang").html(result)
                    window.scroll({
                        top: 0,
                        left: 0,
                        behavior: "instant",
                    });
                }
            })
        }

        function timkiemAjax(search, page) {
            $.ajax({
                type: "POST",
                url: "timkiem.php",
                data: {
                    search: search,
                    page: page
                },
                caches: false,
                success: (result) => {
                    $("div.phantrang").html(result)
                    window.scroll({
                        top: 0,
                        left: 0,
                        behavior: "instant",
                    });

                }
            })
        }

        function extraPro() {

            $(".extraPro").hide()
        }

        function mainPro() {
            $(".extraPro").show()
        }

        function extraMain(params) {
            var s = [mainPro, extraPro]
            s[params.value]();
        }

        function extraProAjax(maloaisp, masp) {
            $.ajax({
                url: "goiyCrud.php",
                type: "POST",
                data: {
                    maloaisp: maloaisp.value,
                    masp: masp
                },
                cache: false,
                success: (result) => {
                    $("div.goiy").html(result)
                    window.scroll({
                        top: 0,
                        left: 0,
                        behavior: "instant",
                    });

                }
            })
        }

        function xlgoiy(main, extra,loai) {
            $.ajax({
                url: "xlgoiy.php",
                type: "POST",
                data: {
                    loai:loai,
                    main: main,
                    extra: extra
                },
                cache: false,
                success: (result) => {
                    location.reload()
                }
            })
        }
    </script>
</head>