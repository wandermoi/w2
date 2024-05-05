<?php session_start(); ?>
<?php
    unset($_SESSION['member']);
    unset($_SESSION['Quyen']);
    unset($_SESSION['card']);
    header("Location:index.php");
?>