<!-- signup.php -->
 <?php
require "conn.php";


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Account</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">

<style>
body {
  background: radial-gradient(circle at top, #1a1a1a, #0b0b0b);
  font-family: "Poppins", sans-serif;
  height:100vh;
  margin:0;
  display:flex;
  align-items:center;
  justify-content:center;
  color:white;
}

.card {
  background: rgba(255,255,255,0.06);
  backdrop-filter: blur(12px);
  border: 1px solid rgba(255,255,255,0.12);
  width: 360px;
  padding: 30px;
  border-radius: 20px;
  box-shadow: 0 8px 30px rgba(0,0,0,0.4);
}

.card h3 {
  text-align:center;
  background: linear-gradient(45deg, #ff004c, #ffa600);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  margin-bottom:20px;
  font-weight:700;
}

input {
  width:100%;
  padding:12px;
  border:1px solid rgba(255,255,255,0.2);
  border-radius:10px;
  margin-bottom:12px;
  background: rgba(255,255,255,0.08);
  color:white;
  outline:none;
  transition:0.3s;
}

input:focus {
  border-color:#ff004c;
  box-shadow:0 0 8px #ff004c88;
}

button {
  width:100%;
  padding:12px;
  background: linear-gradient(45deg,#ff004c,#ff6a00);
  border:none;
  border-radius:12px;
  margin-top:10px;
  font-size:16px;
  color:white;
  font-weight:600;
  cursor:pointer;
  transition:0.3s;
}

button:hover {
  transform:scale(1.03);
  box-shadow:0 0 10px #ff004c99;
}

a {
  color:#ff6a00;
  text-decoration:none;
}
</style>

</head>
<body>

<div class="card">

  <h3>Create Account</h3>

  <form action="signup_backend.php" method="POST">

    <input type="text" name="user_name" placeholder="Name" required>
    <input type="text" name="user_age" placeholder="Age" required>
    <input type="text" name="user_gender" placeholder="Gender" required>
    <input type="number" name="user_ph" placeholder="Phone Number" required>
    <input type="email" name="user_email" placeholder="Email" required>
    <input type="date" name="user_dob" required>
    <input type="password" name="user_password" placeholder="Password" required>

    <button type="submit" name="signup_btn">Sign Up</button>
  </form>

  <div style="text-align:center; margin-top:15px;">
    Already have an account? <a href="login.php">Login</a>
  </div>

</div>

</body>
</html>
