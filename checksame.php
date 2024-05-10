<?php

function Co_TK($tk)
{
    require_once("DataProvider.php");
    $sql = 'SELECT * 
        FROM user
        WHERE UserName="' . $tk . '"';
    $res = query($sql);
    echo json_encode($res);
    
    return count($res) > 0 ? true : false;
}
