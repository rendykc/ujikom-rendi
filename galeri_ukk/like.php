<?php
session_start();
require_once 'function.php';

// Pastikan fotoid tersedia di URL dan user sudah login
if (isset($_GET['fotoid']) && isset($_SESSION['userid'])) {
    $fotoid = $_GET['fotoid'];
    $userid = $_SESSION['userid'];

    // Mengamankan input
    $fotoid = mysqli_real_escape_string($conn, $fotoid);
    $userid = mysqli_real_escape_string($conn, $userid);

    // Cek apakah pengguna sudah memberi like pada foto ini
    $query_check_like = "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'";
    $result_check_like = mysqli_query($conn, $query_check_like);

    if (mysqli_num_rows($result_check_like) == 0) {
        // Menambahkan like jika belum ada
        $query_insert_like = "INSERT INTO likefoto (fotoid, userid) VALUES ('$fotoid', '$userid')";
        if (mysqli_query($conn, $query_insert_like)) {
            // Redirect ke halaman yang sesuai
            header("Location: index.php"); // Ganti dengan halaman yang sesuai
        } else {
            echo "Terjadi kesalahan saat memberi like.";
        }
    } else {
        echo "Anda sudah memberi like pada foto ini.";
    }
} else {
    echo "ID foto atau pengguna tidak valid.";
}
?>
