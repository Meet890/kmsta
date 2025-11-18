<?php
require "show_account_backend.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>KMNSTA Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body {
    background: radial-gradient(circle at top, #1a1a1a, #0b0b0b);
    font-family: 'Poppins', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin:0;
    color:white;
}

.login-box {
    width: 360px;
    padding: 28px;
    border-radius: 20px;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.12);
    backdrop-filter: blur(12px);
    text-align: center;
}

.insta-gradient {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 20px;
    background: linear-gradient(45deg, #ff004c, #ffa600);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.saved-account {
    display: flex;
    align-items: center;
    background: rgba(255,255,255,0.05);
    padding: 14px;
    border-radius: 16px;
    margin-bottom: 12px;
    cursor: pointer;
    border: 1px solid rgba(255,255,255,0.1);
    transition: 0.3s;
    overflow: hidden;
}

.saved-account:hover {
    background: rgba(255,255,255,0.1);
}

.saved-account img {
    width: 46px;
    height: 46px;
    border-radius: 50%;
    margin-right: 12px;
    border: 2px solid #ff004c;
    object-fit: cover;
}

.saved-account span {
    font-weight: 600;
}

.password-section {
    width: 100%;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
    margin-top: 10px;
}

.password-section.open {
    max-height: 140px;
}

.password-section input {
    width: 100%;
    padding: 10px;
    margin-bottom: 8px;
    border-radius: 10px;
    border: 1px solid rgba(255,255,255,0.15);
    background: rgba(255,255,255,0.08);
    color: white;
    outline: none;
}

.password-section input:focus {
    border-color: #ff004c;
    box-shadow: 0 0 8px #ff004c88;
}

.password-section button {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 10px;
    background: linear-gradient(45deg, #ff004c, #ff7a00);
    color: white;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

.password-section button:hover {
    transform: scale(1.03);
    box-shadow: 0 0 10px #ff004c99;
}

.create-btn {
    width: 100%;
    padding: 12px;
    margin-top: 20px;
    background: linear-gradient(45deg, #ff004c, #ff7a00);
    border: none;
    border-radius: 12px;
    font-weight: 600;
    color: white;
    cursor: pointer;
    transition: 0.3s;
}

.create-btn:hover {
    transform: scale(1.02);
    box-shadow: 0 0 12px #ff004c88;
}
</style>
</head>
<body>

<div class="login-box">

    <h3 class="insta-gradient">KMNSTA</h3>

    <?php
    $sql = "SELECT * FROM accounts WHERE user_id = $user_id";
    $result = $conn->query($sql);

    if($result && mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)) {
            $acc_id = $row['acc_id'];
            $acc_username = $row['acc_username'];
            $acc_profile = !empty($row['profile_img']) ? $row['profile_img'] : 'default-avatar.png';
    ?>
            <div class="saved-account" onclick="togglePassword(this,event)">
                <img src="<?= $acc_profile ?>" alt="Profile">
                <span><?= htmlspecialchars($acc_username) ?></span>
                <div class="password-section">
                    <form action="acc_login_backend.php" method="post">
                        <input type="hidden" name="acc_id" value="<?= $acc_id ?>">
                        <input type="password" name="acc_password" placeholder="Enter password" required>
                        <button type="submit" name="acc_login_btn">Login</button>
                    </form>
                </div>
            </div>
    <?php
        }
    } else {
        echo "<p>No saved accounts found.</p>";
    }
    ?>

    <form action="create_account.php" method="post">
        <button class="create-btn" name="create_acc_btn">Create New Account</button>
    </form>

</div>

<script>
function togglePassword(accountDiv, event) {
    const section = accountDiv.querySelector('.password-section');
    const input = section.querySelector('input[type="password"]');

    if(event.target.tagName === 'INPUT' || event.target.tagName === 'BUTTON') return;

    document.querySelectorAll('.password-section').forEach(sec => {
        if(sec !== section) sec.classList.remove('open');
    });

    section.classList.toggle('open');

    if(section.classList.contains('open')) {
        input.focus();
    }
}
</script>

</body>
</html>
