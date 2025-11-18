<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    require "show_account_backend.php";

    ?>
    <div class="container justify-content-center" >

        <div class="row pt-4 d-flex">
            <div class="col-3 mb-3 mb-sm-0">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</body>

</html> -->


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
        <div class="saved-account border border-black">
            <span>username_one</span>
            <button class="btn btn-outline-dark btn-sm">Login</button>
        </div>

        <!-- Saved Account 2 -->
        <div class="saved-account border border-black">
            <span>username_two</span>
            <button class="btn btn-outline-dark btn-sm">Login</button>
        </div>

        <!-- Create New Account -->
        <form action="" method="post">
            <button class="create-btn" name="create_acc_btn">Create one's</button>
        </form>
    </div>

</body>

</html>