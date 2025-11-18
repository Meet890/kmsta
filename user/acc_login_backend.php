<?php
require_once "conn.php";
if(isset($_POST["acc_login_btn"])){
    $acc_id=$_POST["acc_id"];
    $acc_password=$_POST["acc_password"];
     echo"this is id".$acc_id." this is pass".$acc_password."";

    $sql= "select * from accounts where acc_id = $acc_id and acc_password = '$acc_password' ";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)> 0){
        $row=mysqli_fetch_array($result);
        $_SESSION['acc_id']=$row["acc_id"];
        echo "this is session".$_SESSION['acc_id'];
        //inport header
        header("Location: logged/home.php");

    }
    else{
        echo "<h3>wrong Password<h3>";
    }
}

?>

