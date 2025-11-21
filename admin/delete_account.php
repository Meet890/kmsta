<?php
require 'conn.php';
// require 'session.php';
$user_id =$_GET['id'];
$delete = "delete from accounts where acc_id = '$user_id'";
if($conn->query($delete)==true){
    echo "user deleted";
    header("Location:accounts.php");
}
else{
    echo "user not deleted";
}


?>