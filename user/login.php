<!-- login.php -->
 <?php
require "conn.php";


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">

<style>
body {
  background:#0c0c0c;
  display:flex;
  justify-content:center;
  align-items:center;
  height:100vh;
  font-family:"Poppins",sans-serif;
  color:white;
}

.card {
  width:360px;
  padding:30px;
  border-radius:20px;
  background:rgba(255,255,255,0.06);
  border:1px solid rgba(255,255,255,0.15);
  backdrop-filter:blur(12px);
}

.card h3 {
  text-align:center;
  font-size:26px;
  margin-bottom:20px;
  font-weight:700;
  background:linear-gradient(45deg,#ff004c,#ffa600);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
}

input {
  width:100%;
  padding:12px;
  border-radius:10px;
  background:rgba(255,255,255,0.08);
  border:1px solid rgba(255,255,255,0.15);
  margin-bottom:12px;
  color:white;
}

button {
  width:100%;
  padding:12px;
  margin-top:10px;
  border:none;
  border-radius:12px;
  font-size:16px;
  background:linear-gradient(45deg,#ff004c,#ff6a00);
  color:white;
  font-weight:600;
  cursor:pointer;
}

button:hover {
  transform:scale(1.03);
}
</style>
</head>

<body>

<div class="card">
  <h3>Login</h3>

  <form action="login_backend.php" method="POST">
    <input type="email" name="user_email" placeholder="Email" required>
    <input type="password" name="user_password" placeholder="Password" required>
    <button type="submit" name="login_btn">Login</button>
  </form>

  <div style="text-align:center; margin-top:15px;">
    Don't have an account? <a href="signup.php" style="color:#ff6a00;">Sign Up</a>
  </div>
</div>

</body>
</html>
