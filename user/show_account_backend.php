<?php
require_once "conn.php";
$user_id = $_SESSION["user_id"];

if (isset($_POST["create_acc_btn"])) {
    echo $_SESSION["user_id"];

} else {
if(isset($_POST["login_btn"])) {
echo "hello";
}
}