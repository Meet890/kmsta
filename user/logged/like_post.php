<?php
// session_start();
header("Content-Type: application/json");

require "conn.php"; // your DB file

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "Not logged in"]);
    exit;
}

$user_id = $_SESSION['user_id'];
$post_id = intval($_POST['post_id']);

// check like exists
$check = mysqli_query($conn, "SELECT * FROM post_likes WHERE post_id=$post_id AND user_id=$user_id");

if (mysqli_num_rows($check) > 0) {
    // remove like
    mysqli_query($conn, "DELETE FROM post_likes WHERE post_id=$post_id AND user_id=$user_id");
    $liked = false;
} else {
    // add like
    mysqli_query($conn, "INSERT INTO post_likes (post_id, user_id) VALUES ($post_id, $user_id)");
    $liked = true;
}

// get updated like count
$countRes = mysqli_query($conn, "SELECT COUNT(*) AS total FROM post_likes WHERE post_id=$post_id");
$countRow = mysqli_fetch_assoc($countRes);
$like_count = $countRow['total'];

// return JSON ONLY
echo json_encode([
    "success" => true,
    "liked" => $liked,
    "like_count" => $like_count
]);
exit;
?>
