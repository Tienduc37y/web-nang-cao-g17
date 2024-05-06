<?php
session_start();
session_destroy();
$_SESSION['isLogin']= false;
header("Location: index.html")
?>