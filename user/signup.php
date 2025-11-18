<!DOCTYPE html>
<html>
<head>
<title>Signup - Instagram</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="card p-4" style="width: 350px;">

    <h3 class="text-center mb-3">Create Account</h3>

    <form action="signup_backend.php" method="POST">

      <input class="form-control mb-2" type="text" name="user_name" placeholder="Name" required>
      <input class="form-control mb-2" type="text" name="user_age" placeholder="Age" required>
      <input class="form-control mb-2" type="text" name="user_gender" placeholder="Gender" required>
      <input class="form-control mb-2" type="number" name="user_ph" placeholder="Phone number" required>
      <input class="form-control mb-2" type="email" name="user_email" placeholder="Email" required>
      <input class="form-control mb-2" type="date" name="user_dob" placeholder="DOB" required>
      <input class="form-control mb-2" type="password" name="user_password" placeholder="Password" required>

      <button class="btn btn-success w-100" type="signup" name="signup_btn" id="signup_btn">Sign Up</button>
    </form>

    <div class="text-center mt-3">
      <span>Already have an account?</span>
      <a href="login.php">Login</a>
    </div>

  </div>
</div>

</body>
</html>
