<?php
    session_start();

    if(!isset($_SESSION["login"])){
        header("Location:login.php");
    }
    
    require "function.php";
    $id = $_GET["id"];

    // Ambil data foto berdasarkan ID
    $data = query("SELECT * FROM albumfoto WHERE id=$id")[0];

    if(isset($_POST["ubah"])){
        $id = $_POST["fid"];
        $fotoLama = $_POST["fFoto"];
        $judul = $_POST["fJudul"];
        $deskripsi = $_POST["fDeskripsi"];
        $foto = "";

        if($_FILES['fFoto']['error'] === 4){
            $foto = $fotoLama;
        } else {
            $namaFile = $_FILES['fFoto']['name'];
            $ukuranFile = $_FILES['fFoto']['size'];
            $error = $_FILES['fFoto']['error'];
            $tempName = $_FILES['fFoto']['tmp_name'];

            // Cek apakah gambar valid
            $ektensiGambarValid = ['jpg','jpeg','png'];
            $ektensiGambar = explode('.',$namaFile);
            $ektensiGambar = strtolower(end($ektensiGambar));
            if(!in_array($ektensiGambar,$ektensiGambarValid)){
                echo "<script>alert('Yang Anda upload bukan gambar');</script>";
                return false;
            }

            // Buat nama file baru
            $namaFileBaru = uniqid();
            $namaFileBaru .= '.' . $ektensiGambar;

            // Pindahkan file ke folder img/
            move_uploaded_file($tempName, 'img/'.$namaFileBaru);

            $foto = $namaFileBaru;
        }

        // Update data di database
        $query = "UPDATE albumfoto SET 
                    foto = '$foto', 
                    judul = '$judul', 
                    deskripsi = '$deskripsi' 
                    WHERE id = $id";
        mysqli_query($koneksi, $query);

        if(mysqli_affected_rows($koneksi) > 0){
            echo "<script>alert('Data berhasil diubah!'); document.location.href='admin.php';</script>";
        } else {
            echo "<script>alert('Data gagal diubah!'); document.location.href='admin.php';</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Foto</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-size: 16px;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
        }

        .form-group input:focus, .form-group textarea:focus {
            border-color: #007bff;
        }

        .form-group textarea {
            resize: vertical;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .preview-img {
            width: 100%;
            max-width: 150px;
            margin-top: 15px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Edit Foto</h2>
        <form action="#" method="post" enctype="multipart/form-data">
            <input type="hidden" name="fid" value="<?= $data["id"]?>">
            <input type="hidden" name="fFoto" value="<?= $data["foto"]?>">

            <!-- Preview Foto Lama -->
            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" name="fFoto" id="foto" />
                <div class="preview-img">
                    <img src="img/<?= $data["foto"] ?>" alt="Foto Lama">
                </div>
            </div>

            <!-- Input Judul -->
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="fJudul" id="judul" value="<?= $data["judul"]?>" />
            </div>

            <!-- Input Deskripsi -->
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="fDeskripsi" id="deskripsi" cols="30" rows="10"><?= $data["deskripsi"]?></textarea>
            </div>

            <!-- Button Submit -->
            <div class="form-group">
                <button type="submit" name="ubah">Ubah Data!</button>
            </div>
        </form>
    </div>

</body>
</html>
