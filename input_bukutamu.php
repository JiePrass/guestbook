<?php
    include "config.php";
    session_start();

    if(isset($_POST['upload'])) {
        $firstname = htmlentities(trim($_POST["firstname"]));
        $lastname = htmlentities(trim($_POST["lastname"]));
        $email = htmlentities(trim($_POST['temail']));
        $komentar = htmlentities(trim($_POST['tkomentar']));
        $date = date("j F Y, g:i a");
        $ip1 = $_SERVER["REMOTE_ADDR"];
        $ip2 = getenv("HTTP_X_FORWARD_FOR");
        $ip = $ip1 . "-" . $ip2;
        
        if((empty($firstname)) || (empty($email)) || (empty($komentar))) {
            echo "Data tidak boleh kosong";
            exit;
        } else {
            $query = "INSERT INTO pengunjung (firstname,lastname,email,komentar,date,ip)" . 
            "VALUES ('$firstname','$lastname','$email','$komentar','$date','$ip')";

            mysqli_query($conn, $query) or die('Error, query failed' . mysqli_error($conn));
            mysqli_close($conn);
            header('Location: index.php');
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        <?php include "style.css"; ?>
    </style>
    <title>Input Bukutamu</title>
</head>
<body class="vh-100 overflow-hidden">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand fs-4" href="#">GuestBook</a>

            <!-- Toggle Btn -->
            <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- SideBar -->
            <div class="sidebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">

                <!-- SideBar Header -->
                <div class="offcanvas-header text-white border-botton">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">GuestBook</h5>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>

                <!-- SideBar Body -->
                <div class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0">
                    <ul class="navbar-nav justify-content-center align-items-center fs-5 flex-grow-1 pe-3">
                        <li class="nav-item mx-2">
                            <a class="nav-link" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link active" aria-current="page" href="#">Add</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="admin.php">Manage</a>
                        </li>
                    </ul>

                    <!-- Login / Sign up -->
                    <?php
                    if (empty($_SESSION["sadmin_username"])) {
                        echo '<div class="d-flex flex-column flex-lg-row justify-content-center align-items-center gap-3">
                            <a href="login.php" class="text-white text-decoration-none">Login</a>
                            <a href="input_user.php" class="text-white text-decoration-none px-3 py-1 rounded-4"
                                style="background-color: #f94ca4">
                                Sign up!</a>
                            </div>';
                    } else {
                        echo '<div class="d-flex flex-column flex-lg-row justify-content-center align-items-center gap-3">
                        <a href="logout.php" class="text-white text-decoration-none px-3 py-1 rounded-4"
                        style="background-color: #FF0000">
                        Logout</a>
                        </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5 text-white">
        <h1 class="text-center">Tambahkan Buku Tamu</h1>
        
        <form action="<?php $PHP_SELF?>" method="post" name="uploadform" id="uploadform" class="row g-3">
            <div class="col-md-6">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
            <div class="col-md-6">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
            <div class="col-md-12">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="temail" required>
            </div>
            <div class="col-md-12">
                <label for="comments" class="form-label">Comments</label>
                <textarea class="form-control" id="comments" rows="3" name="tkomentar" required></textarea>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-dark" name="upload" id="uploadform" value="submit">Submit</button>
            </div>
        </form>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>