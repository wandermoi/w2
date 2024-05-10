<?php
require_once("DataProvider.php");
function addGoiy($main, $extra)
{
    $sql = "INSERT INTO goiy(sanphamchinh, sanphamphu) VALUES ('$main','$extra')";
    query($sql);
}

function xoaGoiy($main, $extra)
{
    $sql = "DELETE FROM goiy WHERE sanphamchinh='$main' AND sanphamphu='$extra'";
    query($sql);
}
$main = $_REQUEST['main'];
$extra = $_REQUEST['extra'];
$loai = $_REQUEST['loai'];
switch ($loai) {
    case 'add':
        addGoiy($main, $extra);
        break;
    default:
        xoaGoiy($main, $extra);
        break;
}
