<!DOCTYPE html>
<html>
<head>
<title>Login - Instagram</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="card p-4" style="width: 350px;">

    <h3 class="text-center mb-4">Instagram</h3>

    <form action="backend/login.php" method="POST">
      <div class="mb-3">
        <input type="text" class="form-control" name="username" placeholder="Username" required>
      </div>

      <div class="mb-3">
        <input type="password" class="form-control" name="password" placeholder="Password" required>
      </div>

      <button class="btn btn-primary w-100">Log In</button>
    </form>

    <div class="text-center mt-3">
      <span>Don't have an account?</span>
      <a href="signup.html">Sign up</a>
    </div>

  </div>
</div>

</body>
</html>
