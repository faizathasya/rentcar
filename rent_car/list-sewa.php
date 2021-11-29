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
    <title>Daftar Penyewaan Mobil</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
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
                     Daftar Penyewaan Mobil
                </h4>
            </div>

            <div class="card-body">
               <ul class="list-group">
                    <?php
                    include "connection.php";
                    $sql = "select 
                    sewa. *, pelanggan.*, karyawan.*,
                    penyewaan.id_pengembalian,penyewaan.tgl_pengembalian,
                    sewa.total_bayar
                    from
                    sewa inner join pelanggan
                    on pelanggan.id_pelanggan=sewa.id_pelanggan
                    inner join karyawan
                    on sewa.id_karyawan=karyawan.id_karyawan
                    left outer join penyewaan
                    on sewa.id_sewa=penyewaan.id_sewa
                    order by sewa.tgl_sewa desc";

                    $hasil = mysqli_query($connect, $sql);
                    while ($sewa = mysqli_fetch_array($hasil)) {
                        ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <small class="text-info">Kode sewa</small>
                                    <h5><?=($sewa["id_sewa"])?></h5>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                <small class="text-info">Peminjam</small>
                                    <h5><?=($sewa["nama_pelanggan"])?></h5>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                <small class="text-info">karyawan</small>
                                    <h5><?=($sewa["nama_karyawan"])?></h5>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                <small class="text-info">Tgl. sewa</small>
                                    <h5><?=($sewa["tgl_sewa"])?></h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <h6>
                                        Status :
                                        <?php if ($sewa["id_pengembalian"] == null) { ?>
                                            <div class="badge badge-warning">
                                                Masih Disewa 
                                            </div>
                                            <a href="process-kembali.php?id_sewa=<?=$sewa["id_sewa"]?>"
                                            onclick="return confirm('Kamu yakin ingin kembali?')">
                                            <button class="btn btn-sm btn-success mx-2">
                                               Kembalikan
                                            </button>
                                            </a>

                                        <?php } else {?>
                                            <div class="badge badge-success">
                                                Sudah Dikembalikan 
                                            </div>
                                            <div class="badge badge-danger">
                                                Denda : Rp <?=(number_format($sewa["total_bayar"],2))?>
                                            </div>
                                            <div class="badge badge-info">
                                                Total Bayar : Rp <?=(number_format($sewa["total_bayar"],2))?>
                                            </div>
                                        <?php } ?>
                                    </h6>
                                </div>
                            </div>

                            <small class="text-success">
                                List mobil yang disewa
                            </small>

                            <ul>
                                <?php
                                $id_sewa = $sewa["id_sewa"];
                                $sql = "select * from detail_sewa 
                                inner join mobil 
                                on detail_sewa.id_mobil = mobil.id_mobil
                                where detail_sewa.id_sewa = '$id_sewa'";
                                
                                $hasil_mobil = mysqli_query($connect, $sql);
                                while ($mobil = mysqli_fetch_array($hasil_mobil)) {
                                    ?>
                                    <li>
                                        <small>
                                            <?=($mobil["jenis"])?>
                                            <i class="text-primary">
                                                (Merk <?=($mobil["merk"])?>)
                                            </i>
                                        </small>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>
               </ul>
            </div>
        </div>
        <div clas="card-footer bg-success">
        <a href="form-sewa.php">
                    <button class="btn btn-success form-control"> 
                        Add Sewa
                    </button>
                </a>
        </div>
    </div>
</body>
</html>