<?php
//session_start();
require "conn.php";


$user_id = $_GET['id'];

$sql = "SELECT * FROM accounts WHERE acc_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (isset($_POST['update_profile'])) {
    $username = $_POST['username'];
    $bio = $_POST['bio'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $profile_photo = $user['acc_profile_photo'];

    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['name'] != "") {
        $file_name = $_FILES['profile_photo']['name'];
        $file_tmp = $_FILES['profile_photo']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = array("jpg", "jpeg", "png");

        if (in_array($file_ext, $allowed_ext)) {
            $new_name = "uploads/" . uniqid() . "." . $file_ext;
            if (move_uploaded_file($file_tmp, $new_name)) {
                $profile_photo = $new_name;
            } else {
                $error = "Failed to upload photo.";
            }
        } else {
            $error = "Only JPG, JPEG, PNG files are allowed.";
        }
    }

    $password_sql = "";
    if (!empty($password)) {
        if ($password === $confirm_password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $password_sql = ", acc_password = '$hashed_password'";
        } else {
            $error = "Passwords do not match!";
        }
    }

    if (!isset($error)) {
        $update_sql = "UPDATE accounts SET acc_username = ?, acc_bio = ?, acc_profile_photo = ? $password_sql WHERE user_id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("sssi", $username, $bio, $profile_photo, $user_id);
        if ($stmt->execute()) {
            $success = "Profile updated successfully!";
            $user['acc_username'] = $username;
            $user['acc_bio'] = $bio;
            $user['acc_profile_photo'] = $profile_photo;
        } else {
            $error = "Failed to update profile.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background: #0b0b0b;
            color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type=text],
        input[type=password],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #333;
            background: #111;
            color: white;
        }

        input[type=file] {
            margin-bottom: 15px;
            color: white;
        }

        button {
            padding: 10px 20px;
            background: linear-gradient(45deg, #ff004c, #ffae00);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            transform: scale(1.05);
        }

        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
        }

        .success {
            background: #0f0a;
            color: #0f0;
        }

        .error {
            background: #2a0000;
            color: #ff4c4c;
        }

        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px solid #ff004c;
            object-fit: cover;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
   
    <div class="container">
        <h2>Edit Profile</h2>

        <?php if (isset($error))
            echo "<div class='alert error'>$error</div>"; ?>
        <?php if (isset($success))
            echo "<div class='alert success'>$success</div>"; ?>

        <form method="post" enctype="multipart/form-data">
            <img src="../user/logged/uploads/ <?php echo $user['acc_profile_photo']; ?>" alt="Profile Photo" class="profile-img"><br>
            <input type="file" name="profile_photo" accept=".jpg,.jpeg,.png">
            <input type="text" name="username" placeholder="Username"
                value="<?php echo htmlspecialchars($user['acc_username']); ?>" required>
            <textarea name="bio" placeholder="Bio"><?php echo htmlspecialchars($user['acc_bio']); ?></textarea>
            <input type="password" name="password" placeholder="New Password (leave blank if unchanged)">
            <input type="password" name="confirm_password" placeholder="Confirm Password">
            <button type="submit" name="update_profile">Update Profile</button>
        </form>
    </div>

</body>

</html>