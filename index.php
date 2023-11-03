<?php
    include "config.php";
    session_start();

    //banyaknya baris yang tampil per halaman
    $rowsPerPage = 5;
    //muncul pertama secara default
    $pageNum = 1;

    //jika $_GET['page'] didefinisikan, gunakan sebagai nomor halaman
    if (isset($_GET['page'])) {
        $pageNum = $_GET['page'];
    }

    //menghitung offset
    $offset = ($pageNum - 1) * $rowsPerPage; //ERROR "An non-numeric value encountered"
    $query = "SELECT * FROM pengunjung ORDER BY 'id' DESC LIMIT $offset, $rowsPerPage";
    $result = mysqli_query($conn, $query) or die('Error, query failed 1');

    //jumlah total
    $query1 = "SELECT COUNT(id) AS numrows FROM pengunjung";
    $result1 = mysqli_query($conn, $query1) or die('Error, query failed 2');
    $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
    $numrows = $row1['numrows'];
?>


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
    <title>Buku Tamu</title>
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
                <div class="offcanvas-body d-flex flex-column flex-lg-row">
                    <ul class="navbar-nav justify-content-center align-items-center fs-5 flex-grow-1 pe-3">
                        <li class="nav-item mx-2">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="input_bukutamu.php">Add</a>
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

    <h2 class="d-flex flex-column justify-content-center align-items-center text-white p-4">Buku Tamu
    </h2>

    <div class="d-flex flex-column justfiy-content-center align-items-center" align="center">
        <p class="text-white">
            <?php
            echo "Total nomor bukutamu : $numrows";
            ?>
        </p>
        <?php
        $no = 1;
        while ($hasil = mysqli_fetch_array($result)) {
            ?>
            <table class="tbl-index">
                <tr bgcolor="#DEDEDE">
                    <td>Dari <?php $nama = $hasil['firstname'] . " " . $hasil['lastname']; 
                    echo $nama; ?> Pada <?= $hasil['date']; ?></td>
                </tr>
                <tr bgcolor="#DEDEDE">
                    <td>
                        <?= $hasil['komentar']; ?>
                    </td>
                </tr>
            </table>
            <?php
            $no++;
            echo "<br>";
        }
        ?>
    </div>

    <?php
    //banyaknya baris yang ada di database
    $query = "SELECT COUNT(id) AS numrows FROM pengunjung";
    $result = mysqli_query($conn, $query) or die('Error, query failed');
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $numrows = $row['numrows'];

    //banyaknya halaman ketika menggunakan paging
    $maxPage = ceil($numrows / $rowsPerPage);

    //tampilkan link untuk akses tiap halaman
    $self = $_SERVER['PHP_SELF'];
    $nav = '';
    for ($page = 1; $page <= $maxPage; $page++) {
        if ($page == $pageNum) {
            $nav .= " $page "; //tidak dibutuhkan link ke halaman saat ini
        } else {
            $nav .= " <a href=\"$self?page=$page\">$page</a>";
        }
    }

    // membuat link previous dan next
    // ditambah link langsung ke
    // halaman awal dan akhir
    
    if ($pageNum > 1) {
        $page = $pageNum - 1;
        $prev = " <a href=\"$self?page=$page\" class='text-white' >[Prev]</a> ";

        $first = " <a href=\"$self?page=1\" class='text-white'>[First Page]</a> ";
    } else {
        $prev = '&nbsp;'; //ada di halaman pertama, jangan tampilkan link previous
        $first = '&nbsp;'; //juga jangan tampilkan link first page
    }

    if ($pageNum < $maxPage) {
        $page = $pageNum + 1;
        $next = " <a href=\"$self?page=$page\" class='text-white'>[Next]</> ";

        $last = " <a href=\"$self?page=$maxPage\" class='text-white'>[Last Page]</a>";
    } else {
        $next = '&nbsp;'; //ada di halaman terakhir, jangan tampilkan link next
        $last = '&nbsp;'; //juga jangan tampilkan link lastpage
    }

    //tampilkan link navigasi
    echo "<center class='text-white'>$first " . " $prev " . " $nav " . " $next " . " $last</center>";
    ?>
    <?php
    mysqli_close($conn);
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>