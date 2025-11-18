<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "insta";
$conn = new mysqli("$server","$username","$password","$db");

if($conn -> connect_error){
    die("Connection Failed");
}
else{
    // echo "Connected";
}

require 'session.php';
?>