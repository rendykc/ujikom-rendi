<?php
    session_start();

    if(!isset($_SESSION["login"])){
        header("Location:login.php");
    }
    
    require "function.php";
    
    if(isset($_POST["submit"])){
        $judul = $_POST["fJudul"];
        $deskripsi = $_POST["fDeskripsi"];

        $namaFile = $_FILES['fFoto']['name'];
        $ukuranFile = $_FILES['fFoto']['size'];
        $error = $_FILES['fFoto']['error'];
        $tempName = $_FILES['fFoto']['tmp_name'];

        // Cek apakah tidak ada gambar yang diupload
        if($error === 4){
            echo "<script>
                    alert('Pilih gambar terlebih dahulu!');
                    document.location.href='tambah.php';
                    </script>";
            return false;        
        }

        // Cek apakah yang diupload adalah gambar atau tidak
        $ektensiGambarValid = ['jpg','jpeg','png'];
        $ektensiGambar = explode('.',$namaFile);
        $ektensiGambar = strtolower(end($ektensiGambar));
        if(!in_array($ektensiGambar,$ektensiGambarValid)){
            echo"<script>
                    alert('Yang anda upload bukan gambar');
                </script>";
            return  false;
        }

        // Buat nama file baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.' . $ektensiGambar;

        // Siap upload
        move_uploaded_file($tempName,'img/'.$namaFileBaru);

        $query =  "INSERT INTO albumfoto VALUES('','$namaFileBaru','$judul','$deskripsi')";

        mysqli_query($koneksi,$query);

        if(mysqli_affected_rows($koneksi) > 0){
            echo "
                <script>
                    alert('Data berhasil ditambahkan!');
                    document.location.href='admin.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Data gagal ditambahkan!');
                    document.location.href='admin.php';
                </script>
            ";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Foto</title>
    <style>
        /* Style for the entire body */
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

        /* Container for the form */
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        /* Heading style */
        h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Style for form groups (input fields and labels) */
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
            border-color: #0056b3;
        }

        .form-group textarea {
            resize: vertical;
        }

        /* Button style */
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
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Tambah Foto</h2>
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" name="fFoto" id="foto" />
            </div>
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="fJudul" id="judul" />
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="fDeskripsi" id="deskripsi" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Tambah Data!</button>
            </div>
        </form>
    </div>
</body>
</html>
