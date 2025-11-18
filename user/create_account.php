<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
/* ------------ GLOBAL THEME ------------ */
body {
    font-family: "Poppins", sans-serif;
    background: radial-gradient(circle at top, #1a1a1a, #0c0c0c);
    height: 100vh;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    overflow: hidden;
}

/* Animated background glow */
body::before {
    content: "";
    position: fixed;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle, rgba(255,0,76,0.15), transparent 60%);
    filter: blur(80px);
    animation: glow 6s infinite alternate ease-in-out;
    z-index: -1;
}
@keyframes glow {
    from { transform: translateY(-20px); opacity: 0.7; }
    to   { transform: translateY(20px); opacity: 1; }
}

/* ------------ CARD -------------- */
.card {
    width: 100%;
    max-width: 380px;
    padding: 30px;
    background: rgba(20, 20, 20, 0.75);
    border-radius: 20px;
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.08);
    box-shadow: 0px 5px 25px rgba(0,0,0,0.4);
    animation: cardPop 0.8s ease-out;
}

@keyframes cardPop {
    from { opacity: 0; transform: scale(0.85); }
    to { opacity: 1; transform: scale(1); }
}

.card h2 {
    text-align: center;
    font-size: 26px;
    font-weight: 600;
    background: linear-gradient(45deg, #ff004c, #ffa600);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 25px;
}

/* ------------ PROFILE PHOTO -------------- */
.profile-photo {
    text-align: center;
    margin-bottom: 20px;
}

.profile-photo img {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #ff004c;
    box-shadow: 0 0 15px #ff004cc0;
    transition: 0.3s;
}
.profile-photo img:hover {
    transform: scale(1.05);
}

/* ------------ INPUTS -------------- */
label {
    display: block;
    margin: 12px 0 6px;
    font-weight: 500;
}

input, textarea {
    width: 100%;
    padding: 12px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 10px;
    color: white;
    font-size: 14px;
    outline: none;
    transition: 0.3s;
}

input:focus, textarea:focus {
    border-color: #ff004c;
    box-shadow: 0 0 8px #ff004c80;
}

/* ------------ BUTTON -------------- */
button {
    width: 100%;
    margin-top: 25px;
    padding: 12px;
    background: linear-gradient(135deg, #ff004c, #ff6a00);
    border: none;
    color: white;
    font-size: 17px;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.35s;
    letter-spacing: 0.5px;
}

button:hover {
    transform: scale(1.03);
    box-shadow: 0 0 12px #ff004caa;
}

/* File input */
input[type="file"] {
    border: none;
    background: transparent;
    margin-top: 10px;
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

        <button type="submit" name="acc_submit">Create Account</button>

    </form>
</div>

<script>
function previewPhoto(e) {
    document.getElementById('preview').src =
        URL.createObjectURL(e.target.files[0]);
}
</script>

</body>
</html>
