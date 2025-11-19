<!-- navbar.html -->
<nav class="nav-glass">
  <div class="nav-inner">

    <!-- Logo -->
    <div class="nav-logo">
      KMSTA
    </div>

    <!-- Search Bar (desktop only) -->
    <form class="nav-search"action="search.php" method="get">
      <input type="text" name="query" placeholder="Search">
      <button type="submit" class="search-btn">
        <i class="bi bi-search"></i>
      </button>
    </form>

    <!-- Right Icons -->
    <div class="nav-icons" style="position: relative; display: flex; align-items: center; gap: 20px;">

      <a href="home.php"><i class="bi bi-house-door fs-4"></i></a>
      <a href="search.php"><i class="bi bi-search fs-4"></i></a>
      <a href="messages.php"><i class="bi bi-chat-dots fs-4"></i></a>

      <!-- Profile Dropdown -->
      <div class="profile-dropdown" style="position: relative;">
        <a href="my_account.php" id="profileBtn"><i class="bi bi-person-circle fs-4"></i></a>

        <ul id="dropdownMenu" style="
            display: none;
            position: absolute;
            top: 40px;
            right: 0;
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 8px;
            font-size:10px;
            list-style: none;
            padding: 8px 0;
            min-width: 180px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.5);
            z-index: 100;
        ">
          <li><a href="my_account.php" style=" font-size: 15px; display:block; padding: 10px 15px; color: white; text-decoration: none;">View Profile</a></li>
          <li><a href="edit_profile.php" style="font-size: 15px;display:block; padding: 10px 15px; color: white; text-decoration: none;">Edit Personal Details</a></li>
          <li><hr style="margin: 4px 0; border-color: #444;"></li>
          <li><a href="../logout.php" style="font-size: 15px;display:block; padding: 10px 15px; color: white; text-decoration: none;">Logout</a></li>
        </ul>
      </div>

    </div>

  </div>
</nav>

<style>
/* --------------- NAV BAR GLASS STYLE --------------- */
.nav-glass {
  width: 100%;
  position: sticky;
  top: 0;
  z-index: 50;
  padding: 12px 0;
  background: rgba(20, 20, 20, 0.75);
  backdrop-filter: blur(12px);
  border-bottom: 1px solid rgba(255,255,255,0.08);
  animation: navFade 0.6s ease;
}

@keyframes navFade {
  from { opacity:0; transform: translateY(-15px); }
  to   { opacity:1; transform: translateY(0); }
}

.nav-inner {
  max-width: 1200px;
  margin: auto;
  padding: 0 18px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: nowrap; /* prevents breaking when zooming */
}

/* -------- LOGO -------- */
.nav-logo {
  font-size: 22px;
  font-weight: 800;
  background: linear-gradient(45deg, #ff004c, #ffa800);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  user-select: none;
  cursor: pointer;
}


/* -------- SEARCH BAR -------- */
.nav-search {
  position: relative;
  display: none;
  flex-shrink: 0; /* prevents disappearing on zoom */
}

.nav-search input {
  width: 260px;
  padding: 7px 38px 7px 12px;
  border-radius: 10px;
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.15);
  color: white;
  outline: none;
}

.nav-search input::placeholder {
  color: #bbb;
}

.search-btn {
  position: absolute;
  right: 8px;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(255,255,255,0.10);
  border: 1px solid rgba(255,255,255,0.2);
  padding: 4px 8px;
  border-radius: 6px;
  cursor: pointer;
  color: #fff;
  transition: 0.25s;
}

.search-btn:hover {
  background: rgba(255,255,255,0.18);
  color: #ff004c;
  text-shadow: 0 0 10px #ff004c;
}

/* Desktop search */
@media (min-width: 768px) {
  .nav-search {
    display: block;
  }
}

/* -------- ICONS -------- */
.nav-icons a {
  color: #eee;
  margin-left: 20px;
  font-size: 24px;
  transition: 0.3s;
}

.nav-icons a:hover {
  color: #ff004c;
  text-shadow: 0 0 10px #ff004c;
  transform: scale(1.15);
}
</style>

<!-- Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<script>
// Dropdown toggle
const profileBtn = document.getElementById('profileBtn');
const dropdownMenu = document.getElementById('dropdownMenu');

profileBtn.addEventListener('click', function(e) {
    e.preventDefault();
    dropdownMenu.style.display =
      dropdownMenu.style.display === 'block' ? 'none' : 'block';
});

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
        dropdownMenu.style.display = 'none';
    }
});
</script>
