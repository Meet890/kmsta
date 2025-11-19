<?php
include "conn.php";
// session_start();

// Logged in user ID (required for hiding own account)
$loggedUser = $_SESSION['user_id'];

$query = "";
$users = [];

if (isset($_GET['query'])) {
    $query = mysqli_real_escape_string($conn, $_GET['query']);
    $sql = "SELECT * FROM accounts
            WHERE acc_username LIKE '%$query%' 
            OR acc_bio LIKE '%$query%'";
    $users = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Search</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;900&display=swap" rel="stylesheet">
<script src="https://unpkg.com/lucide-icons@latest"></script>

<style>
/* GLOBAL */
body {
  margin: 0;
  background: #0f0f0f;
  font-family: "Poppins", sans-serif;
  color: white;
}

/* NAVBAR */
.navbar-custom {
  width: 100%;
  background: rgba(20,20,20,0.9);
  padding: 12px 20px;
  border-bottom: 1px solid rgba(255,255,255,0.1);
  backdrop-filter: blur(10px);
  position: sticky;
  top: 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.nav-title {
  font-size: 22px;
  font-weight: 700;
  background: linear-gradient(45deg, #ff004c, #ffae00);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.nav-search input {
  width: 260px;
  padding: 7px 38px 7px 12px;
  border-radius: 10px;
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.15);
  color: white;
}

.nav-search button {
  position: absolute;
  right: 8px;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(255,255,255,0.1);
  border: 1px solid rgba(255,255,255,0.2);
  padding: 4px 8px;
  border-radius: 6px;
  color: #fff;
}

/* SEARCH RESULTS */
.search-box {
  max-width: 800px;
  margin: 40px auto;
  padding: 10px;
}

.search-heading {
  font-size: 20px;
  margin-bottom: 20px;
}

.search-heading span {
  color: #ff004c;
}

.user-grid {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

/* USER CARD */
.user-card {
  display: flex;
  align-items: center;
  justify-content: space-between;      /* follow btn right */
  background: rgba(25,25,25,0.8);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 16px;
  padding: 14px;
  transition: 0.3s;
}

.user-card:hover {
  border-color: #ff004c;
  transform: translateY(-3px);
}

.user-content {
  display: flex;
  align-items: center;
  gap: 16px;
}

.user-img {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid #ff004c;
}

.user-name {
  font-weight: 600;
  font-size: 16px;
}

.user-username {
  font-size: 14px;
  color: #bbb;
}

/* FOLLOW BUTTON */
.follow-btn {
  background: #0095f6;
  color: white;
  border: none;
  padding: 8px 18px;
  border-radius: 10px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  transition: 0.2s;
}

.follow-btn:hover {
  background: #0077cc;
}

/* DROPDOWN */
.profile-dropdown ul {
  display: none;
  position: absolute;
  top: 40px;
  right: 0;
  background:#1a1a1a;
  border:1px solid #333;
  border-radius:8px;
  box-shadow:0 4px 12px rgba(0,0,0,0.5);
}
.profile-dropdown ul li a {
  padding:10px 15px;
  display:block;
  text-decoration:none;
  color:white;
}
.profile-dropdown ul li a:hover {
  background: rgba(255,0,76,0.2);
}
</style>
</head>

<body>
<?php
include"navbar.php";
?>
<!-- NAVBAR -->

<!-- SEARCH RESULTS -->
<div class="search-box">

  <?php if ($query != ""): ?>
    <h2 class="search-heading">
      Search results for: <span><?php echo htmlspecialchars($query); ?></span>
    </h2>
  <?php endif; ?>

  <div class="user-grid">
    <?php
    if ($query != "" && mysqli_num_rows($users) > 0) {
        while ($u = mysqli_fetch_assoc($users)) {

            // HIDE OWN ACCOUNT
            if ($u['user_id'] == $loggedUser) {
                continue;
            }
            ?>

            <div class="user-card">

              <div class="user-content">
                <img src="uploads/<?php echo $u['acc_profile_photo']; ?>" class="user-img">

                <div class="user-info">
                    <div class="user-name">@<?php echo $u['acc_username']; ?></div>
                    <div class="user-username"><?php echo $u['acc_bio']; ?></div>
                </div>
              </div>

              <button class="follow-btn">Follow</button>

            </div>

        <?php }

    } elseif ($query != "") {
        echo "<p style='color:#bbb;'>No users found.</p>";
    }
    ?>
  </div>
</div>

<script>
lucide.createIcons();

const profileBtn = document.getElementById('profileBtn');
const dropdownMenu = document.getElementById('dropdownMenu');

profileBtn.addEventListener('click', function(e) {
    e.preventDefault();
    dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
});

document.addEventListener('click', function(e) {
    if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
        dropdownMenu.style.display = 'none';
    }
});
</script>

</body>
</html>
