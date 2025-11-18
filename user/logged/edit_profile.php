<?php
// if(session_status() == PHP_SESSION_NONE){
//     session_start();
// }
include "conn.php"; 
include "navbar.php";
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM user_details WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if(isset($_POST['update_profile'])){
    $user_name = $_POST['user_name'];
    $user_age = $_POST['user_age'];
    $user_gender = $_POST['user_gender'];
    $user_ph = $_POST['user_ph'];
    $user_email = $_POST['user_email'];
    $user_dob = $_POST['user_dob'];
    $password = $_POST['user_password'];
    $confirm_password = $_POST['confirm_password'];

    $password_sql = "";
    if(!empty($password)){
        if($password === $confirm_password){
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $password_sql = ", user_password = '$hashed_password'";
        } else {
            $error = "Passwords do not match!";
        }
    }

    if(!isset($error)){
        $update_sql = "UPDATE user_details SET user_name = ?, user_age = ?, user_gender = ?, user_ph = ?, user_email = ?, user_dob = ? $password_sql WHERE user_id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("sissssi", $user_name, $user_age, $user_gender, $user_ph, $user_email, $user_dob, $user_id);
        if($stmt->execute()){
            $success = "Profile updated successfully!";
            $user['user_name'] = $user_name;
            $user['user_age'] = $user_age;
            $user['user_gender'] = $user_gender;
            $user['user_ph'] = $user_ph;
            $user['user_email'] = $user_email;
            $user['user_dob'] = $user_dob;
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
body { font-family: "Poppins", sans-serif; background: #0b0b0b; color: white; margin:0; padding:0; }
.container { max-width:600px; margin:50px auto; padding:20px; background: rgba(255,255,255,0.05); border-radius:15px; border:1px solid rgba(255,255,255,0.1); }
h2 { text-align:center; margin-bottom:20px; }
input[type=text], input[type=password], input[type=number], input[type=email], input[type=date], select { width:100%; padding:10px; margin-bottom:15px; border-radius:8px; border:1px solid #333; background:#111; color:white; }
button { padding:10px 20px; background: linear-gradient(45deg,#ff004c,#ffae00); border:none; border-radius:12px; color:white; font-weight:600; cursor:pointer; transition:0.3s; }
button:hover { transform:scale(1.05); }
.alert { padding:10px; margin-bottom:15px; border-radius:8px; }
.success { background: #0f0a; color:#0f0; }
.error { background: #2a0000; color:#ff4c4c; }
</style>
</head>
<body>
<div class="container">
    <h2>Edit Profile</h2>

    <?php if(isset($error)) echo "<div class='alert error'>$error</div>"; ?>
    <?php if(isset($success)) echo "<div class='alert success'>$success</div>"; ?>

    <form method="post">
        <input type="text" name="user_name" placeholder="Full Name" value="<?php echo htmlspecialchars($user['user_name']); ?>" required>
        <input type="number" name="user_age" placeholder="Age" value="<?php echo htmlspecialchars($user['user_age']); ?>" required>
        <select name="user_gender" required>
            <option value="">Select Gender</option>
            <option value="Male" <?php if($user['user_gender']=='Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if($user['user_gender']=='Female') echo 'selected'; ?>>Female</option>
            <option value="Other" <?php if($user['user_gender']=='Other') echo 'selected'; ?>>Other</option>
        </select>
        <input type="text" name="user_ph" placeholder="Phone" value="<?php echo htmlspecialchars($user['user_ph']); ?>" required>
        <input type="email" name="user_email" placeholder="Email" value="<?php echo htmlspecialchars($user['user_email']); ?>" required>
        <input type="date" name="user_dob" placeholder="Date of Birth" value="<?php echo htmlspecialchars($user['user_dob']); ?>" required>
        <input type="password" name="user_password" placeholder="New Password (leave blank if unchanged)">
        <input type="password" name="confirm_password" placeholder="Confirm Password">
        <button type="submit" name="update_profile">Update Profile</button>
    </form>
</div>

</body>
</html>
