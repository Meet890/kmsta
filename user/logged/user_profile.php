<?php
//session_start();
require 'conn.php';

$acc_id = $_SESSION['acc_id'];
$searchUserId = $_GET["searchUserId"];

// Fetch user info
$sql = "SELECT * FROM accounts WHERE acc_id = $searchUserId ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $searchUserName = $row["acc_username"];
        $searchUserBio = $row["acc_bio"];
        $searchUserProfile = $row["acc_profile_photo"];
    }
}

// Following count
$sql = "SELECT COUNT(*) AS total FROM followers WHERE follower_id = $searchUserId";
$result = $conn->query($sql);
$following = $result->fetch_assoc()["total"];

// Followers count
$sql = "SELECT COUNT(*) AS total FROM followers WHERE following_id = $searchUserId";
$result = $conn->query($sql);
$followers = $result->fetch_assoc()["total"];

// Post count
$sql = "SELECT COUNT(*) AS total FROM post WHERE acc_id = $searchUserId";
$result = $conn->query($sql);
$postsCount = $result->fetch_assoc()["total"];

// Follow
if (isset($_POST['follow_btn'])) {
    $follower = $acc_id;
    $following = $_POST['follow_id'];

    if ($follower != $following) {
        $chk = mysqli_query($conn,
            "SELECT * FROM followers 
             WHERE follower_id='$follower' 
             AND following_id='$following'"
        );

        if (mysqli_num_rows($chk) == 0) {
            mysqli_query($conn,
                "INSERT INTO followers (follower_id, following_id)
                 VALUES ('$follower', '$following')"
            );
        }
    }

    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
}

// Unfollow
if (isset($_POST['unfollow_btn'])) {
    $follower = $acc_id;
    $following = $_POST['follow_id'];

    mysqli_query($conn,
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

    <style>
        body {
            margin: 0;
            padding: 0;
            background: radial-gradient(circle at top, #0b0b0b, #1a1a1a);
            font-family: "Poppins", sans-serif;
            color: white;
        }

        .container-box {
            padding: 25px;
            max-width: 900px;
            margin: auto;
        }

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
            transform: scale(1.05);
        }

        .stats {
            margin-top: 15px;
            font-size: 15px;
        }

        .stats span {
            margin-right: 20px;
        }

        .bio {
            margin-top: 10px;
            font-size: 14px;
            color: #ccc;
        }

        hr {
            border-color: #333;
            margin: 30px 0;
        }

        /* POSTS GRID */
        .gallery {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .post-box {
            position: relative;
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

        .post-actions {
            position: absolute;
            bottom: 6px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            opacity: 0;
            transition: 0.3s;
        }

        .post-box:hover .post-actions {
            opacity: 1;
        }

        .action-btn {
            background: rgba(0, 0, 0, 0.6);
            padding: 8px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.3);
            cursor: pointer;
            color: white;
            font-size: 18px;
            transition: 0.25s;
        }

        .action-btn:hover {
            transform: scale(1.25);
            background: rgba(255, 0, 76, 0.7);
        }

        .post-caption {
            margin-top: 5px;
            color: #fff;
            font-size: 14px;
            text-align: center;
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
            background: rgba(0, 0, 0, 0.95);
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .modal-content {
            max-width: 90%;
            max-height: 70%;
            border-radius: 15px;
            box-shadow: 0 0 20px #ff004caa;
        }

        .modal-caption {
            color: white;
            text-align: center;
            font-size: 16px;
            margin-top: 10px;
        }

        .modal-actions {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 10px;
        }

        @media screen and (max-width: 768px) {
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

<?php include "navbar.php"; ?>

<div class="container-box">

    <!-- PROFILE -->
    <div class="profile-wrapper">
        <img src="uploads/<?php echo ($searchUserProfile ?? 'default2.png'); ?>">

        <div>
            <div class="username"><?php echo $searchUserName; ?></div>

            <form method="post">
                <input type="hidden" name="follow_id" value="<?php echo $searchUserId; ?>">

                <?php
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

            <?php if ($isFollowing): ?>
                <form action="chat.php" method="GET">
                    <input type="hidden" name="user" value="<?php echo $searchUserId; ?>">
                    <button class="edit-btn" style="background:#444;">Chat</button>
                </form>
            <?php endif; ?>

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
        $sql = "SELECT * FROM post WHERE acc_id = $searchUserId ORDER BY post_id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $post_file = $row['post_location'];
                $file_type = $row['post_type'];
                $caption = $row['caption'] ?? '';
                $file_path = "uploads/" . $post_file;

                echo '<div class="post-box">';

                if ($file_type == "image") {
                    echo '<img src="' . $file_path . '" onclick="openModal(\'' . $file_path . '\', \'image\', \'' . addslashes($caption) . '\')">';
                }

                if ($file_type == "video") {
                    echo '<video onclick="openModal(\'' . $file_path . '\', \'video\', \'' . addslashes($caption) . '\')">
                            <source src="' . $file_path . '" type="video/mp4">
                          </video>';
                }

                echo '
                    <div class="post-actions">
                        <button class="action-btn like-btn"><i class="bi bi-heart"></i></button>
                        <button class="action-btn comment-btn"><i class="bi bi-chat"></i></button>
                    </div>
                    <div class="post-caption">' . htmlspecialchars($caption) . '</div>
                </div>';
            }
        } else {
            echo "<p>No posts.</p>";
        }
        ?>
    </div>

</div>

<!-- VIEW POST MODAL -->
<div id="postModal" class="modal">
    <img id="modalImg" class="modal-content" style="display:none;">
    <video id="modalVideo" class="modal-content" controls style="display:none;"></video>
    <div class="modal-caption"></div>
    <div class="modal-actions">
        <button class="action-btn like-btn"><i class="bi bi-heart"></i></button>
        <button class="action-btn comment-btn"><i class="bi bi-chat"></i></button>
    </div>
</div>

<script>
function openModal(fileSrc, type, caption) {
    const modal = document.getElementById("postModal");
    const modalImg = document.getElementById("modalImg");
    const modalVideo = document.getElementById("modalVideo");
    const modalCaption = modal.querySelector(".modal-caption");

    modal.style.display = "flex";
    modalCaption.textContent = caption;

    if (type === "image") {
        modalImg.src = fileSrc;
        modalImg.style.display = "block";
        modalVideo.style.display = "none";
    } else {
        modalVideo.src = fileSrc;
        modalVideo.style.display = "block";
        modalImg.style.display = "none";
        modalVideo.play();
    }
}

document.getElementById("postModal").addEventListener("click", function(e) {
    if (e.target === this) {
        this.style.display = "none";
        document.getElementById("modalImg").src = "";
        document.getElementById("modalVideo").pause();
        document.getElementById("modalVideo").src = "";
        this.querySelector(".modal-caption").textContent = "";
    }
});
</script>

</body>
</html>
