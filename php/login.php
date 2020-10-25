<?php
    if (isset($_COOKIE['currentUsername'])) {
        header('Location: dashboard.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chocolate Factory: Login</title>
    <link rel="stylesheet" href="../styles/login.css">
</head>

<body>
    <div class="flex-container login-header">
        <h1>Willy Wangky Choco Factory</h1>
    </div>
    <div class="flex-container">
        <div class="login-form">
            <form action="logincheck.php" method="POST">
                <div class="form-control">
                    <label for="email"><strong>Email</strong></label>
                    <input class="input" type="email" name="email" id="email" required="" placeholder="example007@example.com">
                </div>
                <div class="form-control">
                    <label for="password"><strong>Password</strong></label>
                    <input class="input" type="password" name="password" id="password" required="" placeholder="********">
                </div>
                <button class="btn-login" type="submit">Login</button>
            </form>
            <a href="register.php">Don't have account yet? Sign up</a>
        </div>
    </div>
</body>

</html>