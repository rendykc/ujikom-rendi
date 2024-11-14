<?php 
    session_start();

    if(!isset($_SESSION["login"])){
        header("Location:login.php");
    }

    require"function.php";
    $datas= query("SELECT * FROM albumfoto");

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"
</head>
<body>


<!-- navbar -->

   <div class="wrap-card">
   <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">galeri</a>
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
          <a class="nav-link" href="logout.php">logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <h1>Data Album Foto</h1>
    <span>
        <a href="tambah.php">Tambah Data</a> 
        <a href="logOut.php">Log Out</a>
    </span>
    <table  >
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Action</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php    $i=1; ?>
            <?php foreach($datas as $key){ ?>
                <tr>
                    <td> <?= $i; ?> </td>
                    <td><img src="img/<?= $key["foto"]; ?> " width="100px"></td>
                    <td><?= $key["judul"]; ?></td>
                    <td><?= $key["deskripsi"]; ?></td>
                    
                    <td>
                        <a href="hapus.php?id=<?= $key["id"] ?>" onclick="return confirm('yakin?')">hapus</a> | 
                        <a href="update.php?id=<?= $key["id"] ?>">ubah</a>
                    </td>
                </tr>
            <?php  $i++; ?>  
            <?php }; ?>
            
        </tbody>
    </table>
    </div>
</body>
</html>