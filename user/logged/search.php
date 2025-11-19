<?php
include "conn.php";
// session_start();

// Logged in account ID
$acc_id = $_SESSION['acc_id'];        // follower_id
$loggedUser = $_SESSION['acc_id'];   // same as above? Using your own vars

$query = "";
$users = [];

/* -----------------------------------------
   SEARCH USERS
----------------------------------------- */
if (isset($_GET['query'])) {
    $query = mysqli_real_escape_string($conn, $_GET['query']);
    $sql = "SELECT * FROM accounts
            WHERE acc_username LIKE '%$query%' 
            OR acc_bio LIKE '%$query%'";
    $users = mysqli_query($conn, $sql);
}

/* -----------------------------------------
   FOLLOW / UNFOLLOW LOGIC
----------------------------------------- */

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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Search</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;900&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide-icons@latest"></script>

    <style>
        /* GLOBAL */
        body {
            margin: 0;
            background: #0f0f0f;
            font-family: "Poppins", sans-serif;
            color: white;
        }

        .search-box {
            max-width: 800px;
            margin: 40px auto;
            padding: 10px;
        }

        .search-heading {
            color: white;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .search-heading span {
            color: #ff004c;
        }

        a:link,
        a:visited,
        a:hover,
        a:active {
            color: inherit;
            /* or a specific color */
            text-decoration: none;
        }

        .user-grid {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .user-card {
            display: flex;
            align-items: center;
            background: rgba(25, 25, 25, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            overflow: hidden;
            padding: 14px;
            transition: 0.3s;
        }

        .user-card:hover {
            border-color: #ff004c;
            transform: translateY(-3px);
        }

        .user-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 16px;
            border: 2px solid #ff004c;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            color: #fff;
            font-weight: 600;
            font-size: 16px;
        }

        .user-username {
            color: #bbb;
            font-size: 14px;
        }

        /* SEARCH RESULTS */
        .user-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(25, 25, 25, 0.8);
            padding: 14px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .user-content {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 2px solid #ff004c;
            object-fit: cover;
        }

        /* BUTTONS */
        .follow-btn {
            background: #0095f6;
            color: white;
            padding: 8px 18px;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        .following-btn {
            background: transparent;
            border: 1px solid #555;
            color: white;
            padding: 8px 18px;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <?php include "navbar.php"; ?>

    <div class="search-box">

        <?php if ($query != ""): ?>
            <h2 class="search-heading">Search results for: <span><?php echo htmlspecialchars($query); ?></span></h2>
        <?php endif; ?>

        <div class="user-grid">
            <?php
            if ($query != "" && mysqli_num_rows($users) > 0) {

                while ($u = mysqli_fetch_assoc($users)) {

                    // skip own profile
                    if ($u['acc_id'] == $loggedUser)
                        continue;

                    // check follow status
                    $checkFollow = mysqli_query(
                        $conn,
                        "SELECT * FROM followers
                                WHERE follower_id='$acc_id'
                                AND following_id='{$u['acc_id']}'"
                    );

                    $isFollowing = mysqli_num_rows($checkFollow) > 0;
                    ?>
                    <a href="user_profile.php?searchUserId=<?php echo $u['acc_id'] ?>">
                        <div class="user-card">

                            <!-- LEFT : PROFILE -->
                            <div class="user-content">
                                <img src="uploads/<?php echo $u['acc_profile_photo']; ?>" class="user-img">
                                <div class="user-info">
                                    <div class="user-name">@<?php echo $u['acc_username']; ?></div>
                                    <div class="user-username"><?php echo $u['acc_bio']; ?></div>
                                </div>
                            </div>

                            <!-- RIGHT : FOLLOW / UNFOLLOW -->
                            <?php if ($isFollowing): ?>

                                <form method="post">
                                    <input type="hidden" name="follow_id" value="<?php echo $u['acc_id']; ?>">
                                    <button name="unfollow_btn" class="following-btn">Following</button>
                                </form>

                            <?php else: ?>

                                <form method="post">
                                    <input type="hidden" name="follow_id" value="<?php echo $u['acc_id']; ?>">
                                    <button name="follow_btn" class="follow-btn">Follow</button>
                                </form>

                            <?php endif; ?>

                        </div>
                    </a>

                <?php }

            } else {
                echo "<p style='color:#bbb;'>No users found.</p>";
            }
            ?>
        </div>
    </div>

    <script> lucide.createIcons(); </script>

</body>

</html>