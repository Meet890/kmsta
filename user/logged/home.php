<?php
// session_start();
require 'conn.php';
// echo $_SESSION['acc_id'];
//  echo '<pre>';
//     var_dump($_SESSION);
//     echo '</pre>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Home</title>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;900&display=swap" rel="stylesheet">

<!-- Icons -->
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

/* Scrollbar */
::-webkit-scrollbar { width: 6px; }
::-webkit-scrollbar-thumb { background:#444; border-radius:10px; }

/* Navbar */
.navbar-custom {
  width: 100%;
  background: rgba(20,20,20,0.9);
  border-bottom: 1px solid rgba(255,255,255,0.06);
  padding: 12px 20px;
  backdrop-filter: blur(10px);
  position: sticky;
  top: 0;
  z-index: 50;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.nav-title {
  font-size: 22px;
  font-weight: 700;
  color: white;
  background: linear-gradient(45deg, #ff004c, #ffae00);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

/* Stories */
.story-bar {
  padding: 12px 10px;
  display: flex;
  gap: 20px;
  overflow-x: auto;
}
.story { text-align: center; color: white; }
.story-img {
  width: 70px;
  height: 70px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid #ff004c;
  box-shadow: 0 0 10px #ff004c90;
  transition: 0.3s;
}
.story-img:hover { transform: scale(1.07); }

/* Post Cards */
.post-card {
  width: 750px; /* square card */
  margin: 20px auto;
  background: rgba(25,25,25,0.85);
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid rgba(255,255,255,0.08);
  box-shadow: 0 4px 14px rgba(0,0,0,0.6);
  transition: 0.3s;
}
.post-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 18px rgba(0,0,0,0.8);
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
  border: 2px solid #ff004c;
}

/* Post Media */
.post-img {
  width: 100%;
  height: 350px;
  object-fit: cover;
  cursor: pointer;
  transition: 0.3s;
}
.post-img:hover { opacity: 0.9; }

/* Modal for fullscreen view */
.modal {
  display: none;
  position: fixed;
  z-index: 999;
  padding-top: 60px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.9);
}
.modal-content {
  margin: auto;
  display: block;
  max-width: 90%;
  max-height: 90%;
}
.close-modal {
  position: absolute;
  top: 20px;
  right: 35px;
  color: white;
  font-size: 40px;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s;
}
.close-modal:hover { color: #ff004c; }

/* Post actions */
.post-actions {
  padding: 14px;
  display: flex;
  gap: 20px;
  font-size: 26px;
}
.post-actions span {
  cursor: pointer;
  transition: 0.2s;
}
.post-actions span:hover {
  transform: scale(1.2);
  color: #ff004c;
}

/* Comment section */
.comment-section {
  padding: 0 14px 14px;
  display: flex;
  flex-direction: column;
  gap: 6px;
}
.comment-section input {
  width: 100%;
  padding: 8px 12px;
  border-radius: 20px;
  border: none;
  background: rgba(255,255,255,0.1);
  color: white;
  outline: none;
  transition: 0.3s;
}
.comment-section input:hover { background: rgba(255,255,255,0.2); }
.comment-section input:focus { background: rgba(255,255,255,0.25); }

/* Bottom nav */
.bottom-nav {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  background: rgba(20,20,20,0.9);
  backdrop-filter: blur(10px);
  border-top: 1px solid rgba(255,255,255,0.08);
  display: flex;
  justify-content: space-around;
  padding: 12px 0;
  font-size: 26px;
  z-index: 50;
}
.bottom-nav a {
  color: white;
  text-decoration: none;
  transition: 0.25s;
}
.bottom-nav a:hover {
  color: #ff004c;
  transform: scale(1.2);
}
</style>
</head>
<body>

<!-- Fullscreen modal -->
<div id="mediaModal" class="modal">
  <span class="close-modal">&times;</span>
  <img class="modal-content" id="modalImg">
</div>

<?php include "navbar.php"; ?>

<!-- STORIES -->
<div class="story-bar">
  <div class="story">
    <img src="avatar1.jpg" class="story-img">
    <small>You</small>
  </div>
  <div class="story">
    <img src="avatar2.jpg" class="story-img">
    <small>Alex</small>
  </div>
  <div class="story">
    <img src="avatar3.jpg" class="story-img">
    <small>Bhoomi</small>
  </div>
</div>

<!-- POST FEED -->
<?php
$posts = mysqli_query($conn, "SELECT p.*, a.acc_username, a.acc_profile_photo 
                              FROM post p 
                              JOIN accounts a ON p.acc_id=a.acc_id 
                              ORDER BY p.post_id DESC");

while($post = mysqli_fetch_assoc($posts)):
?>
<div class="post-card" data-postid="<?= $post['post_id'] ?>">
  <div class="post-header">
    <img src="uploads/<?= $post['acc_profile_photo'] ?>" alt="<?= $post['acc_username'] ?>">
    <strong><?= htmlspecialchars($post['acc_username']) ?></strong>
  </div>

  <?php if($post['post_type'] == 'image'): ?>
    <img src="uploads/<?= $post['post_location'] ?>" class="post-img" alt="Post Image">
  <?php elseif($post['post_type'] == 'video'): ?>
    <video src="uploads/<?= $post['post_location'] ?>" class="post-img" controls></video>
  <?php endif; ?>

  <div class="post-actions">
    <span class="like-btn" data-postid="<?= $post['post_id'] ?>">❤️</span>
    <span class="comment-btn" data-postid="<?= $post['post_id'] ?>">💬</span>
    <span class="share-btn">📤</span>
  </div>

  <div style="padding: 0 14px 8px;">
    <?= htmlspecialchars($post['post_caption']) ?>
  </div>

  <div class="comment-section">
    <input type="text" placeholder="Add a comment..." data-postid="<?= $post['post_id'] ?>">
    <button type="submit" name="submit" id="submit">submit</button>
  </div>
</div>
<?php endwhile; ?>

<!-- BOTTOM NAV -->
<div class="bottom-nav">
  <a href="#"><i data-lucide="home"></i></a>
  <a href="#"><i data-lucide="search"></i></a>
  <a href="#"><i data-lucide="plus-circle"></i></a>
  <a href="#"><i data-lucide="clapperboard"></i></a>
  <a href="#"><i data-lucide="user"></i></a>
</div>

<script>
lucide.createIcons();

// Like button
document.querySelectorAll('.like-btn').forEach(btn => {
  btn.addEventListener('click', function() {
    const postId = this.dataset.postid;
    this.classList.toggle('liked');
    fetch('like_post.php', {
      method: 'POST',
      headers: {'Content-Type':'application/x-www-form-urlencoded'},
      body: `post_id=${postId}`
    });
  });
});

// Comment input: Enter key
document.querySelectorAll('.comment-section input').forEach(input => {
  input.addEventListener('keypress', function(e){
    if(e.key === 'Enter') {
      const postId = this.dataset.postid;
      const comment = this.value.trim();
      if(comment === '') return;
      fetch('add_comment.php', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: `post_id=${postId}&comment_text=${encodeURIComponent(comment)}`
      });
      this.value = '';
    }
  });
});

// Open modal on image/video click
document.querySelectorAll('.post-img').forEach(el => {
  el.addEventListener('click', function() {
    const modal = document.getElementById('mediaModal');
    const modalImg = document.getElementById('modalImg');
    modal.style.display = "block";
    modalImg.src = this.src;
  });
});

// Close modal
document.querySelector('.close-modal').addEventListener('click', function() {
  document.getElementById('mediaModal').style.display = "none";
});
</script>

</body>
</html>
