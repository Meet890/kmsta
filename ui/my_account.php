<!DOCTYPE html>
<html>
<head>
<title>My Account - Instagram</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

<?php include "navbar.html"; ?>

<div class="container mt-4">

  <div class="d-flex">
    <img src="img/user_profile.jpg" class="rounded-circle" width="120" height="120">

    <div class="ms-4">
      <h4 class="fw-bold">my_username</h4>
      <button class="btn btn-outline-secondary btn-sm">Edit Profile</button>

      <div class="mt-3">
        <span class="me-3"><strong>12</strong> posts</span>
        <span class="me-3"><strong>230</strong> followers</span>
        <span><strong>180</strong> following</span>
      </div>

      <p class="mt-2">This is my bio...</p>
    </div>
  </div>

  <hr>

  <!-- User posts grid -->
  <div class="row">
    <div class="col-4 mb-3"><img src="img/post1.jpg" class="img-fluid"></div>
    <div class="col-4 mb-3"><img src="img/post2.jpg" class="img-fluid"></div>
    <div class="col-4 mb-3"><img src="img/post3.jpg" class="img-fluid"></div>
  </div>

</div>

</body>
</html>
