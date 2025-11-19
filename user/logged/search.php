<?php
include "conn.php";

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

/* ---------------- NAVBAR ---------------- */
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

.nav-icons {
  display: flex;
  gap: 20px;
  align-items: center;
  position: relative;
}

.nav-icon {
  color: white;
  cursor: pointer;
  transition: 0.3s;
}
.nav-icon:hover { transform: scale(1.2); }

/* Search Input */
.nav-search {
  position: relative;
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
  cursor: pointer;
}

/* ---------------- SEARCH RESULTS ---------------- */
.search-box {
  max-width: 800px;
  margin: 40px auto;
  padding: 10px;
}
.search-heading {
  color: white;
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
.user-card {
  display: flex;
  align-items: center;
  background: rgba(25,25,25,0.8);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 16px;
  overflow: hidden;
  padding: 14px;
  transition: 0.3s;
}
.user-card:hover {
  border-color: #ff004c;
  transform: translateY(-3px);
}
.user-img {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  object-fit: cover;
  margin-right: 16px;
  border: 2px solid #ff004c;
}
.user-info {
  display: flex;
  flex-direction: column;
}
.user-name {
  color: #fff;
  font-weight: 600;
  font-size: 16px;
}
.user-username {
  color: #bbb;
  font-size: 14px;
}

/* Dropdown */
.profile-dropdown ul {
  display: none;
  position: absolute;
  top: 40px;
  right: 0;
  background:#1a1a1a;
  border:1px solid #333;
  border-radius:8px;
  font-size:12px;
  list-style:none;
  padding:8px 0;
  min-width:180px;
  box-shadow:0 4px 12px rgba(0,0,0,0.5);
  z-index:100;
}
.profile-dropdown ul li a {
  display:block;
  padding:10px 15px;
  font-size:15px;
  color:white;
  text-decoration:none;
}
.profile-dropdown ul li a:hover {
  background: rgba(255,0,76,0.2);
  border-radius: 6px;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar-custom">
  <div class="nav-title">KMSTA</div>

  <form class="nav-search" action="search.php" method="GET">
    <input type="text" name="query" placeholder="Search users" value="<?php echo htmlspecialchars($query); ?>">
    <button type="submit"><i data-lucide="search"></i></button>
  </form>

  <div class="nav-icons">
    <a href="home.php" class="nav-icon"><i data-lucide="home"></i></a>
    <a href="messages.php" class="nav-icon"><i data-lucide="message-square"></i></a>

    <div class="profile-dropdown">
      <a href="my_account.php" id="profileBtn" class="nav-icon"><i data-lucide="user"></i></a>
      <ul id="dropdownMenu">
        <li><a href="my_account.php">View Profile</a></li>
        <li><a href="edit_profile.php">Edit Personal Details</a></li>
        <li><hr style="margin:4px 0;border-color:#444;"></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- SEARCH RESULTS -->
<div class="search-box">
  <?php if ($query != ""): ?>
    <h2 class="search-heading">Search results for: <span><?php echo htmlspecialchars($query); ?></span></h2>
  <?php endif; ?>

  <div class="user-grid">
    <?php
    if ($query != "" && mysqli_num_rows($users) > 0) {
        while ($u = mysqli_fetch_assoc($users)) {
            ?>
            <div class="user-card">
                <img src="uploads/<?php echo $u['acc_profile_photo']; ?>" class="user-img">
                <div class="user-info">
                    <div class="user-name">@<?php echo $u['acc_username']; ?></div>
                    <div class="user-username"><?php echo $u['acc_bio']; ?></div>
                </div>
            </div>
        <?php }
    } elseif ($query != "") {
        echo "<p style='color:#bbb;'>No users found.</p>";
    }
    ?>
  </div>
</div>

<!-- Lucide Icons -->
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
