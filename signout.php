<?php  

session_start();
error_reporting(0);

session_unset();
session_destroy();

$_SESSION["alertSuccess"] = "Anda berhasil logout";
header('Location: index');
exit();
?>