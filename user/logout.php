<?php
session_start();
session_destroy();
echo "hello meet";
header("Location:signup.php");
?>