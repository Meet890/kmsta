<?php
require "conn.php";
// session_start();
  // echo '<pre>';
  //   var_dump($_SESSION);
  //   echo '</pre>';

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KMSTA ADMIN PANEL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      body {
        background: #f5f6fa;
      }
      .sidebar {
        height: 100vh;
        background: #1f2937;
        padding-top: 20px;
      }
      .sidebar a {
        padding: 12px 20px;
        display: block;
        color: #d1d5db;
        text-decoration: none;
        font-size: 16px;
      }
      .sidebar a:hover {
        background: #374151;
        color: #fff;
      }
      .sidebar .active {
        background: #4b5563;
        color: #fff;
      }
      .content {
        padding: 30px;
      }
    </style>
  </head>

  <body>

    <div class="container-fluid">
      <div class="row">
        
        <!-- SIDEBAR -->
        <div class="col-md-2 sidebar">
          <h4 class="text-center text-light mb-4">KMSTA ADMIN</h4>
          
          <a href="#" class="active">Dashboard</a>
          <a href="#">Users</a>
          <a href="#">Accounts</a>
          <a href="#">Posts</a>
          <a href="#">Reports</a>
          <a href="#">Messages</a>
          <a href="#">Analytics</a>
          <a href="../user/logout.php">Logout</a>
        </div>

        <!-- MAIN CONTENT -->
        <div class="col-md-10 content">
          <h2 class="mb-4">Dashboard</h2>

          <div class="row g-4">

            <!-- Users card -->
            <div class="col-sm-6 col-lg-4">
              <div class="card shadow-sm">
                <div class="card-body">
                  <h5 class="card-title">Users</h5>
                  <p class="card-text">Manage all platform users, activity, and suspensions.</p>
                  <a href="users.php" class="btn btn-primary">Manage Users</a>
                </div>
              </div>
            </div>

            <!-- Accounts card -->
            <div class="col-sm-6 col-lg-4">
              <div class="card shadow-sm">
                <div class="card-body">
                  <h5 class="card-title">Accounts</h5>
                  <p class="card-text">Review account details and ownership data.</p>
                  <a href="accounts.php" class="btn btn-primary">Manage Accounts</a>
                </div>
              </div>
            </div>

            <!-- Posts card -->
            <div class="col-sm-6 col-lg-4">
              <div class="card shadow-sm">
                <div class="card-body">
                  <h5 class="card-title">Posts</h5>
                  <p class="card-text">Moderate posts of user-generated content.</p>
                  <a href="#" class="btn btn-primary">View Posts</a>
                </div>
              </div>
            </div>

            <!-- Reports card -->
            <div class="col-sm-6 col-lg-4">
              <div class="card shadow-sm">
                <div class="card-body">
                  <h5 class="card-title">Reports</h5>
                  <p class="card-text">Handle user reports on content or behavior.</p>
                  <a href="#" class="btn btn-danger">Review Reports</a>
                </div>
              </div>
            </div>

            <!-- Messages card -->
            <div class="col-sm-6 col-lg-4">
              <div class="card shadow-sm">
                <div class="card-body">
                  <h5 class="card-title">Messages</h5>
                  <p class="card-text">Admin broadcasts & user inquiries.</p>
                  <a href="#" class="btn btn-secondary">Open Inbox</a>
                </div>
              </div>
            </div>

            <!-- Analytics card -->
            <div class="col-sm-6 col-lg-4">
              <div class="card shadow-sm">
                <div class="card-body">
                  <h5 class="card-title">Analytics</h5>
                  <p class="card-text">View engagement, growth, and traffic statistics.</p>
                  <a href="#" class="btn btn-success">View Analytics</a>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
