<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Account</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">

<style>
body {
    margin: 0;
    padding: 0;
    background: #0f0f0f;
    font-family: "Poppins", sans-serif;
    color: white;
}

/* TOP PROFILE SECTION */
.container-box {
    padding: 25px;
}

.profile-wrapper {
    display: flex;
    align-items: center;
}

.profile-wrapper img {
    width: 130px;
    height: 130px;
    border-radius: 50%;
    border: 3px solid #ff004c;
    box-shadow: 0 0 15px #ff004c7c;
}

.username {
    font-size: 26px;
    font-weight: 700;
    background: linear-gradient(45deg, #ff004c, #ffae00);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.edit-btn {
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    padding: 6px 14px;
    color: white;
    font-weight: 600;
    border-radius: 10px;
    margin-top: 10px;
    transition: 0.3s;
}

.edit-btn:hover {
    background: rgba(255,255,255,0.2);
}

/* STATS */
.stats {
    margin-top: 15px;
}
.stats span {
    margin-right: 20px;
    font-size: 14px;
}

/* GALLERY GRID */
.gallery {
    padding: 10px;
}
.gallery img {
    width: 100%;
    aspect-ratio: 1/1;
    object-fit: cover;
    border-radius: 10px;
    transition: 0.3s;
}
.gallery img:hover {
    transform: scale(1.03);
    box-shadow: 0 0 12px #ff004c8a;
}
</style>

</head>

<body>

<!-- NAVBAR -->
<?php include "navbar.php"; ?>

<div class="container-box">

    <div class="profile-wrapper">
        <img src="img/user_profile.jpg">

        <div class="ms-4">
            <div class="username">my_username</div>
            <button class="edit-btn">Edit Profile</button>

            <div class="stats">
                <span><strong>12</strong> posts</span>
                <span><strong>230</strong> followers</span>
                <span><strong>180</strong> following</span>
            </div>

            <p style="margin-top:10px;">This is my bio...</p>
        </div>
    </div>

    <hr style="border-color:#333">

    <!-- POSTS GRID -->
    <div class="row gallery">
        <div class="col-4 mb-3"><img src="img/post1.jpg"></div>
        <div class="col-4 mb-3"><img src="img/post2.jpg"></div>
        <div class="col-4 mb-3"><img src="img/post3.jpg"></div>
    </div>

</div>

</body>
</html>
