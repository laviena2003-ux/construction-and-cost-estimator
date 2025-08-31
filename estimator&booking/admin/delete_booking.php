<?php
session_start();
require_once "../config.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn = Config::getConnection();
    $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: bookings.php");
exit();
