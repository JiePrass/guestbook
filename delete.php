<?php
    include 'config.php';

    $urutan = $_GET['id'];
    $queri = "DELETE FROM pengunjung WHERE id='$urutan'";
    mysqli_query($conn, $queri);
    header("Location:admin.php");
?>