<?php
require "conn.php";
// session_start();

$user_id = $_SESSION["acc_id"];
$post_id = intval($_POST["post_id"]);
$comment = mysqli_real_escape_string($conn, $_POST["comment_text"]);

if(!$user_id || !$post_id || $comment == ""){
    echo "Invalid";
    exit;
}

// INSERT COMMENT
mysqli_query($conn, "
    INSERT INTO post_comments (post_id, user_id, comment)
    VALUES ($post_id, $user_id, '$comment')
");

// RETURN UPDATED COMMENT LIST
include "load_comments.php";
?>
