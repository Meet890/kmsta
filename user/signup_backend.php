<?php
require 'conn.php';
if(isset($_POST['signup_btn'])){
    $user_name = $_POST['user_name'];
    $user_age = $_POST['user_age'];
    $user_gender = $_POST['user_gender'];
    $user_ph = $_POST['user_ph'];
    $user_email = $_POST['user_email'];
    $user_dob = $_POST['user_dob'];
    $user_password = $_POST['user_password'];
    $add_user = "INSERT INTO user_details (user_name, user_age , user_gender , user_ph , user_email , user_dob , user_password) VALUES ('$user_name','$user_age','$user_gender','$user_ph','$user_email','$user_dob','$user_password')";
    if($conn->query($add_user)==true){
    echo "INSERTED";
    }else{
        echo "error";
    }
}
$conn->close();
?>