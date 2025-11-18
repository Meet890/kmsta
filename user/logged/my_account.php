<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Account</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">

<style>
/* BODY & FONT */
body {
    margin: 0;
    padding: 0;
    background: radial-gradient(circle at top, #0b0b0b, #1a1a1a);
    font-family: "Poppins", sans-serif;
    color: white;
}

/* CONTAINER */
.container-box {
    padding: 25px;
    max-width: 900px;
    margin: auto;
}

/* PROFILE SECTION */
.profile-wrapper {
    display: flex;
    align-items: center;
    gap: 25px;
    background: rgba(255,255,255,0.05);
    padding: 20px;
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.1);
    backdrop-filter: blur(12px);
    box-shadow: 0 0 20px rgba(255,0,76,0.3);
}

.profile-wrapper img {
    width: 130px;
    height: 130px;
    border-radius: 50%;
    border: 3px solid #ff004c;
    box-shadow: 0 0 15px #ff004c7c;
    object-fit: cover;
}

.username {
    font-size: 28px;
    font-weight: 700;
    background: linear-gradient(45deg, #ff004c, #ffae00);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 6px;
}

.edit-btn {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.2);
    padding: 8px 16px;
    color: white;
    font-weight: 600;
    border-radius: 12px;
    margin-top: 8px;
    cursor: pointer;
    transition: 0.3s;
}

.edit-btn:hover {
    background: rgba(255,255,255,0.2);
    box-shadow: 0 0 12px #ff004c88;
    transform: scale(1.05);
}

/* STATS */
.stats {
    margin-top: 15px;
    font-size: 15px;
}
.stats span {
    margin-right: 20px;
}

/* BIO */
.bio {
    margin-top: 10px;
    font-size: 14px;
    color: #ccc;
}

/* DIVIDER */
hr {
    border-color: #333;
    margin: 30px 0;
}

/* GALLERY GRID */
.gallery {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}
.gallery img {
    width: 100%;
    aspect-ratio: 1/1;
    object-fit: cover;
    border-radius: 14px;
    transition: 0.3s;
    border: 1px solid rgba(255,255,255,0.1);
}
.gallery img:hover {
    transform: scale(1.05);
    box-shadow: 0 0 15px #ff004caa;
}

/* RESPONSIVE */
@media screen and (max-width: 768px) {
    .profile-wrapper {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .profile-wrapper img {
        margin-bottom: 15px;
    }
    .stats {
        display: flex;
        justify-content: center;
        gap: 15px;
    }
    .gallery {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media screen and (max-width: 480px) {
    .gallery {
        grid-template-columns: 1fr;
    }
}
</style>

</head>

<body>

<!-- NAVBAR -->
<?php include "navbar.php"; ?>

<div class="container-box">

    <!-- PROFILE SECTION -->
    <div class="profile-wrapper">
        <img src="img/user_profile.jpg" alt="Profile Picture">

        <div>
            <div class="username">my_username</div>
            <button class="edit-btn">Edit Profile</button>

            <div class="stats">
                <span><strong>12</strong> posts</span>
                <span><strong>230</strong> followers</span>
                <span><strong>180</strong> following</span>
            </div>

            <p class="bio">This is my bio. Add something creative or catchy about yourself!</p>
        </div>
    </div>

    <hr>

    <!-- POSTS GRID -->
    <div class="gallery">
        <img src="img/post1.jpg" alt="Post 1">
        <img src="img/post2.jpg" alt="Post 2">
        <img src="img/post3.jpg" alt="Post 3">
        <img src="img/post4.jpg" alt="Post 4">
        <img src="img/post5.jpg" alt="Post 5">
        <img src="img/post6.jpg" alt="Post 6">
    </div>

</div>

</body>
</html>
