<?php
session_start();
# jika saat load halaman ini, pastikan telah login
# sbg petugas
if (!isset($_SESSION["petugas"])) {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>List Karyawan</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="text-white">
                    Daftar Karyawan
                </h4>
            </div>

            <div class="card-body">
                <form action="list-karyawan.php" method="get">
                <input type="text" name="search" 
                    class="form-control mb-2"
                    placeholder="Search Your Data">
                </form>
                <ul class="list-group">
                    <?php
                    include("connection.php");
                    if (isset($_GET["search"])) {
                        # menegecek apakah ada data dgn method GET dgn nama "search"
                        $search = $_GET["search"];
                        $sql = "select * from petugas
                        where nama_karyawan like '%search%'
                        or alamat_karyawan like '%search%'
                        or kontak like '%search%'
                        or username like '%search%'";
                    } else {
                        $sql = "select * from karyawan";

                    }
                    # eksekusi SQL
                    $hasil = mysqli_query($connect, $sql);
                    while ($karyawan = mysqli_fetch_array($hasil)) {
                        ?>
                        </li class="list-group-item">
                             <div class="row">
                                <div class="col-lg-8 col-md-10">
                                    <h4>Nama Karyawan: <?php echo $karyawan["nama_karyawan"];?></h4>
                                    <h6>Alamat Karyawan: <?php echo $karyawan["alamat_karyawan"]?></h6>
                                    <h6>kontak: <?php echo $karyawan["kontak"];?></h6>
                                    <h6>username: <?php echo $karyawan["username"];?></h6>
                                </div>
                            </div>
                         </li>
                        <?php
                    }
                    ?>
                </ul>
                <!-- button tambah data -->
                <a href="form-karyawan.php">
                    <button class="btn btn-success">
                        Tambah Data Karyawan                 
                     </button>
                </a>
            </div>
        </div>
    </div>
</body>