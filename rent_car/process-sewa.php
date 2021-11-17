<?php
include "connection.php";
# menampung data yang dikirim
$kode_sewa = $_POST["kode_sewa"];
$tgl_sewa = $_POST["tgl_sewa"];
$id_pelanggan = $_POST["id_pelanggan"];
$id_karyawan = $_POST["id_karyawan"];
$mobil = $_POST["isbn"]; // array

# perintah SQL untuk insert ke tabel sewa
$sql = "insert into sewa values
('$kode_sewa','$tgl_sewa',
'$id_pelanggan','$id_karyawan')";

if (mysqli_query($connect, $sql)) {
    # jika berhasil insert ke tbl sewa
    # insert ke tabel detail_sewa
    for ($i=0; $i < count($mobil); $i++) { 
        $isbn = $mobil[$i];
        $sql = "insert into detail_sewa values
        ('$kode_sewa','$isbn')";
        if (mysqli_query($connect, $sql)) {
            # jika berhasil insert ke tabel detail sewa
            # bisa lanjut
        } else {
            # jika gagal insert ke table detail_sewa
            echo mysqli_error($connect);
            exit;
        }
    }
    header("location:list-sewa.php");
} else {
    # jika gagal insert ke tbl sewa
    echo mysqli_error($connect);
}
?>