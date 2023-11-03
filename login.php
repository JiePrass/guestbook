<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        <?php include "style.css"; ?>
    </style>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login</title>
</head>

<body class="login vh-100 overflow-hidden">
    <div class="wrapper">
        <form action="validasi.php" method="post" name="login">
            <h1>Login</h1>

            <div class="input-box">
                <input type="text" name="tusername" id="tusername" placeholder="Username">
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="password" name="tpasswd" id="tpasswd" placeholder="Password">
                <i class='bx bxs-lock-alt'></i>
            </div>
            
            <input type="submit" value="submit" name="Login" class="login-btn">

            <div class="register-link">
                <p>Don't have a account? <a href="input_user.php">Sign up!</a></p>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>