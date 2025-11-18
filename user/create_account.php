<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background: #f4f6fa;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    width: 100%;
    max-width: 420px;
}

.card {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.card h2 {
    text-align: center;
    margin-bottom: 20px;
}

.profile-photo {
    text-align: center;
    margin-bottom: 20px;
}

.profile-photo img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #ddd;
    margin-bottom: 10px;
}

input[type="file"] {
    margin-top: 10px;
}

label {
    font-weight: bold;
    margin-top: 10px;
    display: block;
}

input, textarea {
    width: 100%;
    padding: 10px;
    margin-top: 6px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
}

button {
    width: 100%;
    padding: 12px;
    background: #4A6CF7;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    margin-top: 20px;
    cursor: pointer;
}

button:hover {
    background: #3756d8;
}

    </style>
</head>
<body>

<div class="container">
    <form class="card" action="create_Account_backend.php" method="POST" enctype="multipart/form-data">

        <h2>Create Your Account</h2>

        <!-- Profile Photo -->
        <div class="profile-photo">
            <img id="preview" src="default-avatar.png" alt="Profile Photo">
            <input type="file" name="acc_profile_photo" accept="image/*" onchange="previewPhoto(event)">
        </div>

        <!-- Username -->
        <label>Username</label>
        <input type="text" name="acc_username" placeholder="Enter username" required>

        <!-- Bio -->
        <label>Bio</label>
        <textarea name="acc_bio" placeholder="Tell something about yourself"></textarea>

        <!-- Password -->
        <label>Password</label>
        <input type="password" name="acc_password" placeholder="Enter password" required>

        <button type="submit" name ="acc_submit" id="acc_submit">Create Account</button>

    </form>
</div>

<script>
function previewPhoto(e) {
    document.getElementById('preview').src = URL.createObjectURL(e.target.files[0]);
}
</script>

</body>
</html>
