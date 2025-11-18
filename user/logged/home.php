<?php
// session_start();
require '../conn.php';
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
/* ---------------- GLOBAL THEME ---------------- */
body {
  margin: 0;
  padding: 0;
  background: #0f0f0f;
  font-family: "Poppins", sans-serif;
  color: white;
  overflow-x: hidden;
}

/* Smooth scrollbar */
::-webkit-scrollbar { width: 6px; }
::-webkit-scrollbar-thumb { background:#444; border-radius:10px; }

/* ---------------- PREMIUM NAVBAR ---------------- */
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
  animation: navSlide 0.8s ease-out;
}

@keyframes navSlide {
  from { opacity:0; transform:translateY(-20px); }
  to { opacity:1; transform:translateY(0); }
}

.nav-title {
  font-size: 22px;
  font-weight: 700;
  color: white;
  background: linear-gradient(45deg, #ff004c, #ffae00);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.nav-icon {
  color: white;
  cursor: pointer;
  transition: 0.3s;
}
.nav-icon:hover { transform: scale(1.2); }

/* ---------------- STORIES ---------------- */
.story-bar {
  padding: 12px 10px;
  display: flex;
  gap: 20px;
  overflow-x: auto;
}

.story {
  text-align: center;
  color: white;
}

.story-img {
  width: 70px;
  height: 70px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid #ff004c;
  box-shadow: 0px 0px 10px #ff004c90;
  transition: 0.3s;
}

.story-img:hover {
  transform: scale(1.07);
}

/* ---------------- POST CARD ---------------- */
.post-card {
  background: rgba(25,25,25,0.8);
  border-radius: 16px;
  overflow: hidden;
  margin: 15px 12px;
  border: 1px solid rgba(255,255,255,0.08);
  box-shadow: 0px 4px 14px rgba(0,0,0,0.6);
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

.post-img {
  width: 100%;
  height: auto;
  max-height: 400px;
  object-fit: cover;
}

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
}

/* ---------------- BOTTOM NAV ---------------- */
.bottom-nav {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  background: rgba(20, 20, 20, 0.9);
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

  <div class="story">
    <img src="avatar4.jpg" class="story-img">
    <small>Meet</small>
  </div>
</div>

<!-- POST FEED -->
<div class="post-card">
  <div class="post-header">
    <img src="avatar2.jpg">
    <strong>Alex</strong>
  </div>

  <img src="post1.jpg" class="post-img">

  <div class="post-actions">
    <span>❤️</span>
    <span>💬</span>
    <span>📤</span>
  </div>

  <div style="padding: 0 14px 14px;">
    <strong>Alex</strong> enjoying the weekend!
  </div>
</div>

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
</script>

</body>
</html>
