<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .story-img {
      width: 65px;
      height: 65px;
      object-fit: cover;
      border-radius: 50%;
      border: 2px solid #f2003c;
    }
    .post-img {
      object-fit: cover;
      width: 100%;
      height: 100%;
    }
  </style>

  <title>Instagram Home</title>
</head>

<body class="bg-light">

<!-- Stories Bar -->
<div class="bg-white border-bottom p-2">
  <div class="d-flex overflow-auto gap-3">
    <div class="text-center">
      <img src="avatar1.jpg" class="story-img">
      <small class="d-block">You</small>
    </div>
    <div class="text-center">
      <img src="avatar2.jpg" class="story-img">
      <small class="d-block">alex</small>
    </div>
    <div class="text-center">
      <img src="avatar3.jpg" class="story-img">
      <small class="d-block">sofia</small>
    </div>
    <!-- repeat -->
  </div>
</div>

<!-- Feed -->
<div class="container mt-3">

  <!-- Post -->
  <div class="card mb-4">
    <div class="d-flex align-items-center p-3">
      <img src="avatar2.jpg" class="rounded-circle me-2" width="40">
      <strong>alex</strong>
    </div>

    <div class="ratio ratio-1x1">
      <img src="post1.jpg" class="post-img">
    </div>

    <div class="p-3">
      <div class="d-flex gap-3 fs-4 mb-2">
        <span>❤️</span>
        <span>💬</span>
        <span>📤</span>
      </div>

      <p><strong>alex</strong> enjoying the weekend!</p>
    </div>
  </div>

</div>

<!-- Bottom Navigation -->
<nav class="navbar bg-white border-top fixed-bottom">
  <div class="container d-flex justify-content-around fs-4">
    <a class="nav-link px-3">🏠</a>
    <a class="nav-link px-3">🔍</a>
    <a class="nav-link px-3">➕</a>
    <a class="nav-link px-3">🎬</a>
    <a class="nav-link px-3">👤</a>
  </div>
</nav>

</body>
</html>
