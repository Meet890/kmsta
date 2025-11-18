<?php
require_once "conn.php";
$user_id = $_SESSION["user_id"];

if(isset($_POST["create_acc_btn"])) {
echo"hello ";

}else{
$sql = "select * from accounts where user_id=$user_id";
$result = $conn->query($sql);
if ($result) {
    // echo"hello";
    $row = mysqli_fetch_array($result);
    //print one by one with while loop
    $acc_id = $row["acc_id "];
    $user_id = $row["user_id "];
    $acc_profile_photo = $row["acc_profile_photo"];
    $acc_bio = $row["acc_bio"];
    $acc_username = $row["acc_username "];
    $acc_password = $row["acc_password"];
} else {
    echo "error";
}
}