<?php
require "conn.php";
// session_start();

$comment_id = intval($_POST["comment_id"]);
$user_id = $_SESSION["acc_id"];

// Only delete your own comment!
mysqli_query($conn, "
    DELETE FROM post_comments 
    WHERE id=$comment_id AND user_id=$user_id
");

echo "OK";
?>
