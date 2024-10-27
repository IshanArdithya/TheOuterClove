<?php
session_start();

$_SESSION['staff'] = [];

session_destroy();

header("Location: adminlogin.php");
exit;
?>
