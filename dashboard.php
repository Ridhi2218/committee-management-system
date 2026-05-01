<?php
// dashboard.php
session_start();
if (!isset($_SESSION['role'])) { header('Location: index.php'); exit(); }
if ($_SESSION['role'] === 'admin') { header('Location: admin/dashboard.php'); exit(); }
else { header('Location: employee/dashboard.php'); exit(); }
?>
