<?php
include "../conn.php";
// session_start();

// Example logged-in user_id
$user_id = $_SESSION['user_id'];

if (isset($_POST['upload_post'])) {

    $caption = $_POST['post_caption'];
    $file_name = $_FILES['post_file']['name'];
    $file_tmp = $_FILES['post_file']['tmp_name'];

    // File extension
    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Validate extension
    $allowed = ['jpg','jpeg','png','mp4'];
    if (!in_array($ext, $allowed)) {
        die("Invalid file type!");
    }

    // Detect file type
    $file_type = in_array($ext, ['jpg','jpeg','png']) ? 'image' : 'video';

    // UNIQUE FILE NAME
    $unique_name = "post_" . uniqid("", true) . "_" . bin2hex(random_bytes(5)) . "." . $ext;

    // Local path
    $upload_path = "uploads/" . $unique_name;

    // Move file
    if (move_uploaded_file($file_tmp, $upload_path)) {

        // Insert into DB
        $acc_id=$_SESSION['acc_id'];
        $sql = "INSERT INTO post (post_id,acc_id, post_location,post_type, post_caption) 
                VALUES ('','$acc_id', '$unique_name', '$file_type', '$caption')";

        if ($conn->query($sql)) {
            echo "<script>alert('Uploaded Successfully!'); window.location='my_account.php';</script>";
        } else {
            echo "DB Error: " . $conn->error;
        }

    } else {
        echo "Failed to upload file.";
    }
}
?>
