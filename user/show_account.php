<?php
require "show_account_backend.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Instagram Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #fafafa;
    font-family: 'Segoe UI', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.insta-gradient {
    background: linear-gradient(45deg, #f58529, #dd2a7b, #8134af, #515bd4);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: 700;
    text-align: center;
    margin-bottom: 20px;
}

.login-box {
    max-width: 380px;
    padding: 30px 25px;
    background: #fff;
    border: 1px solid #dbdbdb;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    text-align: center;
}

.saved-account {
    border: 1px solid #dbdbdb;
    border-radius: 20px;
    padding: 12px 20px;
    margin-bottom: 15px;
    background: #fafafa;
    cursor: pointer;
    position: relative;
    transition: background 0.2s, max-height 0.3s ease;
    overflow: hidden;
}

.saved-account:hover {
    background: #f0f0f0;
}

.saved-account img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
    object-fit: cover;
    vertical-align: middle;
}

.saved-account span {
    font-weight: 600;
    vertical-align: middle;
}

.password-section {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
    margin-top: 10px;
}

.password-section.open {
    max-height: 150px;
}

.password-section input {
    width: 100%;
    padding: 8px 10px;
    margin-bottom: 8px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

.password-section button {
    width: 100%;
    padding: 8px;
    border-radius: 6px;
    border: none;
    background-color: #4A6CF7;
    color: white;
    cursor: pointer;
}

.password-section button:hover {
    background-color: #3756d8;
}

.create-btn {
    border: none;
    width: 100%;
    padding: 12px;
    margin-top: 20px;
    background: linear-gradient(45deg, #f58529, #dd2a7b, #8134af, #515bd4);
    color: white;
    border-radius: 8px;
    font-weight: 600;
}

.create-btn:hover {
    opacity: 0.9;
}
</style>
</head>
<body>

<div class="login-box">

    <h3 class="insta-gradient">kmnsta</h3>

    <?php
    $sql = "SELECT * FROM accounts WHERE user_id = $user_id";
    $result = $conn->query($sql);

    if($result && mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)) {
            $acc_id = $row['acc_id'];
            $acc_username = $row['acc_username'];
            $acc_profile = !empty($row['profile_img']) ? $row['profile_img'] : 'default-avatar.png';
    ?>
            <div class="saved-account" onclick="togglePassword(this, event)">
                <img src="<?php echo $acc_profile; ?>" alt="Profile">
                <span><?php echo htmlspecialchars($acc_username); ?></span>
                <div class="password-section">
                    <form action="acc_login_backend.php" method="post">
                        <?php echo '<input type="hidden" name="acc_id" value="'.$acc_id.'">';?>
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

    <form action="" method="post">
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


