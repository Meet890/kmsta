<?php
include "conn.php";
// session_start();

$me = $_SESSION['acc_id'];
$receiver = $_POST['receiver_id'];
$message = mysqli_real_escape_string($conn, $_POST['message']);

$sql = "INSERT INTO messages (sender_id, receiver_id, message_text)
        VALUES ('$me', '$receiver', '$message')";

mysqli_query($conn, $sql);
?>
