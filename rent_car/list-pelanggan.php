<?php 
session_start();
# jika saat load halaman ini, pastikan telah login sebagai karyawan
if (!isset($_SESSION["karyawan"])) {
    header("Location:login.php");
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>List Pelanggan</title>
</head>
<body>
    <div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
  <a class="navbar-brand" href="RENTAL-MOBIL/list-sewa.php"> RENT CAR</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="list-mobil.php"> Mobil <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link active" href="list-pelanggan.php"> Pelanggan <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link active" href="list-karyawan.php"> Karyawan <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link active" href="list-sewa.php"> Sewa <span class="sr-only">(current)</span></a>
    </div>
  </div>
  <form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav>
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="text-white">
                    Daftar Pelanggan
                </h4>
            </div>

            <div class="card-body">
                <form action="list-pelanggan.php" method="get">
                    <input type="text" name="search"
                    class="form-control mb-2" placeholder="Pencarian" />
                </form>

                <ul class="list-group">
                    <?php
                    include "connection.php";
                    if (isset($_GET["search"])) {
                        $search = $_GET["search"];
                        $sql = "select * from pelanggan
                        where nama_pelanggan like '%$search%'
                        or kontak like '%$search%'
                        or alamat_pelanggan like '%$search%'";
                    } else {
                        $sql =" select * from pelanggan";
                    }

                    $hasil = mysqli_query($connect, $sql);
                    while ($pelanggan = mysqli_fetch_array($hasil)) {
                        ?>
                        <li class="list-group-item mb-2">
                            <div class="row">
                                <div class="col-lg-9">
                                    <h4>
                                        <?=($pelanggan["nama_pelanggan"])?>
                                    </h4>

                                    <h6>Kontak: <?=($pelanggan["kontak"])?></h6>
                                    <h6>Alamat: <?=($pelanggan["alamat_pelanggan"])?></h6>
                                </div>
                                <div class="col-lg-3">
                                <a href="form-pelanggan.php?id_pelanggan=<?php echo $pelanggan["id_pelanggan"];?>">
                                        <button class="btn btn-info btn-block mb-2">
                                            Edit
                                        </button>
                                </a>

                                </a>
                                
                                    <a href="process-pelanggan.php?id_pelanggan=<?=$pelanggan["id_pelanggan"]?>"
                                    onClick="return confirm('Apakah Anda Yakin?')">

                                <button class="btn btn-block btn-danger">
                                    Hapus
                                </button>
                                </a>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                    
                </ul>

                <!-- button tambah data -->
                <a href="form-pelanggan.php">
                    <button class="btn btn-success">
                        Tambah Data pelanggan                  
                     </button>
                </a>
            </div>
        </div>
    </div>
</body>
</html>