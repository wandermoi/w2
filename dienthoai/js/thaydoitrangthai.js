function active_inactive_user(tinhtrang, mahd) {
    if (confirm("bạn muốn thực thi thao tác đó")) {
        $.ajax({
            type: 'post',
            url: 'tinhtrangdh.php',
            data: {
                tinhtrang: tinhtrang,
                mahd: mahd
            },
            success: function(result) {
                alert(result);
                window.location.reload();
            }
        })
    }
}