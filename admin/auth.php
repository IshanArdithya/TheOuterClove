<?php
session_start();

if (!isset($_SESSION['staff']['id']) || !isset($_SESSION['staff']['email'])) {
    header("Location: adminlogin.php");
    exit();
}