<?php
    if(isset($_POST['upload'])) {
        include 'config.php';

        $username = trim($_POST['tusername']);
        $password = md5(trim($_POST['tpassword']));

        if(empty($username) || empty($password)) {
            $message = "Data not valid";
        } else {
            $kueri = "SELECT * FROM pengguna WHERE username='$username'";
            $hasil = mysqli_query($conn, $kueri) or die('Error, query failed. ' . mysqli_error($conn));
            $result = mysqli_fetch_array($hasil);
            
            //jika ada username yang sama
            if($result != 0) {
                $message = "There is same username ";
            } else {
                $query = "INSERT INTO pengguna (username, password)" . "VALUES ('$username', '$password')";

                mysqli_query($conn, $query) or die('Error, query failed' . mysqli_error($conn));
                mysqli_close($conn);

                echo "Add User Administrator '$username' SUCCESS";
                exit;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menambahkan User Admin</title>
        <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        <?php include "style.css"; ?>
    </style>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="login vh-100 overflow-hidden">
    <div class="wrapper">
        <form action="<?php $PHP_SELF ?>" method="post" name="uploadform" id="uploadform">
            <h1>Sign up!</h1>

            <div class="input-box">
                <input type="text" name="tusername" id="tusername" placeholder="Username">
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="password" name="tpassword" id="tpassword" placeholder="Password">
                <i class='bx bxs-lock-alt'></i>
            </div>
            
            <input type="submit" value="submit" name="Submit" class="login-btn">

            <div class="register-link">
                <p>Already have an account? <a href="login.php">Login!</a></p>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>