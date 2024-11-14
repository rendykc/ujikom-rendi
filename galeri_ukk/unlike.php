<?php
session_start();
require_once 'function.php';

// Pastikan fotoid tersedia di URL
if (isset($_GET['fotoid']) && isset($_SESSION['userid'])) {
    $fotoid = $_GET['fotoid'];
    $userid = $_SESSION['userid'];

    // Mengamankan input
    $fotoid = mysqli_real_escape_string($conn, $fotoid);
    $userid = mysqli_real_escape_string($conn, $userid);

    // Menghapus data like dari database
    $query = "DELETE FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'";
    if (mysqli_query($conn, $query)) {
        // Setelah unlike, kembali ke halaman foto atau gallery
        header("Location: gallery.php"); // Ganti dengan halaman yang sesuai
    } else {
        echo "Terjadi kesalahan saat menghapus like.";
    }
} else {
    echo "ID foto atau pengguna tidak valid.";
}
?>
