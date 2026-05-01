<?php
session_start();
include 'includes/db_connect.php';
header('Content-Type: text/html; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit();
}

$role     = isset($_POST['role']) ? trim($_POST['role']) : '';
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

/* ===============================
   EMPLOYEE LOGIN
=============================== */
if (strtolower($role) === 'employee') {

    $sql = "SELECT * FROM id_emp
            WHERE user_name = ?
            AND is_deleted = 'no'
            AND status = 1
            LIMIT 1";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Query Error: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        if ($password === $row['password']) {

            $_SESSION['user_id']   = $row['id'];
            $_SESSION['role']      = 'employee';
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['full_name'] = trim(
                $row['first_name'] . ' ' .
                $row['middle_name'] . ' ' .
                $row['last_name']
            );

            header("Location: employee/dashboard.php");
            exit();

        } else {
            echo "<script>alert('❌ Wrong password for employee!'); location.href='index.php';</script>";
            exit();
        }

    } else {
        echo "<script>alert('❌ Employee username not found or inactive!'); location.href='index.php';</script>";
        exit();
    }
}

/* ===============================
   ADMIN LOGIN
=============================== */
elseif (strtolower($role) === 'admin') {

    $sql = "SELECT * FROM id_admin
            WHERE username = ?
            AND is_deleted = 'no'
            LIMIT 1";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Query Error: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        if ($password === $row['password']) {

            $_SESSION['user_id']   = $row['id'];
            $_SESSION['role']      = 'admin';
            $_SESSION['user_name'] = $row['username'];
            $_SESSION['full_name'] = $row['name'];

            header("Location: admin/dashboard.php");
            exit();

        } else {
            echo "<script>alert('❌ Wrong password for admin!'); location.href='index.php';</script>";
            exit();
        }

    } else {
        echo "<script>alert('❌ Admin username not found!'); location.href='index.php';</script>";
        exit();
    }
}

else {
    echo "<script>alert('⚠️ Please select a valid role!'); location.href='index.php';</script>";
    exit();
}
?>
