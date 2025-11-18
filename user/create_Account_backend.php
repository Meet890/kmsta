<?php
require 'conn.php';

if (isset($_POST['acc_submit'])) {
    $acc_username = $_POST['acc_username'];
    $acc_password = $_POST['acc_password'];
    $acc_bio = $_POST['acc_bio'];
    $user_id = $_SESSION['user_id'];
    $ins_acc = "INSERT INTO accounts VALUES ('',$user_id,'','$acc_bio','$acc_username','$acc_password')";
    $res = mysqli_query($conn, $ins_acc);

    // echo $ins_acc;
    if ($res >0) {
        $sql = "select * from accounts where user_id = $user_id and acc_password = '$acc_password' ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $_SESSION['acc_id'] = $row["acc_id"];
            echo "this is session" . $_SESSION['acc_id'];
            header('Location: logged/home.php');
            exit;
        }
    } else {
        echo "ERROR: " . $conn->error;
    }
}
