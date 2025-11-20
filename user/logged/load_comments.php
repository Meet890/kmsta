<?php
require "conn.php";
// session_start();

$post_id = intval($_POST["post_id"]);

$comments = mysqli_query($conn, "
    SELECT c.*, a.acc_username, a.acc_profile_photo
    FROM post_comments c
    JOIN accounts a ON c.user_id = a.acc_id
    WHERE c.post_id=$post_id
    ORDER BY c.id DESC
");

$html = "";

while($c = mysqli_fetch_assoc($comments)){
    $deleteBtn = ($c["user_id"] == $_SESSION["acc_id"]) 
        ? "<span class='delete-comment' data-comment='{$c['id']}'>❌</span>"
        : "";

    $html .= "
        <div class='comment-item'>
            <img src='uploads/{$c['acc_profile_photo']}' class='comment-pfp'>
            <b>@{$c['acc_username']}</b> {$c['comment']}
            $deleteBtn
        </div>
    ";
}

echo $html;
?>
