<?php
require 'conn.php';

// Logged in user ID
$login_id = $_SESSION['acc_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Home</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide-icons@latest"></script>

  <style>
    body {
      margin: 0;
      padding: 0;
      background: #0f0f0f;
      font-family: "Poppins", sans-serif;
      color: white;
      overflow-x: hidden;
    }

    .post-card {
      width: 750px;
      margin: 20px auto;
      background: rgba(25, 25, 25, 0.85);
      border-radius: 16px;
      border: 1px solid rgba(255, 255, 255, 0.08);
      overflow: hidden;
    }

    .post-header {
      display: flex;
      align-items: center;
      padding: 14px;
    }

    .post-header img {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      margin-right: 12px;
    }

    .post-img {
      width: 100%;
      height: 350px;
      object-fit: cover;
      cursor: pointer;
    }

    .post-actions {
      padding: 12px 14px;
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 26px;
    }

    .like-btn {
      font-size: 28px;
      cursor: pointer;
      transition: 0.2s;
    }

    .comment-section {
      padding: 10px 14px;
    }

    .comment-input {
      width: 100%;
      padding: 8px 12px;
      border-radius: 20px;
      border: none;
      background: rgba(255, 255, 255, 0.12);
      color: white;
    }

    .comment-item {
      padding: 6px 0;
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .delete-comment {
      color: #ff2f4d;
      cursor: pointer;
      font-size: 12px;
      margin-left: 8px;
    }
  </style>

</head>

<body>

<?php include 'navbar.php'; ?>

<?php
$posts = mysqli_query($conn, "
    SELECT p.*, a.acc_username, a.acc_profile_photo 
    FROM post p
    JOIN accounts a ON a.acc_id = p.acc_id
    ORDER BY p.post_id DESC
");

while ($post = mysqli_fetch_assoc($posts)):

    $post_id = $post['post_id'];

    // LIKE COUNT
    $like_q = mysqli_query($conn, "SELECT COUNT(*) AS c FROM post_likes WHERE post_id=$post_id");
    $count_row = mysqli_fetch_assoc($like_q);
    $like_count = $count_row['c'];

    // Check if user liked already
    $liked_q = mysqli_query($conn, "SELECT * FROM post_likes WHERE post_id=$post_id AND user_id=$login_id");
    $liked = mysqli_num_rows($liked_q) > 0;
?>

<div class="post-card" data-postid="<?= $post_id ?>">

    <div class="post-header">
        <img src="uploads/<?= $post['acc_profile_photo'] ?>">
        <strong><?= $post['acc_username'] ?></strong>
    </div>

    <?php if ($post['post_type'] == 'image'): ?>
        <img src="uploads/<?= $post['post_location'] ?>" class="post-img">
    <?php else: ?>
        <video src="uploads/<?= $post['post_location'] ?>" class="post-img" controls></video>
    <?php endif; ?>

    <div class="post-actions">
        <!-- LIKE BUTTON -->
        <span class="like-btn" 
              data-postid="<?= $post_id ?>" 
              style="color: <?= $liked ? 'red' : 'white' ?>;">❤️</span>

        <!-- LIKE COUNT (empty if 0) -->
        <span id="like-count-<?= $post_id ?>">
            <?= $like_count > 0 ? $like_count . " likes" : "" ?>
        </span>

        <span class="comment-btn" data-postid="<?= $post_id ?>">💬</span>
        <!-- <span class="share-btn">📤</span> -->
    </div>

    <!-- CAPTION -->
    <div style="padding: 0 14px 8px;"><?= htmlspecialchars($post['post_caption']) ?></div>

    <!-- COMMENT LIST -->
    <div id="comment-list-<?= $post_id ?>" style="padding: 0 14px 10px;">
        <?php
        $com = mysqli_query($conn, "
           SELECT c.*, a.acc_username 
           FROM post_comments c 
           JOIN accounts a ON a.acc_id = c.user_id 
           WHERE c.post_id=$post_id 
           ORDER BY c.id DESC
        ");
        while ($c = mysqli_fetch_assoc($com)):
        ?>
            <div class="comment-item">
                <b><?= $c['acc_username'] ?>:</b>
                <?= htmlspecialchars($c['comment']) ?>
                <?php if ($c['user_id'] == $login_id): ?>
                    <span class="delete-comment" data-comment="<?= $c['id'] ?>">Delete</span>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- COMMENT INPUT -->
    <div class="comment-section">
        <input type="text" class="comment-input" placeholder="Add a comment..." data-postid="<?= $post_id ?>">
    </div>

</div>

<?php endwhile; ?>

<script>document.querySelectorAll('.like-btn').forEach(btn => {
  btn.addEventListener('click', function() {
    const postId = this.dataset.postid;
    
    fetch('like_post.php', {
      method: 'POST',
      headers: {'Content-Type':'application/x-www-form-urlencoded'},
      body: `post_id=${postId}`
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        this.textContent = `❤️ ${data.like_count}`;
        this.classList.toggle("liked", data.liked);
      }
    });
  });
});


// ADD COMMENT
document.querySelectorAll('.comment-input').forEach(input => {
    input.addEventListener('keypress', function(e){
        if(e.key === "Enter"){
            let postId = this.dataset.postid;
            let text = this.value.trim();
            if(text === "") return;

            fetch("add_comment.php", {
                method:"POST",
                headers: {"Content-Type":"application/x-www-form-urlencoded"},
                body: "post_id="+postId+"&comment_text="+encodeURIComponent(text)
            })
            .then(res => res.text())
            .then(html => {
                document.getElementById("comment-list-" + postId).innerHTML = html;
            });

            this.value = "";
        }
    });
});

// DELETE COMMENT
document.addEventListener("click", function(e){
    if(e.target.classList.contains("delete-comment")){

        const id = e.target.dataset.comment;

        fetch("delete_comment.php", {
            method:"POST",
            headers: {"Content-Type":"application/x-www-form-urlencoded"},
            body: "comment_id=" + id
        });

        e.target.closest(".comment-item").remove();
    }
});
</script>

</body>
</html>
