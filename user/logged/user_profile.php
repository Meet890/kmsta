<?php
//session_start();
require 'conn.php';
$acc_id=$_SESSION['acc_id'];
$searchUserId = $_GET["searchUserId"];
$sql = "SELECT * FROM accounts WHERE acc_id = $searchUserId ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $searchUserName = $row["acc_username"];
        $searchUserBio = $row["acc_bio"];
        $searchUserProfile = $row["acc_profile_photo"];
    }
}
//find following
$sql = "select count(*) as total  from followers where follower_id = $searchUserId";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$following = $row["total"];
//find followers
$sql = "select count(*) as total  from followers where following_id = $searchUserId";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$followers = $row["total"];
//find post
$sql = "select count(*) as total  from post where acc_id = $searchUserId";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$postsCount = $row["total"];


//follow and unfollow
if (isset($_POST['follow_btn'])) {

    $follower = $acc_id;               // logged in user
    $following = $_POST['follow_id'];  // target user

    if ($follower != $following) {

        // Check follow status
        $chk = mysqli_query(
            $conn,
            "SELECT * FROM followers 
             WHERE follower_id='$follower' 
             AND following_id='$following'"
        );

        if (mysqli_num_rows($chk) == 0) {
            // FOLLOW
            mysqli_query(
                $conn,
                "INSERT INTO followers (follower_id, following_id)
                 VALUES ('$follower', '$following')"
            );
        }
    }

    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
}


// UNFOLLOW
if (isset($_POST['unfollow_btn'])) {

    $follower = $acc_id;
    $following = $_POST['follow_id'];

    mysqli_query(
        $conn,
        "DELETE FROM followers 
         WHERE follower_id='$follower' 
         AND following_id='$following'"
    );

    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Account</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">

    <?php
    require_once "conn.php";
    ?>

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
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            box-shadow: 0 0 20px rgba(255, 0, 76, 0.3);
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
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            color: white;
            font-weight: 600;
            border-radius: 12px;
            margin-top: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        .edit-btn:hover {
            background: rgba(255, 255, 255, 0.2);
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

        .gallery img,
        .gallery video {
            width: 100%;
            aspect-ratio: 1/1;
            object-fit: cover;
            border-radius: 14px;
            transition: 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.1);
            cursor: pointer;
        }

        .gallery img:hover,
        .gallery video:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px #ff004caa;
        }

        /* ADD POST MODAL */
        #addPostModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 200;
        }

        #addPostModal .modal-content {
            background: #1a1a1a;
            padding: 25px;
            border-radius: 15px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 0 20px #ff004caa;
        }

        #addPostModal h3 {
            margin-bottom: 15px;
            text-align: center;
            color: #ff004c;
        }

        #addPostModal input,
        #addPostModal textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #333;
            background: #111;
            color: white;
        }

        #addPostModal button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
        }

        #addPostModal button[type="submit"] {
            background: linear-gradient(45deg, #ff004c, #ffae00);
            color: white;
        }

        #addPostModal button#closeModal {
            background: #333;
            color: white;
            margin-top: 10px;
        }

        /* VIEW POST MODAL */
        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            max-width: 90%;
            max-height: 90%;
            margin: auto;
            border-radius: 15px;
            box-shadow: 0 0 20px #ff004caa;
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
             <img src="uploads/<?php echo ($searchUserProfile ?? 'default2.png'); ?>">

            <div>
                <div style="display:flex; align-items:center; gap:10px;">
                    <div class="username"><?php echo $searchUserName; ?></div>
                </div>

                <form action="#" method="post">
                    <input type="hidden" name="follow_id" value="<?php echo $searchUserId; ?>">

                    <?php
                    // Check follow status
                    $isFollowQuery = mysqli_query(
                        $conn,
                        "SELECT * FROM followers 
                        WHERE follower_id='$acc_id' 
                        AND following_id='$searchUserId'"
                    );
                    $isFollowing = mysqli_num_rows($isFollowQuery) > 0;
                    ?>

                    <?php if ($isFollowing): ?>
                        <button class="edit-btn" name="unfollow_btn" style="background:#444;">Following</button>
                    <?php else: ?>
                        <button class="edit-btn" name="follow_btn" style="background:#0095f6;">Follow</button>
                    <?php endif; ?>
                </form>

                <div class="stats">
                    <span><strong><?php echo $postsCount; ?></strong> posts</span>
                    <span><strong><?php echo $followers; ?></strong> followers</span>
                    <span><strong><?php echo $following; ?></strong> following</span>
                </div>

                <p class="bio"><?php echo $searchUserBio; ?></p>
            </div>

        </div>

        <hr>

        <!-- POSTS GRID -->
        <div class="gallery">
            <?php
            $searchUserId = $_GET["searchUserId"];
            $sql = "SELECT * FROM post WHERE acc_id = $searchUserId ORDER BY post_id DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $post_file = $row['post_location'];
                    $file_type = $row['post_type'];  // image or video
                    $file_path = "uploads/" . $post_file;

                    if ($file_type == "image") {
                        echo '<img src="' . $file_path . '" alt="post-image" class="gallery-img" onclick="openModal(\'' . $file_path . '\', \'image\')">';
                    }

                    if ($file_type == "video") {
                        echo '<video class="gallery-img" onclick="openModal(\'' . $file_path . '\', \'video\')"><source src="' . $file_path . '" type="video/mp4"></video>';
                    }
                }
            } else {
                echo "<p>No posts.</p>";
            }
            ?>
        </div>

    </div>

    

    <!-- VIEW POST MODAL -->
    <div id="myModal" class="modal">
        <img id="modalImg" class="modal-content" style="display:none;">
        <video id="modalVideo" class="modal-content" controls style="display:none; max-height:90vh;"></video>
    </div>

    <script>
        // ===== ADD POST MODAL =====
        const addPostBtn = document.getElementById('addPostBtn');
        const addPostModal = document.getElementById('addPostModal');
        const closeAddModalBtn = document.getElementById('closeModal');

        addPostBtn.addEventListener('click', () => {
            addPostModal.style.display = 'flex';
        });

        closeAddModalBtn.addEventListener('click', () => {
            addPostModal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target === addPostModal) {
                addPostModal.style.display = 'none';
            }
        });

        // ===== VIEW POST MODAL =====
        const viewModal = document.getElementById("myModal");
        const modalImg = document.getElementById("modalImg");
        const modalVideo = document.getElementById("modalVideo");

        function openModal(fileSrc, type) {
            viewModal.style.display = "flex";

            if (type === "image") {
                modalImg.src = fileSrc;
                modalImg.style.display = "block";
                modalVideo.style.display = "none";
            } else if (type === "video") {
                modalVideo.src = fileSrc;
                modalVideo.style.display = "block";
                modalImg.style.display = "none";
                modalVideo.load();
                modalVideo.play();
            }
        }

        viewModal.addEventListener("click", function (e) {
            if (e.target === viewModal) {
                closeViewModal();
            }
        });

        function closeViewModal() {
            viewModal.style.display = "none";
            modalImg.src = "";
            modalVideo.pause();
            modalVideo.src = "";
        }
    </script>

</body>

</html>