<?php
// session_start(); 
require_once "conn.php";

$acc_id = $_SESSION['acc_id'] ?? 0;

$sql_user = "SELECT acc_username FROM accounts WHERE acc_id = $acc_id LIMIT 1";
$result_user = $conn->query($sql_user);
$sql_bio = "SELECT acc_bio FROM accounts WHERE acc_id = $acc_id LIMIT 1";
$result_bio = $conn->query($sql_bio);


// FIND TOTAL FOLLOWERS
$sql = "SELECT COUNT(*) AS total FROM followers WHERE following_id = $acc_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$followers = $row['total'];

// FIND TOTAL FOLLOWING
$sql = "SELECT COUNT(*) AS total FROM followers WHERE follower_id = $acc_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$following = $row['total'];

// FIND TOTAL POSTS
$sql = "SELECT COUNT(*) AS total FROM post WHERE acc_id = $acc_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$postsCount = $row['total'];

//update profile image

if (isset($_POST['Update_Image'])) {

    $userId = $_SESSION['acc_id'];

    // File info
    $fileName = $_FILES['profile_photo']['name'];
    $tmpName = $_FILES['profile_photo']['tmp_name'];

    // Unique name
    $newName = time() . "_" . $fileName;

    // Move file to uploads folder
    move_uploaded_file($tmpName, "uploads/" . $newName);

    // Update DB
    $update = mysqli_query(
        $conn,
        "UPDATE accounts 
         SET acc_profile_photo='$newName' 
         WHERE acc_id='$userId'"
    );

    // Update session so profile image updates everywhere
    $_SESSION['acc_profile_photo'] = $newName;

    // Refresh page
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
}


//

if ($result_user && $result_user->num_rows > 0) {
    $user_row = $result_user->fetch_assoc();
    $username = htmlspecialchars($user_row['acc_username']);
} else {
    $username = "Unknown User";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Account</title>

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

        /* ====== POST ACTION BUTTONS (NEW) ====== */

.post-box {
    position: relative;
}

.post-actions {
    position: absolute;
    bottom: 8px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 12px;
    opacity: 0;
    transition: 0.3s ease-in-out;
}

.post-box:hover .post-actions {
    opacity: 1;
}

.action-btn {
    background: rgba(0,0,0,0.6);
    border: 1px solid rgba(255,255,255,0.2);
    padding: 8px 10px;
    border-radius: 50%;
    color: white;
    cursor: pointer;
    transition: 0.25s;
    font-size: 18px;
}

.action-btn:hover {
    background: rgba(255,0,76,0.7);
    transform: scale(1.25);
}

    </style>

</head>

<body>

    <!-- NAVBAR -->
    <?php include "navbar.php"; ?>

    <div class="container-box">

        <!-- PROFILE SECTION -->
        <div class="profile-wrapper">
            <img src="uploads/<?php echo ($_SESSION['acc_profile_photo'] ?? 'default2.png'); ?>">



            <div>
                <div style="display:flex; align-items:center; gap:10px;">
                    <div class="username"><?php echo $username; ?></div>
                </div>
                <button class="edit-btn" id="UpdateImageBtn">Update Photo</button>
                <a href="edit_profile.php"><button class="edit-btn">Edit Profile</button></a>
                <button class="edit-btn" id="addPostBtn">Add Post</button>

                <div class="stats">
                    <div class="stats">
                    <span><strong><?php echo $postsCount; ?></strong> posts</span>
                    <span><strong><?php echo $followers; ?></strong> followers</span>
                    <span><strong><?php echo $following; ?></strong> following</span>
        </div>
                </div>

                <p class="bio">This is my bio. Add something creative or catchy about yourself!</p>
            </div>

        </div>

        <hr>

        <!-- POSTS GRID -->
        <div class="gallery">
            <?php
            $acc_id = $_SESSION["acc_id"];
            $sql = "SELECT * FROM post WHERE acc_id = $acc_id ORDER BY post_id DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $post_file = $row['post_location'];
                    $file_type = $row['post_type'];  // image or video
                    $file_path = "uploads/" . $post_file;

echo '<div class="post-box">';

if ($file_type == "image") {
    echo '<img src="' . $file_path . '" class="gallery-img" onclick="openModal(\'' . $file_path . '\', \'image\')">';
}

if ($file_type == "video") {
    echo '<video class="gallery-img" onclick="openModal(\'' . $file_path . '\', \'video\')">
            <source src="' . $file_path . '" type="video/mp4">
          </video>';
}

// === POST UI BUTTONS ===
echo '
    <div class="post-actions">
        <button class="action-btn like-btn"><i class="bi bi-heart"></i></button>
        <button class="action-btn comment-btn"><i class="bi bi-chat"></i></button>
        <button class="action-btn delete-btn" data-id="' . $row['post_id'] . '"><i class="bi bi-trash"></i></button>
    </div>
</div>';

                }
            } else {
                echo "<p>No posts.</p>";
            }
            ?>
        </div>

    </div>
    <!-- update modal -->
    <div id="UpdateImageModal" style="display:none;">
        <div class="modal-content">
            <h3>Update Image</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="profile_photo" accept=".jpg,.jpeg,.png" required>
                <button type="submit" name="Update_Image">Upload</button>
            </form>
            <button id="closeModal">Cancel</button>
        </div>
    </div>
    <!-- ADD POST MODAL -->
    <div id="addPostModal">
        <div class="modal-content">
            <h3>Add New Post</h3>
            <form action="upload_post.php" method="post" enctype="multipart/form-data">
                <input type="file" name="post_file" accept=".jpg,.jpeg,.png,.mp4" required>
                <textarea name="post_caption" placeholder="Write a caption..."></textarea>
                <button type="submit" name="upload_post">Upload</button>
            </form>
            <button id="closeModal">Cancel</button>
        </div>
    </div>

    <!-- VIEW POST MODAL -->
    <div id="myModal" class="modal">
        <img id="modalImg" class="modal-content" style="display:none;">
        <video id="modalVideo" class="modal-content" controls style="display:none; max-height:90vh;"></video>
    </div>
    <div id="deleteModal" class="modal" style="display:none; justify-content:center; align-items:center;">
    <div class="modal-content" style="background:#222; padding:20px; border-radius:12px; width:300px; text-align:center;">
        <h3 style="color:#ff004c; margin-bottom:10px;">Delete Post?</h3>
        <p style="color:#ccc;">This action is UI only and does nothing.</p>

        <button class="edit-btn" id="confirmDelete">Yes, Delete</button>
        <button class="edit-btn" id="cancelDelete" style="margin-top:10px;">Cancel</button>
    </div>
</div>

    <script>
        const openBtn = document.getElementById('UpdateImageBtn');
        const modal = document.getElementById('UpdateImageModal');
        const closeBtn = document.getElementById('closeModal');

        openBtn.addEventListener('click', () => {
            modal.style.display = 'flex';
        });

        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>

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

        // ===== UI DELETE ONLY =====
let deleteModal = document.getElementById("deleteModal");
let deletePostID = null;

// open delete confirmation
document.querySelectorAll(".delete-btn").forEach(btn => {
    btn.addEventListener("click", () => {
        deletePostID = btn.dataset.id;
        deleteModal.style.display = "flex";
    });
});

// cancel
document.getElementById("cancelDelete").onclick = () => {
    deleteModal.style.display = "none";
};

// UI only confirm
document.getElementById("confirmDelete").onclick = () => {
    alert("UI ONLY: Post ID " + deletePostID + " would be deleted.");
    deleteModal.style.display = "none";
};

// close modal on outside click
window.onclick = function(e) {
    if (e.target === deleteModal) {
        deleteModal.style.display = "none";
    }
};

    </script>

</body>

</html>