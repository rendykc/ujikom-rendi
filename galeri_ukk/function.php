<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "punya_rendi");

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Fungsi query untuk mengambil data
function query($query){
    global $koneksi;
    $result = mysqli_query($koneksi, $query);

    // Cek apakah query berhasil
    if (!$result) {
        die("Query gagal: " . mysqli_error($koneksi));
    }

    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }

    return $rows;
}
?>


