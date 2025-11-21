<?php
require 'conn.php';
require 'session.php';
$user_id =$_GET['id'];
$delete = "delete from user_details where user_id = '$user_id'";
if($conn->query($delete)==true){
    echo "user deleted";
}
else{
    echo "user not deleted";
}
?>