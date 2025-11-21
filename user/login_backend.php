<?php
session_start();
require 'conn.php';

if (isset($_POST['login_btn'])) {
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];

    // Check if admin
    $admin_sql = "SELECT * FROM admin WHERE admin_email='$email' AND admin_password='$password' LIMIT 1";
    $admin_res = mysqli_query($conn, $admin_sql);

    if (mysqli_num_rows($admin_res) > 0) {
        $admin = mysqli_fetch_assoc($admin_res);
        $_SESSION["admin_id"] = $admin["admin_id"];
        $_SESSION["admin_name"] = $admin["admin_name"];
        $_SESSION["role"] = "admin";
        header("Location: ../admin/admin_dashboard.php");
        exit();
    }

    // Check normal user
    $user_sql = "SELECT * FROM user_details WHERE user_email='$email' AND user_password='$password' LIMIT 1";
    $user_res = mysqli_query($conn, $user_sql);

    if (mysqli_num_rows($user_res) > 0) {
        $user = mysqli_fetch_assoc($user_res);
        $_SESSION["user_id"] = $user["user_id"];
        $_SESSION["user_name"] = $user["user_name"];
        $_SESSION["user_email"] = $user["user_email"];
        $_SESSION["role"] = "user";
        header('Location: show_account.php');
        exit();
    }

    echo "<script>alert('Invalid Email or Password'); window.location='user_login.php';</script>";
}
?>
