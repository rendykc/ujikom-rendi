<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Photo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baumans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .judul {
            text-align: center;
            margin-top: 50px;
        }

        .judul h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .card-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 30px;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 15px;
            padding: 15px;
            width: 280px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            cursor: pointer;
        }

        .card span {
            display: block;
            margin-top: 10px;
            font-size: 14px;
            color: #333;
        }

        .comment-form {
            margin-top: 20px;
        }

        .comment-form input[type="text"] {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .comment-form button {
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .comment-form button:hover {
            background-color: #0056b3;
        }

        .comments {
            margin-top: 15px;
        }

        .comment {
            padding: 5px;
            background-color: #f8f9fa;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .likes {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .like-button {
            background-color: #007bff;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .like-button.liked {
            background-color: #28a745;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: white;
            margin-top: 50px;
        }

        footer a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <?php
        require "function.php";
        session_start();  // Mulai sesi untuk akses user_id
        $datas = query("SELECT * FROM albumfoto");

        // Menambahkan komentar
        if (isset($_POST['submit_comment'])) {
            $id_foto = $_POST['id_foto'];
            $komentar = $_POST['komentar'];
            mysqli_query($koneksi, "INSERT INTO komentar (id_foto, komentar) VALUES ('$id_foto', '$komentar')");
        }

        // Menambahkan like
        if (isset($_POST['like'])) {
            $id_foto = $_POST['id_foto'];
            $user_id = $_SESSION['user_id'];  // Mengambil ID pengguna yang sedang login
            $check_like = mysqli_query($koneksi, "SELECT * FROM likes WHERE id_foto = '$id_foto' AND user_id = '$user_id'");
            if (mysqli_num_rows($check_like) == 0) {
                // Jika belum memberi like, tambahkan like
                mysqli_query($koneksi, "INSERT INTO likes (id_foto, user_id) VALUES ('$id_foto', '$user_id')");
            }
        }
    ?>


    <article>
        <div class="judul">
            <h1>Gallery Photo</h1>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">galeri</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href=""></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">LOGOUT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
        </div>
        <div class="card-wrapper">
            <?php foreach ($datas as $key): ?>
            <div class="card">
                <!-- Link untuk membuka modal gambar -->
                <a href="javascript:void(0);" onclick="openModal('img/<?= $key['foto'] ?>')">
                    <img src="img/<?= $key['foto'] ?>" alt="<?= $key['judul'] ?>" />
                </a>
                <span>kegiatan: <?= $key['judul'] ?></span>
                <span>keterangan: <?= $key['deskripsi'] ?></span>
                <span>tanggal: 12-02-2023</span>

                <!-- Form untuk mengirim komentar -->
                <div class="comment-form">
                    <form method="post">
                        <input type="hidden" name="id_foto" value="<?= $key['id'] ?>">
                        <input type="text" name="komentar" placeholder="Tulis komentar..." required>
                        <button type="submit" name="submit_comment">Kirim Komentar</button>
                    </form>
                </div>

                <!-- Daftar komentar -->
                <div class="comments">
                    <?php
                        $comments = query("SELECT * FROM komentar WHERE id_foto = " . $key['id']);
                        foreach ($comments as $comment):
                    ?>
                        <div class="comment"><?= $comment['komentar'] ?></div>
                    <?php endforeach; ?>
                </div>

                <!-- Tombol Like -->
                <div class="action-links">
    <!--  -->
</div>

            </div>
            <?php endforeach; ?>
        </div>
    </article>

    <!-- Modal untuk Lightbox -->
    <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="modalImg">
    </div>

    <footer>
        <h3>dibuat oleh Rendy Ferdiansyah</h3>
        <a href="login.php">Silakan login untuk menambahkan data</a>
    </footer>

    <script>
        // Fungsi untuk membuka modal gambar
        function openModal(imgSrc) {
            const modal = document.getElementById('myModal');
            const modalImg = document.getElementById('modalImg');
            modal.style.display = "flex";
            modalImg.src = imgSrc;
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            const modal = document.getElementById('myModal');
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            const modal = document.getElementById('myModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
