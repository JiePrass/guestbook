<?php

include("config.php");
session_start();
if (empty($_SESSION['sadmin_username'])) {
    header('Location: login.php');

    
}

    $id = $_GET['id'];
    $query = "SELECT * FROM pengunjung WHERE id = '$id'";
    $result = mysqli_query($conn, $query) or die('Error, query failed. ' . mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    list($id, $firstname, $lastname, $email, $komentar, $date, $ip) = $row;

if (isset($_POST['btnUpdate'])) {

    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['temail']);
    $komentar = trim($_POST['tkomentar']);

    $query = "UPDATE pengunjung SET firstname='$firstname',lastname='$lastname',email='$email',komentar='$komentar' WHERE id='$id'";
    mysqli_query($conn, $query) or die('Error, query failed. ' . mysqli_error($conn));
    header("Location: admin.php");
    exit;
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
        <title>Document</title>
    </head>
    <body>
        
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand fs-4" href="index.php">GuestBook</a>

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
                    <div class="offcanvas-body d-flex flex-column flex-lg-row">
                        <ul class="navbar-nav justify-content-center align-items-center fs-5 flex-grow-1 pe-3">
                            <li class="nav-item mx-2">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="nav-link" href="input_bukutamu.php">Add</a>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="nav-link active" aria-current="page" href="#">Manage</a>
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

        <?php   
        ?>

        <div class="container mt-5 text-white">
            <h1 class="text-center">Update Buku Tamu</h1>
            <form method="post" name="updateform" id="updateform" class="row g-3">
                <div class="col-md-6">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $firstname; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $lastname; ?>" required>
                </div>
                <div class="col-md-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="temail" value="<?= $email; ?>" required>
                </div>
                <div class="col-md-12">
                    <label for="comments" class="form-label">Comments</label>
                    <textarea class="form-control" id="comments" rows="3" name="tkomentar" required>
                    <?= $komentar; ?>
                    </textarea>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-dark" name="btnUpdate" id="uploadform" value="Update">Submit</button>
                </div>
            </form>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    </body>
</html>
