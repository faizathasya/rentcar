<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Form Sewa Mobil</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class=" text-white">
                    Form Sewa Mobil
                </h4>
            </div>

            <div class="card-body">
                <form action="process-sewa.php" 
                method="post">
                     <!-- input kode sewa -->
                Kode Peminjaman
                <input type="text" name="id_sewa" 
                class="form-control mb-2" required>

                <!-- tgl_sewa dibuat otomatis -->
                <?php
                date_default_timezone_set('Asia/Jakarta');
                ?>
                Tanggal sewa
                <input type="text" name="tgl_sewa" 
                class="form-control mb-2" readonly
                value="<?=(date("Y-m-d H:i:s"))?>">

                <!-- pilih anggota melalui nama -->
                Pilih Data Anggota
                <select name="id_anggota"
                class="form-control mb-2" required>
                <?php
                include "connection.php";
                $sql = "select * from anggota";
               
                $hasil = mysqli_query($connect, $sql);
              
                while ($anggota = mysqli_fetch_array($hasil)) {
                    ?>
                    <option value="<?= ($anggota["id_anggota"])?>">
                        <?= ($anggota["nama_anggota"])?>
                    </option>
                    <?php
                }
                ?>
                </select>

                <!-- petugas ambil data login -->
                <input type="hidden" name="id_petugas"
                value="<?=($_SESSION["petugas"]["id_petugas"])?>">

                Petugas
                <input type="text" name="nama_petugas"
                class="form-control mb-2" readonly
                value="<?=($_SESSION["petugas"]["nama_petugas"])?>">

                <!-- tampilkan pilihan buku yang akan disewa -->
                Pilih buku yang akan disewa
                <select name="isbn[]" class="form-control mb-2"
                required multiple="multiple">
                <?php
                $sql = "select * from buku";
                $hasil = mysqli_query($connect, $sql);
                while ($buku = mysqli_fetch_array($hasil)) {
                    ?>
                    <option value="<?=($buku["isbn"])?>">
                    <?=($buku["judul_buku"])?>
                    </option>
                    <?php

                }
                ?>
                </select>

                <button type="submit" 
                class="btn btn-block btn-dark">
                sewa
                </button>
                </form>
               
                
            </div>
        </div>
    </div>
</body>
</html>