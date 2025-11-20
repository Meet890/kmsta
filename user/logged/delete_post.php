<?php
include "conn.php"; // update path if needed

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_POST['post_id'])) {
        echo json_encode(["success" => false, "error" => "No post ID"]);
        exit;
    }

    $post_id = intval($_POST['post_id']);

    // DELETE POST FROM DB ONLY
    $delete = mysqli_query($conn, "DELETE FROM post WHERE post_id = $post_id");

    if ($delete) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => mysqli_error($conn)]);
    }
}
?>
