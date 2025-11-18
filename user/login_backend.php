<?php
require 'conn.php';

if(isset($_POST['login_btn'])){
    $user_email= $_POST['user_email'];
    $user_password= $_POST['user_password'];
    $sql = "select * from user_details where user_email = '$user_email' and user_password = '$user_password'";
    $res = $conn->query($sql);

    if($res -> num_rows > 0){
        $row = $res -> fetch_assoc();
        $_SESSION["user_id"] = $row["user_id"];
        $_SESSION["user_name"] = $row["user_name"];
        $_SESSION['user_email'] = $user_email;
        header('Location: show_account.php');
        exit();
}else {
    header('Location: signup.php');
}
$conn->close();
}
?>