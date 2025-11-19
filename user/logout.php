<?php
session_start();
session_destroy();
// echo "hello krupal";
header("Location:login.php");
?>