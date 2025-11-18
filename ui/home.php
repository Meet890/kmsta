<!DOCTYPE html>
<html>
<head>
<title>Home - Instagram</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

<!-- Include Navbar -->
<?php include "navbar.html"; ?>

<div class="container mt-3">

  <!-- Stories -->
  <div class="d-flex overflow-auto pb-3 mb-4 border-bottom">
    <div class="text-center me-3">
      <img src="img/user1.jpg" class="rounded-circle border" width="70" height="70">
      <small class="d-block">You</small>
    </div>

    <div class="text-center me-3">
      <img src="img/user2.jpg" class="rounded-circle border" width="70" height="70">
      <small class="d-block">Anna</small>
    </div>

    <div class="text-center me-3">
      <img src="img/user3.jpg" class="rounded-circle border" width="70" height="70">
      <small class="d-block">Mike</small>
    </div>
  </div>


  <!-- Posts -->
  <div class="card mb-4">
    <div class="card-header d-flex align-items-center">
      <img src="img/user2.jpg" class="rounded-circle me-2" width="40" height="40">
      <strong>anna_22</strong>
    </div>

    <img src="img/post1.jpg" class="card-img-top">

    <div class="card-body">
      <i class="bi bi-heart fs-3 me-3"></i>
      <i class="bi bi-chat fs-3"></i>

      <p class="mt-2"><strong>anna_22</strong> Enjoying the beach today!</p>

      <a href="post_view.html" class="text-muted">View all comments</a>
    </div>
  </div>

</div>

</body>
</html>
