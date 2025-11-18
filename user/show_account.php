<?php
require "show_account_backend.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram Login</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        .card h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .saved-account {
            margin-bottom: 10px;
            border-radius: 8px;
            cursor: pointer;
            padding: 10px;
            transition: background 0.2s;
            position: relative;
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
            font-weight: bold;
            vertical-align: middle;
        }

        .password-section {
            margin-top: 10px;
            display: none;
        }

        .password-section input {
            width: calc(100% - 20px);
            padding: 8px 10px;
            margin-bottom: 5px;
            border-radius: 6px;
            border: 1px solid #ddd;
            display: block;
        }

        .password-section button {
            padding: 8px 10px;
            width: 100%;
            border-radius: 6px;
            border: none;
            background: #4A6CF7;
            color: white;
            cursor: pointer;
        }

        .password-section button:hover {
            background: #3756d8;
        }

        body {
            background: #fafafa;
            font-family: 'Segoe UI', sans-serif;
        }

        /* Instagram gradient */
        .insta-gradient {
            background: linear-gradient(45deg, #f58529, #dd2a7b, #8134af, #515bd4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
        }

        .login-box {
            max-width: 380px;
            margin: 70px auto;
            padding: 30px 25px;
            background: #fff;
            border: 1px solid #dbdbdb;
            border-radius: 12px;
            text-align: center;
        }

        .saved-account {
            border: 1px solid #dbdbdb;
            border-radius: 20px;
            padding: 18px 20px;
            margin-bottom: 15px;
            position: relative;
            background: #fafafa;
        }

        .saved-account button {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 12px;
            padding: 5px 12px;
            border-radius: 10px;
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

    <div class="login-box shadow-lg border border-black">

        <!-- Instagram style title -->
        <h3 class="insta-gradient mb-4">kmnsta</h3>

        <!-- Saved Account 1 -->







        <?php
        $sql = "select * from accounts where user_id= $user_id";
        $result = $conn->query($sql);

        if ($result == true) {
            echo'<div class="card"><h2>Login</h2>';
            while ($row = mysqli_fetch_array($result)) {

                $acc_id = $row["acc_id"];
                $acc_username = $row["acc_username"];

                ?>
                
                    

                    <!-- Saved Account 1 -->
                    <div class="saved-account" onclick="togglePassword(this)">
                        <img src="" alt="Profile">
                        <span><?php echo $acc_username; ?></span>
                        <div class="password-section">
                            <input type="password" placeholder="Enter password">
                            <a href="acc_login_backend.php"><button>Login</button></a>
                        </div>
                    </div>



                
                <?php
            }
            echo'</div>';
        } else {
            echo "error";
        }
        ?>

        <form action="" method="post">
            <button class="create-btn" name="create_acc_btn">Create ones</button>
        </form>
    </div>

</body>
<script>
    function togglePassword(accountDiv) {
        const section = accountDiv.querySelector('.password-section');
        // Toggle visibility
        if (section.style.display === 'block') {
            section.style.display = 'none';
        } else {
            section.style.display = 'block';
        }
    }
</script>

</html>