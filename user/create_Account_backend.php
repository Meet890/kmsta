<?php
require 'conn.php';

if (isset($_POST['acc_submit'])) {
    $acc_username = $_POST['acc_username'];
    $acc_password = $_POST['acc_password'];
    $acc_bio = $_POST['acc_bio'];
    $user_id = $_SESSION['user_id'];
    $ins_acc = "INSERT INTO accounts VALUES ('',$user_id,'','$acc_bio','$acc_username','$acc_password')";
    echo $ins_acc;
    if ($conn->query($ins_acc)) {
        header('Location: index.php');
        exit;
    } else {
        echo "ERROR: " . $conn->error;
    }
}
