<!-- navbar.html -->
<nav class="nav-glass">
  <div class="nav-inner">

    <!-- Logo -->
    <div class="nav-logo">
      KMSTA
    </div>

    <!-- Search Bar (desktop only) -->
    <form class="nav-search">
      <input type="text" placeholder="Search">
    </form>

    <!-- Right Icons -->
    <div class="nav-icons">
      <a href="home.php"><i class="bi bi-house-door"></i></a>
      <a href="search.php"><i class="bi bi-search"></i></a>
      <a href="messages.php"><i class="bi bi-chat-dots"></i></a>
      <a href="my_account.php"><i class="bi bi-person-circle"></i></a>
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
  display: none;
}

.nav-search input {
  width: 260px;
  padding: 7px 12px;
  border-radius: 10px;
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.15);
  color: white;
  outline: none;
}

.nav-search input::placeholder {
  color: #bbb;
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
